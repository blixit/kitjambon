<?php
class UploadController extends Controller{

    public $models = array(
            'default'=>'reseau',
            'default2'=>'document',
            );
    public $params = array(
            'default'=>'ei1',
    );

    function __construct($request){
            parent::__construct($request);
            $this->layout = 'default';
    } 

    function index(){
        if(!$this->session->islogged()) 
            $this->redirect("?membre/login"); 
			
		//on crée le jeton s'il n'existe pas 
        if(Session::getToken('uploadDefichier')===false){ 
            Session::addToken(array(
                'name' => 'uploadDefichier',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
            ));
        }
         
		$soumis = null;
        $erreurs = array();
        $notifications = array(); 
        
        /* petite manipulation pour éviter les soumissions multiples de formulaire ...
         * le souci avec cette méthode c'est qu'elle ne préserve pas le fichier téléchargé après la redirection
         * il faut donc le sauvegarder avant de rediriger. La sauvegarde s'effectue dans un fichier temporaire
		 * sous condition que le fichier soit valide
		 */
        if($this->request->data){
            $soumis = $this->request->data;
            $soumisfile = $this->request->datafile;
            
            /* à ce niveau, le formulaire a été envoyé.
             * Si la requete provient d'un autre site ou n'a pas de http_referer (a été directement écrite dans l'url)
             * on la rejette illico
             */ 
            if($this->request->is('external') || $this->request->is('no-origin') || !Session::isValidToken('uploadDefichier')){
               $message = 'Erreur [DLU '.__LINE__.'] : La requête a échouée. Veuillez réactualiser la page.';
               $this->error($message);
               return false;
            } 
            $t = Session::getToken('uploadDefichier');
            if($t['value']!==$soumis['token'])  
                $erreurs[] = "Le formulaire n'est plus valide.";
                
            // on sauvegarde le fichier avec les seuls droits de lecture si la taille est bonne et aucune erreur détectée
            $upload_max_file = PregFucntions::return_bytes(ini_get('upload_max_filesize'));
            $size = filesize($soumisfile['fichier']['tmp_name']); 
			
            if(empty($erreurs) && $size <= $upload_max_file){
                $valid = $this->anyErrorFile($soumisfile['fichier']['error']);
                if($valid){                    
                    $name = $soumisfile['fichier']['name'];
                    $path = UPLOADS.DS.$soumisfile['fichier']['name'];  
					
                    if($this->moveFile($soumisfile['fichier']['tmp_name'],$path,0444)) {  
                                    $_SESSION['saveform'] = $soumis;
                                    $_SESSION['saveformfile'] = $path;  
                                    unset($soumis);
                                    unset($soumisfile);  
                                    header('Location: '.Router::url('?upload/index/'));
                                    exit; 
                    }
                    else{
                            $erreurs[] = "Une erreur est survenue.";
                            $erreurs[] = "Il se pourrait que votre fichier ne respecte pas les règles de sécurité.";
                    }
                    
                }
                else
                    $erreurs[] = $valid; 
            }         
            else
                $erreurs[] = "La limite autorisée est de ".ini_get('upload_max_filesize')."o";
                
        }
        
		// ... suite de la manipulation et déplacement du fichier vers sa destination finale
        if(isset($_SESSION['saveform'])){ 
            // à ce niveau, il ne sert à rien de continuer si le jeton est invalide. D'ailleurs on le supprime
            if(!Session::isValidToken('uploadDefichier')){ 
                $message = "Le temps de soumission est dépassé. Veuillez recharger la page.";
                $this->error($message);
                return false;
            } 
            //récupération des données et suppression des varibles de session
            $soumis = $_SESSION['saveform'];
            $soumisfile = $_SESSION['saveformfile']; 
            unset($_SESSION['saveform']); 
            unset($_SESSION['saveformfile']);  
            
            //on récupère les données du formulaire
            $form = array(
                'year' => $soumis['year'], 
                'ue' => $soumis['ue'], 
                'catg' => strtolower($soumis['catg']), 
                'name' => basename($soumisfile), 
                'size' => filesize($soumisfile),//($soumisfile['fichier']['tmp_name']),
                'path' => 'files/ei'.$soumis['year'].'/'.$soumis['ue'].'/'.$soumis['catg'].'/',
                'code' => Session::genereToken(),
                'valid'=>0
            );
			
            // On s'assure que le token généré est unique dans la base de données
            while($this->document->find(array( 'conditions'=>'doc_code=\''.$form['code'].'\'','fecthMethod' => PDO::FETCH_ASSOC))){  
                $form['code'] = Session::genereToken();
            }  
			//on s'assure que le cours corrsepond à l'année Ex: algpr => ei1
			$find = $this->reseau->find(array( 
				'conditions' => 'net_niveau = '.$form['year'].' AND net_nom = '.Functions::squote($form['ue']).' ',
				'fecthMethod' => PDO::FETCH_ASSOC
			));
			  		
			if($find){ 
				//On place les fichiers au bon endroit
				$path = DWLOADS_short.DS.$form['path'].$form['name']; 
				if($this->renameFile($soumisfile,$path)){ 
					/* Puisque le fichier a déjà été contrôlé, on l'ajoute aisément dans la base de données puis dans le 
					 * bon répertoire, mais avec le statut non approuvé par l'admin, soit mem_etat = 0 
					 */ 
					if($this->document->add(array( 
						'values'=>" '',".Functions::squote($form['name'])
						.",".Functions::squote($form['path']).",".$form['size']
						.",".$form['year'].",".Functions::squote($form['ue'])
						.",".Functions::squote($form['catg']).",".Functions::squote($form['code'])
						.",0,NOW()" 
					))===true){
						$notifications[] = "Votre fichier a bien été uploadé sous le nom : ".$form['name'];
						$notifications[] = "Votre fichier a bien été uploadé et attend d'être validé. ";
					} 
					else
						$erreurs[] = "[1] Une erreur est survenue lors de la migration des fichiers.";
				}
				else
					$erreurs[] = "[2] Une erreur est survenue lors de la migration des fichiers.";
			}
			else{
				$erreurs[] = "Le module mentionné ne correspond pas à l'année choisie.";		
				chmod($soumisfile,0777);
				unlink($soumisfile);
			}			
            //Une fois le formulaire soumis, on génère un nouveau jeton, et ce quelque soit l'issue (formulaire validé ou non, envoyé ou non)
            Session::addToken(array(
                'name' => 'uploadDefichier',
                'limit_time' => 10*60, //10 min  
                'time' => time(), 
                'erase' => true,
            ));
 
            
        } 
        
        $list_ue['ei1'] = $this->reseau->find(array( 'conditions' => 'net_niveau=1','fecthMethod' => PDO::FETCH_ASSOC));
        $list_ue['ei2'] = $this->reseau->find(array( 'conditions' => 'net_niveau=2','fecthMethod' => PDO::FETCH_ASSOC));
        $list_ue['ei3'] = $this->reseau->find(array( 'conditions' => 'net_niveau=3','fecthMethod' => PDO::FETCH_ASSOC));
        $list_catg = array(
                'ds'=>'Enoncés de Devoirs Surveillés',
                'dsc'=>'Corrigés de Devoirs Surveillés',
                'ta'=>'Travaux en Autonomie',
                'tp'=>'Travaux Pratiques',
        );
        if(empty($list_ue)){
                $message = (Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."]." : "Erreur [ DLU ".__LINE__ ." ] : un problème est survenu lors du chargement de la page.";
                $this->error($message);
        } 
        $variables['soumis'] = $soumis;
        $variables['erreurs'] = $erreurs;
        $variables['notifications'] = $notifications;
        $variables['list_ue'] = $list_ue;
        $variables['list_catg'] = $list_catg;
 
        $this->myrender(array(
            'menu' => 'menu',
            'title' => 'Espace Upload',
            'view' => 'index',
            'variables' => $variables,
        ));
        unset($soumis);
        unset($soumisfile);
    }
    
    /* On déplace le fichier, avec un nouveau nom unique si un doublon existe, vers le rep TMP_UPLOADS
     * Le déplacement ne s'effectue que si les règles sont respectées
     * On change enfin les droits sur le fichier en lecture seule
    */
    protected function moveFile($oldname,$newname,$rights=0404){
            $filename = basename($newname);  
            $dir = dirname($newname).DS;  
            $t = explode('.', $filename);  

    if(sizeof($t)>0 && PregFucntions::prohibited_extension(end($t)))  return false;  
            if(!PregFucntions::check_file_name($filename))  return false; 
    if(!PregFucntions::check_file_length($newname))  return false; 

            $uniqnewname = $this->uniqFileName($dir,$filename);
            if($uniqnewname!==false){
                    if(is_uploaded_file($oldname)){
                            if(move_uploaded_file($oldname,$dir.$uniqnewname)){ 
                                    if(chmod($dir.$uniqnewname,$rights))
                                            return true;
                            }  
                    }   
            }  

    return false;        
}
    /* Renomme le fichier avec un nom unique si un doublon existe dans le rep final*/
    protected function renameFile($oldname,$newname){
		$filename = basename($newname);  
		$dir = dirname($newname).DS; 
		$uniqnewname = $this->uniqFileName($dir,$filename);
		if(!is_dir($dir))
			mkdir($dir,0700,true);			
		return ($uniqnewname!==false) ? rename($oldname,$dir.$uniqnewname) : false;
    }
    /* Cette fonction reçoit un nom de fichier et son répertoire et détermine un nom unique dans ce répertoire
     * Si le chemin n'est pas trouvé, on retourne le même nom de fichier 
     * Elle ne gère pas les doubles extensions
     */
    protected function uniqFileName($path,$name){ 
            if(!file_exists($path.$name)) //le nom est déjà unique
                    return $name;

            $t = explode('.', $name); 
            if(sizeof($t)<=2){
                    while(file_exists($path.$name)){
                            if(sizeof($t)==2)
                                    $name = $t[0].'_'.uniqid().'.'.$t[1];
                            else  
                                    $name = $t[0].'_'.uniqid(); 
                    }
                    return $name;
            }
            return false;
    }
    /*
     * Si file_error n'est pas définie, on returne false
     * Si aucune erreur, true
     * si erreur, on reonvoie l'erreur
     */
    protected function anyErrorFile($file_error) { 
        if (is_numeric($file_error)) { 
            $error_msg = '';
            switch ($file_error){     
                case 1: // UPLOAD_ERR_INI_SIZE     
                    $error_msg = "Le fichier dépasse la limite autorisée par le serveur (fichier php.ini) !";     
                break;     
                case 2: // UPLOAD_ERR_FORM_SIZE     
                    $error_msg =  "Le fichier dépasse la limite autorisée dans le formulaire HTML !"; 
                break;     
                case 3: // UPLOAD_ERR_PARTIAL     
                    $error_msg = "L'envoi du fichier a été interrompu pendant le transfert !";     
                break;     
                case 4: // UPLOAD_ERR_NO_FILE     
                    $error_msg = "Le fichier que vous avez envoyé a une taille nulle !"; 
                break;     
            } 
            if(!strlen($error_msg))
                return true;
            return $error_msg;
        }
        return false;
    }
}
