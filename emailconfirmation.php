<?php
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
		<title>Confirmation adresse email</title>
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
    
        if(!isset($_SESSION['clientUserName']) && empty($_SESSION['clientUserName'])):
          
          header("Location: errors/400.php");
          exit();
    
        endif;
      
      
        $username = $_SESSION['clientUserName'];
        
        $sql = "select * from client where clientUserName='$username'";
        $result = $con->query($sql);
      
        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $code = $row["codeEmail"];
            $clientID = $row["clientID"];
            $clientUserName = $row["clientUserName"];
          }
        }
      
        if(isset($_POST['submitCfr'])){
            if ($con->escape_string($_POST['codemail']) == $code){
                $sql = "UPDATE client SET emailValid = 1 where clientUserName = '$username'";
                $con->query($sql);
                $_SESSION['clientID'] = $clientID;
                $_SESSION['clientUserName'] = $clientUserName;
                header ('location: index/profile.php');
            }
            else
                echo "<script>$(document).ready(function(){ emailCodeIncorrect() })</script>";
        }
      
        if(isset($_POST['submitPsm'])){
          
          $_SESSION['clientID'] = $clientID;
          $_SESSION['clientUserName'] = $clientUserName;
          header ('Location: index/profile.php');
          
        }
  
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 mx-auto">
               <form id="email-conf-form" action="emailconfirmation.php" method="post">
                <div class="auto-form-wrapper">
                   <div class="form-group" style="text-align:center">
                     <h4 style="font-weight:normal">S'il vous plaît entrer le code que vous avez reçu par e-mail</h4>
                     <div class="text-center"><img class="img-responsive" src="index/img/paper-plane.png" style="width:35%;display:inline"></div>
                   </div>
                    <div class="form-group" style="margin-bottom: 0!important;">
                      <div class="input-group">
                        <input id="codemail" name="codemail" type="text" class="form-control form-control-lg" placeholder="######" style="border-right:1px solid #e5e5e5;font-size: 125%;height: inherit;">
                        <div id="codemail-ic-span" class="input-group-append">
                          <span class="input-group-text">
                            <i id="codemail-ic-i" class="mdi mdi-check-circle-outline"></i>
                          </span>
                        </div>
                        <div class="container" style="padding:0;text-align:left;margin:0;">
                            <small id="codemail_error" class="form-text text-muted text-error">*</small>
                        </div>
                      </div>
                    </div>
                    <div class="form-group text-center" style="margin-top:1.8rem!important">
                      <input type="submit" name="submitCfr" value="Confirmer mon email" class="btn btn-dark-red submit-btn btn-block">
                      <button class="btn btn-primary submit-btn btn-block lg-rg-btn-primary" type="submit" name="submitPsm">Pas maintenant</button>
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
      <script src="index/js/validation.js"></script>
      <div class="overlay-msg-ctr">
        <div class="msg-ctr">
          <div class="msg-image">
            <img src="index/img/round-error-symbol.png"> 
          </div>
          <div class="msg-text-ctr">
            <span class="msg-text">
              Le message de confirmation parfois peut prendre un peu de temps. Si vous êtes sûr de ne pas avoir reçu de message, vous devrez peut-être essayez plus tard.
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