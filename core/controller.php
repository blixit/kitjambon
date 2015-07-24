<?php
class Controller {

    public $request;
    private $vars = array();
    public $rendered;
    public $menuRendered = false;
    public $layout = 'default';
    public $getMenu = null;
    public $models = array('default'=>'membre');
    public $getModels = array();
    public $params = array();
    public $nbParamInUrl = 0;
    public $session = null;
    public $initialTime = 0;
    public $loaded = false;  

    function __construct($request){ 
		$this->loaded = true;
		$this->request = $request;
		$this->rendered = false;
		if(isset($request) && !$request->is('external'))
			$this->set('caller','?'.trim($request->is('query'),'/'));
    }
    //génération du html
    public function render($view){
            if(!$this->rendered){ //par sécurité car require_once bloque les doubles inclusions
            // time
                    $this->set('generationTime',$this->generationTime());
                    extract($this->vars);
                    if(strpos($view,'/')===0)
                            $view = ROOT.DS.'view'.$view.'.php';
                    else
                            $view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';

                    ob_start();
                    require_once $view;
                    $content_for_layout = ob_get_clean();

                    require_once ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
                    $this->rendered = true;
                    return true;
            }
            return false;
    }
    //génération du menu
    public function renderMenu($menu){
            if(!$this->menuRendered){ //par sécurité car require_once bloque les doubles inclusions
                    extract($this->vars);
                    if(strpos($menu,'/')===0)
                            $menu = COMPOSANTS.$menu.'.php';
                    else
                            $menu = COMPOSANTS.DS.$menu.'.php';
                    ob_start();
                    require_once $menu;
                    $content_for_menu = ob_get_clean();
                    $this->menuRendered = true;
                    return $content_for_menu;
            }
            return false;
    }
    //enregistrement des variables
    public function set($key,$value=null){
            if(is_array($key)){
                    $this->vars += $key; 
            }else{
                    $this->vars[$key] = $value; 
            }
    }
    //chargement du modèle
    public function loadModel($name,$configName=''){
            $file = MODEL.DS.$name.'.php'; //on inclut le model
            if(!file_exists($file)){
                    return false; 
            }
            require_once $file;
            if(!isset($this->$name)){
                    $this->$name = new $name(!empty($configName) ? $configName : ''); 
                if(!$this->$name) return false;
            }
            return true;
    }
    public function error($message){
            header("HTTP/1.0 404 Not Found");
            $this->getMenu =  $this->renderMenu('menu');
            $this->set('content_for_menu',$this->getMenu);
            $this->set('message',$message); 
            $this->render('/errors/404');
                    exit;
    }
    public function redirect($link,$code=303,$name='See Other'){      
            
            header("HTTP/1.0 $code $name");
            header('Location: '.$link);
                    exit;
    }
    public function controlParam(){
        return true;
    }
    public function generationTime(){
                    return round(microtime(true)-$this->initialTime,5);
            }
    public function myrender($options){
        //title, menu et render
        $variables = array();
        $variables['title_for_layout'] = isset($options['title']) ? strtoupper($options['title']) : constant('site_i_name');

        $this->getMenu = $this->renderMenu(isset($options['menu']) ? $options['menu'] : 'menu');
        $variables['content_for_menu'] = $this->getMenu;

        if(isset($options['variables'])){
            $variables += $options['variables']; 
        }
        $this->set($variables);
        return $this->render($options['view']);
    }
} 