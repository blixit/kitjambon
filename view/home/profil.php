<div class="container col-xs-12" style="margin:0px">
<div class="row ">
	<!-- Menu activités -->
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
		<div class="panel panel-success" style="padding:5px"> 
			<div class="panel-heading">Activité</div>
			<div class="panel-body" style="padding:5px">
				<?php 
					if(!empty($activite)){ 
						$ratio = ($activite['nb_down'] != 0) ? $activite['nb_up'] / $activite['nb_down'] : 0;
						$ratio = round($ratio,2);
						$color = ($ratio >= 1 )? 'green' : 'red' ;
						$ico = '<i class="glyphicon glyphicon-arrow-up"></i>/<i class="glyphicon glyphicon-arrow-down"></i>';
						echo '<span style="color:'.$color.'">Ratio  '.$ico.' : '.$ratio.'</span><br>';
				?>
						Uploads : <?php echo $activite['nb_up'];?><br>
						Téléchargements : <?php echo $activite['nb_down'];?><br>
						Avis + : <?php echo $activite['nb_av_plus'];?><br>
						Avis - : <?php echo $activite['nb_av_moins'];?><br>
						Messages : <?php echo $activite['nb_messages'];?><br>
						Parrainages : <?php echo $activite['nb_parrainages'];?> <br>
						Signalements : <?php echo $activite['nb_signalements'];?> <br>
						Connexions : <?php echo $activite['nb_connexions'];?><br>
						Vu la dernière fois : <?php echo $activite['last_connexion'];?><br>
					<?php  
					}
					else{
						echo "Aucune activité détectée.";
					}
				?> 
			</div>
		</div>
	</div>
	<!-- Div milieu-->
	<div class="col-xs-12 col-sm-9  col-md-9 col-lg-8">
		<h1><i class="fa fa-home"></i>Mon compte</h1>
		<div class="panel panel-info" style="padding:5px">
			<div class="panel-heading">
			  <!--<h3 class="panel-title">Mes informations personnelles</h3>-->
			</div>
			<div class="panel-body row">
				<div class="pull-left col-xs-12 col-sm-3"><img style="width:150px; height:200px; " src="/webroot/img/membres/SJ.png" alt="Loading..."/></div>
				<div class="pull-right col-xs-12 col-sm-9">
					<table  class="table table-striped  table-condensed " border="0" cellspacing="0" cellpadding="10" bordercolor="gray" style="margin:10px">
						<tbody>
							<tr><th>Pseudo</th>		<td><?php echo $user['mem_login']; ?></td></tr>
							<tr><th>Mail</th>		<td><?php echo $user['mem_mail']; ?></td></tr>
							<tr><th>Année</th>		<td>EI<span id="result_change_year"><?php echo $user['mem_year'];?></span>
													<span class="pull-right"><a data-toggle="modal" data-target="#modal_change_year" href="#">
														<i class="glyphicon glyphicon-pencil"></i></a></span>
													</td>
							</tr>
							<tr><th>Matière</th>	<td><span id="result_change_ue"><?php echo $user['mem_ue']; ?></span>
													<span class="pull-right"><a data-toggle="modal" data-target="#modal_change_ue" href="#">
														<i class="glyphicon glyphicon-pencil"></i></a></span>
													</td>
							</tr>
							<tr><th>Style</th>		<td><span id="result_change_temperament"><?php echo $user['temperament']; ?></span>
													<span class="pull-right"><a data-toggle="modal" data-target="#modal_change_style" href="#">
														<i class="glyphicon glyphicon-pencil"></i></a></span>
													</td>
							</tr>
							<tr><th colspan="2">Répertoires de cours</th></tr>
							<tr><td colspan="2">
								<?php 
									if($reseaux){ 
			                            foreach($reseaux as $r) {
			                                if(!empty($r['net_nom'])){
			                                    echo "<a href='".Router::url('?download/view/a/'.$user['mem_year'].'/'.$r['net_nom'])."'>".$r['net_nom']."</a>  ";
			                                }
			                            } 
			                        }
								?>
							</td></tr>
							<tr><th colspan="2">Groupes <i class="fa fa-info"></i></th></tr>
							<tr><td colspan="2">
								<?php 
									if($groupes){ 
			                            foreach($groupes as $g) {
			                                if(!empty($g['gr_nom'])){
			                                    echo "<a href='".Router::url('?home/groupe/'.$g['gr_id'])."'>".$g['gr_nom']."</a> ";
			                                }
			                            } 
			                        } 
								?>
							</td></tr>
							<tr><th colspan="2">Contacts</th></tr>
							<tr><td colspan="2">
								<?php 
									if($contacts){ 
			                            foreach($contacts as $c) {
			                                if(!empty($c)) 
			                                    echo "<a href='".Router::url('?membre/view/'.$c['mem_id'])."'>".$c['mem_login']."</a> ";
			                                
			                            } 
			                        } 
								?>
							</td></tr>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
	<!-- Menu social -->
	<div id="lien_parrainage" class="col-xs-12 col-sm-12  col-md-12 col-lg-2">
		<div class="panel panel-danger" >
			<div class="panel-heading">
			  <h3 class="panel-title">Social </h3>
			</div>
			<div class="panel-body" style="padding:5px">
				<a href="<?php echo Router::url('?membre/liste/1/1');?>">Liste des membres</a><br>
				<a href="<?php echo Router::url('?membre/parrainer');?>">Parrainer un nouveau</a><br>
				<a href=""><del>Signaler un membre</del></a><br>
			</div>
			<br>
			<div class="panel-heading">
			  <h3 class="panel-title">Derniers arrivants </h3>
			</div>
			<div class="panel-body" style="padding:5px">
				<?php
					if(!empty($lastComers)){
						foreach ($lastComers as  $value) {
							echo "EI".$value['mem_year']." <a href=\"".Router::url('?membre/view/'.$value['mem_id'])."\">".$value['mem_login']."</a><br>";
						}
					}
				?>
			</div>
		</div>
	</div>
