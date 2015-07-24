<div class="container"> 
	<h1>Espace sondage </h1>
	<p>Les sondages proposés sur ce site sont anonymes.</p>
	<p style="color:red">La mise en place du service est toujours en cours.</p>
	<?php 
		if(isset($listeDesSondages)){ 
			?>
			<div class="panel">
			<table class="table table-striped table-condensed table-hover col-xs-12" border="0" cellspacing="0" cellpadding="10" bordercolor="gray" >
				<thead>
					<th colspan="3"></th>
				</thead>
				<tbody> 
					<?php

					foreach ($listeDesSondages as $value) {  
						echo '<tr><td>';  
						echo '<span><strong>'. $value['sond_theme'].'</strong></span> <a href="'.Router::url('?sondage/view/'.$value['sond_id']).'"><span class="glyphicon glyphicon-arrow-right"></span></a></br>';
						echo '<span>Nombre de participants : '.$value['sond_ndParticipants'].'</span><br>';
						echo '<span>Nombre de questions : '.$value['sond_ndParticipants'].'</span><br>';
						echo '<span>Fin : <i>'.$value['sond_dateF'].'</i></span>';
						echo '<p>'. $value['sond_resume'].'</p>';
						echo '</td></tr>';
					}
					?> 
				</tbody>
			</table>
			</div>
			<?php
		}else{ 
		?>
			Il n'y a aucun sondage.
		<?php
		}
	?>
	
</div>