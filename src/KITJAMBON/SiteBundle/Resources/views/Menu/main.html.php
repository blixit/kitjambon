<?php
	class Router{
		static function url($d){
			return '';
		}
	}
	//var_dump($options);
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo  $view['router']->generate('kitjambon_site_accueil', array());?>">
          	<?php  //echo constant('site_i_name');?></a>
        </div>
        <div class="collapse navbar-collapse"> 
        	 
          <ul class="nav navbar-nav ">
            <li class="">
				<a href="<?php echo $view['router']->generate('kitjambon_site_presentation', array());?>">Présentation</a>
			</li>
			
            <li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ton année <span class="caret"></span></a>
				<ul class="dropdown-menu jqueryFadeIn" role="menu"> 					 
                  <li><a href="<?php echo $view['router']->generate('kitjambon_site_cours_view', array('eix'=>1));?>">E1</a></li>
                  <li><a href="<?php echo $view['router']->generate('kitjambon_site_cours_view', array('eix'=>2));?>">E2</a></li>
                  <li><a href="<?php echo $view['router']->generate('kitjambon_site_cours_view', array('eix'=>3));?>">E3</a></li> 
                </ul>
			</li>
			<!-- Menu imbriqué : annee/options/modules -->
            <li >
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ton module <span class="caret"></span></a>
				<ul class="dropdown-menu jqueryFadeIn" role="menu" >
					<?php if(!empty($options)){ 
						//on parcourt les annees ($annee['optionAnnee']=1 pour ei1, 2 pour ei2)
						foreach($options['annees'] as $annee):							
						?>
					<li class="dropdown-submenu">
						<a data-toggle="dropdown"tabindex="-1" href="#"><span class="fa fa-folder"></span><?php echo ($annee['optionAnnee']==1) ? 'EI1':'EI2 - EI3'; ?></a>
						<ul class="dropdown-menu">
							<?php
								//on parcourt les options ($option['optionNom']=Aéronautique par exemple)								 
								foreach($options['options'][$annee['optionAnnee']] as $option):
									 
									?>
									<li class="dropdown-submenu">
										<a data-toggle="dropdown"tabindex="-1" href="#"><span class="fa fa-folder-o"></span> <?php echo $option['optionNom']; ?></a>
											<ul class="dropdown-menu">
												<?php
													//on parcourt les modules
													foreach($modules as $module)
														if($annee['optionAnnee'] == $module->getOptionAnnee() 
															&& $option['optionNom'] == $module->getOptionNom()){ 
															//on génère l'uri
															$uri = $view['router']->generate('kitjambon_transfert_download_view', 
																	array(
																		'eix' => $annee['optionAnnee'],
																		'abrege' => $module->getOptionAbrege()
																		));
															echo '<li><a href="'.$uri.'"><span class="fa fa-folder-open"></span>'.$module->getOptionModule().'</a></li>  ';
														}
												?> 
												
											</ul>
									</li>
									<?php
									 											 
								endforeach;
								
							?>
							<li><a href="#"><span class="fa fa-bar-chart-o"></span> Acion niveau 2</a></li>  
							<li><a href="#"><span class="fa fa-bar-chart-o"></span> Autre acion niveau 2</a></li>  
							<li class="dropdown-submenu">
								<a data-toggle="dropdown"tabindex="-1" href="#"><span class="fa fa-cogs"></span> Sous menu niveau 3</a>
									<ul class="dropdown-menu">
										<li><a href="#"><span class="fa fa-bar-chart-o"></span> Acion niveau 3</a></li>  
										<li><a href="#"><span class="fa fa-bar-chart-o"></span> Autre acion niveau 3</a></li>  
										
									</ul>
							</li>											
						</ul>
					</li>

					<?php 
						endforeach;
						} 
					?>
                </ul>
			</li>
			<li><a href="<?php// echo $view['router']->generate('kitjambon_transfert_download_view', array()); ?>
						">Sondage </a></li>
            <li><a href="<?php //echo constant('site_i_facebook'); ?>" target="blanc">Ton forum</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
		  	<!-- notification contact -->
		  	<?php if(isset($_SESSION['membre']) && isset($nb_tes_notifs_contact)) {
		  		/*echo '<li> <a id="tes_notifications" href="" title="Mes demandes de contact" >
		  				<span class="label label-danger"><i class="fa fa-user"></i> '.$nb_tes_notifs_contact
		  				.'</span></a></li>'; 
		  				*/?>
		  				<!-- Button trigger modal -->
						<li class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal_contact">
							<i class="fa fa-user"></i><?php echo $nb_tes_notifs_contact; ?>
						</li>
						<?php 
		  		}
		  	?>
			<!-- admin -->
			<li class="dropdown">
			<a href="<?php echo Router::url('?home/profil/'); ?>">
				<?php
					if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']=='yes' && isset($_SESSION['membre']))
                        echo $_SESSION['membre']['mem_login'].'<strong style="color:red">(NEW)</strong>';
				?>
			</a>
			</li>
			<li class="dropdown">

			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-home my-icon-sm"></i>
					<span class="caret"></span>
			  </a>
			  <?php
				$isses = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : 'no';
				echo '<ul class="dropdown-menu" role="menu">';

				if($isses == 'no'){
					echo '<li><a href="'.Router::url('?membre/login').'">Connexion</a></li>';
					echo '<li><a href="'.Router::url('?membre/suscribe/0/0').'">Inscription</a></li>';
					echo '<li class="disabled"><a>Deconnexion</a></li>';
					echo '<li class="disabled"><a>Ajouter un fichier</a></li>';
					echo '<li class="disabled"><a>Proposer un cours</a></li>';
					echo '<li class="divider"></li>';
				}
				else{
					echo '<li class="disabled"><a>Connexion</a></li>';
					echo '<li class="disabled"><a>Inscription</a></li>';
					echo '<li><a href="'.Router::url('?membre/logout').'">Deconnexion</a></li>';
					//echo '<li><a href="'.constant('site_i_share_url').'">Ajouter un fichier</a></li>';
					echo '<li class="disabled"><a>Proposer un cours</a></li>';
					echo '<li class="divider"></li>';
				}
				//echo '<li><a href="'.constant('site_i_facebook').'">Envoyer une alerte</a></li>';
				echo '</ul>';
			  ?>
			</li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="myModal_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Gérer vos relations</h4>
      </div>
      <div class="modal-body">
      	
        <?php  
        if(!empty($tes_notifs_contact)){
        	echo "Ces personnes veulent entrer en contact avec vous. Vous avez le choix d'accepter ou de refuser leur demande. </br>";
        	foreach($tes_notifs_contact as $demandeur){
        		echo '<a href="'.Router::url('?membre/view/'.$demandeur['mem_id']).'" >'.$demandeur['mem_login']."</a>, ";
        		echo '<span class="divider"></span>';
        	}
        }
        else 
        	echo "Aucune demande de contact.";
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button> 
      </div>
    </div>
  </div>
</div>