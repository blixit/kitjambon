<?php 
	class coursController extends Controller{
	
		public $models = array(
			'default'=>'reseau', 
			);
		public $params = array(
			'default'=>'ei1',
		);
		
		function __construct($request){
			parent::__construct($request);
			$this->layout = 'default'; 
		}
		 
		function view($niveau,$ue=null){
		  	$str = "ei".$niveau;
			$cours[$str] = $this->reseau->find(array( 
				'conditions' =>  " net_niveau   = ".intval($niveau)." ".(isset($ue) ? "AND net_nom = ".Functions::squote(strtolower($ue)): ""), 
				'order' => 'net_options ASC'
			)); 
			$cours[$str]['nom'] = "EI".$niveau;
			
			if(empty($cours)){
				$message = (Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."] : Un des paramètres n'est pas configuré." : "Le chemin ".$params." n'existe pas.";
				$this->error($message);				
			}
			
			$ue = isset($ue) ? $ue : 'algpr';
			$variables['link_cours'] = '?download/a/'.$niveau.'/'.$ue; 
			$variables['cours_niveau'] = $niveau; 
			$variables['cours'] = $cours;  
			
			$this->myrender(array(
				'menu' => 'menu',
				'title' => 'Modules des EI'.strtoupper($niveau),
				'view' => 'view',
				'variables' => $variables,
			));
			
		}
		 
		function index(){ 
			$cours['ei1'] = $this->reseau->find(array( 'conditions' => 'net_niveau=1'));
			$cours['ei1']['nom'] = 'EI1';			
			$cours['ei2'] = $this->reseau->find(array( 'conditions' => 'net_niveau=2', 'order' => 'net_options ASC'));
			$cours['ei2']['nom'] = 'EI2';
			$cours['ei3'] = $this->reseau->find(array( 'conditions' => 'net_niveau=3'));
			$cours['ei3']['nom'] = 'EI3';
			
			if(empty($cours)){
				$message = (Conf::DEBUG) ? "Erreur [".get_class($this)." ".__LINE__ ."]." : "Erreur [ CTRL".__LINE__ ." ] : un problème est survenu lors du chargement de la page.";
				$this->error($message);				
			}
			
			$variables['cours'] = $cours;  
			   
			$this->myrender(array(
				'menu' => 'menu',
				'title' => "Liste de tous les modules actuels",
				'view' => 'index',
				'variables' => $variables,
			));
		}
	
	}
?>