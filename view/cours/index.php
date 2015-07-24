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
	foreach($cours as $crs){
		if(isset($crs)){
		?>
			<div class="row"> 
			<div class="row col-md-12 "> 
			<fieldset class="">
			<legend><span class="label label-default"><?php echo $crs['nom'];?></span></legend>
				<?php 
				$lastoption = "";
				foreach($crs as $k) { 
					if(!empty($k) && $k !== $crs['nom']){ 						 
						$option = ($k->net_options != $lastoption) ? $k->net_options : $lastoption;
						if($k->net_options != $lastoption)
							echo '<h4>'.$option.'</h4>';
						$lastoption = $option;
						?> 
						<a href="<?php echo Router::url('?download/view/a/'.$k->net_niveau.'/'.$k->net_nom); ?>">
						<button type="button" class="btn btn-default"  title="<?php echo $k->net_description; ?>">
						<?php echo $k->net_nom; ?>
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
