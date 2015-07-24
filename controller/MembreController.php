<?php
class MembreController extends Controller{

    public $models = array(
            'default'=>'membre',
            'default2'=>'reseau',
            'default3'=>'groupe',
            'default4'=>'contact_membre',
            'default5'=>'history',
            );
    public $params = array(
            'default'=>'',
    );

    function __construct($request){			
        parent::__construct($request);
        $this->layout = 'default'; 
        if($this->request->action=='view'){
            $this->nbParamInUrl=1;
        }
        if($this->request->action=='passinit'){
            $this->nbParamInUrl=1;
        }
        if($this->request->action=='suscribe'){
            $this->nbParamInUrl=2;
        }
    }
    function controlParam(){
        //un seul param, dc on récupère le 1er
        $cond = false;
        $p = current($this->request->params);
        
        /* Si l'action est view: on vérifie que l'utilisateur existe et a un compte valide */
        if($this->request->action=='view'){
            $user = $this->membre->findFirst(array(
                'tables' => 'membre',
                'conditions' => ' mem_id = '.$p,
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            $cond = ((!empty($user)) && is_numeric($p));
        }
        /* Si l'action est liste: on vérifie que le format est numérique */
        if($this->request->action=='liste'){ 
            $cond1 = (is_numeric($p));
            $cond2 =  (isset($this->request->params[1])) ? (is_numeric($this->request->params[1]) ? true : false) : true;  
            $cond = $cond1 && $cond2;
        }
        /*Si l'action est passinit: */
        if($this->request->action=='passinit'){
            $user = $this->membre->findFirst(array(
                'tables' => 'membre',
                'conditions' => 'mem_renew_pass = \''.$p.'\'',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            $cond =(!empty($user));
        } 
        /*Si l'action est activation: */
        if($this->request->action=='activation'){
            $user = $this->membre->findFirst(array(
                'tables' => 'membre',
                'conditions' => 'mem_etat = 0 AND mem_token = \''.$p.'\'',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            $cond1 =(!empty($user));
            $cond2 =(!empty($p));
            $cond = ($cond1 && $cond2);
        } 

        /*Si l'action est suscribe: */
        if($this->request->action=='suscribe'){
            $p = $this->request->params; 
            $cond0 = count($p)==2 ? true : false; 
            if($cond0 && $p[0] == '0' && $p[1]=='0') // auto-inscription
                return true;
            //inscription suite à un parrainage
            $cond1 = PregFucntions::verifyEmail($p[0]); 
            $cond2 = PregFucntions::verifyAlphaNum($p[1]); 
            $parrain = $this->membre->findFirst(array(
                'tables' => 'parrainage',
                'conditions' => 'valide = 0 AND token = \''.$p[1].'\''. " AND fillot_mail = '".$p[0]."'",
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 
            $cond3 =($parrain); 
            $cond = ($cond0 && $cond1 && $cond2 && $cond3);
        } 

        return $cond;
    }
    function view($id){
        //si pas connecté on redirige vers la page de connexion
        if(!$this->session->islogged()){
            $this->redirect("?membre/login/"); 
        }
        // si les paramètres sont pas bon on génère une erreur
        if(!$this->controlParam()){
            $this->error((Conf::DEBUG) ?
                    "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'a pas le bon type ou est mal configuré, ou l'utilisateur n'existe pas." : "L'url spécifiée n'existe pas."
             );
        }
        //on vérifie si la connexion est celle d'un admin
        $compteAdmin = $this->session->isloggedAsAdmin();
        $variables['compteAdmin'] = $compteAdmin;
        
        //on récupère l'utilisateur qu'on veut visualiser
        $user = $this->membre->findFirst(array(
            'tables' => 'membre',
            'conditions' => 'mem_id = '.$id,
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));
        
        //si l'utilisateur à visualiser est l'utilisateur lui-même
        $monCompte = ($user['mem_login'] == $_SESSION['membre']['mem_login']);
        $variables['monCompte'] = $monCompte;
        
        /* Données sensibles : à ne montrer qu'à l'intéressé ou aux admins 
         * Si celui qui regarde n'est pas autorisé, on modifie ces infos
         */
        if(!($compteAdmin || $monCompte)){
                $user['mem_mail'] = '--Information non publique--'; //à reconsidérer en fonction des souhaits de l'user
                $user['mem_etat'] = ($user['mem_etat']==0) ? '--Compte non validé.--' : '--Compte validé.--';
        }
        $variables['user'] = $user;

        /* On récupère les réseaux et groupes du concerné */
        $variables['sesReseaux'] = $this->reseau->find(array(
            'tables' => 'reseau r NATURAL JOIN reseau_membre rm',
            'conditions' => 'rm.mem_id = '.$user['mem_id'],
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));
        $variables['sesGroupes'] = $this->groupe->find(array(
            'tables' => 'groupe g NATURAL JOIN groupe_membre gm',
            'conditions' => 'gm.mem_id = '.$user['mem_id'],
            'fecthMethod' => PDO::FETCH_ASSOC,
        )); 
        $interaction = $this->contact_membre->findFirst(array(
            'tables' => 'contact_membre',
            'conditions' => "(mem_id_1 =".$user['mem_id']." AND mem_id_2 =".$_SESSION['membre']['mem_id']." ) OR "
                           ."(mem_id_2 =".$user['mem_id']." AND mem_id_1 =".$_SESSION['membre']['mem_id']." )",
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));
        $variables['interaction'] = $interaction; 
        //Functions::debug($interaction);
        //si vous avez une interaction sous la forme d'échange de contacts, alors ne plus proposer le bouton mail|phone|facebook
        $variables['contactMe'] = ($interaction===false) ? true : false; 
        
        //génération du token
        //ca permettra de vérifier que l'utilisateur est bien passé par la page view et non par un autre moyen comme le lien
        Session::addToken(array(
            'name' => 'vueUtilisateurenCours'.$user['mem_id'],
            'limit_time' => Conf::SESSION_TIME,  
            'time' => time(),
            'erase' => true
        ));  
        
        $list = Script::_multi_script(array(
                array(
                        'action' => 'click',
                        'element' => '#',
                        'name' => '', 
                        'code' => ""
                ), 
                array(
                        'type' => '_query',
                        'action' => 'click',
                        'element' => '#send_mail',
                        'name' => 'send_mail',  
                        'code' => 'window.location.reload();',  
                        'toReload' => '#rien',  
                        'query' => urlencode(
                                        'mode:mail' //pour l'instant on ne gère que les mails
                                        .'|user:'.$user['mem_id']
                                        .'|username:'.$user['mem_login']
                                        .'|concerne:'.$_SESSION['membre']['mem_login']
                                        .'|resume:'.$_SESSION['membre']['mem_login']." veut entrer en contact avec vous. Voici son mail  ".$_SESSION['membre']['mem_mail']
                                        ),  
                        'reponse' => '#reponse',  
                        'method' => 'GET',  
                        'url' => '?ajax/send/',  
                        'time' => '3000',  
                ),
                array(
                        'type' => '_query',
                        'action' => 'click',
                        'element' => '#accepte_demande',
                        'name' => 'accepte_demande',  
                        'code' => 'window.location.reload();',  
                        'toReload' => '#rien', // on recharge la page 
                        'query' => urlencode($interaction['mem_id_1'].':'.$interaction['mem_id_2']
                            ),  
                        'reponse' => '#reponse_accepte_demande',  
                        'method' => 'GET',  
                        'url' => '?ajax/accepte_demande/',  
                        'time' => '3000',  
                )));  
        /*Les champs obligatoires pour le type _query : toReload, "query, #element, #reponse , "method, "url*/
         
        $variables['mesScripts'] = $list['s']; //définitions des fonctions => dans le header
        $variables['mesScriptsFunc'] = $list['d']; // appels des fonctions définis => dans le footer

        $this->myrender(array(
            'menu' => 'menu',
            'title' => $user['mem_login'],
            'view' => 'view',
            'variables' => $variables,
        ));
    }
    function liste($page=null,$eix=null){
        //si pas connecté on redirige vers la page de connexion
        if(!$this->session->islogged()){
            $this->redirect("?membre/login/"); 
        }
        // si les paramètres sont pas bon on génère une erreur
        if(!$this->controlParam()){
            $this->error((Conf::DEBUG) ?  "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'a pas le bon type ou est mal configuré, ou l'utilisateur n'existe pas." : "L'url spécifiée n'existe pas.");
        }

        $MAX_USERS_PER_PAGE = 10;
        $variables['MAX_USERS_PER_PAGE'] = $MAX_USERS_PER_PAGE; 
        $variables['limit'] = ($page-1).','.($MAX_USERS_PER_PAGE); 
        $variables['pageActive'] = intval((isset($page) ? $page : 1)); 
        $variables['yearRestriction'] = intval((isset($eix) ? $eix : 1));   

        //on définit le nombre de pages
        $v = $this->membre->findFirst(array(
                    'tables' => 'membre',
                    'champs' => ' COUNT(mem_id) as total ', 
                    'conditions' => 'mem_etat=1 AND mem_year = '.$variables['yearRestriction'],
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
        $variables['nbPages'] = ceil($v['total']/$MAX_USERS_PER_PAGE); 

        //si on demande une page particulière
        if($variables['pageActive'] != 1){
            //$page = $variables['pageActive'] ; // page commence à 1 
            //on vérifie que cette page contient du contenu, !!attention requete imbriquée
            $find = $this->membre->findFirst(array(
                'tables' => '(SELECT mem_id, mem_year FROM membre WHERE mem_etat=1 AND mem_year='.$variables['yearRestriction'].' LIMIT '.(($page-1)*$MAX_USERS_PER_PAGE).','.$MAX_USERS_PER_PAGE.' ) as m ',
                'champs' => 'COUNT(mem_id) as total',  
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));               
            if($find!==false && intval($find['total'])>0) { // alors il y a du contenu
                $variables['limit'] =  (($page-1)*$MAX_USERS_PER_PAGE).','.$MAX_USERS_PER_PAGE; 
            }
            else
                $variables['pageActive'] = 1;
        }

        //on vérifie si la connexion est celle d'un admin, pour l'instant ne sert pas vraiment à grand chose. Pourra être utile si on rajoute des fonctionnalités
        $compteAdmin = $this->session->isloggedAsAdmin();
        $variables['compteAdmin'] = $compteAdmin;
        
        //on récupère la liste d'utilisateur par groupe de MAX_USERS_PER_PAGE appartenant à la classe yearRestriction
        $users = $this->membre->find(array(
            'tables' => 'membre',
            'conditions' => 'mem_etat=1 AND mem_year='.$variables['yearRestriction'],
            'limit' => $variables['limit'],
            'order' => ' mem_login ASC ',
            'fecthMethod' => PDO::FETCH_ASSOC,
        )); 

        //on définit le nombre d'utilisateurs
        $nbUsers = $this->membre->findFirst(array(
                    'tables' => 'membre',
                    'champs' => ' COUNT(mem_id) as total ', 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
        $variables['nbUsers'] = $nbUsers['total'];
         
        $variables['users'] = $users; 

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Liste des jambons',
            'view' => 'liste',
            'variables' => $variables,
        ));
    }


    function login(){ 
        if($this->session->islogged()){
            if(isset($_SESSION['caller']))
                $this->redirect($_SESSION['caller']); 
            else
                $this->redirect("?home/"); 
        }             

        $erreurs = array(); 
        $soumis = ($this->request->data) ? $this->request->data : null;  
        $form = array( 'login' => '', 'pass' =>  ''  );
         
        if($soumis){
            // à ce niveau, le formulaire a été envoyé.
            /* Si la requete provient d'un autre site ou n'a pas de http_referer (a été directement écrite dans l'url)
             * on la rejette illico
            */
            //on rejette les requetes extérieures ou tapées dans l'url ou par un autre moyen que post
            if($this->request->is('no-origin')){ 
               $this->error('Erreur [MEM '.__LINE__.'] : La requête a échouée.');
               return false;
            }
            $_SESSION['saveform'] = $soumis;
            unset($soumis); 
            $this->redirect('?membre/login/'); 
        } 
        if(isset($_SESSION['saveform'])){ 
            $soumis = $_SESSION['saveform'];
            unset($_SESSION['saveform']); 
            $form = array(
                'login' =>isset($soumis) ? PregFucntions ::sanitize_string($soumis['login']) : '',
                'pass' =>isset($soumis) ? sha1(PregFucntions ::sanitize_string($soumis['pass'])) : '',
            ); 
            
            $user = $this->membre->findFirst(array(
                'tables' => ' membre ',
                'conditions' => ' mem_etat = 1 AND mem_login = \''.$form['login'].'\' AND mem_pass = \''.$form['pass'].'\'',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            //Functions::debug($user);
            if(!empty($user)){
                $_SESSION['membre'] = $user;
                $_SESSION['loggedIn']='yes';  
                setcookie('loggedAs',$user['mem_token'],time()+3600*5,WEBROOT.DS,'',false);
                setcookie('dejaVenu',$user['mem_token'],time()+3600*5,WEBROOT.DS,'',false);

                $activite = $this->membre->findFirst(array(  
                    'tables'=>'activite_membre',
                    'conditions'=>' id_user = '.$user['mem_id'], 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
                if(empty($activite)) { //aucune activité
                    $this->membre->add(array(  
                        'tables'=>'activite_membre',
                        'champs'=>' id_user ', 
                        'values'=> $user['mem_id'], 
                    )); 
                }
                $this->membre->upDate(array(  
                    'tables'=>'activite_membre',
                    'affectations'=>' nb_connexions = nb_connexions + 1', 
                    'conditions'=> ' id_user = '.$user['mem_id'], 
                )); 


                Session::begin(); 
                if(isset($_SESSION['caller']))
                    $this->redirect(Router::url($_SESSION['caller']));
                else
                    $this->redirect(Router::url('?home/index'));
            }
            elseif(isset($soumis)){
                $erreurs[] = "Désolé, nous n'avons pas trouvé de correspondance.";
                $erreurs[] = "Il se peut que votre compte ne soit pas activé. Veuillez suivre le lien reçu par mail lors de votre inscription.";
            }
        }
        $variables['soumis'] = $soumis;
        $variables['erreurs'] = $erreurs;
        $variables['form'] = $form;

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Espace de connexion',
            'view' => 'login',
            'variables' => $variables,
        ));
    }
    function logout(){
        if(!$this->session->islogged())
            $this->error("Page innacessible.");
        
        Session::kill();
        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Déconnexion',
            'view' => 'logout',
        ));
    }
    function passlost(){
        if($this->session->islogged())
            $this->redirect("?home/");
 
        $erreurs = array();
        $notifications = array();
        $soumis = ($this->request->data) ? $this->request->data : null; 

        $form = array('mail' =>isset($soumis) ? PregFucntions::sanitize_string($soumis['mail']) : '');

        $user = $this->membre->findFirst(array(
            'tables' => ' membre ',
            'conditions' => ' mem_mail = \''.$form['mail'].'\'',
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));

        if(!empty($user)){ 
            //Envoyer le mail
            if($this->mail(array(
                'config' => 'nacder.net',
                'destinataire' => $user['mem_mail'],
                'expediteur' => Conf::$mail['default']['no-reply'],
                'aliasExpediteur' => constant('site_i_name'),
                'objet' => "[".constant('site_i_name')."] - Votre mot de passe ", 
                'message' =>  Mail::_messagePassLost(array( 
                                        'mem_renew_pass' => $user['mem_renew_pass'],
                                        'logo' => Conf::$mail['default']['logo'],
                                    ))
            )))
            {
                $notifications[] = "Un mail vous a été envoyé. Veillez suivre les  instructions qui l'accompagnent pour renouveller votre mot de passe. ";
                $notifications[] = 'N\'oubliez pas de vérifier vos spams.';
            }
            else{
                $erreurs[] = "Une erreur est survenue pendant l'envoie du message. Veuillez ressayer plus tard. Merci.";
            }

        }
        elseif(isset($soumis)){
            $erreurs[] = "Désolé, cet identifiant est inexistant. Veuillez vérifier le format de l'url. ";
        }
        $variables['soumis'] = $soumis;
        $variables['erreurs'] = $erreurs;
        $variables['notifications'] = $notifications;
        $variables['form'] = $form;
        $this->set($variables);
        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Mot de passe',
            'view' => 'passlost',
            'variables' => $variables,
                    ));
    }
    function passinit($token){
        if($this->session->islogged())
            $this->redirect("?home/");

        if(!$this->controlParam())
            $this->error((Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'a pas le bon type ou est mal configuré, ou l'utilisateur n'existe pas." : "L'url spécifiée n'existe pas.");
        
        $data=null;
        $erreurs = array();
        $notifications = array();
        if($this->request->data)
            $data = $this->request->data;
        $soumis = $data;
        $form = array();

        if($data){
            $_SESSION['save_form'] = $data;
            unset($data);
            $this->redirect('?membre/passinit/'.$token);
        }
        if(isset($_SESSION['save_form'])){
            $data = $_SESSION['save_form']; 
            unset($_SESSION['save_form']);
            $form = array(
                'pass' =>isset($data) ? $data['pass'] : '',
                'pass2' =>isset($data) ? $data['pass2'] : '',
                'renew_pass' =>isset($data) ? $data['renew_pass'] : '',
                'mail' =>isset($data) ? $data['mail'] : '',
            );
            if(PregFucntions::verifyLength($form['pass'],8,50)){
                if(!empty($form['pass']) &&  $form['pass'] == $form['pass2'] ){
                //user
                    $user = $this->membre->findFirst(array(
                            'tables' => ' membre ',
                            'conditions' => " mem_renew_pass = '".$form['renew_pass']."'",
                    'fecthMethod' => PDO::FETCH_ASSOC,
                        ));

                    if(!empty($user)){
                        $form['pass'] = sha1($form['pass']);
                        do
                            $form['renew_pass'] = 'KIT'.rand(1,9999999).'c';
                        while($this->membre->findFirst(array(
                                'tables' => ' membre ',
                                'champs' => ' mem_renew_pass ',
                                'conditions' => " mem_renew_pass = '".$form['renew_pass']."'"
                            )));

                        if($this->membre->upDate(array(
                            'tables' => ' membre ',
                            'conditions' => ' mem_mail = \''.$form['mail'].'\' AND mem_renew_pass = \''.$user['mem_renew_pass'].'\' ',
                            'affectations' => ' mem_pass = \''.$form['pass'].'\', mem_renew_pass = \''.$form['renew_pass'].'\', mem_etat = 1 ',
                        ))){
                            if($this->membre->upDate(array(
                                'tables' => ' openu_users ',
                                'conditions' => ' email = \''.$form['mail'].'\' ',
                                'affectations' => ' password = \''.$form['pass'].'\' ',
                            ))){
                                $notifications[] = "Votre mot de passe a été parfaitement enregistré.";
                            }
                        }
                        else
                            $erreurs[] = "Une erreur est survenue lors de la mise à jour. Veuillez réessayer plus tard. Merci de votre compréhension.";

                    }
                    else{
                        $erreurs[] = "Ces données ne sont plus valables ou ne l'ont jamais été.";
                        $erreurs[] = "Assurez-vous d'avoir indiqué le code le plus récent reçu par mail.";
                    }
                }
                else
                    $erreurs[] = "Les 2 mots de passe doivent concorder.";
            }
            else
                $erreurs[] = "Le mot de passe doit contenir entre 8 et 50 caractères.";
        }

        $variables['token'] = $token;
        $variables['soumis'] = $data;
        $variables['erreurs'] = $erreurs;
        $variables['notifications'] = $notifications;
        $variables['form'] = $form;

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Restauration de mot de passe',
            'view' => 'passinit',
            'variables' => $variables,
                    ));
    }
    function suscribe($param_mail,$param_mail_token){
        if($this->session->islogged()) 
            $this->redirect("?home/"); 

        if(!$this->controlParam())
            $this->error((Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'a pas le bon type ou est mal configuré, ou l'utilisateur n'existe pas." : "L'url spécifiée n'existe pas.");
         
        $erreurs = array();
        $notifications = array();
        $soumis = ($this->request->data) ? $this->request->data : null;  
        $form = array( 'mail' =>$param_mail, 'pass' =>'', 'pass2' =>'',  'login' =>'', 'temperament' =>'', );
        
        if(Session::getToken('inscription')===false){ 
            Session::addToken(array(
                'name' => 'inscription',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
            ));
        }
        $token = Session::getToken('inscription'); 
        
        if($soumis){
            // à ce niveau, le formulaire a été envoyé.
            /* Si la requete provient d'un autre site ou n'a pas de http_referer (a été directement écrite dans l'url)
             * on la rejette illico
            */
            //on rejette les requetes extérieures ou tapées dans l'url ou par un autre moyen que post
            if($this->request->is('no-origin') || !Session::isValidToken('inscription')){
               $message = 'Erreur [MEM '.__LINE__.'] : La requête a échouée. Veuillez réactualiser la page.';
               $this->error($message);
               return false;
            }
            //on vérifie aussi que le token enregistré et celui envoyé sont les mêmes
            if($token['value']!==$soumis['token'])   
                $this->redirect('?membre/suscribe/'.$param_mail.'/'.$param_mail_token);   
             
            if(empty($erreurs)){
                $_SESSION['saveform'] = $soumis;
                unset($soumis);  
                $this->redirect('?membre/suscribe/'.$param_mail.'/'.$param_mail_token);   
             
            }
        }
        if(isset($_SESSION['saveform'])){ 
            $soumis = $_SESSION['saveform'];
            unset($_SESSION['saveform']); 
            if(!Session::isValidToken('inscription')){ 
                $this->error("Le temps de soumission est dépassé. Veuillez recharger la page.");
                return false;
            }
            
            $form = array(
                'mail' =>  PregFucntions::sanitize_string($soumis['mail']),
                'pass' => PregFucntions::sanitize_string($soumis['pass']),
                'pass2' => PregFucntions::sanitize_string($soumis['pass2']),
                'login' => PregFucntions::sanitize_string($soumis['login']),
                'year' => PregFucntions::sanitize_string($soumis['year']),  
		        'ue' => PregFucntions::sanitize_string($soumis['ue']),
                'temperament' => PregFucntions::sanitize_string($soumis['temperament']),
                'renew_pass' => Session::genereToken(),
                'droit' => 'user',
                'etat' => 0, 
            );
            
            //on s'assure que le cours corrsepond à l'année Ex: algpr => ei1
            $find = $this->reseau->find(array( 
                    'conditions' => 'net_niveau = '.$form['year'].' AND net_nom = '.Functions::squote($form['ue']).' ',
                    'fecthMethod' => PDO::FETCH_ASSOC
            ));
            if(!$find)
                $erreurs[] = "L'ue ne correspond pas à l'année choisie."; 
            if(!(substr($form['mail'], strrpos($form['mail'], '@')) === '@eleves.ec-nantes.fr'))
                $erreurs[] = "Vous n'êtes pas de l'école Centrale. Il vous faut un mail du type xxx@eleves.ec-nantes.fr";
            if( !PregFucntions::verifyAlphaNum($form['login'])) 
                    $erreurs[] = "Le login ne doit contenir que des caractères alphanumériques, espaces, tirets et apostrophes";
            if(!PregFucntions::verifyLength($form['login'],6,30)) 
                    $erreurs[] = "Le login doit contenir entre 6 et 30 caractères, le login entre 6 et 30.";
            if(!is_string($form['temperament'])) 
                    $erreurs[] = "Le tempérament ne doit contenir que des lettres."; 
            if(!PregFucntions::verifyLength($form['temperament'],6,30)) 
                    $erreurs[] = "Le tempérament doit contenir entre 6 et 30 caractères.";
            if(!PregFucntions::verifyLength($form['pass'],8,15)) 
                    $erreurs[] = "Le mot de passe doit contenir entre 8 et 15 caractères";
            if($form['pass']!=$form['pass2']) 
                    $erreurs[] = "Les 2 mots de passe doivent concorder";
            if(!PregFucntions::verifyPassword($form['pass']))
                    $erreurs[] = "Le mot de passe ne doit contenir que des lettres, des chiffres ou les caractères suivants -.?!'\" ";
            
            if(empty($erreurs)){ 
                $user = $this->membre->findFirst(array( 
                    'conditions' => " mem_login = ".Functions::squote($form['login'])." OR mem_mail = ".Functions::squote($form['mail']),
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));

                if(empty($user)){
                    // inscription
                    $this->membre->add(array(
                        'tables' => ' membre ',
                        'values' => " ''"
                            .",".Functions::squote($form['mail']). ",".Functions::squote($form['login'])
                            .",".Functions::squote(sha1($form['pass'])).",".Functions::squote($form['droit'])
                            .",".$form['year'].",".Functions::squote($form['ue'])
                            .",".Functions::squote(Session::genereToken()).",".Functions::squote($form['temperament'])
                            .","."NOW()".",".Functions::squote($form['etat'])
                            .",".Functions::squote(Session::genereToken()) 
                    ));
                    //on vérifie qu'il est bien inscrit
                    $user = $this->membre->findFirst(array( 
                        'conditions' => " mem_login = ".Functions::squote($form['login']),
                        'fecthMethod' => PDO::FETCH_ASSOC,
                    ));
                    //GESTION DU PARRAINAGE
                    if($param_mail_token!='0' && $param_mail!='0' ){ // cas de l'inscription par parrainage 
                        /* Puisque l'utilisateur a entamé la phase d'inscription,
                        on met à jour la table de parrainage ... */
                        $this->membre->upDate(array(
                            'tables' => ' parrainage ',
                            'affectations' => 'valide = 1, heure = NOW(),fillot = '.$user['mem_id'],
                            'conditions' => 'token = \''.$param_mail_token.'\''. " AND fillot_mail = '".$param_mail."'",
                        ));
                        
                        /* ... et on supprime les autres lignes de parrainage qui concerne cette utilisateur*/
                        $this->membre->delete(array(
                            'tables' => ' parrainage ',
                            'conditions' => 'token <> \''.$param_mail_token.'\''. " AND fillot_mail = '".$param_mail."'",
                        ));
                        /* ... pour finir, on récupère le parrain, puis on augmente son nombre de parrainages*/
                        $parrain = $this->membre->findFirst(array(
                            'tables' => 'parrainage',
                            'conditions' => 'token = \''.$param_mail_token.'\''. " AND fillot_mail = '".$param_mail."'",
                            'fecthMethod' => PDO::FETCH_ASSOC,
                        )); 
                        if($parrain){
                            $this->membre->upDate(array(
                                'tables' => ' activite_membre ',
                                'affectations' => ' nb_parrainages = nb_parrainages+1 ',
                                'conditions' => ' id_user = \''.$parrain['parrain'].'\'',
                            ));
                        }
                    }
                        
                    //L'inscription s'est bien déroulée
                    if(!empty($user)){
                        //on l'ajoute à la 2e base 
                        $this->membre->add(array(
                            'tables' => " openu_users ",
                            'values' => "'','".$user['mem_login']."','".$user['mem_pass']."','".$user['mem_login']."','registered','".$user['mem_mail']."','fr','".$user['mem_date_joined']."','".$user['mem_renew_pass']."',"."1"
                            )); 
                        // ajouter au réseau
                        $reseau = $this->reseau->findFirst(array('conditions' => " net_nom = ".Functions::squote($form['ue'])));
                        $this->reseau->add(array(
                            'tables' => " reseau_membre ",
                            'values' => "".$reseau->net_id.",".$user['mem_id']
                            ));
                        //ajouter dans l'historique reseau et dans l'historique public
                        $this->history->add(array(
                            'tables' => 'history', 
                            'values' => "'',".$user['mem_id']
                                    .",".Functions::squote("Inscription")
                                    .",".Functions::squote($user['mem_login']." vient de rejoindre la communauté.").",NOW()"
                                    .",".$reseau->net_id.",0"
                        )); 
                        //on crée un le lien entre l'utilisateur et l'admin
                        $admin = $this->membre->findFirst(array( 
                            'conditions' => " mem_login = 'wdadmin' ", 
                        )); 
                        $this->membre->add(array(
                            'tables' => " contact_membre ",
                            'values' => "".$user['mem_id'].",".$admin->mem_id.",0",
                        ));
                        
                        //Envoyer le mail
                        $this->mail(array(
                            'config' => 'nacder.net',
                            'destinataire' => $user['mem_mail'],
                            'expediteur' => Conf::$mail['default']['no-reply'],
                            'aliasExpediteur' => constant('site_i_name'),
                            'objet' => "[".constant('site_i_name')."] - Confirmez votre inscription", 
                            'message' =>  Mail::_messageSuscribe(array(
                                                    'mem_login' => $user['mem_login'],
                                                    'mem_token' => $user['mem_token'],
                                                    'logo' => Conf::$mail['default']['logo'],
                                                ))
                        ));
                        /**
                        * on ne crée pas la session, car il doit maintenant se connecter après avoir cliqué sur le lien reçu par mail
                        */
                        //$_SESSION['membre'] = $user;
                        //$_SESSION['loggedIn']='yes';   
                        //setcookie('loggedAs',$user['mem_token'],time()+3600*5,WEBROOT.DS,'',false);
                        //setcookie('dejaVenu',$user['mem_token'],time()+3600*5,WEBROOT.DS,'',false);

                        //Session::begin(); 
                        //$this->redirect(Router::url('?home/index'));
                        $notifications[] = "Pour achever votre inscription veuillez suivre les instructions du mail que vous allez recevoir.";
                    }
                    else 
                        $erreurs[] = "Un problème est survenu. Veuillez ressayer plus tard.";
                }
                else 
                    $erreurs[] = "Désolé, un compte avec ce mail ou ce login existe déjà. Si c'est le votre et que vous souhaitez le récupérer"
                        . ", cliquez sur <i>Mot de passe perdu ?</i>. ";
                
            }
        
            //Une fois le formulaire soumis, on génère un nouveau jeton, et ce quelque soit l'issue (formulaire validé ou non, envoyé ou non)
            Session::addToken(array(
                'name' => 'inscription',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
                'erase' => true,
            ));
        }
        
         
        
        
        $list_ue['ei1'] = $this->reseau->find(array('conditions' => 'net_niveau=1','fecthMethod' => PDO::FETCH_ASSOC,  ));
    	$list_ue['ei2'] = $this->reseau->find(array('conditions' => 'net_niveau=2','fecthMethod' => PDO::FETCH_ASSOC,  ));
    	$list_ue['ei3'] = $this->reseau->find(array('conditions' => 'net_niveau=3','fecthMethod' => PDO::FETCH_ASSOC,  ));

          
        $variables['list_ue'] = $list_ue;
        $variables['soumis'] = $soumis;
        $variables['erreurs'] = $erreurs;
        $variables['notifications'] = $notifications;
        $form['token'] = $token['value'];
        $variables['form'] = $form;
        $variables['form_action'] = $param_mail.'/'.$param_mail_token;   
             

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Espace Inscription',
            'view' => 'suscribe',
            'variables' => $variables,
        ));
    } 
    function activation($token){
        if($this->session->islogged())
            $this->redirect("?home/");

        $variables = array('erreurs'=>array(),'notifications'=>array());

        $erreur = false;
        if(!$this->controlParam()){
            $variables['erreurs'][] = ((Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'a pas le bon type ou est mal configuré, ou l'utilisateur n'existe pas." 
                : "Votre code n'est plus valide. Veuillez recommencer la procédure d'inscription.");
            $erreur = true;
        }

        if(!$erreur){
            $user = $this->membre->findFirst(array(
                'conditions' => "mem_token = '".$token."' AND mem_etat=0", 
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            if(!empty($user)){ 
                if($this->membre->upDate(array(
                    'tables' => 'membre',
                    'affectations' => "mem_etat = 1",
                    'conditions' => "mem_login = ".Functions::squote($user['mem_login']) 
                    ))){
                    $variables['notifications'][] = "Votre compte est desormais actif. Vous pouvez vous connecter en utilisant vos identifiants.";
                }
                else
                    $variables['erreurs'][] = "Un problème est survenu. Veuillez ressayer plus tard.";
            }
        }

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Activation du compte',
            'view' => 'activation',
            'variables' => $variables,
        ));


    } 
    function parrainer(){
        if(!$this->session->islogged()) 
            $this->redirect("?membre/login");

        $erreurs = array();
        $notifications = array();
        $soumis = ($this->request->data) ? $this->request->data : null;  
        $form = array( 'mail' =>'' );
        
        if(Session::getToken('parrainage')===false){ 
            Session::addToken(array(
                'name' => 'parrainage',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
            ));
        }
        $token = Session::getToken('parrainage'); 

        if($soumis){
            // à ce niveau, le formulaire a été envoyé.
            /* Si la requete provient d'un autre site ou n'a pas de http_referer (a été directement écrite dans l'url)
             * on la rejette illico
            */
            //on rejette les requetes extérieures ou tapées dans l'url ou par un autre moyen que post
            if($this->request->is('no-origin') || !Session::isValidToken('parrainage')){
               $message =  (conf::DEBUG) ? 'Erreur [MEM '.__LINE__.'] : La requête a échouée. Veuillez réactualiser la page.' : 'Le jeton CRSF a expiré. Veuillez réactualiser la page.';
               $this->error($message);
               return false;
            } 
            //on vérifie aussi que le token enregistré et celui envoyé sont les mêmes
            if($token['value']!==$soumis['token'])   
                $this->redirect('?membre/parrainer/');   
             
            if(empty($erreurs)){
                $_SESSION['saveform'] = $soumis;
                unset($soumis); 
                $this->redirect('?membre/parrainer/'); 
            }
        }
        if(isset($_SESSION['saveform'])){ 
            $soumis = $_SESSION['saveform'];
            unset($_SESSION['saveform']); 
            if(!Session::isValidToken('parrainage')){ 
                $this->error("Le temps de soumission est dépassé. Veuillez recharger la page.");
                return false;
            }
            
            $form = array(
                'mail' =>  PregFucntions::sanitize_string($soumis['mail']),  
            );
            //on s'assure que le mail est inexistant dans la table des membres
            $find = $this->membre->find(array( 
                    'conditions' => 'mem_mail = '.$form['mail'],
                    'fecthMethod' => PDO::FETCH_ASSOC
            ));
             
            if($find )
                $erreurs[] = "Le mail est déjà utilisé."; 

            if(!(substr($form['mail'], strrpos($form['mail'], '@')) === '@eleves.ec-nantes.fr'))
                $erreurs[] = "Vous n'êtes pas de l'école Centrale. Il vous faut un mail du type xxx@eleves.ec-nantes.fr";
            
            if(empty($erreurs)){
                // ajout à la table parrainage
                $token_de_validation = Session::genereToken();
                $this->membre->add(array(
                    'tables' => ' parrainage ',
                    'values' => " "
                        .Functions::squote($_SESSION['membre']['mem_id'])
                        . ",'-1'" 
                        .",".Functions::squote($form['mail'])
                        .","."NOW()"
                        .",'0'"
                        .",".Functions::squote($token_de_validation)                          
                ));

                //Envoyer le mail au fillot
                if($this->mail(array(
                    'config' => 'nacder.net',
                    'destinataire' => $form['mail'],
                    'expediteur' => Conf::$mail['default']['no-reply'],
                    'aliasExpediteur' => constant('site_i_name'),
                    'objet' => "[".constant('site_i_name')."] - Confirmez votre parrainage", 
                    'message' =>  Mail::_messageParrainage(array(
                                            'parrain_login' => $_SESSION['membre']['mem_login'],
                                            'parrain_mail' => $_SESSION['membre']['mem_mail'],
                                            'fillot_mail' => $form['mail'],
                                            'mem_token' => $token_de_validation,
                                            'logo' => Conf::$mail['default']['logo'],
                                        ))
                )))
                    $notifications[] = "Votre requête a été transmise.";
                else
                    $erreurs[] = "La requête n'a pas pu être envoyée à l'adresse donnée.";
            }

            Session::addToken(array(
                'name' => 'parrainage',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
            ));
        }
        
        $variables['soumis'] = $soumis;
        $variables['erreurs'] = $erreurs;
        $variables['notifications'] = $notifications;
        $form['token'] = $token['value'];
        $variables['form'] = $form;

        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Espace Parrainage',
            'view' => 'parrainage',
            'variables' => $variables,
        ));

    }
    private function mail($options){ 
        
        $mail = new Mail($options['config']); 
  
        $ret = $mail->send($options);
        unset($mail);
        return $ret; 
    }
}