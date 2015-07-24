<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="KITJAM' TEAM">
    <meta name="Keywords" lang="fr" content="kit-jambon, kit jambon, kitjambon, site, ecn" />


	<meta name="author" content="Le grand jambonneur"/>
	<meta name="Publisher" content="La kitjam'team" />
	<meta property="fb:app_id" content="437624479711827"/>
	<meta property="fb:admins" content="437624479711827"/>
	<meta property="og:site_name" content="Le kit pour les jambonneurs"/>
	<meta property="og:title" content="Bienvenue sur le kit-jambon : plateforme de téléchargement/upload"/>
	<meta property="og:url" content="http://kit-jambon.nacder.net/"/>
	<meta property="og:type" content="website"/>
	<meta property="og:image" content="http://kit-jambon.nacder.net/images/vu.jpg"/>
	<meta property="og:description"
          content="Un site pour ne plus glander. Des annales et des exercices en tout genre qui vous permettront
				de garder un rythme d'étude soutenu."/>


    <link rel="shortcut icon" href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/logo.jpg">
    <link rel="alternate" href="http://kit-jambon.nacder.net/" hreflang="fr" />

    <title><?php echo isset($title_for_layout) ? $title_for_layout : constant('site_i_name');?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/signin.css" rel="stylesheet">
    <link href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/sticky-footer-navbar.css" rel="stylesheet">
    <link href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/bootstrap-social.css" rel="stylesheet">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo RESSOURCES.DS;?>bootstrap/dist/css/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php echo RESSOURCES.DS;?>bootstrap/assets/js/html5shiv.js"></script>
      <script src="<?php echo RESSOURCES.DS;?>bootstrap/assets/js/respond.min.js"></script>
    <![endif]-->
	<?php 
		if(isset($mesScripts)){
			foreach($mesScripts as $v)
				echo "\n\t".$v;
		}
	?>
	<?php include_once '../view/scripts/kissmetrics_header.php'; ?>
</head>
    <body>
    	<?php include_once("../view/scripts/analyticstracking.php") ?>
        <div id="menu">
            <?php echo $content_for_menu;?>
        </div> 
       <?php echo $content_for_layout;?> 
	<div class="" style="" >
		<div class="container  ">
			<p class="text-muted"><?php echo constant('site_i_real_name'); ?> | Copyright © 2014-<?php echo date('Y',time()); ?> | 
			<i>Un projet de la <a href="<?php echo Router::url('?accueil/presentation');?>"> kitjam' team </a></i>
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
    <script src="<?php echo RESSOURCES.DS;?>bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo RESSOURCES.DS;?>bootstrap/dist/js/myquery.js"></script>
	<script src="<?php echo RESSOURCES.DS;?>bootstrap/docs/assets/js/docs.min.js"></script>

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="<?php echo RESSOURCES.DS;?>bootstrap/docs/assets/js/ie10-viewport-bug-workaround.js"></script>


	<script>
	  window.twttr = (function (d,s,id) {
		var t, js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=1;
		js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
		return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
	  }(document, "script", "twitter-wjs"));
	</script>
	<div id="fb-root"></div>
    <script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&appId=904337376249783&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>

	<!-- Analytics
	================================================== -->
	<script>
	  var _gauges = _gauges || [];
	  (function() {
		var t   = document.createElement('script');
		t.async = true;
		t.id    = 'gauges-tracker';
		t.setAttribute('data-site-id', '4f0dc9fef5a1f55508000013');
		t.src = '//secure.gaug.es/track.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(t, s);
	  })();
	</script>
	<?php 
		if(isset($mesScriptsFunc)){
			foreach($mesScriptsFunc as $v)
				echo "\n".$v;
		}
	?>
    </body>
</html>
