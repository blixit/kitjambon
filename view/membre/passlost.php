<div class="container">
    <form class="form-signin " role="form" method="post" action="<?php echo Router::url('?membre/passlost/'); ?>" >
        <h2 class="form-signin-heading">Demande de mot de passe</h2>
        <p>
            <span class="pull-left"><a href="<?php echo Router::url('?membre/login/'); ?>">Se connecter</a></span>
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
            <div class="alert alert-warning alert-dismissible" role="alert">
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
        <input class="form-control" name="mail" type="text" value="<?php echo $form['mail']; ?>" placeholder="Entrez votre mail" required autofocus />
        <br/>
        <input class="btn btn-md btn-primary btn-block" name="submitted" type="submit" value="Envoyer"/>

    </form>
</div>
<br/>
