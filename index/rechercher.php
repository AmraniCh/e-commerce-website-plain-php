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
							$categorieID = filter_var($con->escape_string($_GET['categorie']), FILTER_SANITIZE_NUMBER_INT);
							$mot = filter_var($con->escape_string($_GET['rechercher']), FILTER_SANITIZE_STRING);
							$res_query = $article->RechercherArticle($categorieID,$mot);
							if($res_query){
								while($row = $res_query->fetch_array())
								{
									$imageArticle = $article->ImageArticle($row['articleID']);
									$niveau = $article->echoNiveau($row['articleID']);
									$categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                                    
                                    $param = $article->urlProduitParameterValue($row['articleID']);
                                    
                                    if(strlen($row['articleNom']) > 38)
                                        $articleNom = substr($row['articleNom'], 0, 38).' ...';
                                    else
                                        $articleNom = $row['articleNom'];
                                    
									if ($row['remiseDisponible'] == true) {
										echo "<div class='col-md-3 col-xs-6'><div class='product'><a href='produit.php?produit=".$param."'><div class='product-img'><img src='".$imageArticle."' alt='".$articleNom."'> <div class='product-label'><span class='sale'>".$row['tauxRemise']." %</span><span class='new'>Nouveau</span></div></div></a><div class='product-body'><p class='product-category'>".$categorieNom."</p><h3 class='product-name'><a href='produit.php?produit=".$param."'>".$articleNom."</a></h3> <h4 class='product-price'>" .$row['articlePrixRemise']. " DHS<del class='product-old-price'>" .$row['articlePrix']. "</del></h4> <div class='product-rating'>" .$niveau. "</div><div class='product-btns'><button id='" .$row['articleID']. "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='quick-view'><a href='produit.php?produit=".$param."'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='" .$row['articleID']. "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>";
										}
										else{
											echo "<div class='col-md-3 col-xs-6'><div class='product'> <a href='produit.php?produit=".$param."'><div class='product-img'><img src='".$imageArticle."' alt='".$articleNom."'> <div class='product-label'><span class='new'>Nouveau</span></div></div></a><div class='product-body'> <p class='product-category'>".$categorieNom."</p><h3 class='product-name'><a href='produit.php?produit=".$param."'>".$articleNom."</a></h3> <h4 class='product-price'>" .$row['articlePrix']. " DHS</h4> <div class='product-rating'>" .$niveau. "</div><div class='product-btns'><button id='" .$row['articleID']. "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='quick-view'><a href='produit.php?produit=".$param."'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='" .$row['articleID']. "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>";
                                        }
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
		
		<?php include_once "includes/footer.php" ?>