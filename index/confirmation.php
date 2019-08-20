<?php include_once "includes/panierheader.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID']) || !isset($_SESSION['typelivraison']) || !isset($_SESSION['totalApayer'])):

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
				header('Location: index.php');
				exit();
			endif;

			if(isset($_POST['sbm_commandes'])):
				header('Location: commandes.php');
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
				
				$total_a_payer = filter_var($_SESSION['totalApayer'], FILTER_SANITIZE_NUMBER_FLOAT);
				
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
						<div class="loading-verif-ctr">
							<img class='img-responisive laoding-verfi' src='img/index.shopping-cart-loader-icon.svg'>
							<span id="ajx_message"></span>
						</div>
						<div class="row div-verif-info">			
							<div class="hdr-verif-info">
								<span class="title-verif-info">
									<h3>Vérification des information de contact</h3>
								</span>
							</div>
							<div class="body-verif-info">
								<div class="astuce-verif-info">
									<p><i class="fa fa-info-circle"></i> S'il vous plaît vérifier vos informations de contact avant d'envoyer le demande</p>
								</div>
								<div class="form-group">
									<input class="form-control" id="nom" type="text" name="nom" placeholder="nom" value="<?php echo $nom?>">
									<div class="container text-error-ctr">
                            			<small id="erreurNom" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<input class="form-control" id="prenom" type="text" name="prenom" placeholder="Prenom" value="<?php echo $prenom?>">
									<div class="container text-error-ctr">
                            			<small id="erreurPrenom" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<input class="form-control" id="ville" type="text" name="ville" placeholder="Ville" value="<?php echo $ville?>">
									<div class="container text-error-ctr">
                            			<small id="erreurVille" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
									<input class="form-control" id="adresse" type="text" name="adresse" placeholder="Adresse" value="<?php echo $adresse?>">
									<div class="container text-error-ctr">
                            			<small id="erreurAdresse" class="form-text text-muted erreur-info"></small>
									</div>
								</div>
								<div class="form-group">
									<input class="form-control" id="tele" type="text" name="tele" placeholder="Téléphone" value="<?php echo $tele?>">
									<div class="container text-error-ctr">
                            			<small id="erreurNumTele" class="form-text text-muted erreur-info"></small>
                        			</div>
								</div>
								<div class="form-group">
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
									<button type="button" id="commandeBtn" class="btn">Commander</button>
								</div>
							</div>
						</div>
						<div class="previous-page-btn text-center">
							<button type="submit" name="rtn" id="retourpanierBtn" class="btn btn-dark-red etapes-btn"><i class="fa fa-chevron-circle-left"></i>Types De Livraison</button>	
						</div>
					</div>
				</form>
			</div>
			
		</div>
		
		<div class="changetele-overlay">
			<div class="changetele-overlay-content">
				<div class="changetele-overlay-items">
					<label for="numTele">Saisis Votre numéro Teléphone : </label>
					<input type="text" id="numTele" class="from-control" placeholder="Numéro Téléphone">
					<div class="changeTele-msg">
						<span id="teleValidateMsg"></span>
					</div>
					<button type="button" id="changerTeleBtn" class="btn ovr-button-styles">Changer</button>
				</div>
				<div class="changeTele-overlay-close">
					
					<button type="button" id="closeOverlay" class="btn ovr-button-styles"><i class="fa fa-times"></i></button>
					
				</div>
			</div>
		</div>
		
		<script>
            $(document).ready(function(){
		
                setTimeout(function(){
                    
                    $('html, body').animate({
                        scrollTop: parseInt($(".div-verif-info").offset().top - 15)
                    }, 600);
                }, 800);
				
				$("#commandeBtn").on("click", function(){
					
					if(Validation() != null){
						
						$('html, body').animate({
							scrollTop: parseInt($("#header").offset().top)
						}, 800);

						var nom = $("#nom").val().trim();
						var prenom = $("#prenom").val().trim();
						var ville = $("#ville").val().trim();
						var adresse = $("#adresse").val().trim();
						var tele = $("#tele").val().trim();
						var codePostal = $("#codePostal").val().trim();
						
						var info = [];
						info.push(nom, prenom, ville, adresse, tele, codePostal);
	
						var error = false;
						
						$.ajax({
							url: "../public-includes/ajax_queries",
							method: "POST",
							dataType: "JSON",
							async: false,
							data: {
								function: "MiseAjourInfoCommande",
								info: info
							},
							beforeSend: function(){
								AJXCommandeMessages("Vérification et mise à jour les coordonnées de contact ...");
							},
							success: function(data){
								(data == null) ? error = "Vérification et mise à jour des informations de contact echoué." : error = false;
							},
							complete: function(){
								
								if(error == false){
									
									setTimeout(function(){
										$.ajax({
											url: "../public-includes/ajax_queries",
											method: "POST",
											dataType: "JSON",
											async: false,
											data: {
												function: "VrfDispoArtCommande",
											},
											beforeSend: function(){
												AJXCommandeMessages("Confirmation de la disponibilité d'articles commandées ...");
											},
											success: function(data){
												(data == null) ? error = "Une ou plusieurs articles demandées n'est plus disponible." : error = false;
											},
											complete: function(){
												
												if(error == false){	
													
													setTimeout(function(){
														
														$.ajax({
															url: "../public-includes/ajax_queries",
															method: "POST",
															dataType: "JSON",
															async: false,
															data: {
																function: "VrfQtyArtCommande",
															},
															beforeSend: function(){
																AJXCommandeMessages("Vérification de la quantité commandées ...");
															},
															success: function(data){
																(data == null) ? error = "La quantité commandée invalide." : error = false;
															},
															complete: function(){
																if(error == false)
																{	
																	setTimeout(function(){
																		$.ajax({
																			url: "../public-includes/ajax_queries",
																			method: "POST",
																			dataType: "JSON",
																			async: false,
																			data: {
																				function: "CreationCommande",
																			},
																			beforeSend: function(){
																				AJXCommandeMessages("Création du commande en cours  ...");
																			},
																			success: function(data){
																				(data == null) ? error = "Création du commande à été echoué." : error = false;
																			},
																			complete: function(){
																				if(error == false){
																					setTimeout(function(){
																						$.post(
																							"includes/confirmationform",
																							function(data){
																								
																							
																								
																								$(".div-verif-info-ctr").html(data);
																								
																								$('html, body').animate({
																									scrollTop: parseInt($("#breadcrumb").offset().top)
																								}, 600);
																								$("#commandeTele").text(tele);
																							}
																						);
																					}, 600);
																				}
																			}
																		});
																	}, 700);
																}
															}
														});
														
													}, 700);
													
												}
												
											}
										});
										
									}, 700);
								}
							}
							
						});
					}
					
				});
				
				$(document).on("click", "#changerTeleBtnToggle", function(){	
					$(".changetele-overlay").show();
				});
				
				$(document).on("click", "#closeOverlay", function(){	
					$(".changetele-overlay").hide();
				});
				
				$("#changerTeleBtn").on("click", function(){
			
					var checkNumTele = check_numberPhone($("#numTele"));
					
					if(checkNumTele){
						
						$(".changeTele-msg").hide();
						
						var numTele = $("#numTele").val();
						
						$.ajax({
							url: "../public-includes/ajax_queries",
							method: "POST",
							dataType: "html",
							data: { 
								function: "ChangerNumTele",
								numTele: numTele
							},
							async: false,
							beforeSend: function(){
								$("#numTele").prop("disabled", true);
								$("#changerTeleBtn").prop("disabled", true);
							},
							success: function(data){
								if(data != null){
									$("#numTele").prop("disabled", false);
									$("#changerTeleBtn").prop("disabled", false);
									$(".changeTele-msg").show();
									$("#teleValidateMsg").attr("class", "changetele-msg-success");
									$("#teleValidateMsg").text("Votre numéro téléphone a été changé avec succès.");
									$("#commandeTele").text(numTele);
								}
							},
							complete: function(){
								setTimeout(function(){
									$(".changeTele-msg").hide();
								}, 2300);
							}
						});
						
					}
					else{
						$(".changeTele-msg").show();
						$("#teleValidateMsg").attr("class", "changetele-msg-invalide");
						$("#teleValidateMsg").text("Numéro téléphone invalide.");
					}
				});
				
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
				
				function AJXCommandeMessages(msg){
					$(".div-verif-info, .previous-page-btn").hide();
					$(".loading-verif-ctr").fadeIn();
					$("#ajx_message").text(msg);
				}
				
					
				
			});
		</script>
	
		
		<?php include_once "includes/footer.php" ?>