<div class="container">
	<form class="form-signin " role="form" method="post" action="<?php echo Router::url('?membre/passinit/'.$token); ?>" >
            <h2 class="form-signin-heading">Restauration de mot de passe</h2>
            <p>
                <span class="pull-left"><a href="<?php echo Router::url('?membre/passlost/'); ?>">Mot de passe perdu ?</a></span>
                <span class="pull-right"><a href="<?php echo Router::url('?membre/suscribe/0/0'); ?>">S'inscrire</a></span>
            </p>

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
            <input class="form-control" name="mail" type="text" value="" placeholder="Votre email" required autofocus />
            <input class="form-control" name="renew_pass" type="text" value="" placeholder="Code reçu par mail" required autofocus />
            <input class="form-control" name="pass" type="password" value="" placeholder="Mot de passe" required autofocus />
            <input class="form-control" name="pass2" type="password" value="" placeholder="Confirmation de mot de passe" required />

            <input class="btn btn-md btn-primary btn-block" name="submitted" type="submit" value="Envoyer"/>

	</form>
</div>
<br/>
