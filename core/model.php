<?php
class Model {

    static $connections = array();

    public $dbname = 'nacder.net';
    public $tables = array(
            'default' => 'document'
    );
    public $db;


    function __construct($config=''){
            $erreur = '';
            $c = (!empty($config) ? Conf::$db[$config] : Conf::$db[$this->dbname]);
            if(isset(Model::$connections[$this->dbname])){
                    $this->db = Model::$connections[$this->dbname];
                    return true;
            }

            try{
            	                                   
                    $pdo = new PDO('mysql:host='.$c['db_host'].';dbname='.$c['db_name'].'',
                                    $c['db_user'],
                                    $c['db_pass'],
                                    array(
                                            PDO::ATTR_PERSISTENT => true,
                                            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                                            )
                    );
                    //var_dump($pdo); //il y a une erreur sur la creation de l'instance PDO si le nom de la base de donnée est mauvais
                    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    Model::$connections[$this->dbname] = $pdo;
                    $this->db = $pdo;
                    //echo "valeur de db"; var_dump($this->db); echo "fin de valeur de db";
                    return array(true,'');
            } 
            catch (PDOException $e){
                    $erreur =  $e->getMessage();
                    if(Conf::DEBUG)
                            return array(false,$erreur);
                    else
                            return array(false,"Impossible de se connecter à la base de donnée.");
            }
            
    }
    public function find($req=null){
            $sql = 'SELECT ';

            if(isset($req['champs']))
                    $sql .= $req['champs'];
            else
                    $sql .= ' DISTINCT * ';

            if(isset($req['tables']))
                    $sql .= ' FROM '. $req['tables'];
            else
                    $sql .= ' FROM '. $this->tables['default']; //.' as '. get_class($this);

            // construction de la condition

            if(isset($req['conditions'])){
                    $sql .= ' WHERE ';
                    if(!is_array($req['conditions']))
                            $sql .= $req['conditions'];
                    else
                            foreach($req['conditions'] as $t)
                                    $sql .= $t;
            }
            if(isset($req['order'])){
                    $sql .= ' ORDER BY ';
                            $sql .= $req['order'];
            }
            if(isset($req['limit'])){
                    $sql .= ' LIMIT ';
                            $sql .= $req['limit'];
            }
            //echo get_class($this)."::".$sql.'<br>';
            //Si il y a une erreur sur la ligne suivante, pensez à vérifier dans parametres.php dans la classe Conf et dans la variable $db le nom de la base de données et l'utilisateur. Il doit aussi avoir les droits pour y accéder.
            $q = $this->db->prepare($sql);
            try{
                    $q->execute();
            }
            catch(PDOException $e){ }
            if(!empty($req['fecthMethod']))
                $ret = $q->fetchAll($req['fecthMethod']);
			else	
				$ret = $q->fetchAll(PDO::FETCH_ASSOC);
			$q->closeCursor();
            return $ret;
    }
    public function findFirst($req=null){
            return current($this->find($req));
    }
    public function upDate($req=null){
        $sql = "UPDATE ";

                    if(isset($req['tables']))
                            $sql .= $req['tables'];
                    else
                            $sql .= $this->tables['default'];
        $sql .= ' SET ';
            if(isset($req['affectations']))
                    $sql .= $req['affectations'];
            else
                    return false;

            // construction de la condition

            if(isset($req['conditions'])){
                    $sql .= ' WHERE ';
                    if(!is_array($req['conditions']))
                            $sql .= $req['conditions'];
                    else
                            foreach($req['conditions'] as $t)
                                    $sql .= $t;
            }
            ////echo $sql;
            $q = $this->db->prepare($sql);
            $ret = false;
            try{
                    $ret = $q->execute();
            }
            catch(PDOException $e){ }
			$q->closeCursor();
            return $ret;
    }
    public function add($req){
        $sql = 'INSERT INTO '; 

        if(!isset($req['tables']))
            $sql .= $this->tables['default'];
        else
		    $sql .= $req['tables']; 

        if(isset($req['champs']))  
			$sql .= ' ( '. $req['champs']. ' ) '; 
        
		$sql .= ' VALUES ';

        if(!isset($req['values']))
                return false;

        $sql .= ' ( '. $req['values']. ' ) ';
		//echo $sql;
        $q = $this->db->prepare($sql);

        try{
                $ret = $q->execute();
        }
        catch(PDOException $e){ $ret = $e->getMessage();}
		$q->closeCursor();
		
        return $ret;
    }

    public function delete($req){
        $sql = 'DELETE FROM '; 

        if(!isset($req['tables']))
            $sql .= $this->tables['default'];
        else
            $sql .= $req['tables']; 

        // construction de la condition
        if(isset($req['conditions'])){
                $sql .= ' WHERE ';
                if(!is_array($req['conditions']))
                        $sql .= $req['conditions'];
                else
                        foreach($req['conditions'] as $t)
                                $sql .= $t;
        }
 
        $q = $this->db->prepare($sql);

        try{
                $ret = $q->execute();
        }
        catch(PDOException $e){ $ret = $e->getMessage();}
        $q->closeCursor();
        
        return $ret;
    }
}
        
