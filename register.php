<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Se connecter</title>
		<!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
        <link href="css/main.css" rel="stylesheet" />		
        <link href="css/mainstyle.css" rel="stylesheet" />		
        <link href="css/mdi/css/materialdesignicons.min.css" rel="stylesheet" />
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
  <body>
  <?php
    
			if(isset($_POST['submit']))
			{
                header('location: login.php');
			}
    
    ?>
    <!-- SECTION -->
		<div class="section" style="padding: 2rem 0rem;width: 100%;-webkit-flex-grow: 1;flex-grow: 1;">
			<!-- container -->
        <div class="register-full-container">
      <div class="row w-100">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-8 mx-auto">
           <form id="register-form" action="register.php" method="post">
            <div class="auto-form-wrapper" style="border-radius:30px;">
            <h2 class="text-center mb-4">Creér un compte maintenant</h2>
            <div class="flex-container" style="overflow: hidden">
            <div class="left-container col-xs-12 mx-auto">
                 <div class="form-group">
                  <div class="input-group">
                    <input id="username"type="text" class="form-control" placeholder="Nom d'ultilisateur"/>
                    <div id="username-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="username-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                     <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="username_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="email" type="text" class="form-control" placeholder="Adresse email" />
                    <div id="email-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="email-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="email_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="prenom"type="text" class="form-control" placeholder="Prenom"/>
                    <div id="prenom-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="prenom-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="prenom_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="nom" type="text" class="form-control" placeholder="Nom"/>
                    <div id="nom-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="nom-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="nom_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
                <div class="form-group">
                   <div class="input-group" style="padding-top:4px;margin-bottom:6.5%">
                    <select id="pays" class="form-control">
                        <option>casa</option>
                        <option>tanger</option>
                        <option>rabat</option>
                    </select>
                    </div>
                  </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="adresse" type="text" class="form-control" placeholder="Adresse"/>
                    <div id="adresse-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="adresse-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="adresse_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
              </div>
             <div class="right-container col-xs-12 mx-auto">
               <div class="form-group">
                <div class="input-group">
                    <input id="tele" type="text" class="form-control" placeholder="Telephone"/>
                    <div id="tele-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="tele-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="tele_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
               </div>
                <div class="form-group">
                  <div class="input-group">
                    <input id="code_postal" type="text" class="form-control" placeholder="Code postal"/>
                    <div id="postal-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="postal-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="code_postal_error" class="form-text text-muted">*</small>
                      </div>
                  </div>
               </div>
              <div class="form-group">
                   <div class="input-group" style="padding-top:0px;margin-bottom:6.5%">
                    <select id="question" class="form-control">
                        <option value="Quel était le nom de votre premier animal ?">Quel était le nom de votre premier animal ?</option>
                        <option value="Qui était votre héros d'enfance ?">Qui était votre héros d'enfance ?</option>
                        <option value="Quelle était le nom de votre école primaire ?">Quelle était le nom de votre école primaire ?</option>
                        <option value="Quelle est votre équipe sportive favorite ?">Quelle est votre équipe sportive favorite ?</option>
                        <option value="Quelle est votre couleur préférée ?">Quelle est votre couleur préférée ?</option>
                    </select>
                    </div>
                  </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="reponse" type="text" class="form-control" placeholder="Reponse"/>
                    <div id="reponse-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="reponse-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="reponse_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
               </div>
                  <div class="form-group">
                  <div class="input-group">
                    <input id="password" type="password" class="form-control" placeholder="Mot de passe"/>
                    <div id="password-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="password-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="password_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
               </div>
                 <div class="form-group">
                  <div class="input-group">
                    <input id="password2" type="password" class="form-control" placeholder="Confirmer mot de passe" />
                    <div id="password2-ic-span" class="input-group-append">
                      <span class="input-group-text">
                        <i id="password2-ic-i" class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                    <div class="container" style="padding:0;text-align:left;margin:0;">
                        <small id="password2_error" class="form-text text-muted">*</small>
                    </div>
                  </div>
              </div>
              </div>
              <div class="bottom-container col-xs-12 text-center" style="display:inline-block;width:100%!important">
                    <div class="form-group">
                      <input type="submit" name="submit" value="Register" class="btn btn-primary submit-btn btn-block" style="width:30%;margin-top:2%">
                    </div>
                    <div class="text-block text-center my-3">
                      <span class="text-small font-weight-semibold">
                 
                        Tu as déja un compte ?</span>
                      <a href="login.php" class="text-black text-small">Se coonecter</a>
                    </div>
            </div>
              </div>
              
            </div>
            </form>
        </div>      
          </div>
        </div>
          </div>
    <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/functions.js"></script>
        <script src="js/validation.js"></script>

  </body>
</html>