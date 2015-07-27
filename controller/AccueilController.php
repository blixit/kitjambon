<?php
    class AccueilController extends Controller{

        public $models = array(
            'default'=>'membre',
            'default2'=>'reseau',
            'default3'=>'groupe',
            'default4'=>'document',
            );
        public $params = array(
            'default'=>'',
        );

        function __construct($request){
            $this->request = $request;
            $this->layout = 'default';
        }

        function index(){
            $data = array(); 
            
            $data['nbMembre'] = $this->membre->findFirst(array(
                'champs' => 'DISTINCT COUNT(mem_id) as nbMembre',
                'tables' => 'membre',
                'conditions' => 'mem_etat = 1',
                'fecthMethod' => PDO::FETCH_ASSOC
            ));  

            $data['nbReseau'] = $this->reseau->findFirst(array(
                'champs' => 'DISTINCT COUNT(net_id) as nbReseau',
                'tables' => 'reseau',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            $data['nbGroupe'] = $this->groupe->findFirst(array(
                'champs' => 'DISTINCT COUNT(gr_id) as nbGroupe',
                'tables' => 'groupe',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));
            $data['nbDocs'] = $this->groupe->findFirst(array(
                'champs' => 'DISTINCT COUNT(doc_id) as nbDocs',
                'tables' => 'document',
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));                        
            $data['nbHits'] = $this->groupe->findFirst(array(
                'champs' => 'DISTINCT SUM(hits) as nbHits',
                'tables' => 'openu_files', 
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));

            //derniers fichiers ajoutés
            $data['fichiers'] = $this->document->find(array(
                'tables' => 'openu_files',
                'champs' => '*',
                'limit' => '0,5',
                'order' => 'upload_date DESC', 
                'fecthMethod' => PDO::FETCH_ASSOC,
            )); 

            //matières les plus demandées
            $matieres = $this->document->find(array(
                'tables' => 'reseau_membre',
                'champs' => 'DISTINCT net_id',  
                'fecthMethod' => PDO::FETCH_ASSOC,
            ));  
            if(!empty($matieres)){
                $data['nbInscrits'] = 0; $i=0;
                foreach ($matieres as $value) {
                    $tmp = $this->document->findFirst(array(
                        'tables' => 'reseau_membre',
                        'champs' => 'COUNT(mem_id) as nbInscrits', 
                        'conditions' => 'net_id = '. $value['net_id'] ,
                        'fecthMethod' => PDO::FETCH_ASSOC,
                    ));  
                    $matieres[$i]['nbInscrits'] = (int)$tmp['nbInscrits']; 
                    $i++;
                }
                //tri des matières
                $matieresPlusDemandees = array();
                $max1 = 0; $max2 = 0;

                for($k=0; $k<count($matieres);$k++){
                    for($j=0; $j<count($matieres);$j++){
                        if($matieres[$j]['nbInscrits']>=$max1)
                            {$matieresPlusDemandees[0] = $matieres[$j]; $max1 = $matieres[$j]['nbInscrits']; }
                        elseif($matieres[$j]['nbInscrits']>$max2)
                            {$matieresPlusDemandees[1] = $matieres[$j]; $max2  = $matieres[$j]['nbInscrits'];}
                    }
                }
                $data['matieres'] = $this->document->find(array(
                    'tables' => 'reseau',
                    'champs' => '*',
                    'conditions' => 'net_id = '.$matieresPlusDemandees[0]['net_id'].' OR net_id ='.$matieresPlusDemandees[1]['net_id'],  
                    'fecthMethod' => PDO::FETCH_ASSOC,
                )); 
            } 
            $list = Script::_multi_script(array(
                array(
                        'action' => 'keyup',
                        'element' => '#searchBar',
                        'name' => '', 
                        'code' => " var valeur=$('#searchBar').val();  if(valeur.length>4)  searchFiles(valeur);  "
                )
            ));  
        /*Les champs obligatoires pour le type _query : toReload, "query, #element, #reponse , "method, "url*/
         
        $data['mesScripts'] = $list['s']; //définitions des fonctions => dans le header
        $data['mesScriptsFunc'] = $list['d']; // appels des fonctions définis => dans le footer


            $this->myrender(array(
                'menu' => 'menu',
                'title' => constant('site_i_name'),
                'view' => 'index',
                'variables' => $data,
            )); 
        }
        //les fonctions vides ne sont PAS inutiles
        function presentation(){   }


    } 
