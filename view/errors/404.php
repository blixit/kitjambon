<div class="container">
    <div class="row-4">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                    <div class="jumbotron">
                    <h1>Oups</h1>
                     <div class="alert alert-warning alert-dismissible" role="alert">
                      <strong>Attention!</strong> La page que vous tentez d'afficher n'est pas disponible ou
                      n'existe plus. Si le lien provient de ce site,
                      <a href="mailto:<?php echo Conf::$mail['default']['mail'];?>" class="alert-link">merci de signaler le lien mort .</a>
                      <br/><br/>
                      <?php
                            if(!empty($message)){
                              if(!is_array($message)){
                                echo "<h4>Extra : </h4>";
                                echo '<li>'.$message.'</li>';
                              }
                              else{
                                echo "<h4>Extra : </h4>";
                                foreach ($message as $key => $value) {
                                  echo '<li>'.$value.'</li>';
                                }
                              }
                                    
                            }
                      ?>
                      </div>
                      <button type="button" class="btn btn-info pull-right"> <a href="<?php echo Router::url(isset($caller) ? $caller : '?accueil/');?>">Retour à l'accueil </a></button>

                    </div>
            </div>
    </div>

</div>


