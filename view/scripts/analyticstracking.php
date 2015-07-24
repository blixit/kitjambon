
<script type="text/javascript">  

	 
  var customUserId = <?php echo (!empty($_SESSION['membre']) ? "'user_".$_SESSION['membre']['mem_token']."'" : "'unregistered'"); ?>;
 
 // Standard Google Universal Analytics code
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56545891-1', {'userId': customUserId});   // If "User ID" feature is available
  ga('require', 'displayfeatures');
  ga('set', 'dimension1', customUserId);                   // Set a `customUserId` dimension at page level
  ga('set', '&uid', customUserId);
  ga('send', 'pageview');


  /*var dimensionValue = 'SOME_DIMENSION_VALUE';
ga('set', 'dimension1', dimensionValue);

  ga('create', 'UA-56545891-1', 'auto');
  ga('set', '&uid', <?php echo (!empty($_SESSION['membre']) ? "user_".$_SESSION['membre']['mem_token'] : "unregistered"); ?>); 
  // Définir l'ID utilisateur à partir du paramètre user_id de l'utilisateur connecté.

  ga('send', 'pageview');*/
</script>