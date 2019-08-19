<?php
    require_once 'public-includes/config.php';
    session_start();
    unset($_SESSION['clientID']);
    unset($_SESSION['clientUserName']);
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Se connecter</title>
        <link href="index/css/main.css" rel="stylesheet" />		
        <link href="index/css/mainstyle.css" rel="stylesheet" />		
        <link href="index/css/mdi/css/materialdesignicons.min.css" rel="stylesheet" />
   	    <script src="index/js/jquery.min.js"></script>
   	    <noscript>
   	      <span class="no-javascript-text">veuillez activer javascript</span>
   	      <style>
/*
            .container-scroller{
              display: none;
            }
*/
          </style>
   	      
   	    </noscript>
    </head>
  <body>
  <?php
    
      if(isset($_POST['recSbm'])):
    
        header("Location: recuperation.php");
        exit();
      
      endif;
        
    
      // login
      if(isset($_POST['submit']) && isset($_POST['username-lg']) && isset($_POST['password-lg']))
      {
        
          $clientUserName = filter_var($con->escape_string($_POST['username-lg']), FILTER_SANITIZE_STRING);
          $motdepass = filter_var($con->escape_string($_POST['password-lg']), FILTER_SANITIZE_STRING);
          
          $query = $con->query(" SELECT * 
                            FROM client 
                            WHERE clientUserName = '$clientUserName' ");
        
          if( $query->num_rows >0 ):
        
              $row = $query->fetch_assoc();
        
              if(password_verify($motdepass, $row['motdepasse'])):
        
                $_SESSION['clientUserName'] = $row['clientUserName'];
                $_SESSION['clientID'] = $row['clientID'];
        
                header ('location: index/index.php');
                exit();
        
              else:
        
                echo '<script>$(document).ready(function(){ compteIntrouvable() });</script>';
        
              endif;
        
          endif;
      }
    ?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 mx-auto">
            <div class="auto-form-wrapper">
              <form id="login-form" method="post">
                <div class="form-group" style="margin-bottom: 0!important;">
                  <label for="username-lg" class="label">Nom d'utilisateur :</label>
                  <div class="input-group">
                    <input id="username-lg" name="username-lg" type="text" class="form-control" placeholder="Nom d'utilisateur" value="<?php if(isset($_SESSION['rec_clientUserName']) && isset($_GET['rec'])) echo $_SESSION['rec_clientUserName'] ?>" style="border-right:1px solid #e5e5e5">
                    <div id="username-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="username-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="username_error" class="form-text text-error">*</small>
                    </div>
                  </div>
                </div>
                <div id="fx-firefox-mg" class="form-group" style="margin-bottom: 0!important;">
                  <label for="password-lg" class="label">Mot de passe</label>
                  <div class="input-group">
                    <input id="password-lg" name="password-lg" type="password" class="form-control" placeholder="*********" style="border-right:1px solid #e5e5e5" value="<?php if(isset($_SESSION['rec_motdepasse']) && isset($_GET['rec'])) echo $_SESSION['rec_motdepasse'] ?>">
                    <div id="password-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="password-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="password_error" class="form-text text-error">*</small>
                    </div>
                  </div>
                </div>
                <div class="form-group text-center" style="margin-top:1.8rem!important">
                  <input type="submit" name="submit" value="Se connecter" class="btn btn-dark-red submit-btn btn-block">
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" checked="checked"> Gardez moi connecté
                      <span class="checkmark"></span>
                    </label>
                  </div>
                </div>
              </form>
                <div class="form-group">
                 <form action="" method="post">
                  <button class="btn btn-block g-login" type="submit" name="recSbm">
                    <i class="mdi mdi-lock-open-outline"></i>J'ai oublié mon mot de passe !
                  </button>
                  </form>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Pas un membre ?</span>
                  <a href="register.php" class="text-black text-small">Créer un nouveau compte</a>
              </div>
            </div>
            <p class="footer-text text-center">copyright © 2019 M.G.A All rights reserved.</p>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
        <script src="index/js/functions.js"></script>
        <script src="index/js/validation.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]-->
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<!-- [endif]-->
  </body>
</html>