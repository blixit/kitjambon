<?php
/* 
Ce controller s'appelle Nupload en référence à New Upload
Il permet concretement d'importer des fichiers dans la base de données en les adaptant au format de celle ci


Arborescence des fichiers
files
>eiX
>>Option
>>>Module || Type de document
>>>>Type de document || annee || Proposition || Fichier
>>>>>Annee || Proposition || Fichier
>>>>>>Proposition || Fichier
>>>>>>>Fichier

*/
class NuploadController extends Controller{


//Cette fonction fait l'inventaire des options et modules existant dans le repertoire files et les ajoute à la base de données
function ajout_option($path=ROOT.DS.'files')
{
	//echo $path, "<br/>";
	if(is_dir($path))
	{  
		//echo "path est un repertoire <br/>";
		$dossier = opendir($path);
		while($fichier = readdir($dossier))
		{
			//echo "Il y a un fichier dans le dossier:", $fichier, "<br/>";
			if($fichier != '.' && $fichier != '..' && $fichier != 'index.php')
			{
                        $path = trim($path,'/'); 
                        //echo "on réexéctute la fonction <br/>";
                        self::ajout_option('/'.$path.'/'.$fichier); 
                	}
                	
		}
		//echo "Il n'y a plus de fichier dans le dossier <br/>";
		closedir($dossier);
	}					
	elseif(is_file($path))
	{   
		//on décompose le chemin pour retrouver l'option, le module s'il existe et le type de documents (TA,DS,TP,TD,Cours,Fiches)
		
		$position = strrpos($path, '/ei') + 5; //position est initialement placé sur le premier caractère de l'option
		$option = NULL; $module = NULL; $type_document = NULL; $annee = NULL; $proposition = NULL; $nom_fichier = NULL; //initialisation des variables à retrouver
		
		
		//on récupère le nom du premier dossier après ei1 ou ei2 qui correspond au nom de l'option
		while($position<strlen($path) && $path[$position] != '/')
		{
			$option = $option.$path[$position];
			$position = $position +1;
		}
		
		//on récupère le nom du second dossier après ei1 ou ei2 qui correspond au nom du module ou au type de document
		$position = $position +1;
		while($position<strlen($path) && $path[$position] != '/')
		{
			$module = $module.$path[$position];
			$position = $position +1;
		}
		
		//si le deuxième nom correspond au type de document on transfert le nom sur la variable dans type de document et on met module à NULL
		if( strtolower($module) == 'td' || strtolower($module) == 'tp' || strtolower($module) == 'ta' || strtolower($module) == 'ds' || strtolower($module) == 'cours' || strtolower($module) == 'fiches' || strtolower($module) == 'cm')
		{
			$type_document = $module;
			$module = NULL;
			//echo "on rentre dans le if";
		}
		
		
		//On va chercher le troisième nom de dossier (qui peut être un fichier) et on identifie de quoi il s'agit
		//ce troisième nom peut être un type de document, une année, un kit/proposition ou un nom de fichier
		$nom_fichier_trouve = 0; $nom_fichier = NULL; 
		$position = $position +1;
		while($position<strlen($path) && $path[$position] != '/')
		{
			$nom_fichier = $nom_fichier.$path[$position];
			if($path[$position]=='.')
			{
			 	$nom_fichier_trouve = 1;
			}
			$position = $position +1;	
		}
		
		if($nom_fichier_trouve == 0)
		{
			//identifions le troisième nom
			if( strtolower($nom_fichier) == 'td' || strtolower($nom_fichier) == 'tp' || strtolower($nom_fichier) == 'ta' || strtolower($nom_fichier) == 'ds' || strtolower($nom_fichier) == 'cours' || strtolower($nom_fichier) == 'fiches' || strtolower($nom_fichier) == 'cm')
			{
				$type_document = $nom_fichier;
				$nom_fichier=NULL;
			}
			elseif(strrpos($nom_fichier, '20') != FALSE)
			{
				$annee = $nom_fichier;
				$nom_fichier=NULL;
			}
			elseif(strripos($nom_fichier, 'proposition') != FALSE)
			{
				$proposition = $nom_fichier;
				$nom_fichier=NULL;
			}
		
			//On va chercher le quatrième nom de dossier (qui peut être un fichier) et on identifie de quoi il s'agit
			//ce troisième nom peut être un une année, un kit/proposition ou un nom de fichier
			$nom_fichier_trouve = 0; $nom_fichier = NULL; 
			$position = $position +1;
			while($position<strlen($path) && $path[$position] != '/')
			{
				$nom_fichier = $nom_fichier.$path[$position];
				if($path[$position]=='.')
				{
				 	$nom_fichier_trouve = 1;
				}
				$position = $position +1;	
			}
		
			if($nom_fichier_trouve == 0)
			{
				//identifions le quatrième nom

				if(strrpos($nom_fichier, '20') != FALSE)
				{
					$annee = $nom_fichier;
					$nom_fichier=NULL;
				}
				elseif(strripos($nom_fichier, 'proposition') != FALSE)
				{
					$proposition = $nom_fichier;
					$nom_fichier=NULL;
				}
			
				
				//Si on a toujours pas trouvé nom_fichier, on regarde le cinquieme dossier qui ne peut être qu'un proposition ou alors le nom du fichier 
				
				$nom_fichier_trouve = 0; $nom_fichier = NULL; 
				$position = $position +1;
				while($position<strlen($path) && $path[$position] != '/')
				{
					$nom_fichier = $nom_fichier.$path[$position];
					if($path[$position]=='.')
					{
					 	$nom_fichier_trouve = 1;
					}
					$position = $position +1;	
				}
		
				if($nom_fichier_trouve == 0)
				{
					//identifions le cinquieme nom de dossier

					if(strripos($nom_fichier, 'proposition') != FALSE)
					{
						$proposition = $nom_fichier;
						$nom_fichier=NULL;
					}
			
				
					//Si on a toujours pas trouvé nom_fichier, alors on va identifier le fichier en commençant par la fin du chemin
					$nom_fichier= NULL;
					$longueur_path=strlen($path)-1;
					while($path[$longueur_path]!='/' && $longueur_path>0)
					{
						$nom_fichier=$path[$longueur_path].$nom_fichier;
						$longueur_path=$longueur_path-1;
					}
				}
			}

		}
		
		echo $path, "<br/>";
		echo $option, ' XXX  ', $module, ' XXX  ', $type_document,' XXX  ', $annee,' XXX  ', $proposition,' XXX  ', $nom_fichier, "<br/>";
		
		
		//on vérifie que notre option n'existe pas déjà dans la base de données
		
		$requete= array( 'champs' => 'option_id', 'tables'=>'option', 'conditions'=> 'option_nom='.$option.' AND option_module='.$option);
		$model = new Model;
		$tableau_bdd = $model -> find($requete);
		var_dump($tableau_bdd); var_dump($this->option);
		echo "<br/>";
		
		
		
		
		
		
		
		//on insère notre option dans la base de données
	}				
	//return $error;
	//echo "fin d'execution de la fonction <br/>";	
}

function ajout_Fichier_root()
{

}

function ajout_transfert()
{
	
}

function ajout_fichier_user()
{
	
	
	
}

}
