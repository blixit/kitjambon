<?php
class Functions{
    static function human_filesize($bytes, $decimals = 0) {
            $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$size[$factor];
    }  
    static function debug($var){
            if(Conf::DEBUG){
                    $debug = debug_backtrace();
                    echo '<p><a href="#" onclick="$(this).parent().next(\'ul\').slideToggle(); return false;"><strong>'.$debug[0]['file'].'</strong> '.$debug[0]['line'].'</a></p>';
                    echo '<ul style="display:none">';
                    foreach($debug as $k=>$v){
                            if($k>0 && isset($v['file'])){
                                    echo '<li><strong>'.$v['file'].'</strong> '.$v['line'].'</li>';
                            }
                    }
                    echo '</ul>';
                    var_dump($var);
            }
    }
    static function squote($mot){ return "'".$mot."'";}
    static function dquote($mot){ return "\"".$mot."\"";}
	function enlever_accents($string) 
  {  
    $string= strtr($string,  
      "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ ", 
      "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn_");  

    return $string;  
  }
   /*Algo récursif qui renomme le fichiers en minuscule*/
    static function mtolower($dir='../filesOld/'){
        $dossier = opendir($dir);   static $i=0;  echo $i++;
            while(false !== ($fichier = readdir($dossier))){
                if($fichier != '.' && $fichier != '..'){
                    if(is_dir($dir.$fichier)){ 
                        rename($dir.$fichier, $dir.strtolower($fichier)); 
                        mtolower($dir.strtolower($fichier).'/'); 
                    } 
                }
            }
    }
}
class PregFucntions{
    static function verifyAlphaNum($mot)
    {
            return (preg_match("/^[a-zA-Z0-9 ]*$/",$mot));
    }
    static function verifyEmail($mot)
    {
            return (preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$mot));
    }
    static function verifyPassword($mot)
    {
            return (preg_match("#^[a-zA-Z0-9]#i",$mot)); //   -.?!'" espace
    }
    static function verifyLength($mot, $min, $max=30)
    {
            $size = strlen($mot);
            return $size>=$min && $size<=$max;
    }
    static function verifyUrl($mot)
    {
            return (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$mot)) ? true : false;
    }
    static function verifyPath($mot)
    {
            return (preg_match("#^([a-zA-Z:|/|\\]{1})([/|\\]{1})([^/:*\"<>+/?])+$#",$mot)) ? true : false;
    }
    static function verifySimplePath($mot)
    {
            return (preg_match("/^[a-zA-Z0-9\_\-\\\:]+\.[a-zA-Z]*$/",$mot)) ? true : false;
    }
    static function verifyFileName($mot)
    {
            return (preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $mot)) ? true : false;
    }

    //contrer l'injection SQL
    static function sanitize_string($string) {
        if (get_magic_quotes_gpc()) {
                $sanitize = stripslashes($string);
        } 
        else if(ctype_digit($string))
        {
            $sanitize = intval($string);
        }
        // Pour tous les autres types
        else
        {
            $sanitize = $string;
            $sanitize = addcslashes($string, '\\<>"\'%');
        }
        return htmlentities($sanitize);
    } 
    /* contrer les doubles extensions
     * Si le fichier contient plus d'un point (soit strlen>2) on retourne true, 
     */
    static function double_ext($str){
        $t = explode(".",$str);  
        return (sizeof($t)>2) ;
    }
    static function check_file_name ($filename){
        // Si le format du nom de fichier est valide on renvoie true
        if(!PregFucntions::double_ext($filename))
            return ((preg_match("`^[a-zA-Z0-9-_\ \.]+$`i",$filename)) ? true : false);
        return false;
    }
    static function check_file_length ($filename){
        return ((strlen($filename) < 255) ? true : false);
    }
    static function return_bytes ($size_str){
        switch (substr (strtolower($size_str), -1))
        {
            case 'm': return (int)$size_str * 1048576;
            case 'k': return (int)$size_str * 1024;
            case 'g': return (int)$size_str * 1073741824;
            default: return $size_str;
        }
    }
	static function prohibited_extension($ext){
		return in_array($ext,Conf::$prohibitedFileExtenxion);
	}
}


