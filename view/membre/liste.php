<div class="container"> 
	<div class="panel">
	<table class="table table-striped table-condensed table-hover col-xs-12" border="0" cellspacing="0" cellpadding="10" bordercolor="gray" >
	<thead>
		<th colspan="2"><h2 class="form-signin-heading">Liste des utilisateurs <?php echo '('.$nbUsers.')'; ?> </h2></th> 
		<th colspan="3"><span class="pull-right"><a href="<?php echo Router::url('?membre/liste/1/1'); ?>">Ei1</a>
			|<a href="<?php echo Router::url('?membre/liste/1/2'); ?>">Ei2</a>
			|<a href="<?php echo Router::url('?membre/liste/1/3'); ?>">Ei3</a></span>
		</th>
	</thead>
	<tbody>
	<tr><th class="centered " >Pseudo</th> 
		<td class="">Année</td> 
		<td class="">Son kiffe!</td>
		<td class="">Temperament</td>
		<td class="">Date d'inscription</td>
	</tr> 
	
	<?php foreach($users as $user) : ?>
	<tr><th class="centered col-xs-4" ><a href="<?php echo Router::url('?membre/view/'.$user['mem_id']);?>"><?php echo $user['mem_login']; ?></a></th> 
		<td class="">Ei<?php echo $user['mem_year']; ?></td>
		<td class=""><?php echo $user['mem_ue']; ?></td>
		<td class=""><?php echo $user['temperament']; ?></td>
		<td class=""><?php echo $user['mem_date_joined']; ?></td>
	</tr> 
	<?php endforeach; ?> 
	</tbody>
	</table>
	</div>
	<?php if($nbPages>1): ?> 
		<ul class="pagination">
			
			<?php var_dump($pageActive);
			if($pageActive > 1)
				echo '<li><a href="'.Router::url('?membre/liste/1/'.$yearRestriction).'"> Début </a></li>';
			for($i=$pageActive-$MAX_USERS_PER_PAGE;$i<=$pageActive+$MAX_USERS_PER_PAGE; $i++) {
				if($i>0 && $i<=$nbPages)
				echo '<li '.($i==$pageActive ? 'class="active"':'').'>
					<a href="'.Router::url('?membre/liste/'.$i.'/'.$yearRestriction).'">'.$i.'<span '.($i==$pageActive ? 'class="sr-only"':'').'></span>
					</a></li>';
			} 
			if($pageActive < $nbPages)
				echo '<li><a href="'.Router::url('?membre/liste/'.$nbPages.'/'.$yearRestriction).'"> Fin </a></li>'; 
			?>
		</ul>
	<?php endif;?>
</div>