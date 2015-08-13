<!-- #KITJAMBON/SiteBundle/Ressources/views/Cours/view.html.php -->
<?php $view->extend('::base.html.php') ?>

<div class="container"> 
<div class="row col-sm-12 ">  
	<div class="">
	<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h2>Mes modules</h2>
	<p class="site_description"><i>L'administrateur</i></p>
	<p class="alert alert-info">
	Cette page permet de visualiser les cours déjà uploadés sur la nouvelle version du kitJambon <i>(Données postérieures à 2013)</i>.<br/>
	La 1ère version, moins bien organisée et beaucoup plus fournie à l'instant, reste néanmoins accessible via les mêmes liens.<br/>
	</p>
	</div>
</div>
<div class="row col-sm-12 ">
<?php 
	// on parcourt la liste des modules déjà triée par année/options/module
	foreach($options['annees'] as $annee){ 
		if(isset($annee)){
		?>
			<div class="row"> 
			<div class="row col-md-12 "> 
			<fieldset class="">
			<legend><span class="label label-default"><?php echo ' EI'.$annee['optionAnnee'];?></span></legend>
				<?php 
				$lastoption = "";
				foreach($modules as $k) { 
					if($k->getOptionAnnee()== $annee['optionAnnee']){ 						 
						$option = ($k->getOptionNom() != $lastoption) ? $k->getOptionNom() : $lastoption;
						if($k->getOptionNom() != $lastoption)
							echo '<h4>'.ucfirst($option).'</h4>';
						$lastoption = $option;
						?> 
							<a href="<?php  
							//on génère l'uri
							$uri = $view['router']->generate('kitjambon_transfert_download_view', 
									array(
										'eix' => $annee['optionAnnee'],
										'abrege' => $k->getOptionAbrege()
										));
							echo $uri;
							?>">
							<button type="button" class="btn btn-default"  title="<?php echo $k->getOptionNom(); ?>">
							<?php echo strtoupper($k->getOptionAbrege()); ?>
							</button>
							</a>
						<?php 
					}
				} 
				?>
			</fieldset>
			</div> 
			</div>
			<br/>  
		<?php 
		}
	} 
?>
</div>
</div>
