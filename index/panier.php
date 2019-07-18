<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID'])):
				header('Location: ../login.php');
				exit();
			else:
			
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
							<li class="active"><a>/ store / Mes Favoris
							</a></li>
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
				<div class="row flex-container">
					<div class="col-xs-12 col-lg-8 lft-container">
						<div class="product-container" style="position:relative">
							<!-- produit -->
							<div id="'.$row['articleID'].'" class="product product-panier">
								<div class="product-body" style="">
									<div class="product-header">
										<div class="produit-image">
											<img src="img/product01.png">
										</div>
										<div class="product-name">
											<a href="produit.php?id='.$row['articleID'].'">Article Nom</a>
										</div>
									</div>
									<div class="produit-description">
										<span>Description Description Description Description Description Description Description Description Description Description</span>
									</div>
									<div class="product-price">
										<span>Prix</span>
										<del class="product-old-price">Prix Remise</del>
									</div>
									<div class="delete-favori">
										<button id="" type="button" class="btn-delete-favori"><i class="fa fa-times-circle"></i></button>
									</div>
									<div class="quantite-ctn">
										<div class="input-number">
											<input type="number" value="0">
											<span class="qty-up">+</span>
											<span class="qty-down">-</span>
										</div>
									</div>
								</div>
							</div>
							<!-- /produit -->
						</div>
					</div>
					<div class="col-xs-12 col-lg-4 rgt-container">
						<div class="checkout-info">
							<div class="subtotal-price">Votre Sous-Total : 
								<span id="subTotalPrix">
									1500 DHS
								</span>
							</div>
							<div class="total-price-promotion">Promotion :
								<span id="prixSansProm">
									- 577 DHS
								</span>
							</div>
							<div class="total-price">Le Total : 
								<span id="prixTotal">
									8700 DHS
								</span>
							</div>
							<div class="checkout-cnt">
								<button type="button" id="checkoutBtn" class="checkout-btn">À La Caisse</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
	

		<?php include_once "includes/newsletter.php" ?>
		
		<?php include_once "includes/loading.html" ?>
		
		<script>
            $(document).ready(function(){
				
				(function StickyBarConfig(){
					var ele = $(".rgt-container");
					var $stickyTop = ele.offset().top;
					var $stickHeight = ele.height();

					$(window).scroll(function(){

						var windowTop = $(window).scrollTop();

						if($stickyTop < windowTop)
						{
							ele.css({
								position: 'sticky',
								top: '25px',
								right: "0",
							});
						}	
					});
				}());
			
				$(document).on("click", ".product-favori", function() {
					var articleID = $(this).attr("id");
					$(location).attr("href", "produit.php?id="+articleID);
				});
				
				(function SubstructArtilceDesc(){
					var descriptions = $(".produit-description > span");
					descriptions.each(function(){
						var desc = $(this).html();
						$(this).html(desc.substr(0, 120)+" ...");
					});
				}());
				
			});
		</script>
			

			
		<?php 
			endif;
		?>
		<?php include_once "includes/footer.php" ?>