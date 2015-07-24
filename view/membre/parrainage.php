<?php 

?>
<div class="container">
	<form class="form" role="form" method="post" action="<?php echo Router::url('?membre/parrainer'); ?>">
		<h2 class="form-signin-heading">Parrainer un nouveau membre</h2>  
        <p>La personne que vous invitez recevra un lien lui permettant de s'inscrire. </p>
        <?php if(!empty($soumis)):?>
            <p> <br/>
                <?php if(!empty($erreurs)){?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                <strong>Erreurs</strong> <br/>
                    <ul>
                    <?php foreach($erreurs as $err): ?>
                        <li><?php echo $err; ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php } ?>      
                <?php if(!empty($notifications)){?>
                <div class="alert alert-success alert-dismissible" role="alert">
                <strong>Notifications</strong> <br/>
                    <ul>
                    <?php foreach($notifications as $err): ?>
                        <li><?php echo $err; ?></li>
                    <?php endforeach; ?>
                    </ul>
                </div>
                <?php } ?>
            </p>
        <?php endif; ?> 

		<span class="pull-center">
			<input type="hidden" name="token" value="<?php echo $form['token']; ?>" />
      		<label for="">Son mail  :  
      			<input class="form-control" id="input_mail" name="mail" type="email" placeHolder="" cols="20" required/> 
      		</label>
  		</span>
  		<br>
  		<button type="submit" class="btn btn-primary" >Valider</button>
    
	</form>
</div>