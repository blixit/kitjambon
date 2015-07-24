<div class="container">
    <form class="form-signin " role="form" method="post" action="<?php echo Router::url('?membre/login/'); ?>" >
        <h2 class="form-signin-heading">Connexion</h2>
        <p>
            <span class="pull-left"><a href="<?php echo Router::url('?membre/passlost/'); ?>">Mot de passe perdu ?</a></span>
            <span class="pull-right"><a href="<?php echo Router::url('?membre/suscribe/0/0'); ?>">S'inscrire</a></span>
        </p>

        <?php if(!empty($soumis)):?>
        <p>
                <br/>
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
        </p>
        <?php endif; ?>
        <input class="form-control" name="login" type="text" value="<?php echo $form['login']; ?>" placeholder="Login" required autofocus />
        <input class="form-control" name="pass" type="password" value="<?php echo $form['pass']; ?>" placeholder="Password" required />

        <input class="btn btn-md btn-primary btn-block" name="submitted" type="submit" value="Envoyer"/>

    </form>
</div>
<br/>
