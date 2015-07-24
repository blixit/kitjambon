<div class="container">
<?php //Functions::debug($user);?>
<?php //Functions::debug($_SESSION['membre']);?>
	<div class="panel">
	<table class="table table-striped table-condensed col-xs-12" border="0" cellspacing="0" cellpadding="10" bordercolor="gray" >
	<thead>
		<th colspan="3">
		<h2 class="form-signin-heading">
		@ <?php echo $user['mem_login']; ?>
		<?php if($monCompte) echo " - Mes informations"; ?>
		</h2>
		<span class="pull-right">
			<a href="<?php echo Router::url("?membre/liste/".$user['mem_year']); ?>">
			<i class="glyphicon glyphicon-list"></i>
			Liste des membres</a></span>
		</th>
	</thead>
	<tbody>
	<tr><th class="centered col-xs-4" >Niveau</th>  <td class="col-xs-8"><?php echo 'EI'.$user['mem_year']; ?></td></tr>
	<tr><th class="centered">Matière favorite</th>  <td><?php echo $user['mem_ue']; ?></td></tr>
	<tr><th class="centered">Style</th>  <td><?php echo $user['temperament']; ?></td></tr>
	<tr><th class="centered">Inscription</th>  <td><?php echo $user['mem_date_joined']; ?></td></tr>
	<tr><th class="centered">Ses réseaux</th>  <td>
			<?php
				foreach($sesReseaux as $k){
					echo "<a href='".Router::url('?home/reseau/'.$k['net_id'])."'>".$k['net_nom']."</a>";
					if($k!==end($sesReseaux))
						echo ", ";
				}
			?>
	</td></tr>
	<tr><th class="centered">Ses groupes</th>  <td>
			<?php
				foreach($sesGroupes as $k){
					echo "<a href='".Router::url('?home/groupe/'.$k['gr_id'])."'>".$k['gr_nom']."</a>";
					if($k!==end($sesGroupes))
						echo ", ";
				}
			?>	
	</td></tr>
	<?php 
		if($compteAdmin || $monCompte){
			echo "<tr><th class='centered'>Mail</th>  <td>".$user['mem_mail']."</td></tr>";
			echo "<tr><th class='centered'>Type de compte</th>  <td>".$user['mem_droit']."</td></tr>";
			echo "<tr><th class='centered'>Statut de validation</th>  <td>".$user['mem_etat']."</td></tr>";
		}
		if(($user['mem_login'] != $_SESSION['membre']['mem_login']) && $contactMe){
		?>
		<tr><th id="contact_test" class="centered">Contacter </th>  <td>
			<div class="btn-toolbar">
				<div class="btn-group pull-left"> 
				  <button id="send_mail" name="submit_mail" type="button" class="btn btn-info btn-xs" title="">
				  <i class="glyphicon">@</i>  
				  Mail</button>
				  <button disabled id="send_call" name="submit_call" type="button" class="btn btn-info btn-xs" title="">
				  <i class="glyphicon glyphicon-earphone"></i>  
				  Phone</button>
				  <button disabled id="send_facebook" name="submit_facebook" type="button" class="btn btn-info btn-xs" title="on continue sur facebook!!">
				  <i class="fa fa-facebook"></i>  Facebook
				  </button> 
					<span> <i> En cliquant sur un de ces bouttons, vous acceptez de transmettre vos données (mail, téléphone ou facebook) à cet utilisateur.</i></span>
				</div> 
			</div>  
			<h4><span id="reponse" class="label label-success label-lg pull-right" style="display:none"></span></h4>
		</td></tr>
		<?php 
		}
        if(!($contactMe)){
            ?> 
            <tr><th id="contact_test" class="centered">Lien avec ce jambon </th>  
            <td> 
            	<?php 
            	if($interaction['cm_valid']==0 && $interaction['mem_id_1']!=$_SESSION['membre']['mem_id']){ ?> 
					<button id="accepte_demande" name="accepte_demande" type="button" class="btn btn-primary btn-xs">
				 	Accepter la demande de contact</button>
            	<?php 
            	}elseif($interaction['cm_valid']==0 && $interaction['mem_id_1']==$_SESSION['membre']['mem_id']){
            		echo "Vous avez déjà initié un contact avec ".$user['mem_login'].". Veuillez attendre sa réponse.";
            	}elseif($interaction['cm_valid']==1) { 
            		echo '@_'.$user['mem_login']." fait désormais partie de vos contacts.";
            	} ?>
            	<h4><span id="reponse_accepte_demande" class="label label-success label-lg pull-right"></span></h4>
            </td>
            </tr>
            <?php  
        }		
	?>
	
	</tbody>
	</table>
	</div>
</div>