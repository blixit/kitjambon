<?php
	$cont = new Controller(null);
	$cont->loadModel('reseau');

	if(empty($_SESSION['list_ue']))
	{  
		$list_ue['ei1'] = $cont->reseau->find(array('conditions' => 'net_niveau=1', 'order' => 'net_nom ASC','fecthMethod' => PDO::FETCH_ASSOC ));
		$list_ue['ei2'] = $cont->reseau->find(array('conditions' => 'net_niveau=2', 'order' => 'net_nom ASC','fecthMethod' => PDO::FETCH_ASSOC ));
		$list_ue['ei3'] = $cont->reseau->find(array('conditions' => 'net_niveau=3', 'order' => 'net_nom ASC','fecthMethod' => PDO::FETCH_ASSOC ));
		
		$_SESSION['list_ue'] = $list_ue;
	}
	else{
		$list_ue = $_SESSION['list_ue'];
	} 
	if(empty($_SESSION['nb_tes_notifs_contact'])){
		if(isset($_SESSION['membre'])){
			$i = $_SESSION['membre']['mem_id']; 
	        $tes_notifs_contact= $cont->reseau->find(array( 
	                'tables' => ' membre NATURAL JOIN (SELECT * FROM contact_membre WHERE   ( mem_id_1 = '.$i.' OR mem_id_2 = '.$i.') ) as c',
	                'champs' => 'mem_id, mem_login', 
	                'conditions' => "cm_valid = 0 AND (mem_id=c.mem_id_1) AND mem_id != ".$i,
	                'fecthMethod' => PDO::FETCH_ASSOC,
	            ));  
			/*$tes_notifs_contact = $cont->reseau->find(array(
				'tables' => 'contact_membre',
				'conditions' => '(mem_id_2 = '.$i.' ) AND cm_valid=0',  
				'fecthMethod' => PDO::FETCH_ASSOC
			));*/
			$_SESSION['tes_notifs_contact'] = $tes_notifs_contact;  
			$_SESSION['nb_tes_notifs_contact'] = count($tes_notifs_contact);  
		}
	} 
	$tes_notifs_contact = empty($_SESSION['tes_notifs_contact']) ? array() : $_SESSION['tes_notifs_contact']; 
	$nb_tes_notifs_contact = empty($_SESSION['nb_tes_notifs_contact']) ? 0: $_SESSION['nb_tes_notifs_contact']; 
	unset($cont); 

	 
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo Router::url('?accueil');?>"><?php  echo constant('site_i_name');?></a>
        </div>
        <div class="collapse navbar-collapse"> 
          <ul class="nav navbar-nav">
            <li class="">
				<a href="<?php echo Router::url('?accueil/presentation');?>">Présentation</a>
			</li>
            <li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ton année <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
                  <li><a href="<?php echo Router::url('?cours/view/1');?>">E1</a></li>
                  <li><a href="<?php echo Router::url('?cours/view/2');?>">E2</a></li>
                  <li><a href="<?php echo Router::url('?cours/view/3');?>">E3</a></li>
                </ul>
			</li>
            <li>
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Ton module <span class="caret"></span></a>
				<ul class="dropdown-menu scroll centered" role="menu" style="max-height:300px; overflow-y:scroll">

				  <?php

					if(!empty($list_ue['ei1'])){
						echo ' <li>E1</li> ';
						foreach($list_ue['ei1'] as $l)
							echo '<li>'.'<a href="'.Router::url('?download/view/a/1/'.$l['net_nom']).'">'.$l['net_nom'].'</a></li>';
					} 
					if(!empty($list_ue['ei2'])){
						echo ' <li class="divider"></li> ';
						echo ' <li>E2</li> ';
						foreach($list_ue['ei2'] as $l)
							echo '<li>'.'<a href="'.Router::url('?download/view/a/2/'.$l['net_nom']).'">'.$l['net_nom'].'</a></li>';
					} 
					if(!empty($list_ue['ei3'])){
						echo ' <li class="divider"></li> ';
						echo ' <li><a href="#">E3</a></li> ';
						foreach($list_ue['ei3'] as $l)
							echo '<li>'.'<a href="'.Router::url('?download/view/a/3/'.$l['net_nom']).'">'.$l['net_nom'].'</a></li>';
					}

				  ?>
                </ul>
			</li>
			<li><a href="<?php echo Router::url('?sondage'); ?>">Sondage </a></li>
            <li><a href="<?php echo constant('site_i_facebook'); ?>" target="blanc">Ton forum</a></li>
          </ul>
		  <ul class="nav navbar-nav navbar-right">
		  	<!-- notification contact -->
		  	<?php if(isset($_SESSION['membre']) && isset($nb_tes_notifs_contact)) {
		  		/*echo '<li> <a id="tes_notifications" href="" title="Mes demandes de contact" >
		  				<span class="label label-danger"><i class="fa fa-user"></i> '.$nb_tes_notifs_contact
		  				.'</span></a></li>'; 
		  				*/?>
		  				<!-- Button trigger modal -->
						<li class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal_contact">
							<i class="fa fa-user"></i><?php echo $nb_tes_notifs_contact; ?>
						</li>
						<?php 
		  		}
		  	?>
			<!-- admin -->
			<li class="dropdown">
			<a href="<?php echo Router::url('?home/profil/'); ?>">
				<?php
					if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']=='yes' && isset($_SESSION['membre']))
                        echo $_SESSION['membre']['mem_login'].'<strong style="color:red">(NEW)</strong>';
				?>
			</a>
			</li>
			<li class="dropdown">

			  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-home my-icon-sm"></i>
					<span class="caret"></span>
			  </a>
			  <?php
				$isses = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : 'no';
				echo '<ul class="dropdown-menu" role="menu">';

				if($isses == 'no'){
					echo '<li><a href="'.Router::url('?membre/login').'">Connexion</a></li>';
					echo '<li><a href="'.Router::url('?membre/suscribe/0/0').'">Inscription</a></li>';
					echo '<li class="disabled"><a>Deconnexion</a></li>';
					echo '<li class="disabled"><a>Ajouter un fichier</a></li>';
					echo '<li class="disabled"><a>Proposer un cours</a></li>';
					echo '<li class="divider"></li>';
				}
				else{
					echo '<li class="disabled"><a>Connexion</a></li>';
					echo '<li class="disabled"><a>Inscription</a></li>';
					echo '<li><a href="'.Router::url('?membre/logout').'">Deconnexion</a></li>';
					echo '<li><a href="'.constant('site_i_share_url').'">Ajouter un fichier</a></li>';
					echo '<li class="disabled"><a>Proposer un cours</a></li>';
					echo '<li class="divider"></li>';
				}
				echo '<li><a href="'.constant('site_i_facebook').'">Envoyer une alerte</a></li>';
				echo '</ul>';
			  ?>
			</li>
		  </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="myModal_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Gérer vos relations</h4>
      </div>
      <div class="modal-body">
      	
        <?php  
        if(!empty($tes_notifs_contact)){
        	echo "Ces personnes veulent entrer en contact avec vous. Vous avez le choix d'accepter ou de refuser leur demande. </br>";
        	foreach($tes_notifs_contact as $demandeur){
        		echo '<a href="'.Router::url('?membre/view/'.$demandeur['mem_id']).'" >'.$demandeur['mem_login']."</a>, ";
        		echo '<span class="divider"></span>';
        	}
        }
        else 
        	echo "Aucune demande de contact.";
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button> 
      </div>
    </div>
  </div>
</div>