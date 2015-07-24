<?php  
    class Document extends Model{
        public $tables = array(
                'default' => 'document' 
        ); 

        function checkPath($path){
                $doc = $this->find(array(
                        'conditions' => 'doc_path LIKE '.'\'%'.$path.'%\'',
                        'limit' => '1'
                        )); 
                return (empty($doc)) ? false : true;
        }  

    } 