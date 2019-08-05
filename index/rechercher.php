<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
			<div id="breadcrumb" class="section">
				
				<div class="container">
					
					<div class="row">
						<div class="col-md-12">
							<h3 class="breadcrumb-header">Accueil</h3>
							<ul class="breadcrumb-tree">
								<li class="active"><a href="rechercher.php">/ Rechercher</a></li>
							</ul>
						</div>
					</div>
					
				</div>
				
			</div>
			

			
			<div class="section">
				
				<div class="container">
					<?php 
						if(isset($_GET['categorie']) && isset($_GET['rechercher'])){
							$article = new article();
							$categorie = new categorie();
							$categorieID = $con->escape_string($_GET['categorie']);
							$mot = $con->escape_string($_GET['rechercher']);
							$res_query = $article->RechercherArticle($categorieID,$mot);
							if($res_query){
								while($row = $res_query->fetch_array())
								{
									$imageArticle = $article->ImageArticle($row['articleID']);
									$niveau = $article->echoNiveau($row['articleID']);
									$categorieNom = $categorie->CategorieNomParID($row['categorieID']);
									if ($row['remiseDisponible'] == true) {
										echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'><div class='product pro-tab1'>
												<div class='product-img no-slick-product' style='background-image:url($imageArticle)'>
													<div class='product-label'><span class='sale'>".$row['tauxRemise']."%</span><span class='new'>Nouveau</span></div>
												</div>
												<div class='product-body'>
													<p class='product-category'>".$categorieNom."</p>
													<h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
													<h4 class='product-price'>".$row['articlePrixRemise']." DHS<del class='product-old-price'>". $row['articlePrix']."</del></h4>
													<div class='product-rating'>".$niveau."</div>
													<div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
												</div>
												<div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
												</div>
											</div>";
										}
										else
											echo "<div class='col-xs-12 col-sm-6 col-md-4 col-lg-3'>
												<div class='product pro-tab1'>
													<div class='product-img no-slick-product' style='background-image:url($imageArticle)'>
														<div class='product-label'><span class='new'>Nouveau</span></div>
													</div>
													<div class='product-body'>
														<p class='product-category'>".$categorieNom."</p>
														<h3 class='product-name'><a href='#'>".$row['articleNom']."</a></h3>
														<h4 class='product-price'>".$row['articlePrix']." DHS</h4>
														<div class='product-rating'>".$niveau."</div>
														<div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div>
													</div>
													<div class='add-to-cart'><button id=".$row['articleID']." class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div>
												</div>
											</div>";
								}
							}
							else
							{
								echo '<div class="row">
									<div class="col-12 text-center">
										<h2><img src="img/not-found.png"><span style="color:#D10024">Oups</span> ! Aucun resultat..</h2>
									</div>
								</div>';
							}
						}
					?>
				</div>
				
			</div>

		<?php include_once "includes/newsletter.php" ?>
		
		<?php include_once "includes/loading.html" ?>
		
		<?php include_once "includes/footer.php" ?>