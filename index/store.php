<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Accueil</h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a>/ store / 
							<?php
								$categorie = new Categorie();
								$article = new Article();
								$categorieID = $con->escape_string($_GET['categorie']);
								echo $categorie->categorieNomParID($categorieID).' ('.$article->NbrProduitsParCategorie($categorieID).')';
							?>
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
				<!-- row -->
				<div class="row">
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Categories</h3>
							<div class="checkbox-filter">
								<div class="input-checkbox">
									<input class="cat-check" type="checkbox" id="-1">
									<label for="-1">
										<span></span>
										Tous 
										<small>
										<?php
											$article = new Article();
											$nbr_tous = $article->NbrProduits();
											echo '('.$nbr_tous.')';
										?>
										</small>
									</label>
								</div>
								<?php 
									$categorie = new Categorie();
									$article = new Article();
									$query = $categorie->AfficherCategories();
									$id = $con->escape_string($_GET['categorie']);						
									while($row = $query->fetch_assoc()){
										$nbr_produits = $article->NbrProduitsParCategorie($row['categorieID']);
										if($id == $row['categorieID'])
										{
											echo '<div class="input-checkbox">
												<input class="cat-check" type="checkbox" id="'.$row['categorieID'].'" checked>
												<label for="'.$row['categorieID'].'">
													<span></span>
													'.$row['categorieNom'].'
													<small>('.$nbr_produits.')</small>
												</label>
											</div>';
										}
										else
											echo '<div class="input-checkbox">
												<input class="cat-check" type="checkbox" id="'.$row['categorieID'].'">
												<label for="'.$row['categorieID'].'">
													<span></span>
													'.$row['categorieNom'].'
													<small>('.$nbr_produits.')</small>
												</label>
											</div>';
									}
								?>

							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Price</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Marque</h3>
							<div class="checkbox-filter marques-produit">

							</div>
						</div>
						<!-- /aside Widget -->

						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Top selling</h3>
							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product01.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product02.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>

							<div class="product-widget">
								<div class="product-img">
									<img src="./img/product03.png" alt="">
								</div>
								<div class="product-body">
									<p class="product-category">Category</p>
									<h3 class="product-name"><a href="#">product name goes here</a></h3>
									<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								</div>
							</div>
						</div>
						<!-- /aside Widget -->
					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sort By:
									<select class="input-select">
										<option value="0">Popular</option>
										<option value="1">Position</option>
									</select>
								</label>

								<label>
									Show:
									<select class="input-select">
										<option value="0">20</option>
										<option value="1">50</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row produits-filter">
							<!-- product -->
							
							<!-- /product -->
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Showing 20-100 products</span>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<?php include_once "includes/newsletter.php" ?>
		
		<?php include_once "includes/loading.html" ?>
		
		<script>
		$(document).ready(function(){
			
	
			$(document).on("input", ".cat-check, #price-max, #price-min, .marque-check", function(){
				
				AfficherProduitsFilter();
			});
			
			$(".cat-check").on("click",function(){

				AfficherMarques();
				
			});
		});
		</script>
		
		<?php include_once "includes/footer.php" ?>