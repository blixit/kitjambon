<?php
	$NEW_BASE_URL = str_replace('/','',BASE_URL).DS; //on retire le 1er '/' de base_url
	//dans le 2e paramètres les / deviendront des \/  donc remplacer \/ par /
	//Router::connect('\?membre/login','\?membre/login'); 
	Router::connect(
		'\?download/view/:age/:eix/:ue/:dir',
		'\?download/view/age:([a|n|A|N])/eix:([a-zA-Z0-9]+)/ue:([a-zA-Z]+)/dir:([a-zA-Z0-9\ \-\.\~]+)');
	Router::connect(
		'\?download/view/:age/:eix/:ue',
		'\?download/view/age:([a|n|A|N])/eix:([a-zA-Z0-9]+)/ue:([a-zA-Z]+)/?'); 
	Router::connect(
		'ajax/send/:param',
		'ajax/send/param:(.*)/?');


	// echo Router::url(BASE_URL.'/download/view/age:n/eix:'.$_GET['eix'].'/ue:'.$_GET['ue'].'/dir:ta/2013-2014/capture.jpg');
	// echo Router::url('download/view/age:'.$_GET['age'].'/eix:'.$_GET['eix'].'/ue:'.$_GET['ue'].'/dir:ta/2013-2014/capture.jpg');
	// echo '</br>';
?>
