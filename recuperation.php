<?php
    ob_start();
    require_once 'public-includes/config.php';
    require_once 'public-includes/PHPMAILER.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Se connecter</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link href="index/css/main.css" rel="stylesheet" />		
        <link href="index/css/mainstyle.css" rel="stylesheet" />		
        <link href="index/css/animation.css" rel="stylesheet" />		
        <link href="index/css/mdi/css/materialdesignicons.min.css" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]-->
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <script src="index/js/jquery.min.js"></script>
        <script src="index/js/functions.js"></script>
    </head>
  <body>
    <?php

  
  
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 mx-auto">
               <form ection="" method="post">
                <div class="auto-form-wrapper">
                   <div class="form-group" style="text-align:center">
                     <h4 style="font-weight:normal">Veuillez entrez votre email pour récuperer avoir récuperer votre compte</h4>
                     <div class="text-center"><img class="img-responsive" src="index/img/paper-plane.png" style="width:35%;display:inline"></div>
                   </div>
                    <div class="form-group" style="margin-bottom: 0!important;">
                      <div class="input-group">
                        <input id="email" name="email" type="email" class="form-control form-control-lg" placeholder="email" style="border-right:1px solid #e5e5e5;font-size: 125%;height: inherit;">
                        <div id="codemail-ic-span" class="input-group-append">
                          <span class="input-group-text">
                            @
                          </span>
                        </div>
                      
                      </div>
                    </div>
                    <div class="container">
                          <?php
                               if(isset($_POST['emailSbm']) && isset($_POST['email'])):
    
                                $email = filter_var($con->escape_string($_POST['email']), FILTER_SANITIZE_EMAIL);

                                $query = $con->query(" SELECT *
                                                    FROM client
                                                    WHERE email = '$email'");
                                $row = $query->fetch_assoc();
                                $nom = $row['nom'];

                                if( $query->num_rows > 0 ):

                                  $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                  $codeRec = "";

                                  for( $i = 0 ; $i < strlen($chars) ; $i++ )
                                  {
                                      $rand_index = rand(0, strlen($chars) - 1);
                                      $codeRec .= $chars[$rand_index];
                                  }

                                  $clientID = $row['clientID'];
                                  $query = $con->query(" UPDATE client 
                                                        SET codeRec = '$codeRec'
                                                        WHERE clientID = $clientID");

                                  if(recupererMotdepasse($email, $nom)){
                                      
                                    $_SESSION['rec_clientID'] = $row['clientID'];
                                    $_SESSION['rec_clientUserName'] = $row['clientUserName'];
                                      
                                    echo '<small class="form-text text-muted email-rec-success">Veuillez vérifiez votre email pour terminer le processus de récupération de compte.</small>';
                                  }
                                  else
                                    echo '<small class="form-text text-muted email-rec-error">Une erreur à été produite essayez plus tard.</small>';

                                else:

                                  echo '<small class="form-text text-muted email-rec-error">aucun compte enregistré avec cette adresse email.</small>';

                                endif;

                              endif;
                              
                              ?>
                        </div>
                    <div class="form-group text-center" style="margin-top:.5rem!important">
                      <button class="btn btn-primary submit-btn btn-block lg-rg-btn-primary" type="submit" name="emailSbm" type="button">Envoyer code</button>
                    </div>
                    <div class="form-group text-center">
                      <a class="rec-pass-link" href="recuperation-question-securite.php">Récuperation de compte avec question sécurité</a>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-block g-login msg-toggle" type="button">
                        <i class="mdi mdi-comment-question"></i>Je n'ai pas reçu le code !</button>
                    </div>
                </div>
                </form>
                <p class="footer-text text-center">copyright © 2019 M.G.A All rights reserved.</p>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
      <div class="overlay-msg-ctr">
        <div class="msg-ctr">
          <div class="msg-image">
            <img src="index/img/round-error-symbol.png"> 
          </div>
          <div class="msg-text-ctr">
            <span class="msg-text">
              Le message de confirmation parfois peut prendre un peu de temps. Si vous êtes sûr de ne pas avoir reçu de message, vous devrez peut-être essayer de récupérer votre compte par question sécurité : <a class="rec-pass-link" href="recuperation-question-securite.php">Récuperation de compte avec question sécurité</a>
            </span>
          </div>
          <div class="msg-close">
            <button type="button" class="msg-close-btn ovr-button-styles"><i class="mdi mdi-close-circle"></i></button>
          </div>
        </div>
      </div>
      <script>
      $(function(){
        $(".msg-toggle").click(function(){
          $(".overlay-msg-ctr").show();
        });
        
        $(".msg-close-btn").click(function(){
          $(".overlay-msg-ctr").hide();
        });
      });
      </script>
  </body>
</html>
<?php
  ob_end_flush();
?>