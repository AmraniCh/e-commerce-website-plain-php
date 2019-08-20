<?php include_once "includes/header.php" ?>
<?php require_once 'includes/PHPMAILER_EMAIL_CONFIRMATION.php' ?>
    
		<?php include_once "includes/navigation.php" ?>


<?php
    
    if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID'])):
        header('Location: ../login.php');
        exit();
    endif;
    
    
    $result =  mysqli_query($con,"SELECT * FROM client WHERE clientID = '".$_SESSION['clientID']."'");
    if(mysqli_num_rows($result)>0) {
        $row = mysqli_fetch_assoc($result);
        $clientUserName = $row['clientUserName'];
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $email = $row['email'];
        $adresse = $row['adresse'];
        $ville = $row['ville'];
        $codePostal = $row['codePostal'];
        $telephone = $row['telephone'];
        $emailValid = $row['emailValid'];

        $question1='';
        $question2='';
        $question3='';
        $question4='';
        $question5='';

        $questionSecurite = $row['questionSecurite'];
        if ($questionSecurite=='Quel était le nom de votre premier animal ?'){
            $question1 = 'selected="selected"';
        }
        if ($questionSecurite=='Qui était votre héros d\'enfance ?'){
            $question2 = 'selected="selected"';
        }
        if ($questionSecurite=='Quelle était le nom de votre école primaire ?'){
            $question3 = 'selected="selected"';
        }
        if ($questionSecurite=='Quelle est votre équipe sportive favorite ?'){
            $question4 = 'selected="selected"';
        }
        if ($questionSecurite=='Quelle est votre couleur préférée ?'){
            $question5 = 'selected="selected"';
        }

        $reponseQuestion = $row['reponseQuestion'];
    }

    if(isset($_POST['submit'])):

        if(sendEmail($email, $nom)):
            header ('location: ../emailconfirmation.php');
            exit();
        else:
            $erreur = "Une erreur à été produite essayez plus tard.";
        endif;


    endif;

