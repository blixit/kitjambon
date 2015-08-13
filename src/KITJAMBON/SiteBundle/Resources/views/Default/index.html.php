<!-- #KITJAMBON/SiteBundle/Ressources/views/Default/index.html.php -->
<?php $view->extend('::base.html.php') ?>



<div class="container" >
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BannerReprtoireCours -- >
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-4091232325046143"
     data-ad-slot="8328608911"></ins>
<script>
//asynchrone
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

<!-- DEBUT DU CODE DE VISUALISATION DES FICHIERS -->

<a href="#" onclick="javascript:showPDF(['compte rendu td.docx','03/05/2015'],'http://kit-jambon.nacder.net/filesOld/ei1/ccube/2013-2014/b4/Compte Rendu TD.docx','?download/','15955223');">Compte Rendu TD.docx</a>
<a href="#" onclick="javascript:showPDF(['codeur.m','25/11/2015'],'http://kit-jambon.nacder.net/filesOld/ei1/ccube/2013-2014/b4/codeur.m','?download/','15955224');">codeur.m</a>
<script type="text/javascript">

//
</script>

<!--  Modal affichant le fichier et les commentaires -->
<div class="modal fade" id="modal_view" style="width:100%; height:100%;">
  <div class="modal-dialog" style="width:100%; height:100%;">
    <div class="modal-content">
      <div class="modal-header default">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong class="modal-title">Modal title</strong>-<i class="modal-date"></i>
        <span class="pull-right">Mail: <input type="email" placeHolder="Recommander à une personne" size="40"/></span>
      </div>
      <div class="modal-body" style="min-height:350px" >
      	<!-- la div ci-dessous permet de protéger la page incluse par l'iframe du copier-coller. En effet, l'iframe
       n'étant pas sensible à cette protection déclarer dans le container, on rajoute une div au-dessus de ce dernier
       pour empecher tout copier-coller -->
      	<div id="prevent_copier_coller"
			style="position:absolute; margin:auto;float:left; top:0px;left: 0px;background-color:transparent;opacity:0.1; width:90%; height:100%; ">
	  	</div>
	  <!-- cette div permet de protéger le bouton fullscreen de l'iframe qui ouvre le document comme un google doc et autorise le copier-coller -->
        <div id="prevent_full_screen" 
			style="position:absolute; margin:auto;float:right; top:0px;right: 0px;background-color:transparent;opacity:0.1; width:90%; height:70px; ">
	  	</div>

	  	<?php // si le fichier est interdit à l'utilisateur ?>
	  <!-- cette div s'affiche si l'utilisateur n'a pas le droit de voir ce fichier. voir refresh_prevent_copies() -->
        <div id="prevent_vue_by_grade" 
			style="position:absolute; float:right; top:50px;right:0px;background-color:red;opacity:7; width:100%; height:60%; ">
	  		<div id="prevent_vue_by_grade2" class="pull-center" style="position:absolute; top:25%;margin:auto;width:80%">
	  			<h1>Votre grade ne vous permet pas visualiser ce tp.</h1>
	  		</div>
	  	</div>
	  	<?php ?>

        <iframe id="iframe" src="" 
			style="width:100%; min-height:800px; " 
			frameborder="0"></iframe> 
	  </div> 
      <div class="modal-body"> 
      	<h4>Vote  : 
      		<a href="#"><img style="width:25px" src="<?php //echo RESSOURCES.DS.'img/smiley_content.png';?>"></a> <span id="vote_positif" style="color:green">15</span>
      		<a href="#"><img style="width:25px" src="<?php //echo RESSOURCES.DS.'img/smiley_triste.jpg';?>"></a> <span id="vote_negatif" style="color:red">3</span>
      		<br/>
      		<span id="vote_reponse" style="font-size:14px">Votre vote a été pris en compte</span>
      	</h4>      		
      </div>
      <div class="modal-body"> 
      	<h4>Les commentaires</h4>
      	<div class="modal-commentaires" style="max-height:350px"></div>
      	<br/>
      	<div>
      		<strong>Ajouter un commentaire :</strong><br/>
      		<span id="comment_server_response" style="display:none; color:orange"><br/></span>
      		<textarea id="saisi_commentaire" class="form-control"  cols="80" rows="2" ></textarea>
      		<input id="btn_valide_commentaire" type="button" class="btn btn-primary" value="Valider" onclick="validate_comment();" />
      	</div>
      	<script type="text/javascript"> 
				var validate_comment = function(){  
					if($('#saisi_commentaire').val().length>=20)   
					  	add_comment('1','10',$('#saisi_commentaire').val()); 
				}; 
      	</script>
      	<?php // afficher les commentaires ?>
      	<?php // système de pagination pour les commentaires ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a id="url_download" href="">
        <button type="button" class="btn btn-primary"> 
        	<i class="glyphicon glyphicon-download"> </i>  
        	Télécharger
        </button>
        </a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- FIN DU CODE DE VISUALISATION DES FICHIERS -->






















	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div id="resultSearch"  style="display:none; height-min:150px;padding:5px;margin-bottom:20px;">

			</div>
			<div id="jumbotron" class="jumbotron">
			  <h2><?php //echo constant('site_i_slogan'); ?></h2>
			  	<p><span class="site_description"> 
				  Ce site est une plateforme de téléchargement/upload gratuite.</br>
				  N'hésitez pas à uploader vos fichiers afin d'aggrandir la base de données.</br> 
				</span> 
				</p>
				
				<p>
				<span class="label label-default">Les chiffres : </span>
				</p>
				<div class="row">
				<ul>
					<li><span style="font-size: 15px;"><?php //echo $nbMembre; ?> membres</span></li>
					<li><span style="font-size: 15px;"><?php //echo $nbReseau; ?> répertoires de cours</span></li>
					<!--<li><span style="font-size: 15px;"><?php //echo $nbGroupe; ?> groupes de travail</span></li>-->
					<li><span style="font-size: 15px;">Plus de 2 Go de documents </span></li>
					<!--
					<li><span style="font-size: 15px;">Plus de <?php //echo $nbHits; ?> téléchargements</span></li>-->
				</ul>
				</div>
				<p>
				<span class="label label-default">Le concept : </span>
				</p>
				<section class="row">
				<div class="col-md-4 col-md-offset-1 centered">
					<h3>j'upload</h3>
					<a href="<?php //echo (Session::islogged()) ? constant('site_i_share_url') : ''; ?>">
						<button type="button" class="btn btn-success btn-circle btn-lg ">
						<i class="glyphicon glyphicon-cloud-upload my-icon-xl"></i>
					</button>
					</a>
				</div>
				<div class="col-md-4 col-md-offset-1 centered">
					<h3>je télécharge</h3>
					<a href="<?php //echo Router::url('?cours/index'); ?>">
					<button type="button" class="btn btn-warning btn-circle btn-lg">
					<i class="glyphicon glyphicon-cloud-download my-icon-xl"></i>
					</button>
					</a>
				</div>

				</section>
				</br>
				<p>
				<span class="label label-default">Javascript et Mozilla Firefox</span>
				</p>
				<div class="row">
					Le navigateur Mozilla Firefox présente quelques incompatibilités avec Javascript. Pour
					une meilleure utilisation de ce site, pensez à activer Javascript ou à changer de navigateur 
					(Ex : Chrome, Safari, ...).
				</div>
				</br>
				<p>
				<span class="label label-default">Inscription par parrainage</span>
				</p>
				<div class="row">
					Désormais il vous est possible d'inviter un ami à rejoindre le kit jambon. Pour cela,
					cliquer sur le lien 'Parrainer un nouveau' sur votre <a href="<?php //echo Router::url('?home/profil/#lien_parrainage'); ?>">page de profil</a>.
				</div>
				</br>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="fa fa-users"></i>  Kit-Questions <span class="badge pull-right">1.0</span></h3>
					</div>
					<div class="panel-body">
						<img class="pull-left" src="<?php //echo RESSOURCES.DS.'img/questions.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Vous êtes à la recherche d'un kit inexistant,
					  vous souhaitez poser des questions concernant les modules,
					  la communauté est là pour vous soutenir.
					  </br>
					  <a href="<?php //echo constant('site_i_facebook'); ?>">
					  <button type="button" class="btn btn-warning pull-right"> Go ! </button>
					  </a>
					</div>

				</div>
				<div class="panel panel-success">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="fa fa-info"></i>  Kit-Infos <span class="badge pull-right">3.0</span></h3>
					</div>
					<div class="panel-body">
					  <img class="pull-left" src="<?php //echo RESSOURCES.DS.'img/partage.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Tu souhaites partager une infos canon sur la préparation d'un ds,
					  tu veux partager ta façon de résoudre un exercice,
					  sens-toi libre, t'es un jambonneur.
					  </br>
					  <a href="<?php //echo constant('site_i_facebook'); ?>">
					  <button type="button" class="btn btn-success pull-right"> Go ! </button>
					  </a>
					</div>

				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="fa fa-users"></i> Kit-Working ! <span class="badge pull-right">2.0</span></h3>
					</div>
					<div class="panel-body">
					  <img class="pull-left" src="<?php //echo RESSOURCES.DS.'img/groupe.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Tu es à la recherche d'un ou plusieurs partenaires de travail,
					  un jambonneur sympatique avec les mêmes centres d'intérets que toi,
					  des potes pour former un groupe de travail, c'est par ici.
					  </br>
					  Une fois ton annonce posée, tu pourras voir celle de ceux qui partage
					  tes centres d'intérêts.
					  </br>
					  <a href="<?php //echo Router::url('?home/'); ?>">
					  <button type="button" class="btn btn-warning pull-right"> Go ! </button>
					  </a>
					</div>

				</div>
			</div>
			<div class="row centered">
				<div class="fb-activity" data-site="<?php //echo constant('site_i_url'); ?>" data-action="likes, recommends"
				data-colorscheme="light" data-header="true" data-width="300"></div>
				</br></br>
		   </div>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="">
				<div class="panel panel-info"> 
				<input id="searchBar" class="form-control" type="text" placeHolder="Cherche ton fichier..." />
				<span class="pull-right" style="font-size:12px;color:silver">Saisissez au moins 5 caractères.</span>
				</div>
			</div>
			<?php if(!empty($_SESSION['membre']['mem_id'])) : ?>
			<br>
			<div class=""> 
				<div class="panel panel-info">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Les derniers fichiers ajoutés </h3>
					</div>
					<div class="panel-body" style="text-align:left">
					<?php 
						if(!empty($fichiers))
						foreach ($fichiers as $value) {
							if(!empty($value)){
								echo '<a href="'.Router::url('?download/view/n/'.$value['year'].DS.$value['ue'].DS.$value['catg']).'">';
								echo $value['hits'].'<i class="glyphicon glyphicon-cloud-download"></i>';
								echo '</a> -';
								if(strlen($value['name'])>30)
									echo '(EI'.$value['year'].'-'.$value['ue'].') '.substr($value['name'],0,30).'... ';
								else
									echo '(EI'.$value['year'].'-'.$value['ue'].') '.$value['name']; 
								echo '</br>';
							}						 		
						} 
					?> 
					</div>
				</div> 
			</div>
			<?php endif; ?>
			<div class=""> 
				<div class="panel panel-info">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> Les matières les plus demandées </h3>
					</div>
					<div class="panel-body centered" style="font-size: 25px; width:100%; ">
					<?php 
						if(!empty($matieres)){
							$i = 1;
							foreach ($matieres as $value) {
								echo '<span style="display:inline; width:50%; padding-left:20px;">';
								if(!empty($value)){ 
									echo $i++.'. <a href="'.Router::url('?download/view/a/'.$value['net_niveau'].'/'.$value['net_nom']).'">'.$value['net_nom'].'</a>  ';
								}	
								echo '</span>';
							} 
						} 
					?> 
					</div>
				</div> 
			</div>
			 
			<div class="">
				<div class="fb-like-box" data-href="<?php //echo constant('site_i_facebook'); ?>" data-colorscheme="light"
			data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" data-width="300" ></div>
			</div>
			</br>
			<div class="">
				<?php //include_once $_DIR."composants/mod_sondage.php"; ?>
			</div>
		</div>
	</div>
       </br>
	   <section>
	   <div class="row">

			<div class="">
			</div>
			<div class="">

			</div>
       </div>
	   </section>

    </div><!-- /.container -->