<div class="container">
	<form class="form" method="post" action="?petition" >
		<h2 class="form-signin-heading">Pétition</h2>
		<div class="alert alert-info alert-dismissible" role="alert">
			La période d'essai est terminée : maintenant, nous faisons signer une "pétition" pour connaitre 
			le nombre de personnes intéressées par le projet. </br></br>
			Infos : Par souci de confidentialité et afin de controler les inscriptions, la future version de 
			ce site ne sera accessible que par voie de parrainage.  
			Si ce projet vous intéresse, veuillez laissez vos coordonnées. Nous reviendrons
			vers vous le plutôt possible. Merci		
			</br>
		</div>
		<?php if(isset($notifications)){ ?>
			<h4>Notifications</h4>
			<ul>
				<?php 
				foreach ($notifications as $key => $value) {
					echo '<li>'.$value.'</li>';
				}
				?>
			</ul>
		<?php } ?>
		<input class="form-control" type="text" name="nom" Placeholder="Nom" required/> </br>
		<input class="form-control" type="text" name="prenom" Placeholder="Prénom" required /> </br>
		<input class="form-control" type="email" name="mail" Placeholder="Mail" required /> </br>
		<textarea class="form-control" name="comment" value="Commentaire facultatif (512 caractères)" > </textarea>
		</br>
		<input class="btn btn-md btn-primary btn-block"  type="submit" name="participer" value="Envoyer" />
	</form>
</div>