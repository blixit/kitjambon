<div class="container"> 
	<div class="row col-sm-12 ">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- BannerReprtoireCours -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:728px;height:90px"
		     data-ad-client="ca-pub-4091232325046143"
		     data-ad-slot="8328608911"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>
	<div class="row col-sm-12 ">
		<div class="btn-group pull-left">
		<a href="<?php echo Router::url($link_switch);?>">
		<button type="button" class="btn btn-danger btn-sm" type="text">
		 Voir <?php echo (strtolower($age)=='n') ? "l'ancienne":"la nouvelle";?> version. >> </button>
		</a>
		</div>
		<br/>
		<div class="">
		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h2><?php echo strtoupper($ue_nom_for_layout); ?></h2>
		<p class="site_description"><i><?php echo $ue_description_for_layout; ?></i></p>
		<p class="alert alert-info">Attention! Dans certaines matières le kit se décline en 2 parties. Le bouton rouge
		au-dessus permet de passer de l'ancienne version à la nouvelle et inversement. Il peut être utile lorsque vous ne trouvez
		pas votre fichier. 
		</p>
		</div>
	</div>
	<div class="row col-sm-12 ">
		<span class="pull-left"> 
			<!-- Button trigger modal -->
		<span class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal_listeInscrits"> 
			<?php echo count($listeInscrits); ?> inscrits à ce réseau. </span>
		</span><br/>
	</div>
	<div class="row col-sm-12 ">
		<div class="panel panel-primary"> 
		<span class="pull-right"> 
			<!-- Button trigger modal -->
			<span class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal_inscription"> S'inscrire à ce réseau </span>
			<span class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal_desinscription"> Se désinscrire </span>
		</span><br/>
		<table class="table table-striped table-condensed" border="1" cellspacing="0" cellpadding="10" bordercolor="gray">
		<div class="panel-heading">
		  <h3 class="panel-title">Kit jambon - <?php echo $ue_nom_for_layout; ?>
				<a href="">
				<i class="glyphicon glyphicon-cloud-download"></i>
				</a>
		  </h3>
		</div>
		<thead>
		  <tr>
			<th>Répertoires</th>
			<th>Fichiers</th>
		  </tr>
		</thead>
		<tbody>
		<tr valign="top"><td>
		<span><i class="glyphicon glyphicon-book"></i><a href="<?php echo $link_hyper_racine;?> ">  Racine</a></span><br />
		<span><i class="glyphicon glyphicon-folder-open"></i>
				<i class="glyphicon glyphicon-arrow-up"></i><a href="<?php echo $link_up;?>">  Remonter</a></span><br />
		<?php
			foreach($directory as $dir) {
				if($dir){
                    ?>
                    <span><i class="glyphicon glyphicon-folder-close"></i> <a href="<?php echo $link_racine.(($age=='n') ? $dir['dir'] : $dir['doc_path']);?>">
                    <?php echo strtoupper(($age=='n') ? $dir['dir'] : $dir['doc_path']);?></a></span><br />

                    <?php }} ?>
		</td><td>
		<div class="row col-sm-12 ">
	    <div class="panel panel-primary">
		<table class="table table-striped table-condensed" cellspacing="0" cellpadding="0" border="0">
		<thead>
			<tr style="font-size:8pt;font-family:arial;">
			<th>Nom</th> <td></td>
			<th>Taille</th> <td></td>
			<th>Date</th> <td></td>
			<th><span class="success">Avis +</span></th> <td></td> 
			<th><span class="danger">Avis -</span></th> <td></td>
			<th>Téléchargements</th> <td></td>
			<?php
				if($age=='n'){ 
					echo '<th>Origine</th> <td></td>';
				}
			?>
			</tr>
			<tr><td colspan="5"><span class="label label-info">
		<a href="{{link_zip}}" >Télécharger le répertoire</a></span></td></tr>
		</thead>
		<?php
			foreach($files as $file) {
				if($file){
		?>
			<tr>
				
				<th> 
				<i class="glyphicon glyphicon-cloud-download"></i>
				<a href="<?php echo ($age=='n') ? $file['doc_url'] : Router::url($file['doc_url']);?>" target="blanc">
					<?php echo  utf8_decode(ucfirst(($age=='n') ? $file['name'] : $file['doc_name']));  ?> 
				</a>
				</th> <td> </td>
				<th align="right"><?php echo  ucfirst(($age=='n') ? $file['doc_size'] : $file['doc_size']); ?> </th><td> </td>
				<th><?php  echo  ucfirst(($age=='n') ? $file['upload_date'] : $file['doc_date']); ?></th><td>  </td>
				 
				<?php
					if($age=='n'){  
						echo '<th class="success">'.($file['av_plus']).' <a  href="'.Router::url('?download/avis/'.$file['id'].DS.'p'.DS.$thisDir).'"><i class="glyphicon glyphicon-thumbs-up"></i></a></th> <td> </td>'; //av+
						echo '<th class="danger">'.($file['av_moins']).' <a  href="'.Router::url('?download/avis/'.$file['id'].DS.'m'.DS.$thisDir).'"><i class="glyphicon glyphicon-thumbs-down"></i></a></th> <td> </td>'; //av-
						echo '<th>'.($file['hits']).'</th> <td></td>';
						echo '<th>'.$file['user_login'].'</th> <td></td>';
					}else{
						echo '<th class="success">'.($file['doc_av_plus']).' <a  href="'.Router::url('?download/avis/'.$file['doc_id'].DS.'p'.DS.$thisDir).'"><i class="glyphicon glyphicon-thumbs-up"></i></a></th> <td> </td>'; //av+
						echo '<th class="danger">'.($file['doc_av_moins']).' <a   href="'.Router::url('?download/avis/'.$file['doc_id'].DS.'m'.DS.$thisDir).'"><i class="glyphicon glyphicon-thumbs-down"></i></a></th> <td> </td>'; //av-
						echo '<th>'.($file['doc_hits']).'</th> <td></td>';
					}
				?>
				<!--<th><?php //echo  ucfirst(($age=='n') ? $file->doc_ext : $file['doc_ext']); ?></th>
                <td> </td>-->
			</tr>

		<?php }} ?>
		</table>
		</div>
		</div>
		</td></tr>
		</tbody>
		</table>

		</div>
	</div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal_inscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Inscription au réseau</h4>
      </div>
      	<?php if(!$est_inscrit) {?>
			<div class="modal-body">Etes vous sûr de vouloir rejoindre ce réseau ?</div>
			<div class="modal-body" id="reponse_modal_inscription"></div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" id="modal_inscription" >Oui</button> 
			<button type="button" class="btn btn-primary" data-dismiss="modal">Non</button> 
			</div>
			<?php }else{ ?>
			<div class="modal-body">Vous êtes déjà inscrit à ce réseau.</div>
			<div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button></div>         	
       	<?php } ?>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal_desinscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Quitter ce réseau</h4>
      </div>
      	<?php if($est_inscrit) {?>
			<div class="modal-body"> Etes vous sûr de vouloir quitter ce réseau ?</div>
			<div class="modal-body" id="reponse_modal_desinscription"></div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" id="modal_desinscription" >Oui</button> 
			<button type="button" class="btn btn-primary" data-dismiss="modal">Non</button> 
			</div>
			<?php }else{ ?>
			<div class="modal-body">Vous n'êtes pas inscrit à ce cours.</div>
			<div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button></div>         	
       	<?php } ?> 
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal_listeInscrits" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Liste des jambons inscrits à ce cours</h4>
      </div>
      <div class="modal-body centered" style="max-height: 300px; overflow-y:scroll"> 
		<?php 
			if(!empty($listeInscrits))
				foreach ($listeInscrits as $value) { 
					if(!empty($value))
						echo '<a href="'.Router::url('?membre/view/'.$value['mem_id']).'">'.$value['mem_login'].' </a></br> ';
				}
		?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button> 
      </div>
    </div>
  </div>
</div>