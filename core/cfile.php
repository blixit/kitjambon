<?php
	 class cfile{
		private  $id = 0 ;
		private  $name = ""; 
		public    $path =""  ;
		private  $date = "" ;
		private  $mdate = "" ;
		private  $size = 0 ;
		private  $year = 0 ;
		private  $ue = ""  ;
		private  $catg = "" ; 
		private  $url = ""  ;
		private  $code = ""  ;
		private  $valid = 0 ;

		private $token = array();
 		
 		/**
 		* @param $type 'f' pour file=nom de fichier, 'd' pour data=tableau de données
 		* n pour nothing = on récupère le fichier par au rapport au répertoire utilisateur ex : 1/algpr/dir
 		*/
		function __construct($object,$type='f',$version='',$year='',$ue='',$catg='' ){ 
			switch ($type) {
				case 'f': 
					if (!file_exists($object) or !is_file($object)){
 						return null;
					}

					$this->name = basename($object);
					$this->path = $object;
					$this->date = fileatime($object);
					$this->mdate = filemtime($object);
					$this->size = filesize($object); 

					break;
				
				case 'd':
					if (!is_array($object)){
						return null;
					}
					$this->name = $object['doc_'];
					$this->path = $object['doc_'];
					$this->date = $object['doc_'];
					$this->mdate = $object['doc_'];
					$this->size = $object['doc_'];
					$this->mdate = $object['doc_'];
					$this->mdate = $object['doc_'];
					$this->mdate = $object['doc_'];

					break;
				case 'n': 
					if (!file_exists($object) or !is_file($object)){
 						return null;
					}

					$this->name = basename($object);
					$this->path = $object;
					$this->date = fileatime($object);
					$this->mdate = filemtime($object);
					$this->size = filesize($object); 

					break;
				default: 
					return null;
					break;
			}
			
		}
		static function readMyFile($path,$base=false){
			$ret = array();
             
			if(is_dir($path)){  
				$dossier = opendir($path);
	            while(false !== ($fichier = readdir($dossier))){
	            	if($fichier != '.' && $fichier != '..' && $fichier != 'index.php'){
                        $path = trim($path,'/'); 
                        $tmp = self::readMyFile($path.'/'.$fichier);
                        $ret = array_merge($ret,$tmp);  
                    }
	            }
	            closedir($dossier);
			}					
			elseif(is_file($path)){   
				$ret[] = $path;
			}				

			return $ret;
		}
	}
?>