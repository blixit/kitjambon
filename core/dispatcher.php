<?php
class Dispatcher{

    var $request;
    var $initialTime;

    function __construct(){
        $this->request = new Request();
        if(strrpos($this->request->url, '?'))
            Router::parse(substr($this->request->url,2,strlen($this->request->url)-2),$this->request);
        else
            Router::parse($this->request->url,$this->request);
        //controller est une variable temporaire à ne pas confondre avec request->controller
        $controller = $this->loadController(); 

        if($controller && !(sizeof($this->request->params) < $controller->nbParamInUrl)){
            $controller->session = new Session(); 

            //pour les redirections après connexions
            if(($this->request->controller.DS.$this->request->action) != "membre/login")
                $_SESSION['caller'] = trim($this->request->url,'/');
                if($this->request->controller == "ajax")
                    $_SESSION['caller'] = "?accueil";
                //$_SESSION['caller'] = '?'.$this->request->controller.DS.$this->request->action;
                        
            // récupération des  modèles par défaut
            foreach($controller->models as $v){
                $tmp = $controller->loadModel($v);
                if($tmp)
                    $controller->getModels[$v] = $tmp;
                else{
                    $this->error("Une erreur [PSID ". __LINE__ ." : ".$v."] est survenue.");
                exit;
                }
            }
            // test et exécution de la méthode appelée
            if(!in_array($this->request->action,get_class_methods($controller))){
                    if(Conf::DEBUG) 
                        $this->error('Le controller '.$this->request->controller." n'a pas de méthode (".$this->request->action.")");
                    else 
                        $this->error('Le chemin '.$this->request->action." n'existe pas.");
            }
            else{

                    //récupération des paramètres par défaut
                    //params est un tableau défini dans la classe request, voir core/request.php
                    if(!$this->request->params)
                            $this->request->params = $controller->params;

                    call_user_func_array(
                            array($controller,$this->request->action),
                            $this->request->params
                    );

                    if(!isset($controller->getMenu)){
                            $controller->getMenu =  $controller->renderMenu('menu');
                            $controller->set('content_for_menu',$controller->getMenu);
                    }
                    if(!$controller->rendered)
                            $controller->render($this->request->action);
            }
        }else{
            if(!$controller){
                if(Conf::DEBUG) $this->error('Le controller '.$this->request->controller." n'existe pas.");
                else $this->error('Le chemin '.$this->request->controller." n'existe pas.");
            }
            else if(sizeof($this->request->params) < $controller->nbParamInUrl){
                if(Conf::DEBUG) $this->error("Une erreur [PSID ". __LINE__ ." : ] est survenue : Le nombre de paramètres est insuffisant.");
                else $this->error("Une erreur [PSID ". __LINE__ ." : ] est survenue.");
            }
        }
    }
    function error($message){
        if(!headers_sent())
            header("HTTP/1.0 404 Not Found");
        $controller = new Controller($this->request);
        $controller->getMenu =  $controller->renderMenu('menu');
        $controller->set('content_for_menu',$controller->getMenu);
        $controller->set('message',$message);
        $controller->render('/errors/404');
    }
    function loadController(){
        if(empty($this->request->controller)){
            $this->request->controller = 'accueil';
            $this->request->action = 'index';
        }
        $name = ucfirst($this->request->controller).'Controller'; //Functions::debug($name);
        $file = ROOT.DS.'controller'.DS.$name.'.php';   
        if(!file_exists($file)){
        	$this->error("Une erreur [PSID ". __LINE__ ." : ] est survenue. ");
        	return null;
        }
        require_once $file; 

        return new $name($this->request);
    }

} 