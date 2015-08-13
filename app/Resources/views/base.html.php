<!-- app/Resources/views/base.html.php -->
<!DOCTYPE html> 
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <!-- Bootstrap core CSS -->
        <?php foreach ($view['assetic']->stylesheets( 
            /*array('bundles/css/*',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/css/signin.css',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/css/sticky-footer-navbar.css',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/css/bootstrap.css',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/css/bootstrap-social.css',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/css/starter-template.css',
                ),*/
            array( 
                'bundles/bootstrap/dist/css/menu-imbrique.css',
                'bundles/bootstrap/dist/css/signin.css',
                'bundles/bootstrap/dist/css/sticky-footer-navbar.css',
                'bundles/bootstrap/dist/css/bootstrap.css',
                'bundles/bootstrap/dist/css/bootstrap-social.css',
                'bundles/bootstrap/dist/css/starter-template.css',
                ),
            array('cssrewrite')
        ) as $url): ?>
            <link rel="stylesheet" href="<?php echo $view->escape($url) ?>" />
        <?php endforeach; ?>
        
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- ANTI ADSBLOCK :)  -->

        <?php foreach ($view['assetic']->javascripts(
            array('@KITJAMBONSiteBundle/Resources/public/js/advertisement.js')
        ) as $url): ?>
        <script type="text/javascript" src="<?php echo $view->escape($url) ?>"></script>
        <?php endforeach; ?>
        <?php  
        //$var détermine si on est sur la page qui explique la restriction
        // la temporisation empeche output d'afficher le '1'
        ob_start(); 
        $view['slots']->output('pageDeRestrictionAdblock'); 
        $var = ob_get_clean();
        
        //on récupère l'url de cette page
        $url = $view['router']->generate('kitjambon_membre_account_adblockrestreint', array()); 
        //si on n'est pas sur cette page, on teste la présence de ads_bottom
        if($var===false): ?> 
            <script type="text/javascript">
            if (document.getElementById('ads_bottom') == null) {

                //si ads_block est activé, on redirige vers la page de restriction
                setInterval(window.location.replace("<?php echo $url; ?>"),1);

            } 
            </script> 
        <?php endif;?>


        <!-- FIN ANTI ADSBLOCK :)  -->
    
        <title>KITJAMBON|<?php $view['slots']->output('title', 'Hello Application') ?></title>
    </head>
    <body>
        <div id="menu">
            <?php 
            //on génère l'url du controller qui gère le menu
            $uri = $view['router']->generate('kitjambon_site_menu_main', array());
            //puis on le rend 
            echo $view['actions']->render($uri, array());
            //echo $view['actions']->render('KITJAMBONSiteBundle:/menu/main', array());
             ?>
        </div>
        <br/>
        <br/>
        <br/>
        <?php $view['slots']->output('_content') ?>

        <div class="" style="" >
            <div class="container  ">
                <p class="text-muted"><?php //echo constant('site_i_real_name'); ?> | Copyright © 2014-<?php echo date('Y',time()); ?> | 
                <i>Un projet de la <a href="<?php //echo Router::url('?accueil/presentation');?>"> kitjam' team </a></i>
                <!--<a href="<?php //echo constant('site_i_twitter'); ?>" class="twitter-follow-button"
                        data-url="<?php //echo constant('site_i_twitter'); ?>"
                        data-via="<?php //echo constant('site_i_host'); ?>"
                        data-link-color="#0069D6"
                        data-show-count="true">Follow @KIT</a>-->

                </p>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
         
        <?php foreach ($view['assetic']->javascripts(
            array('@KITJAMBONSiteBundle/Resources/public/bootstrap/dist/js/bootstrap.min.js',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/docs/assets/js/docs.min.js',
                '@KITJAMBONSiteBundle/Resources/public/bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js',  //<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->              
                '@KITJAMBONSiteBundle/Resources/public/js/*')
        ) as $url): ?>
        <script type="text/javascript" src="<?php echo $view->escape($url) ?>"></script>
        <?php endforeach; ?>
        <!-- MENU IMBRIQUE-->
        <script type="text/javascript"> 
        $(function() {
            // Affichage du sous menu en douceur
            jQuery('ul.nav li.dropdown').hover(function() {
              jQuery(this).find('.jqueryFadeIn').stop(true, true).delay(200).fadeIn();
            }, function() {
              jQuery(this).find('.jqueryFadeIn').stop(true, true).delay(200).fadeOut();
            }); 
        });     
        </script>
        <!-- FIN MENU IMBRIQUE--> 

        <script>
          window.twttr = (function (d,s,id) {
            var t, js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
            js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
            return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
          }(document, "script", "twitter-wjs"));
        </script>


    </body>
</html>