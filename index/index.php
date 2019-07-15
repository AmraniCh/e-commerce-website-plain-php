<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
			<!-- SECTION -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- shop -->
						<div class="col-md-4 col-xs-6">
							<div class="shop">
								<div class="shop-img">
									<img src="./img/shop01.png" alt="">
								</div>
								<div class="shop-body">
									<h3>Laptop<br>Collection</h3>
									<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
						<!-- /shop -->

						<!-- shop -->
						<div class="col-md-4 col-xs-6">
							<div class="shop">
								<div class="shop-img">
									<img src="./img/shop03.png" alt="">
								</div>
								<div class="shop-body">
									<h3>Accessories<br>Collection</h3>
									<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
						<!-- /shop -->

						<!-- shop -->
						<div class="col-md-4 col-xs-6">
							<div class="shop">
								<div class="shop-img">
									<img src="./img/shop02.png" alt="">
								</div>
								<div class="shop-body">
									<h3>Cameras<br>Collection</h3>
									<a href="#" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>
						<!-- /shop -->
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /SECTION -->

			<!-- SECTION -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">

						<!-- section title -->
						<div class="col-md-12">
							<div class="section-title">
								<h3 class="title">Nouveautés</h3>
								<div class="section-nav">
									<ul class="section-tab-nav tab-nav">
										<li class="tab1 active" id="aleatoire"><a data-toggle="tab" href="#">Aléatoire</a></li>
										<?php
											$result = RandomCategoriesNav();
											while($row = $result->fetch_row()){
												echo '<li class="tab1" id="'.$row[0].'"><a data-toggle="tab" href="#">'.$row[0].'</a></li>';
											}
										?>
									</ul>
								</div>
							</div>
						</div>
						<!-- /section title -->

						<!-- Products tab & slick -->
						<div class="col-md-12">
							<div class="row">
								<div class="products-tabs">
									<!-- tab -->
									<div id="tab1" class="tab-pane active">
										<div class="products-slick" data-nav="#slick-nav-1">
											<!-- product -->
											<!-- /product -->		
										</div>
										<div id="slick-nav-1" class="products-slick-nav"></div>
									</div>
									<!-- /tab -->
								</div>
							</div>
						</div>
						<!-- Products tab & slick -->
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /SECTION -->

			<!-- HOT DEAL SECTION -->
			<div id="hot-deal" class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12">
							<div class="hot-deal">
								<ul class="hot-deal-countdown">
									<li>
										<div>
											<h3>02</h3>
											<span>Days</span>
										</div>
									</li>
									<li>
										<div>
											<h3>10</h3>
											<span>Hours</span>
										</div>
									</li>
									<li>
										<div>
											<h3>34</h3>
											<span>Mins</span>
										</div>
									</li>
									<li>
										<div>
											<h3>60</h3>
											<span>Secs</span>
										</div>
									</li>
								</ul>
								<h2 class="text-uppercase">hot deal this week</h2>
								<p>New Collection Up to 50% OFF</p>
								<a class="primary-btn cta-btn" href="#">Shop now</a>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /HOT DEAL SECTION -->

			<!-- SECTION -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">

						<!-- section title -->
						<div class="col-md-12">
							<div class="section-title">
								<h3 class="title">Meilleures ventes</h3>
								<div class="section-nav">
									<ul class="section-tab-nav tab-nav">
										<li class="tab2 active" id="aleatoire"><a data-toggle="tab" href="#">Aléatoire</a></li>
										<?php
											$result = RandomCategoriesNav();
											while($row = $result->fetch_row()){
												echo '<li class="tab2" id="'.$row[0].'"><a data-toggle="tab" href="#">'.$row[0].'</a></li>';
											}
										?>
									</ul>
								</div>
							</div>
						</div>
						<!-- /section title -->

						<!-- Products tab & slick -->
						<div class="col-md-12">
							<div class="row">
								<div class="products-tabs">
									<!-- tab -->
									<div id="tab2" class="tab-pane fade in active">
										<div class="products-slick" data-nav="#slick-nav-2">
											<!-- product -->
											<!-- /product -->
										</div>
										<div id="slick-nav-2" class="products-slick-nav"></div>
									</div>
									<!-- /tab -->
								</div>
							</div>
						</div>
						<!-- /Products tab & slick -->
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /SECTION -->

			<!-- SECTION -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-4 col-xs-6">
							<div class="section-title">
								<h4 id="<?php $randomCat = RandomCategoriesWidget(); echo $randomCat ?>" class="title categorie-widget1"><?php echo $randomCat ?></h4>
								<div class="section-nav">
									<div id="slick-nav-3" class="products-slick-nav"></div>
								</div>
							</div>

							<div class="products-widget-slick" data-nav="#slick-nav-3">

							</div>
						</div>

						<div class="col-md-4 col-xs-6">
							<div class="section-title">
								<h4 id="<?php $randomCat = RandomCategoriesWidget(); echo $randomCat ?>" class="title categorie-widget2"><?php echo $randomCat ?></h4>
								<div class="section-nav">
									<div id="slick-nav-4" class="products-slick-nav"></div>
								</div>
							</div>

							<div class="products-widget-slick" data-nav="#slick-nav-4">

							</div>
						</div>

						<div class="clearfix visible-sm visible-xs"></div>

						<div class="col-md-4 col-xs-6">
							<div class="section-title">
								<h4 id="<?php $randomCat = RandomCategoriesWidget(); echo $randomCat ?>" class="title categorie-widget3"><?php echo $randomCat ?></h4>
								<div class="section-nav">
									<div id="slick-nav-5" class="products-slick-nav"></div>
								</div>
							</div>

							<div class="products-widget-slick" data-nav="#slick-nav-5">
							</div>
						</div>

					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /SECTION -->
		<?php include_once "includes/newsletter.php" ?>
		
		<script>
			$(document).ready(function() {
				
				$(document).on("click", "li[class='tab1']", function(e) {		
					SlickNav1();
				});
				$(document).on("click", "li[class='tab2']", function(e) {		
					SlickNav2();
				});
				
				setTimeout(function(){
       				SlickNav1();
					SlickNav2();
					SlickWidget1();
					SlickWidget2();
					SlickWidget3();
        		}, 120);

			});
			
		</script>
		
		
		<?php include_once "includes/loading.html" ?>
		
		<?php include_once "includes/footer.php" ?>
		