</div>
</div>
<br>
<br>
<!-- Modal : modification de l'année-->
<div class="modal fade" id="modal_change_year" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modification de l'année</h4>
      </div>
      <div class="modal-body">
      		<span class="pull-center">
      		<label for="">Nouvelle année :  
      			<select class="form-control" id="input_change_year" name="year" cols="20">
      				<option value="1">Je suis en 1ère année</option>
      				<option value="2">Je suis en 2è année</option>
      				<option value="3">Je suis en 3è année</option>
      			</select>
      		</label>
      		</span>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_change_year" class="btn btn-primary" data-dismiss="modal">Valider</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>	
<!-- Modal : modification de la matière préférée-->
<div class="modal fade" id="modal_change_ue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modification de la matière favorite</h4>
      </div>
      <div class="modal-body">
      		<span class="pull-center">
      		<label for="">Nouvelle matière favorite :  
      			<select class="form-control" id="input_change_ue" name="ue" cols="20"> 
      				<?php
      				//récupération des listes : définies dans le menu
      				$list_ue = $_SESSION['list_ue'];

					if(!empty($list_ue['ei1'])){
						echo ' <option disabled>E1</option> ';
						foreach($list_ue['ei1'] as $l)
							echo '<option value="'.$l->net_nom.'">'.$l->net_nom.'</option>';
					} 
					if(!empty($list_ue['ei2'])){
						echo ' <option class="divider" disabled></option> ';
						echo ' <option disabled>E2</option> ';
						foreach($list_ue['ei2'] as $l)
							echo '<option value="'.$l->net_nom.'">'.$l->net_nom.'</option>';
					} 
					if(!empty($list_ue['ei3'])){
						echo ' <option class="divider" disabled></option> ';
						echo ' <option disabled>EI3</option> ';
						foreach($list_ue['ei3'] as $l)
							echo '<option value="'.$l->net_nom.'">'.$l->net_nom.'</option>';
					}

				  ?>
      			</select>
      		</label>
      		</span>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_change_ue" class="btn btn-primary" data-dismiss="modal">Valider</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>	
<!-- Modal : modification de l'année-->
<div class="modal fade" id="modal_change_style" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modification du tempérament</h4>
      </div>
      <div class="modal-body">
      		<span class="pull-center">
      		<label for="">Nouveau tempérament :  
      			<input class="form-control" id="input_change_temperament" name="temperament" type="text" placeHolder="Sois un peu imaginatif ..." cols="20"/> 
      		</label>
      		</span>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_change_temperament" class="btn btn-primary" data-dismiss="modal">Valider</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
      </div>
    </div>
  </div>
</div>	 