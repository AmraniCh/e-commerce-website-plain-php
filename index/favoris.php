<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID'])):
				header('Location: ../login.php');
				exit();
			else:
			
		?>

		<div id="breadcrumb" class="section">
			
			<div class="container">
				
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Accueil</h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a> / Mes Favoris
							</a></li>
						</ul>
					</div>
				</div>
				
			</div>
			
		</div>
		

		
		<div class="section">
			
			<div class="container">
				<div class="row product-container">
					<?php
						$favori = new Favori();
						$article = new Article();
						$query = $favori->AfficherProduitsFavoris();
						if($query != null):
							while($row = $query->fetch_assoc()){
								$imageArticle = $article->ImageArticle($row['articleID']);
								if($row['remiseDisponible'] != true):
									echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div id="'.$row['articleID'].'" class="product product-favori">
											<div class="product-body">
												<div class="delete-favori"><button id="'.$row['articleID'].'" type="button" class="btn-delete-favori"><i class="fa fa-times-circle"></i></button></div>
												<div class="heart-icon"><i class="fa fa-heart"></i></div>
												<div class="product-header">
													<div class="produit-image">
														<img src="'.$imageArticle.'">
													</div>
													<div class="product-name">
														<a href="produit.php?id="'.$row['articleID'].'">'.$row['articleNom'].'</a>
													</div>
												</div>
												<div class="produit-description"><span>'.$row['articleDescription'].'</span></div>
												<div class="product-price">
													<span>'.$row['articlePrix'].'</span>
												</div>
											</div>
										</div>
									</div>';
								else:
									echo '<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div id="'.$row['articleID'].'" class="product product-favori">
											<div class="product-body">
												<div class="delete-favori"><button id="'.$row['articleID'].'" type="button" class="btn-delete-favori"><i class="fa fa-times-circle"></i></button></div>
												<div class="heart-icon"><i class="fa fa-heart"></i></div>
												<div class="product-header">
													<div class="produit-image">
														<img src="'.$imageArticle.'">
													</div>
													<div class="product-name">
														<a href="produit.php?id='.$row['articleID'].'">'.$row['articleNom'].'</a>
													</div>
												</div>
												<div class="produit-description"><span>'.$row['articleDescription'].'</span></div>
												<div class="product-price">
													<span>'.$row['articlePrix'].'</span>
													<del class="product-old-price">'.$row['articlePrixRemise'].'</del>
												</div>
											</div>
										</div>
									</div>';
								endif;
							}
						endif;
					?>
				</div>
			</div>
			
		</div>

		<?php include_once "includes/newsletter.php" ?>
	
		
		<script>
            
			$(document).ready(function(){
				AucunFavoriTrouve();
				SubstructArtilceDesc();
			});
			
			function SubstructArtilceDesc(){
				var descriptions = $(".produit-description > span");
				descriptions.each(function(){
					var desc = $(this).text();
					if($(this).text().length > 20)
						$(this).text(desc.substr(0, 40)+" ...");
				});
			}
			
			$(document).on("click", ".product-favori", function() {
				var articleID = $(this).attr("id");
				$(location).attr("href", "produit.php?id="+articleID);
			});
			
			$(document).on("click", ".btn-delete-favori", function(e){		
				e.stopPropagation();
				var articleID = $(this).attr("id");
				$.ajax({
					url: "../public-includes/ajax_queries",
					method: "POST",
					data: {
						function: "SupprimerAuFavoris",
						articleID: articleID
					},
					async: false,
					dataType: 'JSON',
					success: function (data) {
						if (data != false){
							$(".product-conatiner").load(" .product-conatiner");
							RemplirFavoris();
						}
					}	
				});
			});

			function AucunFavoriTrouve(){
				$.ajax({
					url: "../public-includes/ajax_queries",
					method: "POST",
					data: { function: "AucunFavoriTrouve" },
					dataType: 'JSON',
					success: function (data) {
						if (data == true)
							$(".product-container").html("<div class='msg-vide text-center'><h4>Vous n'avez actuellement aucun favori.</h4></div><div class='msg-vide text-center'><h5>Ajoutez des produits à vos favoris en cliquant sur <span><i class='fa fa-heart-o'></i></span> la page du produit!<h5></div>");	
					}
				});
			}
            
		</script>
			

			
		<?php 
			endif;
		?>
		<?php include_once "includes/footer.php" ?>