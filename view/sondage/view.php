<div class="container"> 
	<?php  
		echo '<span><h1><strong>'. $sondage['sond_theme'].'</strong></h1></span> <a href="'.Router::url('?sondage/view/'.$sondage['sond_id']).'"></a></br>';
		echo '<span>Nombre de participants : '.$sondage['sond_ndParticipants'].'</span><br>';
		echo '<span>Nombre de questions : '.$sondage['sond_nbQuestions'].'</span><br>';
		echo '<span>Fin : <i>'.$sondage['sond_dateF'].'</i></span>';
		echo '<p>'. $sondage['sond_resume'].'</p>';		
	?>
	<br>
	<form class="form" method="post" action="<?php echo Router::url('?sondage/post/'.$sondage['sond_id']); ?>">
	<?php  
		if(!empty($questions)){ 
			$i = 0;
			echo '<div class="panel">';
			foreach ($questions as $value) {
				echo '<span id="id_question_'.($i+1).'" style="display:'.(($i+1)==1 ? 'block':'none').'">';
				echo '<h3>'.($i+1).'. '.$value['sondQ_question'].'</h3>';
				$j = 0;
				foreach ($value['reponses'] as $reponses) {
					echo " ".$reponses.'  <input name="rep'.($i+1).'.'.($j+1).'" type="radio" value="'.$reponses.'" onclick="javascript:QuestionSuivante('.($i+1).');" /> <br>';
					$j++;
				}
				$i++;
				echo '</span>';
			}
			echo '<span id="id_question_fin" class="pull-center" style="display:none">C\'est fini. Merci d\'y avoir répondu. <br>'
				.'<input id="id_submit_formulaire" class="btn btn-primary" type="submit" value="Valider vos réponses" />'
				.'</span>';
			echo '</div>';
			?>
			<script type="text/javascript"> 
				/**
				* @brief Affiche la question suivante
				* @param numQuestion le numéro de la question dont on a cliqué une des réponses
				*/
				var QuestionSuivante = function (numQuestion){
					// on cache la question courante
					$('#id_question_'+numQuestion).hide();
					//on montre la question suivante
					if(numQuestion < <?php echo count($questions); ?> ) 
						$('#id_question_'+(numQuestion+1)).show(); 
					else{
						$('#id_question_fin').show();
					}
				}

			</script>
			<?php
		}
		else{
			echo "Il n'y aucune question pour ce sondage.";
		}
	?>
	</form> 
</div>