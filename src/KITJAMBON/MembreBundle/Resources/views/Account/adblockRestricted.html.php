<!-- #KITJAMBON/MembreBundle/Resources/views/Account/adblockRestricted.html.php -->
<?php 
	$view->extend('::base.html.php');
	$view['slots']->set('pageDeRestrictionAdblock', true);
	//$pageDeRestrictionAdblock = true;
 ?>

<div class="container">
	<div class="alert alert-danger">
		
		<h3><span class="fa fa-medkit"> </span> Restriction Adblock</h3>
		<p>
			La publicité nous permet de financer en partie l'hébergement de la palateforme.<br/>
			Désactiver une publicité inoffensive contribue à réduire notre marche de manoeuvre.<br/>
			Merci de bien vouloir désactiver Adblock pour une meilleure navigation.</p>
	</div>
</div>