<?php
class DownloadController extends Controller{
    public $nbParamInUrl = 3;
    public $models = array(
            'default'=>'document',
            'default2'=>'reseau',
            );
    public $params = array(
            'default'=>'ei1',
            'default'=>'algpr',
    );

    function __construct($request){
            parent::__construct($request);
            $this->layout = 'default';
    }
   
    function view($age,$eix,$ue,$dir=null){
        if(!$this->session->islogged())
            $this->redirect("?membre/login");

        $thisDir = $age.DS.$eix.DS.$ue.DS.$dir;

        $dir = isset($dir) ? $dir : '';
        $dir = urldecode(trim(str_replace('~','/',$dir),'/'));
        $path = ($age=='a') ? 'filesOld' : 'files'; //a ancien
        $path .= strtolower(DS.'ei'.$eix.DS.$ue.DS.(!empty($dir)? $dir.DS : ''));  
        $directory = array();
        $files = array();

        $link_switch = '?download/view'.DS.(strtolower($age)=='a' ? 'n' : 'a').DS.$eix.DS.$ue;
        $link_hyper_racine = '?download/view'.DS.$age.DS.$eix.DS.$ue;
        //$n = strrpos(substr($dir,0,strlen($dir)-1),'/');  // Ex : dir= sds'/'dsds/ ==> n=3

        switch(strtolower($age)){
                case 'a' : {
                    $link_racine = $link_hyper_racine.DS;  
                    $link_racine .= str_replace('/','~',$dir).'~';//($n) ? substr($dir,0,$n) : '';
                    $m = strrpos(trim($dir,'/'), '/');
                    $link_up = $link_hyper_racine.DS.substr(trim($dir,'/'),0,$m); 
                    
                    $link_download = '?download/view'.DS.$age.DS.$eix.DS.$ue;
                    $path = '../'.$path; // Répertoire pour l'ancienne version du kit
                    $ispath = is_dir($path); //echo $path.' '.$ispath;
                    //var_dump($ispath); var_dump($path);
                    if($ispath){   
                        $ret = array();
                        $ret_files = array();
                        $dossier = opendir($path);
                        while(false !== ($fichier = readdir($dossier))){
                            if($fichier != '.' && $fichier != '..' && $fichier != 'index.php'){
                                if(is_dir($path.$fichier)){
                                        array_push($ret,array("doc_path"=>$fichier));
                                }
                                else{
                                    //création du tokken
                                    Session::addToken($fichier);
                                    $token = Session::getToken($fichier);  
                                    //récupération des infos sur le fichier (vielle version => table oldfiles)
                                    $tmpFile = $this->document->findFirst(array(
                                        'tables' => " openu_oldfiles " , 
                                        'conditions' => " path LIKE '%".$path.$fichier."%'", 
                                        'fecthMethod' => PDO::FETCH_ASSOC,
                                    ));
                                    array_push($ret_files,array( 
                                        "doc_id"=>(!empty($tmpFile['id'])? $tmpFile['id'] : 0 ), 
                                        "doc_name"=>utf8_encode($fichier),
                                        "doc_path"=>$path,
                                        "doc_date"=>date('d m Y ', filemtime($path.$fichier)),
                                        "doc_size"=> Functions::human_filesize(filesize($path.$fichier)),
                                        "doc_year"=>$eix,
                                        "doc_ue"=>$ue,
                                        "doc_catg"=>'',
                                        "doc_url"=>  '?download/load/'.$age.DS.$eix.DS.$ue.DS.(!empty($dir) ? str_replace('/','~',$dir): 'dir').DS.$token['value'],
                                        "doc_code"=>'',
                                        "doc_valid"=>'' ,
                                        "doc_av_plus"=>(!empty($tmpFile['av_plus'])? $tmpFile['av_plus'] : 0 ),
                                        "doc_av_moins"=>(!empty($tmpFile['av_moins'])? $tmpFile['av_moins'] : 0 ), 
                                        "doc_hits"=>(!empty($tmpFile['hits'])? $tmpFile['hits'] : 0 ), 
                                    ));
                                }
                            }
                        }

                        $directory = $ret;
                        $i = 0;
                        foreach($directory  as $d){
                            if($d){ 
                            $directory[$i]['doc_path'] = str_replace($path,"",$d['doc_path']);
                            $t = explode('/',$directory[$i]['doc_path']);
                            $directory[$i]['dir'] = $t[0];
                            $i++;
                            }
                        }

                        $files = $ret_files;
                    }
                }
                break;
                case 'n' : { 

                    if(!($ok = $this->document->findFirst(array(
                        'tables'=> 'reseau',
                        'conditions'=>"net_niveau = ".$eix." AND net_nom = ".Functions::squote($ue)
                    )))){
                        $message = (Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'est pas configuré." : "Le répertoire de cours n'existe pas ou n'a pas encore été créé.";
                        $this->error($message);
                        exit;
                    }
                    $link_racine = $link_hyper_racine.DS;
                    //$link_racine .= $dir;
                    $m = strrpos(trim($dir,'/'), '/');
                    $link_up = $link_hyper_racine.DS.substr(trim($dir,'/'),0,$m); 
                    $directory = $this->document->find(array(
                            'tables' => " openu_files " , 
                            'champs' => " DISTINCT catg " , 
                            'conditions' => " year =  ".$eix." AND ue = ".Functions::squote($ue).(!empty($dir) ? " AND catg != ".Functions::squote($dir) : "" ) ,
                            'order' => " name ASC ",
                            'fecthMethod' => PDO::FETCH_ASSOC,
                    )); 
                    $i = 0;
                    foreach($directory as $d){
                        if($d){    
                        $directory[$i]['dir'] = $directory[$i]['catg'];
                        $i++;                        
                        }
                    }
                    $files = $this->document->find(array(
                        'tables' => " openu_files " , 
                        'conditions' => " year =  ".$eix." AND ue = ".Functions::squote($ue)." AND catg = ".Functions::squote($dir) ,
                        'order' => " name ASC ",
                        'fecthMethod' => PDO::FETCH_ASSOC,
                    ));
                    $j = 0;
                    foreach($files as $d){
                        if($d){
                        $files[$j]['doc_size'] = Functions::human_filesize($d['size']);
                        $files[$j]['doc_url'] = '?download/downloadFinished/'.$files[$j]['id'].'/0/0'; // le controller download a besoin de 3 parametres par defaut pour fonctionner
                        //$files[$j]['doc_url'] = OPENUPLOADDIR.DS.'?action=d&id='.$files[$j]['id'];
                        $j++;
                        }
                    }
                }
                break;
                default :{
                    $message = (Conf::DEBUG) ?
                    "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'est pas configuré." : "Le répertoire de cours n'existe pas ou n'a pas encore été créé.";
                    $this->error($message);
                    exit;
                }
                break;
        }

        $variables['thisDir'] = $thisDir;
        $variables['link_up'] = $link_up;
        $variables['link_switch'] = $link_switch;
        $variables['link_hyper_racine'] = $link_hyper_racine;
        $variables['link_racine'] = $link_racine;
        $variables['age'] = $age;
        $variables['directory'] = $directory;
        $variables['files'] = $files;

        //informations sur le cours (= réseau)
        $t = $this->reseau->find(array(
                'conditions' => " net_nom = '".strtolower($ue)."'"
        )); 
        $variables['ue_nom_for_layout'] = $ue;
        $variables['ue_description_for_layout'] = $t[0]->net_description;  
        
        //on vérifie si l'utilisateur est déjà inscrit à ce cours
        $reseau_membre = $this->reseau->findFirst(array(
                'tables' => " reseau_membre ",
                'conditions' => " net_id = '".$t[0]->net_id."' AND mem_id = ".$_SESSION['membre']['mem_id']
        )); 
        $variables['est_inscrit'] = ($reseau_membre!==false && !empty($reseau_membre));

        //liste des inscrits à ce cours
        $listeInscrits = $this->reseau->find(array(
                'tables' => " reseau_membre rm NATURAL JOIN membre m",
                'champs' => ' DISTINCT m.mem_id, m.mem_login ',
                'conditions' => " rm.net_id = ".$t[0]->net_id."",
                'fecthMethod' => PDO::FETCH_ASSOC
        )); 
        $variables['listeInscrits'] = ($listeInscrits!==false && !empty($listeInscrits)) ? $listeInscrits : null; 


         $list = Script::_multi_script(array( 
                array(
                        'type' => '_query',
                        'action' => 'click',
                        'element' => '#modal_inscription',
                        'name' => 'modal_inscription',  
                        'parameters' => 'id',  
                        'code' => 'setTimeout("window.location.reload()",1000);',  
                        'toReload' => '#rien', // on recharge la page 
                        'query' => urlencode($t[0]->net_id.':'.$_SESSION['membre']['mem_id'] ),  
                        'reponse' => '#reponse_modal_inscription',  
                        'method' => 'GET',  
                        'url' => '?ajax/inscription_reseau/',  
                        'time' => '3000',  
                )));  
        /*Les champs obligatoires pour le type _query : toReload, "query, #element, #reponse , "method, "url*/
        $variables['mesScripts'] = $list['s']; //définitions des fonctions => dans le header
        $variables['mesScriptsFunc'] = $list['d']; // appels des fonctions définis => dans le footer
         
        $this->myrender(array(
            'menu' => 'menu',
            'title' => strtoupper($ue),
            'view' => 'view',
            'variables' => $variables,
        ));
    }
    
    /*
     * Téléchargement d'un fichier de l'ancienne version
     * Pour l'instant on gère le téléchargement par http sans prise de tête et tant pis pour ovh
     */
    function load($age,$eix,$ue,$dir=null,$paramtoken=null){
        if(!$this->session->islogged())
            $this->redirect("?membre/login");
        if(!isset($paramtoken)){
            $message = "Vous tentez d'accéder à un répertoire inexistant." ;
            $this->error($message);
            exit;
        }
        
        $dir = urldecode(str_replace('~', '/', $dir));
        $path = ($age=='a') ? 'filesOld' : 'files'; //a ancien
        $path .= strtolower(DS.'ei'.$eix.DS.$ue.DS.(!empty($dir) ? ($dir!='dir' ? $dir.DS : '') : ''));
        //$file = BASE_URL.DS.$path.Session::getReverseToken($paramtoken);  
        if($age=='a'){ 
            $token = Session::getReverseToken($paramtoken);
            $filename = $token;
        }
        elseif($age=='n'){
            $get = $this->document->findFirst(array(
                'conditions' => " doc_code = ".Functions::squote($paramtoken),
            )); 
            $path = $get->doc_path;
            $filename = $get->doc_name; 
        }
        
        $file = '..'.DS.$path.$filename; 
        
        if(file_exists($file)){
            $size = filesize($file);

            $erreurs = $this->force_telechargement( 
                array(
                        'filename' => $filename,
                        'type' => 'application/octet-stream',
                        'size' => $size,
                        'dir' => $path,
                        'complete_name' => $file,
            )); 
            if($erreurs[0] && $age=='a'){
                Session::delToken($token);
                Session::addToken($token); 

                $tmpFile = $this->document->findFirst(array(
                    'tables' => " openu_oldfiles " , 
                    'conditions' => " path LIKE '%".$file."%'", 
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
                // enregistrement du nombre de téléchargement 
                if(!empty($tmpFile)) {
                    $this->document->upDate(array(
                        'tables' => " openu_oldfiles " , 
                        'affectations' => "hits = hits+1",
                        'conditions' => " path LIKE '%".$file."%'",
                        'fecthMethod' => PDO::FETCH_ASSOC,
                    )); 
                }
            
                 /**
                Enregistrement de l'activité sur les OldFiles
                */ 
                //l'activité est créée automatiquement à la connexion  
                $this->document->upDate(array(  
                    'tables'=>'activite_membre', 
                    'affectations' => "nb_down = nb_down+1",
                    'conditions'=> ' id_user = '.$_SESSION['membre']['mem_id'], 
                ));
            }
            else{
                $this->error($erreurs[1]);
                return false;
            }
        }
                
        $list = Script::_multi_script(array(
            array(
                    'action' => 'ready',
                    'element' => 'body',
                    'name' => 'body', 
                    'code' => "setTimeout('self.close()',10000);"
            )));  
        /*Les champs obligatoires pour le type _query : toReload, "query, #element, #reponse , "method, "url*/
        
        $variables['mesScripts'] = $list['s']; //définitions des fonctions => dans le header
        $variables['mesScriptsFunc'] = $list['d'];
        
            
                
        $variables['file'] = $file; 
        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Telechargement de la ressource en cours',
            'view' => 'load',
            'variables' => $variables,
        ));
    }
    protected function force_telechargement($options){ 
        if(!file_exists($options['complete_name']))
            return array(false,"Le fichier n'existe pas.",null);
        $options['encoding'] = (isset($options['encoding'])) ? $options['encoding'] : 'binary';
        $options['size'] = (isset($options['size'])) ? $options['size'] : '';
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: '.$options['encoding']); 			//Transfert en binaire (fichier).
        header('Content-type: '.$options['type']);   			//soit on précise le type, soit on le met dans le filename
        header('Content-Disposition: attachment; filename='.$options['filename'].''); //Nom du fichier.
        header('Content-Length: '.($options['size'])); 		//Taille du fichier. Envoyer la bonne taill pour ne pas avoir un problème 'fin de l'archive incorrecte'
        header('Expires: 0');	
        header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        $ret = array();
        ob_clean(); // hyper important
        flush();	// 
        try{
            readfile($options['complete_name']);  
        }
        catch(Exception $e){
            $ret[] = $e->getMessage();			
        }
        return array(true,$ret,$options['filename']);	 
    }
    
    function zip(){
        //
    }

    /*
    Téléchargement d'un fichier de la nouvelle version
    */
    function downloadFinished($param){
        if(empty($param)){
            $this->redirect('?errors/notFound');
            exit;
        }
        $t = $this->document->upDate(array(
            'tables' => 'openu_files',
            'affectations' => 'hits = hits+1',
            'conditions' => "id = '".$param."'"
        )); 

        /**
        Enregistrement de l'activité sur les Files
        */
        /* Enregistrement de l'activité ici  */
        //l'activité est créée automatiquement à la connexion  
        $this->document->upDate(array(  
            'tables'=>'activite_membre', 
            'affectations' => "nb_down = nb_down+1",
            'conditions'=> ' id_user = '.$_SESSION['membre']['mem_id'], 
        ));

        $this->redirect(OPENUPLOADDIR.DS.'?action=d&id='.$param);
    } 
    function avis($id,$avis,$age,$eix="",$eu="",$dir=""){
        if(!$this->session->islogged())
            $this->redirect("?membre/login");

        $link = "?download/view/".$age.DS.$eix.DS.$eu.DS.$dir;

        if($age == 'a'){ 
            $table = " openu_oldfiles "; 
        }elseif ($age == 'n') { 
            $table = " openu_files ";
        } 

        //on vérifie que le fichier spécifier existe déjà
        $tmpFile = $this->document->findFirst(array(
            'tables' => $table , 
            'conditions' => " id = ".$id."", 
            'fecthMethod' => PDO::FETCH_ASSOC,
        )); 
        // s'il n'existe pas on redirige ...
        if(empty($tmpFile))
            $this->redirect($link);
        //... si non on effectue la mise à jour
        $this->document->upDate(array(
            'tables' => $table , 
            'affectations' => "av_".($avis=="p" ? "plus" : "moins")." = av_".($avis=="p" ? "plus" : "moins")."+1",
            'conditions' => " id = ".$id."", 
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));  
        /* Enregistrement de l'activité ici  */
        //l'activité est créée automatiquement à la connexion  
        $this->document->upDate(array(  
            'tables'=>'activite_membre', 
            'affectations' => "nb_av_".($avis=="p" ? "plus" : "moins")." = nb_av_".($avis=="p" ? "plus" : "moins")."+1",
            'conditions'=> ' id_user = '.$_SESSION['membre']['mem_id'], 
        )); 

        $this->redirect($link); 
        /*$this->myrender(array(
            'menu' => 'menu',
            'title' => strtoupper($ue),
            'view' => 'view',
            'variables' => null,
        )); */
    }

    function updateOld($p,$po,$poo){
        /*include CORE.DS.'cfile.php';
        echo "../filesOld";
        if(empty($_SESSION['filesold'])){
            $files = cfile::readMyFile("../filesOld",true);
            $_SESSION['filesold'] = $files;
        }
        //first delete table
        echo '<table><tbody>';
        foreach ($_SESSION['filesold'] as $key => $value) {
            //echo '<tr><td>'.$value.'</td><td>'.basename($value).'</td></tr>';
            echo $this->document->add(array(
                'tables'=>'openu_oldfiles',
                'values'=> "'','".$value."','".basename($value)."'",
            ))."<br>";
        }
        echo '</tbody></table>';
        $this->myrender(array(
            'menu' => 'menu',
            'title' => strtoupper($ue),
            'view' => 'updateOld',
            'variables' => $variables,
        ));*/
    }
}