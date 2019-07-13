<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>


<?php
$result =  mysqli_query($con,"SELECT * FROM client WHERE clientID = '".$_SESSION['clientID']."'");
if(mysqli_num_rows($result)>0) {
    $row = mysqli_fetch_assoc($result);
    $clientUserName = $row['clientUserName'];
    $prenom = $row['prenom'];
    $nom = $row['nom'];
    $adresse = $row['adresse'];
    $ville = $row['ville'];
    $codePostal = $row['codePostal'];
    $telephone = $row['telephone'];

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
    ?>



			<!-- BREADCRUMB -->
			<div id="breadcrumb" class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12">
							<h3 class="breadcrumb-header">Accueil</h3>
							<ul class="breadcrumb-tree">
								<li class="active"><a href="#">/ Mon profile</a></li>
							</ul>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /BREADCRUMB -->

			<!-- SECTION -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<div class="col-sm-12 col-md-6">
						<div class="profile-details">
							<div class="section-title">
								<h3 class="title">Profile</h3>
							</div>
							<div class="form-group">
								<input class="form-control" id="username" type="text" name="username" placeholder="Pseudo" disabled value="<?php echo $clientUserName?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="prenom" type="text" name="prenom" placeholder="Prenom" value="<?php echo $prenom?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="email" type="email" name="email" placeholder="Nom" value="<?php echo $nom?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="adresse" type="text" name="addresse" placeholder="Address" value="<?php echo $adresse?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="ville" type="text" name="city" placeholder="Ville" value="<?php echo $ville?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="codePostal" type="text" name="codePostal" placeholder="Code Postal" value="<?php echo $codePostal?>">
							</div>
							<div class="form-group">
								<input class="form-control" id="tele" type="tel" name="tel" placeholder="Telephone" value="<?php echo $telephone?>">
							</div>
							<div class="form-group">
								<lablel for="question" class="inline-label">Question sécurité :</lablel>
								<select name="question" id="question" class="form-control">
                                    <option value="Quel était le nom de votre premier animal ?" <?php echo $question1?>>Quel était le nom de votre premier animal ?</option>
                                    <option value="Qui était votre héros d'enfance ?" <?php echo $question2?>>Qui était votre héros d'enfance ?</option>
                                    <option value="Quelle était le nom de votre école primaire ?" <?php echo $question3?>>Quelle était le nom de votre école primaire ?</option>
                                    <option value="Quelle est votre équipe sportive favorite ?" <?php echo $question4?>>Quelle est votre équipe sportive favorite ?</option>
                                    <option value="Quelle est votre couleur préférée ?" <?php echo $question5?>>Quelle est votre couleur préférée ?</option>
								</select>
							</div>
							<div class="form-group">
								<input class="form-control" id="reponse" tele type="tel" name="reponse" placeholder="Réponse" value="<?php echo $reponseQuestion?>">
							</div>
						</div>

						<div class="changement-motdepasse">
							<div class="section-title">
								<h3 class="title">Changement de mot de passse</h3>
							</div>
							<div class="form-group">
								<input class="form-control" id="motdepasse" type="password" name="motdepasse" placeholder="Mot de passe">
							</div>	
						</div>
					</div>

					<div class="col-sm-12 col-md-6 client-statistiques" style="display:none;">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<div class="order-col">
									<div>1x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
								<div class="order-col">
									<div>2x Product Name Goes Here</div>
									<div>$980.00</div>
								</div>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Place order</a>
					</div>
						
					<div class="col-12" style="clear:both">
						<div class="form-group text-center">
							<button class="btn" type="button" name="btnModifier" id="btnModifier" style="background-color:#d10024;padding:10px;color:#fff">Modifier Compte</button>
						</div>
					</div>
				</div>
				<!-- /container -->
			</div>
			<!-- /SECTION -->

		<?php include_once "includes/newsletter.php" ?>
		
		<?php include_once "includes/loading.html" ?>
		
		<?php include_once "includes/footer.php" ?>