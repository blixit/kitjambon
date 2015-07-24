<?php

/* 
 * Projet : Kit-jambon
 * By Alain Ngangoue
 * Fichier : homeController.php
 * Role :  
 */
class HomeController extends Controller{

        public $models = array(
            'default'=>'membre',
            '2'=>'reseau',
            '3'=>'groupe',
            '4'=>'document',
            '5'=>'history',
            );
        public $params = array(
            'default'=>'',
        );

        function __construct($request){
            parent::__construct($request);            
            $this->layout = 'home';
        }

        function index($variables=null){
            if(!$this->session->islogged())
                $this->redirect("?membre/login/");  

            $variables = isset($variables) ? $variables : array(); 
            $variables['user'] = $_SESSION['membre'];
            $variables['reseaux'] = $this->reseau->find(array(  
                'tables' => ' reseau r NATURAL JOIN reseau_membre rm ',
                'conditions' => "rm.mem_id = ".$_SESSION['membre']['mem_id'],
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 
            $variables['groupes'] = $this->groupe->find(array( 
                'tables' => ' groupe g NATURAL JOIN groupe_membre gm ',
                'conditions' => "gm.mem_id = ".$_SESSION['membre']['mem_id'],
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));  
            $id = $_SESSION['membre']['mem_id'];
            $variables['contacts'] = $this->membre->find(array( 
                'tables' => ' membre NATURAL JOIN (SELECT * FROM contact_membre WHERE   ( mem_id_1 = '.$id.' OR mem_id_2 = '.$id.') ) as c',
                'champs' => 'mem_id, mem_login', 
                'conditions' => "cm_valid = 1 AND (mem_id=c.mem_id_1 OR mem_id=c.mem_id_2) AND mem_id != ".$id,
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));  
            
            $my_networksId = array();
            foreach($variables['reseaux'] as $n)
                if($n)
                    $my_networksId[] = intval($n['net_id']);
            
            $my_groupsId = array();
            foreach($variables['groupes'] as $n)
                if($n)
                    $my_groupsId[] = intval($n['gr_id']);
            
            //si cette variable est défini, alors on est sur l'interface réseau ou groupe 
            if(!isset($variables['history'])){  
                $options['action'] = 'index';
                $options['user'] = $variables['user'];  
                if(isset($this->request->params[0])){
                    switch ($this->request->params[0]) {
                      case 'delete':
                         $variables += $this->delete_message($options);  
                          break;                  
                      default:
                          $variables += $this->receive_form($options);  
                          break;
                    }      
                }       
                else
                    $variables += $this->receive_form($options);  
                
                $variables['history'] = $this->history->find(array( 
                    'list_net' =>  $my_networksId,
                    'list_gr' =>  $my_groupsId,
                    'limit' => 100,
                    'id' => $_SESSION['membre']['mem_id'],
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));
                $variables['action'] = $this->request->action;
            }  

            $erreurs = array();
            $notifications = array();
            $variables['erreurs'] = $erreurs;
            $variables['notifications'] = $notifications;

            $this->myrender(array(
                'menu' => 'menu',
                'title' => (isset($variables['___title']) ? $variables['___title'] : 'Home'),
                'view' => 'index',
                'variables' => $variables,
            ));
            return $variables;
        }

        function reseau($params=null){
            $erreurs = false; $ok = null;
            if (!empty($params) && is_numeric($params))  
                $params = intval($params);
            else $erreurs = true;
            $variables['action'] = 'reseau';
            $options['action'] =  $variables['action'];
            $options['user'] = $_SESSION['membre'];  
            $options['params'] = $this->request->params;   

            if(!$erreurs){
                // on vérifie que l'utilisateur est inscrit à ce réseau
                $ok = $this->reseau->findFirst(array(  
                    'tables' => 'reseau_membre',
                    'conditions' =>  "net_id = ".$params." AND mem_id = ".$_SESSION['membre']['mem_id'], 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));  
            }

            if(!$erreurs && !empty($ok)){ 
                $variables += $this->receive_form($options);

                $variables['history'] = $this->history->real_find(array( 
                    'conditions' => 'hh_net_id = '.$params , 
                    'order' => 'hh_date DESC',
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));  
                $variables['this_reseau'] = $this->reseau->findFirst(array(  
                    'conditions' =>  "net_id = ".$params, 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
                
                $variables['___title'] = 'RESEAU '.$variables['this_reseau']['net_nom']; 
                
                $this->index($variables);
            }
            else
                $this->index(null);
 
        }

        function groupe($params){
            $erreurs = false; $ok = null;
            if (!empty($params) && is_numeric($params))  
                $params = intval($params);
            else $erreurs = true;
             $variables['action'] = 'groupe';
            $options['action'] =  $variables['action'];
            $options['user'] = $_SESSION['membre'];  
            $options['params'] = $this->request->params; 

            if(!$erreurs){
                // on vérifie que l'utilisateur est inscrit à ce réseau
                $ok = $this->groupe->findFirst(array(  
                    'tables' => 'groupe_membre',
                    'conditions' =>  "gr_id = ".$params." AND mem_id = ".$_SESSION['membre']['mem_id'], 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));   
            }
            if(!$erreurs && !empty($ok)){            
                $variables += $this->receive_form($options);

                $variables['history'] = $this->history->real_find(array( 
                    'conditions' => 'hh_gr_id = '.$params , 
                    'order' => 'hh_date DESC',
                    'fecthMethod' => PDO::FETCH_ASSOC,
                ));  
                $variables['this_groupe'] = $this->groupe->findFirst(array(  
                    'conditions' =>  "gr_id = ".$params, 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
                $variables['___title'] = 'RESEAU '.$variables['this_groupe']['gr_nom']; 
                $this->index($variables);
            }
            else
                $this->index(null);
        }

        function profil($param){
            if(!$this->session->islogged())
                $this->redirect("?membre/login/"); 

            //changement de layout pour les tests 
            $this->layout = 'default';

            //récupération des infos de sessions
            $variables['user'] = $_SESSION['membre'];

            //récupération des données
            $variables['reseaux'] = $this->reseau->find(array(  
                'tables' => ' reseau r NATURAL JOIN reseau_membre rm ',
                'conditions' => "rm.mem_id = ".$_SESSION['membre']['mem_id'],
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 
            $variables['groupes'] = $this->groupe->find(array( 
                'tables' => ' groupe g NATURAL JOIN groupe_membre gm ',
                'conditions' => "gm.mem_id = ".$_SESSION['membre']['mem_id'],
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));  
            $id = $_SESSION['membre']['mem_id'];
            $variables['contacts'] = $this->membre->find(array( 
                'tables' => ' membre NATURAL JOIN (SELECT * FROM contact_membre WHERE   ( mem_id_1 = '.$id.' OR mem_id_2 = '.$id.') ) as c',
                'champs' => 'mem_id, mem_login', 
                'conditions' => "cm_valid = 1 AND (mem_id=c.mem_id_1 OR mem_id=c.mem_id_2) AND mem_id != ".$id,
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));   
            $variables['lastComers'] = $this->membre->find(array(  
                'order'=>'mem_date_joined DESC ',
                'limit'=>'5',
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 
            $variables['activite'] = $this->membre->findFirst(array(  
                'tables'=>'activite_membre',
                'conditions'=>' id_user = '.$_SESSION['membre']['mem_id'], 
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 

            //création des scripts
            $list = Script::_multi_script(array(   
                    array(
                            'type' => '_script',
                            'action' => 'click',
                            'element' => '#btn_change_year',
                            'name' => 'btn_change_year',  
                            'code' => "   var year = $('#input_change_year').val(); $.ajax({ type : 'GET', url : '?ajax/profil/', data : 'year:'+year,success : function(server_response){ $('#result_change_year').html(server_response).fadeIn(2000);} });
                                        ",       
                    ), 
                    array(
                            'type' => '_script',
                            'action' => 'click',
                            'element' => '#btn_change_ue',
                            'name' => 'btn_change_ue',  
                            'code' => "   var ue = $('#input_change_ue').val(); $.ajax({ type : 'GET', url : '?ajax/profil/', data : 'ue:'+ue,success : function(server_response){ $('#result_change_ue').html(server_response).fadeIn(2000);} });
                                        ",       
                    ), 
                    array(
                            'type' => '_script',
                            'action' => 'click',
                            'element' => '#btn_change_temperament',
                            'name' => 'btn_change_temperament',  
                            'code' => "   var temperament = $('#input_change_temperament').val();   $.ajax({type : 'GET',  url : '?ajax/profil/', data : 'temperament:'+temperament, success : function(server_response){ $('#result_change_temperament').html(server_response).fadeIn(2000);} });
                                        ",       
                    ),
            ));  
        /*Les champs obligatoires pour le type _query : toReload, "query, #element, #reponse , "method, "url*/
         
        $variables['mesScripts'] = $list['s']; //définitions des fonctions => dans le header
        $variables['mesScriptsFunc'] = $list['d']; // appels des fonctions définis => dans le footer

                

            $this->myrender(array(
                'menu' => 'menu',
                'title' => 'Accueil',
                'view' => 'profil',
                'variables' => $variables,
            )); 
        }
        private function receive_form($options){
            if(empty($options['action']))
                return null;

            $data['errors'] = array();
            $data['notifications'] = array();
            $data['form'] = array();    

            if(!empty($this->request->data)){
                Session::set('saveForm',$this->request->data); 
                unset($this->request->data); 
                switch ($options['action']) {
                    case 'index': $this->redirect('?home/'.$options['action']);
                        break;
                    case 'groupe': $this->redirect('?home/'.$options['action'].'/'.$options['params'][0]);
                        break;
                    case 'reseau': $this->redirect('?home/'.$options['action'].'/'.$options['params'][0]);
                        break; 
                }
                
            }

            $donnees = Session::get('saveForm'); 
            if(!empty($donnees)){
                Session::del('saveForm');
                $form['resume'] = PregFucntions::sanitize_string($donnees['resume']);
                $v = $donnees['visibility'];
                $n = $donnees['net'];
                $g = $donnees['gr'];

                switch($v[0])
                {
                    case '0' : $n = 0; $g = 0; $form['concerne'] = 'Tous'; break;
                    case 'r' : $n = substr($v,2,strlen($v)); $g = 0; $form['concerne'] = $n; break;
                    case 'g' : $n = 0; $g = substr($v,2,strlen($v)); $form['concerne'] = $g; break; 
                }
 
                if(!$this->history->add(array(
                    'tables' => 'history',
                    'values' => '\'\','.$options['user']['mem_id']
                        .','.Functions::squote($form['concerne'])
                        .','.Functions::squote($form['resume'])
                        .','.'NOW(),'.$n.','.$g,
                ))){
                    $data['errors'][] = "Le post n'a pas été  soumis correctement, veuillez ressayer plus tard.";
                }
                else
                    $data['notifications'][] = "Le message a correctement été envoyé.";

            } 
            return $data;
        }
        private function delete_message($options){
            if(empty($options['action']))
                return null;

            
        }
} 