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
		<title>Réinitialidation de mot de passe</title>
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link href="index/css/main.css" rel="stylesheet" />		
        <link href="index/css/mainstyle.css" rel="stylesheet" />		
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
    
      if(!isset($_SESSION['rec_clientID']) && empty($_SESSION['rec_clientID'])):
    
        header("Location: errors/400.php");
        exit();
    
      endif;
        
    

      if(!isset($_GET['code']) && empty($_GET['code'])):

        header("Location: errors/400.php");
        exit();
              
      else:
    
        $codeRec = filter_var($con->escape_string($_GET['code']), FILTER_SANITIZE_STRING);
    
        $clientID = filter_var($_SESSION['rec_clientID'], FILTER_SANITIZE_NUMBER_INT);
    
        $query = $con->query(" SELECT codeRec 
                              FROM client
                              WHERE clientID = $clientID");
        $row = $query->fetch_row();
    
        if($codeRec !== $row[0]):
          header("Location: errors/400.php");
          exit();
        endif;
    
      endif;
    
      if(isset($_POST['submit'])):
    
        $motdepasse = filter_var($con->escape_string($_POST['password']), FILTER_SANITIZE_STRING);
        $confirmer_passe = filter_var($con->escape_string($_POST['password2']), FILTER_SANITIZE_STRING);
    
        if($motdepasse === $confirmer_passe):
    
          $clientID = filter_var($_SESSION['rec_clientID'], FILTER_SANITIZE_NUMBER_INT);
          $_motdepasse = password_hash($motdepasse, PASSWORD_DEFAULT, array('cost' => 10));
    
          $query = $con->query(" UPDATE client
                                SET motdepasse = '$_motdepasse'
                                WHERE clientID = $clientID");
    
          if( $con->affected_rows > 0 ):
    
            $_SESSION['rec_motdepasse'] = $confirmer_passe;
    
            $con->query(" UPDATE client
                                SET codeRec = NULL
                                WHERE clientID = $clientID"); 
    
            header("Location: login.php?rec=true");
            exit();
    
          endif;
    
    
        endif;
          
      endif;
  
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="rein-password-ctr col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 mx-auto">
               <form ection="" method="post">
                <div class="auto-form-wrapper">
                   <div class="form-group" style="text-align:center">
                     <h4 style="font-weight:normal">Veuillez entrez votre email pour récuperer vote mot de passe</h4>
                     <div class="text-center"><img class="img-responsive" src="index/img/paper-plane.png" style="width:35%;display:inline"></div>
                   </div>
                    <div class="form-group">
                     <label for="motdepasse" class="label">Mot de passe</label>
                      <div class="input-group">
                        <input id="password" name="password" type="password" class="form-control" placeholder="mot de passe">
                        <div id="password-ic-span" class="input-group-append">
                          <span class="input-group-text">
                            <i id="password-ic-i" class="mdi mdi-check-circle-outline"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <small id="password_error" class="form-text text-muted text-error"></small>
                    </div>
                    <div class="form-group">
                     <label for="motdepasse" class="label">Confirmer mot de passe</label>
                      <div class="input-group">
                        <input id="password2" name="password2" type="password" class="form-control" placeholder="Confirmer mot de passe" />
                        <div id="password2-ic-span" class="input-group-append">
                          <span class="input-group-text">
                            <i id="password2-ic-i" class="mdi mdi-check-circle-outline"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <small id="password2_error" class="form-text text-muted text-error">*</small>
                    </div>
                    <div class="form-group text-center">
                      <button class="btn btn-primary submit-btn btn-block lg-rg-btn-primary" type="submit" name="submit" type="button">Changer mon mot de passe</button>
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
  </body>
</html>
<?php
  ob_end_flush();
?>