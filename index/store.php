<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
		<?php
			
			if(!isset($_GET['categorie']) && empty($_GET['categorie']) || !is_numeric($_GET['categorie'])):
				header('Location: ../errors/400.php');
				exit();
			else:
				$categorieID = filter_var($_GET['categorie'], FILTER_SANITIZE_NUMBER_INT);
			
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
							<li class="active"><a>/ store / 
							<?php
								$categorie = new Categorie();
								$article = new Article();
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
									while($row = $query->fetch_assoc()){
										$nbr_produits = $article->NbrProduitsParCategorie($row['categorieID']);
										if($categorieID == $row['categorieID'])
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
									<input id="price-min" type="number" min="0" max="9999">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" min="0" max="9999">
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
							<h4 id="<?php $randomCat = RandomCategoriesWidget(); echo $randomCat ?>" class="title categorie-aside"><?php echo $randomCat ?></h4>
							<div class="section-nav">

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
									Sort By : 
									<select id="filtrerPar" class="input-select">
										<option value="Nouveau">Nouveau</option>
										<option value="Recommonde">Recommonde</option>
									</select>
								</label>

								<label>
									Afficher : 
									<select id="afficherNbr" class="input-select">
										<option value="2">2</option>
										<option value="4">4</option>
										<option value="8">8</option>
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
							<span class="store-qty"></span>

							<ul class="store-pagination">

								<!--
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>-->
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
			
			$(".noUi-handle").on("click", function(){
				StorePagination();
                AfficherProduitsFilter();
			});
				
			$(document).on("input", ".cat-check, #price-max, #price-min, .marque-check, #afficherNbr", function(){
                StorePagination();
                AfficherProduitsFilter();
			});
			
			$(".cat-check").on("click",function(){
				AfficherMarques();
			});
			
			$(document).on("click",".pagination",function(e){
				
				$(".pagination").each(function(){
					if($(this).hasClass("active")){
						$(this).removeClass("active");
						$(this).children("a").css("color","#333");
					}
				});
				
				$(this).toggleClass("active");
				$(this).children("a").css("color","#fff");
			
			
				AfficherProduitsFilter();
			});
			
			(function AsideData(){
				var categorie = $(".categorie-aside").attr("id");
				var ele = $(".section-nav");
				$.ajax({	
					url: "../public-includes/ajax_queries",
					method: "POST",
					dataType: "JSON",
					data: {
						function: "RechargerTabWidget",
						categorie: categorie
					},
					success: function(data){
						LoadAsideData(data['tab1'], ele);
					}
				});
			}());
		});
			
		</script>
			

			
		<?php 
			endif;
		?>
		<?php include_once "includes/footer.php" ?>