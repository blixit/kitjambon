<?php
    /*
     * Gestion du temps d'une session 
     *      => begin, update, kill, isalive,
     * Gestion de la connexion
     *      => islogged, isloggedasadmin
     * Gestion des tokens
     *      => generetoken, addtoken, isValidToken
     */
    class Session{

        static public $id;
        static private $tokenTab = array(); 

        function __construct(){
            session_start();
            self::$id = session_id();  
            self::upDate();            
        }
        public function AffichePourAdmin($variable){
            if($this->isloggedAsAdmin()==true)
                print_r($variable);
        }
        static public function set($key,$value){
            $_SESSION[$key] = $value;
        }
        static public function get($key){
            return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        }
        static public function del($key){
            if(isset($_SESSION[$key]))
                unset ($_SESSION[$key]);
        }
        //temps de connexion
        /*
         * Initialise la variables 'session_time'
         */
        static public function begin(){ 
            $_SESSION['session_time'] = time(); 
        }
        /*
         * Teste si le temps de connexion est dépassé.
         * Si la variable 'session_time' n'est pas configuré, on arrete le teste
         * Récupère le temps restant : 'session_remain_time'
         * Si le temps de connexion est dépassé, on détruit la connexion 
         * sinon on la met à jour 
         */
        static public function upDate(){ 
            if(!isset($_SESSION['session_time'])){
                return false;
            } 
            $_SESSION['session_remain_time'] = Conf::SESSION_TIME - (time()-$_SESSION['session_time']);
            if(!self::isAlive()){
                self::kill(); 
            }
            else{
                $_SESSION['session_time'] = time(); 
            }
            return true;
        }
        /*
         * Détruit la connexion
         */
        static public function kill(){
            session_destroy();
            unset($_SESSION);
        } 
        /*
         * Teste si le temps d'une session est écoulé
         */
        static public function isAlive(){   
            if(!isset($_SESSION['session_time'])){
                return false;
            }            
            return($_SESSION['session_time'] >= (time()-Conf::SESSION_TIME)) ; 
        }
        //connexion
        /*
         * Teste si l'utilisateur est connecté => la variable de session 'membre' existe 
         */
        static public function islogged(){ 
            if (isset($_SESSION['membre'])){ 
               return true;
            }
            return false;
        }
        /*
         * Teste si l'utilisateur est logué, et qu'il s'agit d'un compte admin
         */
        static public function isloggedAsAdmin(){
            return (self::islogged() && $_SESSION['membre']['mem_droit'] == 'admin');
        }
        
        // GESTION DES TOKENS : les jetons permettent de sécuriser l'envoi des formulaires, d'éviter les injections CRSF,...
        static public function genereToken(){
            //uniqid(rand(),true);
            //uniqid(mt_rand(),true);
            return md5(uniqid(mt_rand(), true)); 
        }
        /*
         * Rajoute un token avec un nom et une limite de temps au tableau des 
         * tokens. S'il existe déjà, il n'est pas rajouté.
         * @params : $options
         *      => limit_time : la durée de vie du token
         *      => time : date de création du token, à partir de laquelle il devient valide, par défaut time()
         *      => name : le nom du token, Ex: Eklops654r9esfd87564ssfs8LGMFG
         *      => erase : booléen. la valeur true permet d'écraser le token s'il existe
         * !! Les 3 1ers paramètres sont obligatoires
         */
        static public function addToken($options){
            if(empty($options))
                return false;  
            if(!is_array($options))
                $options = array('name' => $options);
            if(!isset($options['name']))
                return false;
            if(!isset($options['time']))
                $options['time'] = time();
            if(!isset($options['limit_time']))
                $options['limit_time'] = Conf::SESSION_TIME;
            
            //on récupère les token dans $_session
            $_SESSION['tokens'] = isset($_SESSION['tokens']) ? $_SESSION['tokens'] : array();
            $already_exist = false;            
            foreach ($_SESSION['tokens'] as $k=>$v){
                if($k == $options['name']){
                    $already_exist = true;
                }
            } 
            
            if($already_exist 
                    && (!isset($options['erase']) || $options['erase']==false)) { 
                    return false;                     
            }  
            /*Remarque : on pourrait à la limite définir le time dans cette 
             * fonction et toujours utiliser la valeur time();
             * mais on laisse à l'utilisateur le choix de mettre le temps qu'il veut
             */
            $_SESSION['tokens'][$options['name']] = array(
                'limit_time' => $options['limit_time'],
                'time' => $options['time'],
                'value' => self::genereToken()
            ); 
             
            return true;
        }
        /*
         * Vérifie si le token est enregistré
         * Compare le token posté ($_get,$_post,...) à celui en mémoire dans self::tokentab
         * @params :  
         *      => name : le nom du token
         */
        static public function isValidToken($name){
            if(!isset($name)) { return false; }
            if(!isset($_SESSION['tokens'])) { return false; }
            $find = false; 
            foreach ($_SESSION['tokens'] as $k=>$v){
                if($k == $name  && isset($v['limit_time']) && isset($v['time'])){ 
                    $old_timestamp = time() - $v['limit_time'];
                    if($v['time'] >= $old_timestamp){
                        $find = true; 
                        break;
                    }   
					else
						self::delToken($name);
                }
            }         
            return $find;                  
        }
        /*
         * Retourne la valeur du token demandé s'il existe
         */
        static public function getToken($name){ 
            return isset($_SESSION['tokens'][$name]) ? $_SESSION['tokens'][$name] : false;
        }
        /*
         * Récupère le nom du token grace à sa valeur. 
         * Si la valeur n'est pas trouvée, on renvoie false
         */
        static public function getReverseToken($value) {
            if(isset($_SESSION['tokens'])){
                foreach($_SESSION['tokens'] as $k=>$v){ 
                    if($v['value']==$value)
                        return $k;
                }
            }
            return false;
        }
        /*
         * Détruit token demandé s'il existe
         */
        static public function delToken($name){
            if(isset($_SESSION['tokens'][$name])){
                unset($_SESSION['tokens'][$name]);
                return true;
            }
            return false;
        }
    }

 