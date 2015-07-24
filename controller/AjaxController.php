<?php
class AjaxController extends Controller{

    public $models = array(
            'default'=>'membre',
            'default2'=>'reseau',
            'default3'=>'groupe',
            'default4'=>'history',
            'default5'=>'contact_membre',
            );
    public $params = array(
            'default'=>'',
    );

    function __construct($request){
        parent::__construct($request);
        $this->layout = 'default';
        $this->nbParamInUrl=1; 
        $this->getMenu = '';
        $this->set('content_for_menu',$this->getMenu);
        $this->rendered = true;  
    } 
    public function controlParam(){
        //on récupère les paramètres dans l'url du type : 
        //?ajax/send/user:4|concerne:autreuser|resume:message 
        $p = current($this->request->params);
        //en fonction de la méthode utilisée: post ou get, le paramètre peut contenir en début de chaine le symbole &
        if($p[0]=='&')
                $p = substr($p,1,strlen($p));
        return $p;
    }
    function send($query){  
        /* on découpe l'url controllée par controlParam() 
         * ?ajax/send/user:4|concerne:autreuser|resume:message 
         */
        $param = explode('|',urldecode(htmlentities($this->controlParam()))); // 0:concerne, 1:resume
        $data = array(); 
        
        foreach($param as $v){
                $t = explode(':',$v);
                $data[$t[0]] = str_replace('%20',' ',$t[1]); //l'url n'adore pas les espaces 
        }
        /* On vérifie la connexion
         */
        if(!$this->session->islogged()){
            return false;
        }
        /*On vérifie que le jeton a été créé avec le format : 
         * vueUtilisateurenCours+idUtilisateur
         * avec idUtilisateur = data['user']
         */
        if(!Session::isValidToken('vueUtilisateurenCours'.$data['user'])){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée. ';
            return false;
        } 
        /* Si la requete provient d'un autre site ou ou n'a pas de http_referer (a été directement écrite dans l'url)
         */
        if($this->request->is('no-origin')){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée.';
            return false;
        }
        $interaction = $this->contact_membre->findFirst(array(
            'tables' => 'contact_membre',
            'conditions' => "(mem_id_1 =".$data['user']." AND mem_id_2 =".$_SESSION['membre']['mem_id']." ) OR "
                           ."(mem_id_2 =".$data['user']." AND mem_id_1 =".$_SESSION['membre']['mem_id']." )",
            'fecthMethod' => PDO::FETCH_ASSOC,
        ));
        
        //si vous avez une interaction sous la forme d'échange de contacts, alors ne plus proposer le bouton mail|phone|facebook
        //Peut-etre que dans une version postérieure, on distinguera les types de contact
        if($interaction===false){
            //on rajoute l'interaction dans la table contact_memre           
            $req = $this->contact_membre->add(array(
                'tables' => 'contact_membre', 
                'values' => "".$_SESSION['membre']['mem_id']
                            .",".$data['user']
                            .",0"
            ));   
            //si l'ajout s'est bien déroulé, on rajoute à l'historique :)
            if($req!==false) {   
                //On ajoute le message à l'historique
                $req = $this->history->add(array(
                    'tables' => 'history', 
                    'values' => "'',".$data['user']
                                .",".Functions::squote($data['concerne'])
                                .",".Functions::squote($data['resume']).",NOW(),0,0"
                )); 

                if($req) {
                    echo $data['username']." a bien recu votre message.";  
                }
                else{
                    echo "  Un problème est survenu lors de l'envoi.  "; 
                }
            }
            else
                echo "Un problème est survenu. Veuillez ressayer plus tard.";
            return $req;
        }
        else
            echo "Vous êtes déjà en contact."; // cette phrase est une sécurité supp. En effet, s'il sont déjà en contact, ils ne verront pas le bouton

        return true;
    } 
    function accepte_demande($query){  
        /* on découpe l'url controllée par controlParam() 
         * ?ajax/accepte_demande/mem_id_1:mem_id_2 
         */
        $interaction = explode(':',urldecode(htmlentities($this->controlParam()))); // 0:concerne, 1:resume
        foreach ($interaction as $key => $value) {
            $interaction[$key] = intval($value);
        }
        /* On vérifie la connexion
         */
        if(!$this->session->islogged()){
            return false;
        }
        /*On vérifie que le jeton a été créé avec le format : 
         * vueUtilisateurenCours+idUtilisateur
         * avec idUtilisateur = $interaction[0]
         */
        if(!Session::isValidToken('vueUtilisateurenCours'.$interaction[0])){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée. ';
            return false;
        } 
        /* Si la requete provient d'un autre site ou ou n'a pas de http_referer (a été directement écrite dans l'url)
         */
        if($this->request->is('no-origin')){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée.';
            return false;
        }
        $reponse = $this->contact_membre->upDate(array(
            'tables' => ' contact_membre ',
            'affectations' => " cm_valid=1 ",
            'conditions' => "mem_id_1= ".$interaction[0]." AND mem_id_2=".$interaction[1],
        )); 
         
        return $reponse;
    } 
    function inscription_reseau($query){  
        /* on découpe l'url controllée par controlParam() 
         * ?ajax/inscription_reseau/net_id:mem_id 
         */
        $data = explode(':',urldecode(htmlentities($this->controlParam()))); // 0:concerne, 1:resume
        foreach ($data as $key => $value)  
            $data[$key] = intval($value); 

        /* On vérifie la connexion */
        if(!$this->session->islogged()) return false;  

        /* Si la requete provient d'un autre site ou ou n'a pas de http_referer (a été directement écrite dans l'url)  */
        if($this->request->is('no-origin')){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée.';
            return false;
        } 
        $reponse = $this->contact_membre->add(array(  'tables' => ' reseau_membre ', 'values' => $data[0].",".$data[1], )); 
        $files = $this->membre->findFirst(array(  'tables' => ' membre ', 'champs'=>'mem_login','conditions' => "mem_id=".$data[1] )); 
        if($reponse!==false && $user!==false) {   
                //On ajoute le message à l'historique
                $this->history->add(array(
                    'tables' => 'history', 
                    'values' => "'',".$data[1]
                                .",".Functions::squote("Inscription au réseau")
                                .",".Functions::squote(strtoupper($user->mem_login)." vient de rejoindre le réseau").",NOW(),".$data[0].",0"
                )); 
        } 
         
        return $reponse;
    } 
    function search_files($query){
        /* on découpe l'url controllée par controlParam() 
         * ?ajax/inscription_reseau/net_id:mem_id 
         */
        $data = urldecode(htmlentities($this->controlParam())); // 0:concerne, 1:resume
         
        /* On vérifie la connexion */
        if(!$this->session->islogged()) {
            echo '<span style="color:red">Ce service requiert une connexion.</span>';
            return false; 
        }

        /* Si la requete provient d'un autre site ou ou n'a pas de http_referer (a été directement écrite dans l'url)  */
        if($this->request->is('no-origin')){
            echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée.';
            return false;
        }
        $mots = explode(' ',$data);
        $dansFilename = "";
        $dansPath = "";
        foreach ($mots as $key => $value) {
            $dansPath .= " path LIKE '%".$value."%' ";
            $dansFilename .= " filename LIKE '%".$value."%' ";
            if($value != end($mots)){
                $dansPath .= " AND ";
                $dansFilename .= " AND ";
            }                
        }
         $files = $this->membre->find(array(  
            'tables' => ' openu_oldfiles ', 
            'conditions' => $dansPath." OR ".$dansFilename ,
            'limit' => '100',
            'fecthMethod' => PDO::FETCH_ASSOC,
        )); 
        /*if($reponse!==false && $user!==false) {   
                //On ajoute le message à l'historique
                $this->history->add(array(
                    'tables' => 'history', 
                    'values' => "'',".$data[1]
                                .",".Functions::squote("Inscription au réseau")
                                .",".Functions::squote(strtoupper($user->mem_login)." vient de rejoindre le réseau").",NOW(),".$data[0].",0"
                )); 
        }*/

        echo "<h3>Résultat de la recherche : </h3><br>";
        $nb = count($files);
        if($nb<100)   echo $nb." fichiers trouvés.<br>";
        else echo "Plus de 100 fichiers trouvés. Veuillez affiner la recherche.";

        echo '<span class=" col-xs-12" style="widht:100%; background-color:red; border-bottom: 1px ridge silver">.</span><br>';
        $i = 0;
        foreach ($files as $key => $value) { 
            //$newpath = str_replace("../filesOld/ei","",$value['path']);
            //on met un ; sachant que les noms de fichiers n'ont contiennent pas
            preg_match_all("|../filesOld/([^\/]+)/([^\/]+)/([^;]+)|",$value['path'] ,$out, PREG_SET_ORDER);
            $age = str_replace("ei", "", $out[0][1]);
            $filename = basename($out[0][3]);
            $dir = str_replace($filename, "", $out[0][3]);
            $dir = str_replace("/", "~",$dir);
            $link = "?download/view/a/".$age."/".$out[0][2]."/".$dir;
            //var_dump($out);
            echo str_replace("../filesOld/", "",$value['path']).'<a href="'.Router::url($link).'"><span class="pull-right" ><i class="fa fa-folder"></i></span></a><br>';
            $i++;
        }
         
        return $reponse;
    }
    function profil($query){ 
        $data = explode(':',urldecode(htmlentities($this->controlParam()))); // 0:concerne, 1:resume
        
        /* On vérifie la connexion */
        if(!$this->session->islogged()) return false;  

        /* Si la requete provient d'un autre site ou ou n'a pas de http_referer (a été directement écrite dans l'url)  */
        if($this->request->is('no-origin')){
            //echo 'Erreur [JAX '.__LINE__.'] : La requête a échouée.';
            return false;
        } 
        
        switch ($data[0]) {
            case 'year':
                $reponse = $this->membre->upDate(array(  
                    'tables' => ' membre ', 
                    'affectations' => " mem_year = '".$data[1]."'", 
                    'conditions' => " mem_id = ". $_SESSION['membre']['mem_id']
                )); 
                if($reponse==true){
                    $_SESSION['membre']['mem_year'] = $data[1];
                    echo $data[1];
                }
        
                break;
            
            case 'ue':
                $reponse = $this->membre->upDate(array(  
                    'tables' => ' membre ', 
                    'affectations' => " mem_ue = '".$data[1]."'", 
                    'conditions' => " mem_id = ". $_SESSION['membre']['mem_id']
                )); 
                if($reponse==true){
                    $_SESSION['membre']['mem_ue'] = $data[1];
                    echo $data[1];
                }
                else echo $reponse;
        
                break;
            
            case 'temperament':
                $reponse = $this->membre->upDate(array(  
                    'tables' => ' membre ', 
                    'affectations' => " temperament = '".$data[1]."'", 
                    'conditions' => " mem_id = ". $_SESSION['membre']['mem_id']
                )); 
                if($reponse==true){
                    $_SESSION['membre']['temperament'] = $data[1];
                    echo $data[1];
                }
                else echo $reponse;
        
                break;
            
            default:
                return false;
                break;
        }
        //
    }
} 