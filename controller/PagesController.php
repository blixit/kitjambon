<?php 
	class PagesController extends Controller{

		public $models = array( 
            'default'=>'reseau', 
        );
		function __construct($request){
			$this->request = $request;
			$this->layout = 'default'; 
		}
		
		/*function view($name){ 
			$this->set(array(
				'phrase' => "Nous sommes sur la page d'accueil des pages:".$name,
				'nom' => 'Bertrand',
			));
			$this->render('index');
		}*/
		function index(){  
			//$this->parsefile_FillBDD();
			/*
			$this->getMenu = $this->renderMenu('menu'); 
			$this->set('content_for_menu',$this->getMenu);
			$this->render('index');
			/*faire d'autres actions d'initialisation ici et laisser la fonction par defaut du dispatcher
			s'occuper du render*/
			//$file_src = '../.gitignore'; ca marche
			//$file_src = '../filesOld/ei1/algpr/ta/GEMAT.pdf'; // marche pas 
			//$file_src = '../filesOld/ei1/algpr/ta/test2.c'; // marche
			$file_src = '../filesOld/ei1/algpr/ta/cv.docx';
			if(file_exists($file_src)){
				$variables['file_src'] = $file_src;
			} 
			$this->myrender(array(
	            'menu' => 'menu',
	            'title' => 'page test',
	            'view' => 'index',
	            'variables' => $variables,
	        ));
		}
		private function parsefile_FillBDD(){
			$filename = "../liste.txt";
			if(!file_exists($filename))
				die('coriace');
			$file = fopen($filename, "r");
			if ($file) {
				$option = "";
				$lastotpion = "";
			    while (($buffer = fgets($file, 4096)) !== false) {
			        //echo $buffer.'<br>';
			        if(strlen($buffer)>3 && is_numeric($buffer[0].$buffer[1])){
			        	$option = strtolower(trim(substr($buffer, 3)));
			        	$lastotpion = $option;
			        	//echo 'Options : '.$option.' $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$<br>';
			        	while (($buffer = fgets($file, 4096)) !== false && (substr($buffer,0,5)!=="-----")){
			        		$tab = array();
			        		if(!empty($buffer) && (substr($buffer,0,2)!=="**")){
			        			$tab = explode('–',$buffer); 
			        			$tab[0] = strtolower(trim($tab[0]));
			        			$tab[1] = strtolower(trim($tab[1]));
			        			$tab = (empty($tab[0]) || empty($tab[1])) ? null : $tab;
			        			/*
			        			$this->reseau->add(array(
			        				'values' => " '','".$tab[0]."'"
			        							.",2"
			        							.",'".$tab[1]."'"
			        							.",'".$option."'"
			        							.",'' "
			        			));*/
			        		}
			        		if(!empty($tab))
			        			echo "\t   ".$tab[0].'::'.$tab[1].'<br>'; 
			        	}
			        	echo 'FIN<br>';
			        }
			    }
			    if (!feof($file)) {
			        echo "Erreur: fgets() a échoué\n";
			    }
			    fclose($file);
			}

		}
		function pdf(){ 
			$this->myrender(array(
	            'menu' => 'menu',
	            'title' => 'page test',
	            'view' => 'index',
	            'variables' => null,
	        ));
		}
	
	}
?>