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

<!-- debut de la modif pour le  layout home -->

		<div class="container col-xs-12" > 
			<?php echo isset($this_reseau) ? '<h3><a href="">'.strtoupper($this_reseau['net_nom']).' : '.$this_reseau['net_description'].'</a></h3>' : '' ; ?>  
			<?php echo isset($this_groupe) ? '<h3><a href="">'.strtoupper($this_groupe['gr_nom']).'</a></h3>' : '' ; ?>  
			<nav class="navbar navbar-default" role="navigation">
			    <div class="container-fluid">
			        <!-- Brand and toggle get grouped for better mobile display -->
			        <div class="navbar-header">
			            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			                <span class="sr-only">Toggle navigation</span>
			                <span class="icon-bar"></span>
			                <span class="icon-bar"></span>
			                <span class="icon-bar"></span>
			            </button>
			            <a class="navbar-brand" href="#">Kit-bord</a>
			        </div>

			        <!-- Collect the nav links, forms, and other content for toggling -->
			        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			            <ul class="nav navbar-nav col-md-5">
			                <li class="active"><a href="<?php echo Router::url('?home/index'); ?>">Mon compte</a></li> 
			            </ul>
			            <div class="navbar-form navbar-right">
			                <div class="form-group">
			                    <input type="text" class="form-control" placeholder="Search">
			                </div> 
			            </div> 
			        </div><!-- /.navbar-collapse -->
			    </div><!-- /.container-fluid -->
			</nav>
			<div class="row">
			    <!-- menu gauche -->
			    <div class="col-xs-12 col-sm-3">
			        <div class="panel panel-success">
			            <div class="panel-heading">
			                <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>  Kit-Space </h3>
			            </div>
			            <div class="row">
			            <div class="panel-body">
			                <strong><?php echo $user['mem_login']; ?></strong> |
			                <a href="<?php echo Router::url("?membre/liste/1/".$user['mem_year']); ?>">Liste des membres</a> <br/> 
			                <legend ></legend><?php echo strtoupper('Mes réseaux'); ?>  
			                    <br/> 
			                    <?php 
			                        if($reseaux){ 
			                            foreach($reseaux as $r) {
			                                if(!empty($r['net_nom'])){
			                                    echo "<a href='".Router::url('?home/reseau/'.$r['net_id'])."'>".$r['net_nom']."</a>  ";
			                                }
			                            } 
			                        }
			                        echo "<legend></legend>".strtoupper('Mes groupes')." <br/> "; 
			                        if($groupes){ 
			                            foreach($groupes as $g) {
			                                if(!empty($g['gr_nom'])){
			                                    echo "<a href='".Router::url('?home/groupe/'.$g['gr_id'])."'>".$g['gr_nom']."</a> ";
			                                }
			                            } 
			                        } 
			                        echo "<legend></legend>".strtoupper('Mes contacts')." <br/> "; 
			                        if($contacts){ 
			                            foreach($contacts as $c) {
			                                if(!empty($c)) 
			                                    echo "<a href='".Router::url('?membre/view/'.$c['mem_id'])."'>".$c['mem_login']."</a> ";
			                                
			                            } 
			                        }                                
			                    ?>

			            </div>
			            </div>
			        </div> 
			    </div>
			    <div class="col-xs-12 col-sm-6">
			    <!-- form -->
			    <div class="row">
			    	<?php
                		if($action=='index')
                			$url = $action.'';
                		if($action=='reseau')
                			$url = $action.'/'.$this_reseau['net_id'];
                		if($action=='groupe')
                			$url = $action.'/'.$this_groupe['gr_id']; 
                	?>
			        <form class="form " role="form" method="post" action="<?php echo Router::url('?home/'.$url);?>" >
			        <textarea class="form-control" name="resume" type="text" placeholder="Exprime-toi dans tes réseaux ou tes groupes"></textarea>
			        <input class="form-control" name="concerne" type="hidden" value="<?php echo $user['mem_id']; ?>" required />
			        <input class="form-control" name="net" type="hidden" value=<?php echo (isset($this_reseau['net_id']) ? $this_reseau['net_id'] : 0); ?> required />
			        <input class="form-control" name="gr" type="hidden" value=<?php echo (isset($this_groupe['gr_id']) ? $this_groupe['gr_id'] : 0); ?> required />

			        <br/>
			        <div class="btn-toolbar">
			            <div class="btn-group pull-left">
			                <button type="button" class="btn btn-warning btn-xs" title="j'en ai marre!!">
			                <i class="glyphicon glyphicon-thumbs-down"></i>  
			                Zzzzzz !</button>
			                <button type="button" class="btn btn-warning btn-xs" title="j'adore!!">
			                <i class="glyphicon glyphicon-thumbs-up"></i>  
			                So good !</button>
			                <button type="button" class="btn btn-warning btn-xs" title="">
			                <i class="glyphicon glyphicon-earphone"></i>  
			                Phone</button>
			                <button type="button" class="btn btn-warning btn-xs" title="on continue sur facebook!!">
			                <i class="fa fa-facebook"></i>  Facebook
			                </button> 
			            </div>
			              <div class="btn-group btn-xs pull-center"> 
			              <select class="select" name="visibility" required >
			                    <?php 
			                    if($action=="index"){
			                        echo '<option value="0">Public</option>';
			                    }
			                    ?>  
						       
			                    <?php
			                    if($reseaux && ($action=="index" || $action=='reseau')){ 
			                    	if($action=="index")
			                        	echo ' <option class="divider" disabled >--réseaux--</option>';
			                        foreach($reseaux as $r) {
			                            if(!empty($r['net_nom'])){
			                                echo "<option value='r-".$r['net_id']."'>".$r['net_nom']."</option>"; 
			                            }
			                        } 
			                    }  
			                   
			                    if($groupes && ($action=="index" || $action=='groupe')){ 
			                        if($action=="index")
			                        	echo '<option class="divider" disabled >--groupes--</option>';
			                        foreach($groupes as $g) {
			                            if(!empty($g['gr_nom'])){
			                                echo "<option value='g-".$g['gr_id']."'>".$g['gr_nom']."</option>"; 
			                            }
			                        } 
			                    }  
			                    ?>
			              </select>
			            </div>  
			            <div class="btn-group pull-right"> 
			              <button name="submitted" type="submit" class="btn btn-default btn-xs" title="j'en ai marre!!">
			              <i class="fa fa-share"></i>
			              Envoyer </button> 
			            </div>
			        </div>
			        </form>
			        <br/>
			        <div class="col-xs-12 ">
			            <?php 
			                if($erreurs) { ?>
			            <div class="alert alert-warning alert-dismissible" role="alert"> 	
			            <strong>Erreurs</strong> <br/>
			                <ul>	
			                <?php foreach($erreurs as $err){	 
			                        echo '<li>'.$err.'</li>';
			                } ?>
			                 </ul>  
			            </div>
			                <?php }
			            ?>
			        </div>
			        <br/>
			    </div>
			    <!-- history -->
			    <div class="row"> 
			      <ul class="media-list ">
			        <li class="media thumbnail">
			            <?php foreach($history as $h) { ?> 
			               <legend></legend>
			                <?php if(!empty($h['hh_id'])){ ?> 
			                <div class="media-body">
			                    <h4 class="media-heading">
			                    <!--Icone sur le coté-->
			                    <?php if($h['hh_net_id']!=0) {?>  
			                            <i class="fa fa-sitemap"></i>
			                    <?php } elseif($h['hh_gr_id']!=0) {?>   
			                            <i class="fa fa-users"></i>
			                    <?php } else { ?>
			                            <i class="fa fa-globe"></i> 
			                    <?php } ?>

			                    </h4>
			                    <p><?php echo $h['hh_resume']; ?> 	</br> 	
			                    	<?php
			                    		if($action=='index')
			                    			$url = $action.'/delete/';
			                    		if($action=='reseau')
			                    			$url = $action.'/'.$this_reseau['net_id'].'/delete/';
			                    		if($action=='groupe')
			                    			$url = $action.'/'.$this_groupe['gr_id'].'/delete/'; 
			                    	?>
			                    <form class="form " role="form" method="post" action="<?php //echo Router::url('?home/'.$url); ?>" >
			                        <input name="hh_id" type="hidden" value="<?php echo $h['hh_id']; ?>"/>
			                        <div class="btn-group pull-right"> 
			                        <?php if($h['hh_mem_id'] == $user['mem_id']) { ?> 
			                                  <button name="delete" type="submit" class="btn btn-default btn-xs my-delete" title="j'en ai marre!!">
			                                  <i class="glyphicon glyphicon-trash"></i>  
			                                  Supprimer</button>  
			                        <?php } else { ?>
			                                  <button name="signal" type="submit" class="btn btn-default btn-xs my-delete" title="j'en ai marre!!">
			                                  <i class="fa fa-exclamation"></i>  
			                                  Signaler</button> 
			                        <?php }  ?>		
			                        </div> 
			                        </form>
			                    </p>
			                    </div>
			                <?php } ?>
			            <?php } ?>
			        </li>
			      </ul> 
			    </div>

			    </div>
			    <!-- pub -->
			    <div class="col-xs-12 col-sm-3">
			            <div class="panel panel-info">
			                    <div class="panel-heading">
			                            <h3 class="panel-title">  Kit-Pub </h3>
			                    </div>
			                    <div class="panel-body">
			                    the pub
			                    <br/> 
			                    </div>
			            </div>
			            <div class="panel panel-info">
			                    <div class="panel-heading">
			                            <h3 class="panel-title">  Kit-Pub </h3>
			                    </div>
			                    <div class="panel-body">
			                    the pub
			                    <br/> 
			                    </div>

			            </div>
			    </div>
			    </div>

		</div>

<!-- fin de la modif pour le  layout home -->
	</br>
	<div class=""  >
		<div class="container" style="bottom:0px; position:fixed; background-color:white;">
			<span class="text-muted"><?php echo constant('site_i_real_name'); ?> | Copyright © 2014-<?php echo date('Y',time()); ?> | 
			<i>Un projet de la <a href="<?php echo Router::url('?accueil/presentation');?>"> kitjam' team </a></i> 
			</span>
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
