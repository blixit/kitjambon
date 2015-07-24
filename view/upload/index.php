<div class="container"> 
    <form class="  " role="form" enctype="multipart/form-data" method="post" action="<?php echo Router::url('?upload/index')?>" >
        <h2 class="form-signin-heading">Soumission de fichier</h2> 

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
        <select class="form-control" name="year" required >
            <option value="" disabled >Année</option>
            <option value="1" >EI1</option>
            <option value="2" >EI2</option>
            <option value="3" >EI3</option>
        </select>  
        <select class="form-control" name="ue"  required >
            <option value="" class="centered" disabled>Module</option>
            <option style="color:brown; font-weight: bold; background-color: lightgrey" value=""  disabled>EI1</option>
            <?php foreach($list_ue['ei1'] as $u){
                if($u)
                echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
            } ?>
           <option style="color:brown; font-weight: bold; background-color: lightgrey" value=""  disabled>EI2</option>
            <?php foreach($list_ue['ei2'] as $u){
                if($u)
                echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
            } ?>
            <option style="color:brown; font-weight: bold; background-color: lightgrey" value=""  disabled>EI3</option> 
            <?php foreach($list_ue['ei3'] as $u){
                if($u)
                echo "<option value='".$u['net_nom']."' class='centered' >".strtoupper($u['net_nom'])." - ".$u['net_description']."</option>";
            } ?>
        </select>	
        <select class="form-control" name="catg" required > 
            <option value="" disabled >Catégorie</option> 
            <?php foreach($list_catg as $k => $v){ 
                echo "<option value='".$k."' >".  strtoupper($k)." - ".$v."</option>";
             } ?>
        </select>
        <input class="form-control" name="fichier" type="file"  required  />  
		<?php $t = Session::getToken('uploadDefichier'); ?>
        <input name="token" type="hidden" value="<?php echo $t['value'];?>" />  
         <br/> 
        <input class="btn btn-md btn-primary btn-block" name="submitted" type="submit" value="Envoyer"/>

    </form> 
</div>