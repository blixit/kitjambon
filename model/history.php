<?php  
    class History extends Model{
        public $tables = array(
                'default' => 'history' 
        );  
        public function find($req)
        {	 
            $sql = 'SELECT *  FROM history h '
                //, membre m WHERE (m.mem_id =hh_mem_id OR m.mem_id =:id)  //triplet de  0 = admin
                .'WHERE (hh_mem_id=0 AND hh_net_id=0 AND hh_gr_id=0) OR (((hh_mem_id='.$req['id'].')  
                        OR (1<>1 ';
                        if(!empty($req['list_net'])){
                            $sql .= 'OR(';
                            foreach($req['list_net'] as $n){
                                if($n)
                                    $sql .=' hh_net_id = '.intval($n);
                                if($n!==end($req['list_net']))
                                     $sql .= ' OR ';
                            }
                            $sql .= ')';
                        }
                        
                        if(!empty($req['list_gr'])){
                            $sql .= ' OR (';
                            foreach($req['list_gr'] as $n){ 
                                    if($n)
                                        $sql .= ' hh_gr_id = '.intval($n);
                                    if($n!==end($req['list_gr']))
                                        $sql .= ' OR ';
                            }
                            $sql .= ')';
                        }
                $sql .=     '))
                        AND hh_date>TIMESTAMP((SELECT mem_date_joined FROM membre WHERE mem_id='.$req['id'].'))
                        )
                        ORDER BY hh_date DESC LIMIT '.$req['limit'];  
            //echo get_class($this)."::".$sql.'<br>';
            $q = $this->db->prepare($sql);             
            try{
                    $q->execute();
            }
            catch(PDOException $e){ }
            if(!empty($req['fecthMethod']))
                return $q->fetchAll(intval($req['fecthMethod']));
            return $q->fetchAll(PDO::FETCH_OBJ);
        }
        public function real_find($req){
            return parent::find($req);
        }

    }
?>