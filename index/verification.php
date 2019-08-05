<?php include_once "includes/panierheader.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID']) || !isset($_SESSION['modelivraison']) || !isset($_SESSION['totalApayer'])):

				header('Location: ../errors/400.php');
				exit();
			
			else:

				$client = new Client();
				$panierID = $client->PanierClient();
				$session_panierID = filter_var($_SESSION['panier'], FILTER_SANITIZE_NUMBER_INT);

				if($panierID != $session_panierID):
					header('Location: ../errors/400.php');
					exit();				
				endif;
			
			endif;	

			if(isset($_POST['rtn'])):

				header('Location: modelivraison.php');
				exit();

			endif;


			$client = new Client();
			$query = $client->InfoClient();

			if($query != null):
				
				while($row = $query->fetch_assoc()){
					
					$nom = $row['nom'];
					$prenom = $row['prenom'];
					$ville = $row['ville'];
					$adresse = $row['adresse'];
					$tele = $row['telephone'];
					$code_postal = $row['codePostal'];
				}
				
				$total_a_payer = filter_var($_SESSION['totalApayer'], FILTER_SANITIZE_NUMBER_INT);
				
				$nbr_articles = $client->NbrArticlesPanier();
					

			endif;
				

			
		?>
		
		
		<div id="breadcrumb" class="section">
				
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header"><a href="index.php">Accueil</a></h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a href="panier.php">/ Mon Panier</a></li>
							<li class="active"><a href="modelivraison.php">Type Livraison</a></li>
							<li class="active"><a>Confirmation</a></li>
						</ul>
					</div>
				</div>

			</div>
				
		</div>
		

		<div class="section verif-info-section">
			<div class="container">
				<form action="" method="post">
					<div class="div-verif-info-ctr">
						<div class="row div-verif-info">			
							<div class="hdr-verif-info">
								<span class="title-verif-info">
									<p>Confirmation des information du commande</p>
								
								<div class="img-verif-info-ctr">
									<img class="img-verif-info" src="img/confirm.png">
								</div>
							</div>
							<div class="body-verif-info">
								<div class="astuce-verif-info">
									<p>S'il vous plaît vérifier vos informations de contact avant d'envoyer la demande</p>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Nom : </label>
									<input class="form-control" id="nom" type="text" name="nom" placeholder="nom" value="<?php echo $nom?>">
									<div class="container text-error-ctr">
                            			<small id="erreurNom" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Prenom : </label>
									<input class="form-control" id="prenom" type="text" name="prenom" placeholder="Prenom" value="<?php echo $prenom?>">
									<div class="container text-error-ctr">
                            			<small id="erreurPrenom" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Ville : </label>
									<input class="form-control" id="ville" type="text" name="ville" placeholder="Ville" value="<?php echo $ville?>">
									<div class="container text-error-ctr">
                            			<small id="erreurVille" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Adresse : </label>
									<input class="form-control" id="adresse" type="text" name="adresse" placeholder="Adresse" value="<?php echo $adresse?>">
									<div class="container text-error-ctr">
                            			<small id="erreurAdresse" class="form-text text-muted erreur-info"></small>
									</div>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Téléphone : </label>
									<input class="form-control" id="tele" type="text" name="tele" placeholder="Téléphone" value="<?php echo $tele?>">
									<div class="container text-error-ctr">
                            			<small id="erreurNumTele" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<label class="label-verif-info">Code Postal : </label>
									<input class="form-control" id="codePostal" type="text" name="codePostal" placeholder="Code postal" value="<?php echo $code_postal?>">
									<div class="container text-error-ctr">
                            			<small id="erreurCodePostal" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="verif-info-panier-details-ctr">
									<div class="verif-info-panier-details">Total d'articles demandées : <span id="nbrArticle"><?php echo $nbr_articles ?></span></div>
									<div class="verif-info-panier-details">Total à payer : <span id="totalPayer" class="price-produit"><?php echo $total_a_payer ?> DHS</span></div>
								</div>
								<div class="container text-error-ctr">
                            		<small id="erreurInfo" class="form-text text-muted erreur-info"></small>
                        		</div>
								<div class="action-verif-info">
									<button type="button" id="commandeBtn" class="btn btn-dark-red etapes-btn blue-idx">Commander</button>	
								</div>
							</div>
						</div>
						<div class="previous-page-btn text-center">
							<button type="submit" name="rtn" id="retourpanierBtn" class="btn btn-dark-red etapes-btn"><i class="fa fa-chevron-circle-left"></i>Types De Livraison</button>	
						</div>
					</div>
					<input type="hidden" name="mdlv" value="<?php echo $_SESSION['modelivraison'] ?>">
				</form>
			</div>
			
		</div>
		
		<?php include_once "includes/loading.html" ?>
		
		<script>
            $(document).ready(function(){
				
				
				$("#commandeBtn").on("click", function(){
					Validation();
					
				});
				
				
				function ModifierInfoComm(){
					
					if(Validation() != null){
					
						var nom = $("#nom").val().trim();
						var prenom = $("#prenom").val().trim();
						var ville = $("#ville").val().trim();
						var adresse = $("#adresse").val().trim();
						var tele = $("#tele").val().trim();
						var codePostal = $("#codePostal").val().trim();
						
						
						
					}									 
				}
				
				function Validation(){

					var checkNumTele = check_numberPhone($("#tele"));
					var checkCodePostal = validNumber($("#codePostal"));
					var checkNom = allLettersWithSpace($("#nom"));
					var checkPrenom = allLettersWithSpace($("#prenom"));
					var checkVille = allLettersWithSpace($("#ville"));
					var checkAdresse = ValidAdress($("#adresse"));

					
					if(!checkNumTele)
					   $("#erreurNumTele").text("Numéro téléphone invalide");
					else
						$("#erreurNumTele").empty();
					
					if(!checkCodePostal)
					   $("#erreurCodePostal").text("Code Postal invalide");
					else
						$("#erreurCodePostal").empty();
					
					if(!checkNom)
						$("#erreurNom").text("Nom invalide");
					else
						$("#erreurNom").empty();
					
					if(!checkPrenom)
						$("#erreurPrenom").text("Prénom invalide");
					else
						$("#erreurPrenom").empty();
					
					if(!checkVille)
						$("#erreurVille").text("Ville invalide");
					else
						$("#erreurVille").empty();
					
					if(!checkAdresse)
						$("#erreurAdresse").text("Adresse invalide");
					else
						$("#erreurAdresse").empty();
					
				
					if(checkNumTele && checkCodePostal && checkNom && checkPrenom && checkVille && checkAdresse)
						return true;
					
					return null;
				}
				
				
				
				
				
				
				
					/*
					$.ajax({
						url: "includes/confirmationform",
						method: "POST",
						success: function(data){
							$(".div-verif-info-ctr").html(data);
						}
					});*/
					
				
			});
		</script>
		<?php include_once "includes/footer.php" ?>