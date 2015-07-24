<?php

/* 
 * Projet : Kit-jambon
 * By Alain Ngangoue
 * Fichier : suscribe.php
 * Role :  formulaire d'inscription
 */

?>
<div class="container">  
    <form class=" col-xs-12  col-sm-12" role="form" method="post" action="<?php echo Router::url('?membre/suscribe/'.$form_action); ?>" >
        <h2 class="form-signin-heading">Inscription</h2> 
        <p>En remplissant ce formulaire, vous acceptez les 
        <a href="documents/conditions.pdf" >
        conditions d'utilisation </a> de ce site. <br/> 
        </p>
        <p>
            <span class="pull-left"><a href="<?php echo Router::url('?membre/login/'); ?>">Se connecter</a></span>  
            |<span class=""><a href="<?php echo Router::url('?membre/passlost/'); ?>">Mot de passe perdu ?</a></span>
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
        <div class="row col-xs-12 col-sm-12">
        <div class="col-xs-12 col-sm-6">
            <fieldset>
            <legend>Identifiants</legend>
            <input class="form-control" name="mail" type="email" value="<?php echo $form['mail']; ?>" placeholder="Adresse e-mail" size="50" required /> 
            <input class="form-control" name="login" type="text" value="<?php echo $form['login']; ?>"placeholder="Nom d'utilisateur" size="50" required /> 
            <input class="form-control" name="pass" type="password" value="<?php echo $form['pass']; ?>" placeholder="Mot de passe"size="50" required /> 
            <input class="form-control" name="pass2" type="password" value="<?php echo $form['pass2']; ?>" placeholder="Confirmation du mot de passe" size="50" required />
            </fieldset>
        </div>
        <div class="col-xs-12 col-sm-6"> 
                <fieldset>
            <legend>Personnalité</legend>			
            <select class="form-control" name="year"  required >
                <option value="" disabled >Année</option>
                <option value="1" >EI1</option>
                <option value="2" >EI2</option>
                <option value="3" >EI3</option>
            </select>	
            <select class="form-control" name="ue"  required >
                <option value="" class="centered" disabled>Matière préférée</option>
                <option value="" class="centered" disabled>EI1</option>
                <?php foreach($list_ue['ei1'] as $u){
                    echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
                } ?>
                <option value="" class="divider" disabled></option>
                <option value="" class="centered" disabled>EI2</option>
                <?php foreach($list_ue['ei2'] as $u){
                    echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
                } ?>
                <option value="" class="divider" disabled></option>
                <option value="" class="centered" disabled>EI3</option> 
                <?php foreach($list_ue['ei3'] as $u){
                    echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
                } ?>
            </select>			
            <label for="temperament">Tempérament (15 lettres max)</label>
            <input class="form-control" name="temperament" type="text" value="<?php echo $form['temperament'];?>" placeholder="Ex: Rigoureux, Cool, Bosseur fou" size="50" required/> 
            </fieldset>
    </div>
        </div>
        <br/>
        <input class="" name="token" type="hidden" value="<?php echo $form['token'];?>" size="50"/>
        <input class="btn btn-md btn-primary  col-xs-4 pull-right" name="submitted" type="submit" value="Envoyer" size="50"/>

    </form> 
</div>

