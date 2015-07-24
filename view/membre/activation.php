<div class="container"> 
    <h2 class="form-signin-heading">Activation du compte</h2>
            <p>
                <span class="pull-left"><a href="<?php echo Router::url('?membre/login/'); ?>">Se connecter</a> | <a href="<?php echo Router::url('?membre/passlost/'); ?>">Mot de passe perdu ?</a></span>
            </p>
 
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
</div>
<br/>
