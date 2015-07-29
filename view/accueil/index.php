<div class="container">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- BannerReprtoireCours -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-4091232325046143"
     data-ad-slot="8328608911"></ins>
<script>
//asynchrone
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<div id="resultSearch"  style="display:none; height-min:150px;padding:5px;margin-bottom:20px;">

			</div>
			<div id="jumbotron" class="jumbotron">
			  <h2><?php echo constant('site_i_slogan'); ?></h2>
			  	<p><span class="site_description"> 
				  Ce site est une plateforme de téléchargement/upload gratuite.<br/>
				  N'hésitez pas à uploader vos fichiers afin d'aggrandir la base de données.<br/> 
				</span> 
				</p>
				
				<p>
				<span class="label label-default">Les chiffres : </span>
				</p>
				<div class="row">
				<ul>
					<li><span style="font-size: 15px;"><?php echo $nbMembre['nbMembre']; ?> membres</span></li>
					<li><span style="font-size: 15px;"><?php echo $nbReseau['nbReseau']; ?> répertoires de cours</span></li>
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
					<a href="<?php echo (Session::islogged()) ? constant('site_i_share_url') : ''; ?>">
						<button type="button" class="btn btn-success btn-circle btn-lg ">
						<i class="glyphicon glyphicon-cloud-upload my-icon-xl"></i>
					</button>
					</a>
				</div>
				<div class="col-md-4 col-md-offset-1 centered">
					<h3>je télécharge</h3>
					<a href="<?php echo Router::url('?cours/index'); ?>">
					<button type="button" class="btn btn-warning btn-circle btn-lg">
					<i class="glyphicon glyphicon-cloud-download my-icon-xl"></i>
					</button>
					</a>
				</div>

				</section>
				<br/>
				<p>
				<span class="label label-default">Javascript et Mozilla Firefox</span>
				</p>
				<div class="row">
					Le navigateur Mozilla Firefox présente quelques incompatibilités avec Javascript. Pour
					une meilleure utilisation de ce site, pensez à activer Javascript ou à changer de navigateur 
					(Ex : Chrome, Safari, ...).
				</div>
				<br/>
				<p>
				<span class="label label-default">Inscription par parrainage</span>
				</p>
				<div class="row">
					Désormais il vous est possible d'inviter un ami à rejoindre le kit jambon. Pour cela,
					cliquer sur le lien 'Parrainer un nouveau' sur votre <a href="<?php echo Router::url('?home/profil/#lien_parrainage'); ?>">page de profil</a>.
				</div>
				<br/>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="panel panel-warning">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="fa fa-users"></i>  Kit-Questions <span class="badge pull-right">1.0</span></h3>
					</div>
					<div class="panel-body">
						<img class="pull-left" src="<?php echo RESSOURCES.DS.'img/questions.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Vous êtes à la recherche d'un kit inexistant,
					  vous souhaitez poser des questions concernant les modules,
					  la communauté est là pour vous soutenir.
					  <br/>
					  <a href="<?php echo constant('site_i_facebook'); ?>">
					  <button type="button" class="btn btn-warning pull-right"> Go ! </button>
					  </a>
					</div>

				</div>
				<div class="panel panel-success">
					<div class="panel-heading">
					  <h3 class="panel-title"><i class="fa fa-info"></i>  Kit-Infos <span class="badge pull-right">3.0</span></h3>
					</div>
					<div class="panel-body">
					  <img class="pull-left" src="<?php echo RESSOURCES.DS.'img/partage.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Tu souhaites partager une infos canon sur la préparation d'un ds,
					  tu veux partager ta façon de résoudre un exercice,
					  sens-toi libre, t'es un jambonneur.
					  <br/>
					  <a href="<?php echo constant('site_i_facebook'); ?>">
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
					  <img class="pull-left" src="<?php echo RESSOURCES.DS.'img/groupe.jpg';?>" style="width:80px;height:100px;margin-right:5px;" alt="Loading..." />
					  Tu es à la recherche d'un ou plusieurs partenaires de travail,
					  un jambonneur sympatique avec les mêmes centres d'intérets que toi,
					  des potes pour former un groupe de travail, c'est par ici.
					  <br/>
					  Une fois ton annonce posée, tu pourras voir celle de ceux qui partage
					  tes centres d'intérêts.
					  <br/>
					  <a href="<?php echo Router::url('?home/'); ?>">
					  <button type="button" class="btn btn-warning pull-right"> Go ! </button>
					  </a>
					</div>

				</div>
			</div>
			<div class="row centered">
				<div class="fb-activity" data-site="<?php echo constant('site_i_url'); ?>" data-action="likes, recommends"
				data-colorscheme="light" data-header="true" data-width="300"></div>
				<br/><br/>
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
								echo '<br/>';
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
				<div class="fb-like-box" data-href="<?php echo constant('site_i_facebook'); ?>" data-colorscheme="light"
			data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" data-width="300" ></div>
			</div>
			<br/>
			<div class="">
				<?php //include_once $_DIR."composants/mod_sondage.php"; ?>
			</div>
		</div>
	</div>
       <br/>
	   <section>
	   <div class="row">

			<div class="">
			</div>
			<div class="">

			</div>
       </div>
	   </section>

    </div><!-- /.container -->
