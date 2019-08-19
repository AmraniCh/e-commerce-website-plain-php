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
		<title>Se connecter</title>
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


      if(isset($_POST['submit']) && isset($_POST['psd_email']) && isset($_POST['reponse']) && isset($_POST['question'])):
    
    
        $psd_email = filter_var($con->escape_string($_POST['psd_email']), FILTER_SANITIZE_STRING);
        $question = filter_var($con->escape_string($_POST['question']), FILTER_SANITIZE_STRING);
        $reponse = filter_var($con->escape_string($_POST['reponse']), FILTER_SANITIZE_STRING);
    
        $query = $con->query(" SELECT *
                              FROM client
                              WHERE ( clientUserName = '$psd_email' OR email = '$psd_email' )
                              AND questionSecurite = '$question'
                              AND reponseQuestion = '$reponse' ");
      
        if( $query->num_rows > 0 ):
          
          $row = $query->fetch_assoc();
          if(recupererMotdepasse($row['email'], $row['nom'])){
            
            $_SESSION['rec_clientID'] = $row['clientID'];
            $_SESSION['rec_clientUserName'] = $row['clientUserName'];
            $msg = '<small class="form-text text-muted email-rec-success">Veuillez vérifiez votre email pour terminer le processus de récupération de compte.</small>';
            
          }
          else
            $msg = '<small class="form-text text-muted email-rec-error">Une erreur à été produite essayez plus tard.</small>';
    
    
        else:
          
          $msg = '<small class="form-text text-muted email-rec-error">L\'identifiant ou reponse de sécurité est incorrect.</small>';
    
        endif;
    
        
    
      endif;
  
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
          <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
              <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6 col-xl-4 mx-auto">
               <form ection="" method="post">
                <div class="auto-form-wrapper">
                    <div class="form-group">
                     <label for="psd_email" class="label">Pseudo ou votre adresse e-mail : </label>
                      <div class="input-group">
                        <input id="psd_email" name="psd_email" type="text" class="form-control form-control-lg" placeholder="Pseudo ou adresse e-mail" style="border-right:1px solid #e5e5e5;font-size: 125%;height: inherit;">
                        <div id="codemail-ic-span" class="input-group-append">
                          <span class="input-group-text">
                            <i class="mdi mdi-account-circle"></i>
                          </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                     <label for="question" class="label">Question sécurité : </label>
                      <div class="input-group" style="padding-top:0px;margin-bottom:6.5%">
                        <select id="question" name="question" class="form-control">
                          <option value="Quel était le nom de votre premier animal ?">Quel était le nom de votre premier animal ?</option>
                          <option value="Qui était votre héros d'enfance ?">Qui était votre héros d'enfance ?</option>
                          <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
                          <option value="Quelle est votre équipe sportive favorite ?">Quelle est votre équipe sportive favorite ?</option>
                          <option value="Quelle est votre couleur préférée ?">Quelle est votre couleur préférée ?</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                     <label for="reponse" class="label">Réponse : </label>
                      <div class="input-group">
                        <input id="reponse" name="reponse" type="text" class="form-control form-control-lg" placeholder="Réponse" style="border-right:1px solid #e5e5e5;font-size: 125%;height: inherit;">
                      </div>
                    </div>
                    <div class="row">
                      <?php if(isset($msg)) echo $msg ?>
                    </div>
                    <div class="form-group text-center">
                      <button class="btn btn-primary submit-btn btn-block lg-rg-btn-primary" type="submit" name="submit" type="button">Récuperer mon compte</button>
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
      <script>


      </script>
  </body>
</html>

<?php
?>