<?php 
/* 
 * Projet : Kit-jambon
 * By Alain Ngangoue
 * Fichier : index.php
 * Role : accueil principal de l'utilisateur 
 */  
?>
<div class="container col-xs-12" >  
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Kit-bord</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav col-md-5">
                <li class="active"><a href="#">Mon compte</a></li>
                <li><a href="?page=join">Réseaux et Groupes</a></li> 
                <?php echo isset($this_reseau) ? '<li>'.$this_reseau['net_description'].'</li>' : '' ; ?>
            </ul>
            <div class="navbar-form navbar-right">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div> 
            </div> 
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<div class="row">
    <!-- menu gauche -->
    <div class="col-xs-12 col-sm-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-user"></i>  Kit-Space </h3>
            </div>
            <div class="row">
            <div class="panel-body">
                <strong><?php echo $user['mem_login']; ?></strong> |
                <a href="<?php echo Router::url("?membre/list/eix:".$user['mem_year']); ?>">Liste des membres</a> <br/> 
                <legend ></legend><?php echo strtoupper('Mes réseaux'); ?>  
                    <br/> 
                    <?php 
                        if($reseaux){ 
                            foreach($reseaux as $r) {
                                if(!empty($r['net_nom'])){
                                    echo "<a href='".Router::url('?home/reseau/'.$r['net_id'])."'>".$r['net_nom']."</a>  ";
                                }
                            } 
                        }
                        echo "<legend></legend>".strtoupper('Mes groupes')." <br/> "; 
                        if($groupes){ 
                            foreach($groupes as $g) {
                                if(!empty($g['gr_nom'])){
                                    echo "<a href='".Router::url('?home/groupe/'.$g['gr_id'])."'>".$g['gr_nom']."</a> ";
                                }
                            } 
                        } 
                        echo "<legend></legend>".strtoupper('Mes contacts')." <br/> "; 
                        if($contacts){ 
                            foreach($contacts as $c) {
                                if(!empty($c)) 
                                    echo "<a href='".Router::url('?membre/view/'.$c['mem_id'])."'>".$c['mem_login']."</a> ";
                                
                            } 
                        }                                
                    ?>

            </div>
            </div>
        </div> 
    </div>
    <div class="col-xs-12 col-sm-6">
    <!-- form -->
    <div class="row">
        <form class="form " role="form" method="post" action="<?php echo Router::url('?home/'.$action.( $action=='reseau' ? '/'.$this_reseau['net_id'] : ( $action=='groupe' ? '/'.$this_groupe['gr_id'] : '')));?>" >
        <textarea class="form-control" name="resume" type="text" placeholder="Exprime-toi dans tes réseaux ou tes groupes"></textarea>
        <input class="form-control" name="net" type="hidden" value=0 required />
        <input class="form-control" name="gr" type="hidden" value=0 required />

        <br/>
        <div class="btn-toolbar">
            <div class="btn-group pull-left">
                <button type="button" class="btn btn-warning btn-xs" title="j'en ai marre!!">
                <i class="glyphicon glyphicon-thumbs-down"></i>  
                Zzzzzz !</button>
                <button type="button" class="btn btn-warning btn-xs" title="j'adore!!">
                <i class="glyphicon glyphicon-thumbs-up"></i>  
                So good !</button>
                <button type="button" class="btn btn-warning btn-xs" title="">
                <i class="glyphicon glyphicon-earphone"></i>  
                Phone</button>
                <button type="button" class="btn btn-warning btn-xs" title="on continue sur facebook!!">
                <i class="fa fa-facebook"></i>  Facebook
                </button> 
            </div>
              <div class="btn-group btn-xs pull-center"> 
              <select class="select" name="visibility" required >
                    <?php  
                    if($action=="index"){
                        echo '<option value="0">Public</option>';
                    }
                    ?>                    
                    <option class="divider" disabled >--réseaux--</option>
                    <?php
                    if($reseaux && ($action=="index" || $action=='reseau')){ 
                        foreach($reseaux as $r) {
                            if(!empty($r['net_nom'])){
                                echo "<option value='r-".$r['net_id']."'>".$r['net_nom']."</option>"; 
                            }
                        } 
                    }  
                    echo '<option class="divider" disabled >--groupes--</option>';
                    if($groupes && ($action=="index" || $action=='groupe')){ 
                        foreach($groupes as $g) {
                            if(!empty($g['gr_nom'])){
                                echo "<option value='g-".$g['gr_id']."'>".$g['gr_nom']."</option>"; 
                            }
                        } 
                    }  
                    ?>
              </select>
            </div>  
            <div class="btn-group pull-right"> 
              <button name="submitted" type="submit" class="btn btn-default btn-xs" title="j'en ai marre!!">
              <i class="fa fa-share"></i>
              Envoyer </button> 
            </div>
        </div>
        </form>
        <br/>
        <div class="col-xs-12 ">
            <?php 
                if($erreurs) { ?>
            <div class="alert alert-warning alert-dismissible" role="alert"> 	
            <strong>Erreurs</strong> <br/>
                <ul>	
                <?php foreach($erreurs as $err){	 
                        echo '<li>'.$err.'</li>';
                } ?>
                 </ul>  
            </div>
                <?php }
            ?>
        </div>
        <br/>
    </div>
    <!-- history -->
    <div class="row"> 
      <ul class="media-list ">
        <li class="media thumbnail">
            <?php foreach($history as $h) { ?> 
               <legend></legend>
                <?php if(!empty($h['hh_id'])){ ?> 
                <div class="media-body">
                    <h4 class="media-heading">
                    <!--Icone sur le coté-->
                    <?php if($h['hh_net_id']!=0) {?>  
                            <i class="fa fa-sitemap"></i>
                    <?php } elseif($h['hh_gr_id']!=0) {?>   
                            <i class="fa fa-users"></i>
                    <?php } else { ?>
                            <i class="fa fa-globe"></i> 
                    <?php } ?>

                    </h4>
                    <p><?php echo $h['hh_resume']; ?> 	</br> 	
                    <form class="form " role="form" method="post" action="<?php //echo Router::url('?home/'.$action.( $action=='reseau' ? '/'.$this_reseau['net_id'] : ( $action=='groupe' ? '/'.$this_groupe['gr_id'] : ''))); ?>" >
                        <input name="hh_id" type="hidden" value="<?php echo $h['hh_id']; ?>"/>
                        <div class="btn-group pull-right"> 
                        <?php if($h['hh_mem_id'] == $user['mem_id']) { ?> 
                                  <button name="delete" type="submit" class="btn btn-default btn-xs my-delete" title="j'en ai marre!!">
                                  <i class="glyphicon glyphicon-trash"></i>  
                                  Supprimer</button>  
                        <?php } else { ?>
                                  <button name="signal" type="submit" class="btn btn-default btn-xs my-delete" title="j'en ai marre!!">
                                  <i class="fa fa-exclamation"></i>  
                                  Signaler</button> 
                        <?php }  ?>		
                        </div> 
                        </form>
                    </p>
                    </div>
                <?php } ?>
            <?php } ?>
        </li>
      </ul> 
    </div>

    </div>
    <div class="col-xs-12 col-sm-3">
            <div class="panel panel-info">
                    <div class="panel-heading">
                            <h3 class="panel-title">  Kit-Pub </h3>
                    </div>
                    <div class="panel-body">
                    the pub
                    <br/> 
                    </div>
            </div>
            <div class="panel panel-info">
                    <div class="panel-heading">
                            <h3 class="panel-title">  Kit-Pub </h3>
                    </div>
                    <div class="panel-body">
                    the pub
                    <br/> 
                    </div>

            </div>
    </div>
    </div>

</div>
</br>