?>



			<div id="breadcrumb" class="section">
				
				<div class="container">
					
					<div class="row">
						<div class="col-md-12">
							<h3 class="breadcrumb-header"><a href="index.php">Accueil</a></h3>
							<ul class="breadcrumb-tree">
								<li class="active"><a href="#">/ Mon profile</a></li>
							</ul>
						</div>
					</div>
					
				</div>
				
			</div>
			

			
			<div class="section">
				
				<div class="container">
                        <div class="profile-details">
                            <div class="section-title">
                                <h3 class="title"><i class="fa fa-user-circle"></i> Profile</h3>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="username">Pseudo :</label>
                                    <input class="form-control" id="username" type="text" name="username" placeholder="Pseudo" disabled="disabled" value="<?php echo $clientUserName?>">
                                </div>
                                <div class="form-group">
                                    <label for="prenom">Prénom :</label>
                                    <input class="form-control" id="prenom" type="text" name="prenom" placeholder="Prenom" value="<?php echo $prenom?>">
                                </div>
                                <div class="form-group">
                                    <label for="nom">Nom :</label>
                                    <input class="form-control" id="nom" type="text" name="nom" placeholder="Nom" value="<?php echo $nom ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Adresse e-mail" value="<?php echo $email?>">
                                </div>
							</div>
							<div class="col-sm-6">
                               <div class="form-group">
                                    <label for="adresse">Adresse :</label>
                                    <input class="form-control" id="adresse" type="text" name="addresse" placeholder="Address" value="<?php echo $adresse?>">
                                </div>
                                <div class="form-group">
                                    <label for="ville">Ville :</label>
                                    <input class="form-control" id="ville" type="text" name="city" placeholder="Ville" value="<?php echo $ville?>">
                                </div>
                                <div class="form-group">
                                    <label for="code_postal">Code Postal :</label>
                                    <input class="form-control" id="code_postal" type="text" name="codePostal" placeholder="Code Postal" value="<?php echo $codePostal?>">
                                </div>
                                <div class="form-group">
                                    <label for="tele">Téléphone :</label>
                                    <input class="form-control" id="tele" type="tel" name="tel" placeholder="Telephone" value="<?php echo $telephone?>">
                                </div>
                            </div>
						</div>

						<div class="profile-securite col-12">
							<div class="section-title">
								<h3 class="title"><i class="fa fa-unlock-alt"></i> Sécurité</h3>
							</div>
							<div class="col-12">
                               <div class="form-group">
                                   <div class="email-verif-status">
                                       <form action="" method="post">
                                        <?php 
                                            if($emailValid == 0):

                                                echo '<div class="email-status-failed">email pas valide</div>';
                                                echo '<button type="submit" name="submit" class="ovr-button-styles btn-verifie-email">Vérifier mon email</button>';

                                            else:

                                                echo '<div class="email-status-success">email valide</div>';

                                            endif;
                                       ?>
                                       </form>
                                       <?php if(isset($erreur)) echo $erreur ?>
                                   </div>
                                </div>
                                <div class="form-group">
                                    <label for="question">Question sécurité :</label>
                                    <select name="question" id="question" class="input-smp">
                                        <option value="Quel était le nom de votre premier animal ?" <?php echo $question1?>>Quel était le nom de votre premier animal ?</option>
                                        <option value="Qui était votre héros d'enfance ?" <?php echo $question2?>>Qui était votre héros d'enfance ?</option>
                                        <option value="Quelle était le nom de votre école primaire ?" <?php echo $question3?>>Quelle était le nom de votre école primaire ?</option>
                                        <option value="Quelle est votre équipe sportive favorite ?" <?php echo $question4?>>Quelle est votre équipe sportive favorite ?</option>
                                        <option value="Quelle est votre couleur préférée ?" <?php echo $question5?>>Quelle est votre couleur préférée ?</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="reponse" tele type="tel" name="reponse" placeholder="Réponse de question sécurié" value="<?php echo $reponseQuestion?>">
                                </div>
                                <div class="form-group">
                                    <label for="motdepasse">Nouveau mot de passe :</label>
                                    <input class="form-control" id="motdepasse" type="password" name="motdepasse" placeholder="Mot de passe" value="">
                                </div>
                                <div class="form-group">
                                    <label for="cnfPasse">Confirmé nouveau mot de passe :</label>
                                    <input class="form-control" id="cnfPasse" type="password" name="motdepasse" placeholder="Confirmé Mot de passe" value="">
                                </div>
                                <div class="profile-valid-msg">
                                    <span id="validMsg" class=""></span>
                                </div>
                            </div>	
					    </div>
                       
                        <div class="profile-btns col-12">
                            <div class="form-group text-center">
                                <button class="btn" type="button" name="btnModifier" id="btnModifier" style="background-color:#d10024;padding:10px;color:#fff">Modifier Compte</button>
                            </div>
                        </div>
				</div>
			</div>
			
        <script>
            
            $("#btnModifier").click(function(){

                if(ValidationProfile() != false){
                    
                    $.ajax({
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: { 
                            function: "MDFProfile",
                            prenom: $("#prenom").val(),
                            nom: $("#nom").val(),
                            email: $("#email").val(),
                            adresse: $("#adresse").val(),
                            ville: $("#ville").val(),
                            postal: $("#code_postal").val(),
                            tele: $("#tele").val(),
                            question: $("#question option:selected").val(),
                            reponse: $("#reponse").val(),
                            passe: $("#cnfPasse").val()
                        },
                        beforeSend: function(data){
                            $('#overlayAjaxLoading').show();
                        },
                        success: function(data){
                            if(data != null){
                                $(".email-verif-status").load(" .email-verif-status");
                                $("#validMsg").removeClass("valid-msg-error").addClass("valid-msg-success");
                                $("#validMsg").text("Profil modifié avec succès.");
                            }
                            if(data == -1){
                                $("#validMsg").removeClass("valid-msg-success").addClass("valid-msg-error");
                                $("#validMsg").text("L'adresse e-mail est déja utilisé. Essayez au autre.");
                            }
                        },
                        complete: function(){
                            setTimeout(function(){
                                $('#overlayAjaxLoading').hide();
                            }, 300);
                        }
                    });
                }
            });
            
        </script>

		<?php include_once "includes/newsletter.php" ?>

		<?php include_once "includes/footer.php" ?>