<?php 
	class sondageController extends Controller{
	
		public $models = array(
			'default'=>'sondage', 
			); 
		
		function __construct($request){
			parent::__construct($request);
			$this->layout = 'default'; 
		}
		 
		function index(){ 
			//si pas connecté on redirige vers la page de connexion
	        if(!$this->session->islogged()){
	            $this->redirect("?membre/login/"); 
	        }
 
			$listeDesSondages = $this->sondage->find(array( 
				'conditions' => 'sond_dateF >= NOW() ',
                'fecthMethod' => PDO::FETCH_ASSOC)); 
			$variables['listeDesSondages'] = $listeDesSondages;  
			//récupérer le nombre de questions

			//ou ecrire une fonction dans le modele qui récupère les sondages et le nombre de question
			// ou laisser tomber car non pertinent

			$this->myrender(array(
				'menu' => 'menu',
				'title' => 'Liste des sondages',
				'view' => 'index',
				'variables' => $variables,
			));
		}
		 
		function view($id){
		  	//si pas connecté on redirige vers la page de connexion
	        if(!$this->session->islogged()){
	            $this->redirect("?membre/login/"); 
	        }
	        //
	        $sondage = $this->sondage->findFirst(array( 
				'tables' => 'sondage_table',
				'conditions' => 'sond_id = '.$id,
                'fecthMethod' => PDO::FETCH_ASSOC
            )); 
            $nbQuestions = $this->sondage->findFirst(array( 
            	'champs' => 'count(*) as total',
				'tables' => 'sondage_table NATURAL JOIN sondage_question',
				'conditions' => 'sondage_table.sond_id = sondage_question.sondQ_sondage_id 
								AND  sondage_table.sond_id = '.$id,
                'fecthMethod' => PDO::FETCH_ASSOC
            )); 
            $sondage['sond_nbQuestions'] = $nbQuestions['total'];
			$variables['sondage'] = $sondage;  

			if(!is_numeric($id) || empty($sondage)){  
	            $message = (Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : L'id du sondage n'est pas correcte." : "Le chemin ".$params." n'existe pas.";
				$this->error($message);
			} 
			//
 
			$questions = $this->sondage->find(array( 
				'tables' => 'sondage_question',
				'conditions' =>  " sondQ_sondage_id = ".$id,
				'fecthMethod' => PDO::FETCH_ASSOC 
			));  

			for ($i=0; $i <count($questions) ; $i++) { 
				$questions[$i]['reponses'] = explode("#", $questions[$i]['sondQ_options']);
			}
			 
			$variables['questions'] = $questions; 

			$this->myrender(array(
				'menu' => 'menu',
				'title' => ucfirst($questions[0]['sondQ_question']),
				'view' => 'view',
				'variables' => $variables,
			));
			
		}
- 100 utilisateurs en moins de 4 mois (176 aujourd'hui)
- une communauté de +200 personnes (plus que certains clubs)
- 19388 téléchargements contre 0 upload, 0 upload, 0 upload, 0 upload ... (Grrrrrr ! )
ce dernier chiffre donne la migraine.
On aimerait améliorer l'application, mais à quoi bon si personne ne veut partager ?!!0

		/**
		*	@brief récupère les données d'un formulaire  
		*	@param id l'identifiant du sondage
		*/
		function post($id){ 
			//si pas connecté on redirige vers la page de connexion
	        if(!$this->session->islogged()){
	            $this->redirect("?membre/login/"); 
	        }

			//
			if(!empty($this->request->data) ){ 
				$_SESSION['saveform'] = $this->request->data;
				$this->redirect('?sondage/post/'.$id);
			} 

			if(!empty($_SESSION['saveform'])){
				//
				//enregistrer les réponses dans la table sondage_resultats

				//mettre à jour le nb de participants dans la table sondage_table
				
				//mettre a jour le vote de l'utilisateur dans la sondage_membre
				unset($_SESSION['saveform']);
			}


			die;
			$this->redirect('?sondage/view/'.$id);

		}
	
	}
?>