<?php
/*
 * Sur ce site, les urls ont la forme particulière suivante : 
 * domaine.tld?controller/action/paramètres en production
 * 127.0.0.1/wwwpath/?controller/action/parametres en dev local
 * Avoir cet info permet en partie de comprendre le reste.
 * Cette remarque est aussi valable pour urls.php et dispatcher.php
 */
/*
 * Le constructeur récupère les infos utiles de l'url et les stocke dans un tableau $url_info
 */
class Request{
    public $url; // URL appelée par l'utilisateur
    public $controller; //chaine de carctere
    public $action;
    public $params;
    public $data;
    public $datafile;
    public $url_info = array();
    function __construct(){
        // on récupère les informations importantes sur l'url et l'origine de la requete
        $this->url_info['no-origin'] = true; 
        $h = filter_input(INPUT_SERVER, 'HTTP_REFERER');
        if(isset($h)){ 
            $this->url_info['no-origin'] = false;
            $t = parse_url($h,PHP_URL_PORT);
            $this->url_info['port'] = $t ? $t : filter_input(INPUT_SERVER, 'SERVER_PORT');
            $this->url_info['scheme'] = parse_url($h,PHP_URL_SCHEME);
            $this->url_info['path'] = parse_url($h,PHP_URL_PATH);
            $this->url_info['pass'] = parse_url($h,PHP_URL_PASS);
            $this->url_info['query'] = parse_url($h,PHP_URL_QUERY);
            $this->url_info['host'] = parse_url($h,PHP_URL_HOST);
            $this->url_info['user'] = parse_url($h,PHP_URL_USER);
            $this->url_info['fragment'] = parse_url($h,PHP_URL_FRAGMENT);
            $this->url_info['external'] = false;
            if($this->url_info['host'] !=  constant('site_i_host')){
                $this->url_info['external'] = true;
            }
        } 
        
        $this->url_info['https']  = filter_input(INPUT_SERVER, 'HTTPS');
        $this->url_info['client_addr'] = filter_input(INPUT_SERVER, 'REMOTE_ADDR');
        $this->url_info['client_host'] = filter_input(INPUT_SERVER, 'REMOTE_HOST');
        $this->url_info['client_port'] = filter_input(INPUT_SERVER, 'REMOTE_PORT');
        $this->url_info['user_agent'] = filter_input(INPUT_SERVER, 'HTTP_USER_AGENT');
        $this->url_info['server_signature'] = filter_input(INPUT_SERVER, 'SERVER_SIGNATURE');
		
        //inconvénient de PATH_INFO : ne récupère pas les paramètres $_get
        $this->url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 'accueil'; // or PATH_INFO 
        
        /*en debug, on retire URL_TO_REMOVE = /_base/webroot (c'est le wwwpath)
         * Ca permet de simuler unn travail en 
         */ 
        $this->url = preg_replace(URL_TO_REMOVE,'',$this->url); //marche avec REQUEST_URI à la place PATH_INFO retire le répetoire DEBUG : _base/webroot ou rien
         
        /* On retire les .. ou ../ pour éviter toute attaque TD car certaines
         * url contiennent des pseudos répertoires. cf DownloadController.php
         */
        $this->url = str_replace(array('../','..'),array('',''),$this->url); 
        
        /* On récupère les données  
         */        
		if(isset($_POST))
        $this->data =& $_POST; 
        else $this->data =  null; 
        // $this->data = isset($_POST) ? $_POST : null; 
        $this->datafile = isset($_FILES) ? $_FILES : null; 
        //le reste est géré par le controlleur en fonction des besoins.
            
    }
    public function is($key){
        return (isset($this->url_info[$key])) ? $this->url_info[$key] : false;
    }

}
?>
