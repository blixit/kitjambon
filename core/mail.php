<?php

/**
 * Projet : Kit-jambon
 * @author Alain Ngangoue
 * Fichier : core/mail.php
 * Role :  gestion des mails 
 * 
 */
class Mail { 

    protected $config = "default";
    public $mail = "";
    protected $defaults = array();

    /* @params:
     *      => string config : nom de la config à utiliser, les config se trouvent dans le fichier config/parametres.php
     */
    function __construct($config){
        if(!isset($config)) 
            $this->config = Conf::$mail['defaut'];
        else
            $this->config = Conf::$mail[$config];
        //si la config demandée n'existe pas, on retourne un objet vide
        if(!isset($this->config))
            return null;  
        $this->defaults = array(
            'aliasExpediteur' => constant('site_i_name'),
            );    
    }
    function headers($options){
        $head = "";

        if(!isset($options['destinataire']) || !isset($options['expediteur']))
            return false;
        if(!isset($options['aliasExpediteur']))  
            $options['aliasExpediteur']  = ""; 

        if(!isset($options['MIME-Version']))  // Version MIME
            $head .= "MIME-Version: 1.0 \n";
        if(!isset($options['Content-type']))  // l'en-tete Content-type pour le format HTML
            $head .= "Content-type: text/html; charset=utf-8 \n";
        if(!isset($options['Reply-To']))     // Mail de reponse
            $head .= "Reply-To: ".$this->config['no-reply']." \n";
        if(!isset($options['From']))         // Expediteur
            $head .= 'From: "'.$options['aliasExpediteur'].'"<'.$options['expediteur'].'>'." \n";
        if(!isset($options['Delivered-to']))   // Destinataire
            $head .= 'Delivered-to: '.$options['destinataire']." \n"; 
        if(!isset($options['Disposition-Notification-To']))    //Accusé réceiption
            $head .= "Disposition-Notification-To:'".$options['expediteur']."'";

        foreach($options as $k=>$v) 
            $head .= $k.':'.$v." \n"; 
        return $head;            
    } 
    function send($options){
        if(!isset($options['destinataire']) || !isset($options['objet']) || !isset($options['message']))
            return false;
        
        $options['expediteur'] = (isset($options['expediteur'])) ? $options['expediteur'] : $this->config['mail'];
        $options['aliasExpediteur'] = (isset($options['aliasExpediteur'])) ? $options['aliasExpediteur'] : $this->defaults['aliasExpediteur']; 

        $headers = $this->headers($options); 

        return mail($options['destinataire'],$options['objet'],$options['message'],$headers) ? true : false;
    }
    static public function balise($balise,$text,$attr=null,$values=null){
        $str = '<'.$balise.' ';
        if(sizeof($attr)==sizeof($values)){
            for($i=0; $i<sizeof($attr); $i++) {
                $str .= $attr[$i]."=\"".$values[$i]."\" ";
            }
        }
        $str .= '>';
        $str .= $text;
        $str .= '</'.$balise.'>';
        return $str;
    }
    static public function _messagePassLost($infos){  
        //mem_renew_pass, logo 
        return  Mail::balise('div',
            //header du message
             Mail::balise('img','',array('style','src'),array('float:left; width:50px; height:50px',$infos['logo']))
            . Mail::balise('h1',constant('site_i_name'))
            . Mail::balise('h5',"Confirmez votre inscription sur ".strtoupper(constant('site_i_name')))

            . Mail::balise('p', 
                Mail::balise('br','Bonjour,')
                ."Vous recevez ce mail suite à une demande de renouvellement de mot de passe sur notre site : "
                . Mail::balise('a',constant('site_i_name').'.',array('href'),array(constant('site_i_url').(Conf::ONLINE ? '': DS.(basename(ROOT)))))
                . Mail::balise('br','')
                ."Veuillez trouver ci-dessous votre code de réinitialisation de mot de passe : "
                . Mail::balise('br',$infos['mem_renew_pass']) 
                ."Copiez ce code et entrez-le sur cette page : "
                . Mail::balise('a','Page de réactivation de mot de passe',array('href'),array(constant('site_i_url')."?membre/passinit/".$infos['mem_renew_pass']))
            )
            .  Mail::balise('p',"Nous vous remercions d'utiliser les services de ".constant('site_i_name').".")
            .  Mail::balise('span', Mail::balise('i','Le jambon vous salue!'),array('style'),array('float:right')) 
            . Mail::balise('br','')
            . Mail::balise('span',"Ce mail a été généré automatiquement, merci de ne pas y répondre.
                Pour toute question supplémentaire, n'hésitez pas à écrire sur notre page facebook."
                . Mail::balise('br',constant('site_i_real_name').' | Copyright © Tous droits réservés'),
                array('style'),array('font-size:10px; color:grey'))
            ,array('style'),array('max-width:500px;display:block;padding:5px; margin:auto; text-align:justify')
        );
    }
    static public function _messageSuscribe($infos){  
        //mem_login, mem_token,logo 
        return  Mail::balise('div',
            //header du message
             Mail::balise('img','',array('style','src'),array('float:left; width:50px; height:50px',$infos['logo']))
            .  Mail::balise('h1',constant('site_i_name'))
            .  Mail::balise('h5',"Inscription sur la plateforme de téléchargement/upload")

            .Mail::balise('p',
                  Mail::balise('br','Bonjour,')
                ."Vous recevez ce mail suite à votre inscription sur notre site : "
                .  Mail::balise('a',constant('site_i_name'),array('href'),array(constant('site_i_url').(Conf::ONLINE ? '': DS.(basename(ROOT))))) 
                .' et nous vous en remercions.'
                .  "Voici votre identifiant personnel dont vous seul avez connaissance du mot de passe : [".$infos['mem_login']."]. "
                ."Pour confirmer votre compte, veuillez suivre ce lien : "
                .  Mail::balise('a','Activation du compte',array('href'),array(constant('site_i_url')."?membre/activation/".$infos['mem_token']))
            )
            .Mail::balise('h4',Mail::balise('strong',Mail::balise('i',"Important !!!")),array('style'),array('color:red'))
            .Mail::balise('p',"Le kitjambon se veut pédagogique et a pour première vocation d'optimiser le rendement de vos révisions. "
                ."Plusieurs outils sont à votre disposition dans ce but : Devoirs Surveillés, Corrections, Travaux en autonomie et Travaux pratiques; 
                le tout sous forme d'annales que vous avez désormais le droit de télécharger." 
            )
            .Mail::balise('p',"Le kitjambon c'est aussi un réseau social que nous sommes en train de développer. C'est un projet d'envergure
                qui a toute sa place au sein du complexe centralien et nous espérons que vous saurez l'accueillir avec enthousiasme."
                .  Mail::balise('br',"Attention!!! Nous attirons votre vigilance sur le fait que certains sujets sont des DS de Centrale et leur
                utilisation requiert un cadre de travail privé. ")
                ."En utilisant les fichiers de ce site, nous vous déléguons toute responsabilité quant à une utilisation illicite ultérieure quelle qu'elle soit. "
                ."En redistribuant les fichiers en provenance de ce site, vous prennez la responsabilité d'assumer les conséquences liées à leur
                utilisation."
            )
            .  Mail::balise('p',"Nous vous remercions à nouveau d'utiliser les services de ".constant('site_i_name').".")
            .  Mail::balise('span', Mail::balise('i','Le jambon vous salue!'),array('style'),array('float:right')) 
            . Mail::balise('br','')
            . Mail::balise('span',"Ce mail a été généré automatiquement, merci de ne pas y répondre.
                Pour toute question supplémentaire, n'hésitez pas à écrire sur notre page facebook."
                . Mail::balise('br',constant('site_i_real_name').' | Copyright © Tous droits réservés'),
                array('style'),array('font-size:10px; color:grey'))            
            ,array('style'),array('max-width:500px;display:block;padding:5px; margin:auto; text-align:justify')
        );
    }
    static public function _messageParrainage($infos){  
        //mem_login, mem_token,logo 
        return  Mail::balise('div',
            //header du message
             Mail::balise('img','',array('style','src'),array('float:left; width:50px; height:50px',$infos['logo']))
            .  Mail::balise('h1',constant('site_i_name'))
            .  Mail::balise('h5',"Inscription sur la plateforme de téléchargement/upload")

            .Mail::balise('p',
                  Mail::balise('br','Bonjour,')
                ."<br>Vous recevez ce mail suite à une demande de l'utilisateur  " 
                .$infos['parrain_login']." (".$infos['parrain_mail']."). <br>" 
                ."Pour créer votre compte, veuillez suivre ce lien : "
                .  Mail::balise('a','Création du compte',array('href'),array(constant('site_i_url')."?membre/suscribe/".$infos['fillot_mail']."/".$infos['mem_token']))
                ."<br>Pour plus d'informations sur qui nous sommes, suivez ce lien : "
                .  Mail::balise('a',constant('site_i_name'),array('href'),array(constant('site_i_url').(Conf::ONLINE ? '': DS.(basename(ROOT)))."?accueil/presentation")) 
                
            )
            ."Cordialement, <br>" 
            . Mail::balise('span', Mail::balise('i','Le jambon'),array('style'),array('float:right')) 
            . Mail::balise('br','')
            . Mail::balise('span',"Ce mail a été généré automatiquement, merci de ne pas y répondre.
                Pour toute question supplémentaire, n'hésitez pas à écrire sur notre page facebook."
                . Mail::balise('br',constant('site_i_real_name').' | Copyright © Tous droits réservés'),
                array('style'),array('font-size:10px; color:grey'))            
            ,array('style'),array('max-width:500px;display:block;padding:5px; margin:auto; text-align:justify')
        );
    }
}           