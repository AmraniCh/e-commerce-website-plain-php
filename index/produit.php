<?php include_once "includes/header.php" ?>

<?php include_once "includes/navigation.php" ?>

<?php
	if(!isset($_GET['id']) && empty($_GET['id']) || !is_numeric($_GET['id'])):
		header('Location: ../login.php');
		exit();
	else:

		$get = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

		$result = ArticleParID($get);
		if(mysqli_num_rows($result)>0) {

			$article = new Article();

			$row = mysqli_fetch_assoc($result);
			$articleID = $row['articleID'];
			$articleNom = $row['articleNom'];
			$articlePrix = $row['articlePrix'];
			$articlePrixRemise = $row['articlePrixRemise'];
			$articleDescription = $row['articleDescription'];
			$articleMarque = $row['articleMarque'];

			$tauxRemise = $row['tauxRemise'];

			$remiseDisponible = $row['remiseDisponible'];
			$unitesEnStock = $row['unitesEnStock'];
			$articleDisponible = $row['articleDisponible'];
			$niveau = $article->echoNiveau($get);
			$categorieID = $row['categorieID'];

			$colors = echocolors($get);
			$images = echoImages($get);
			
			// nbr reviews
			$article = new Article();
			$nbr_reviews = $article->NbrArticleReviews($articleID);

			$result = $con->query("SELECT categorieNom from categorie WHERE categorieID = $categorieID");
			$row2 = mysqli_fetch_assoc($result);
			$categoryName = $row2['categorieNom']; 
			
?>
		<div id="breadcrumb" class="section">
			
			<div class="container">
				
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Accueil</h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a> 
							<?php
								$categorie = new Categorie();
								$categorieNom = $categorie->CategorieNomParID($categorieID);
								echo '/ '.$categorieNom.' / '.$articleNom;
							?>
							</a></li>
						</ul>
					</div>
				</div>
				
			</div>
			
		</div>
		

		
		<div class="section">
			
			<div class="container">
				
				<div class="row">
					
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
                            <?php
                            echo $images;
                            ?>
						</div>
					</div>
					

					
					<div class="col-md-2 col-md-pull-5">
						<div id="product-imgs">
                            <?php
                            echo $images;
                            ?>
						</div>
					</div>
					

					
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?php echo $articleNom?></h2>
							<div>
								<div class="product-rating">
									<?php echo $niveau?>
								</div>
								<a class="review-link" href="#"><?php echo $nbr_reviews ?> Review(s) | Add your review</a>
							</div>
							<div>
								<h3 class="product-price"> <?php  if ($articlePrixRemise!=''){echo $articlePrixRemise.' DHS ';} else{echo $articlePrix.' DHS '; }?><del class="product-old-price"><?php if ($articlePrixRemise!=''){echo $articlePrix.' DHS';} ?></del></h3>
								<span class="product-available">In Stock</span>
							</div>
							<p><?php echo $articleDescription?></p>
							
							<?php 
								if($colors != ''):
							?>
							<div class="product-options">
								<label>
									Color
									<select class="input-select">
                                        <?php
                                        echo $colors;
                                        ?>
									</select>
								</label>
							</div>
							<?php endif; ?>

							<div class="add-to-cart">
								<div class="qty-label">
									Quantité : 
									<div class="input-number">
										<input type="number" class="qty-article" value="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button id="<?php echo $articleID ?>" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
							</div>

							<ul class="product-btns">
								<li><button type="button" id="<?php echo $articleID ?>" class="btn add-to-wishlist"><i class="fa fa-heart-o"></i> Ajouter aux Favoris</button></li>
							</ul>
							<ul class="product-links" style="display:inline-block">
								<li>Category:</li>
								<li><a href="store.php?categorie=<?php echo $categorieID?>"> <?php echo $categoryName?></a></li>
							</ul>

							<ul class="product-links">
								<li>Share:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					

					
					<div class="col-md-12">
						<div id="product-tab">
							
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							

							
							<div class="tab-content">
								
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?php echo $articleDescription?></p>
										</div>
									</div>
								</div>
								

								
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										
										<div class="col-md-3">
											<div class="rating">
												<div class="rating-avg">
													<span id="ratingAvg"></span>
													<div class="rating-avg-stars">
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 100%;"></div>
														</div>
														<span id="sumReviews5" class="sum"></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span id="sumReviews4" class="sum"></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span id="sumReviews3" class="sum"></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span id="sumReviews2" class="sum"></span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span id="sumReviews1" class="sum"></span>
													</li>
												</ul>
											</div>
										</div>
										

										
										<div class="col-md-6">
											<div class="reviews-container">
												<ul class="reviews">
												</ul>
												<ul class="reviews-pagination">
												</ul>
											</div>
										</div>
										

										
										<div class="col-md-3">
											<div id="review-form">
											<?php
												if(isset($_SESSION['clientID'])){
													$clientID = filter_var($_SESSION['clientID'], FILTER_SANITIZE_NUMBER_INT);
													$query = $con->query("SELECT COUNT(*) FROM commentaire WHERE articleID = $articleID AND clientID = $clientID");
													$row = $query->fetch_row();
													if($row[0] == 0)
														include_once("includes/reviewform.html");
													else{
												?>
												<div class="review-submit-ctr">
													<div class="submit-success">
														<span class="submit-success-msg">Merci pour votre évaluation de notre produit ! <i class="fa fa-heart"></i></span>
														<div class="submit-success-img">
															<img src="img/thank-you.png">
														</div>
													</div>
												</div>
												<?php
													}
												}
												else
													include_once("includes/reviewform.html");
												?>
											</div>
										</div>
										
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
					
				</div>
				
			</div>
			
		</div>
		

		
		<div class="section">
			
			<div class="container">
				
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Produits connexes</h3>
						</div>
					</div>

					
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./img/product01.png" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Ajouter aux Favoris</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
							</div>
						</div>
					</div>
					

					
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./img/product02.png" alt="">
								<div class="product-label">
									<span class="new">NEW</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Ajouter aux Favoris</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
							</div>
						</div>
					</div>
					

					<div class="clearfix visible-sm visible-xs"></div>

					
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./img/product03.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Ajouter aux Favoris</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
							</div>
						</div>
					</div>
					

					
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img src="./img/product04.png" alt="">
							</div>
							<div class="product-body">
								<p class="product-category">Category</p>
								<h3 class="product-name"><a href="#">product name goes here</a></h3>
								<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4>
								<div class="product-rating">
								</div>
								<div class="product-btns">
									<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Ajouter aux Favoris</span></button>
									<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>
									<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
								</div>
							</div>
							<div class="add-to-cart">
								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Ajouter au panier</button>
							</div>
						</div>
					</div>
					

				</div>
				
			</div>
			
		</div>
	<?php											}
			else
				echo '<script>AucunResultat($(".full-container"))</script>';
		endif;
	?>

<?php include_once "includes/newsletter.php" ?>

<?php include_once "includes/loading.html" ?>

<script>
	window.onload = function(){
		ReviewsPagination();
		AfficherReviews();
		ReviewsTotalStars();
	}
	
	$(document).on("click", ".pagination", function(){
		
		$(".pagination").each(function(){
			if(!$(this).hasClass("active")){
				$(this).toggleClass("active");
				$(this).children("a").css("color","#fff");
			}
			else{
				$(this).removeClass("active");
				$(this).children("a").css("color","#333");
			}
		});
		
		AfficherReviews();
	});
	
	$("#btnSendReview").click(function(){
		
		var niveau = 0;
		var id = $(".stars > input:checked").attr("id");
		$("input[name='rating']").each(function(){
			if($(this).prop("checked"))
				niveau+=1;
		});
		
		if( $("#reviewTitle").val().length > 0 && $("#reviewText").val().length > 0 && niveau !== 0)
		{
			var titre = $("#reviewTitle").val();
			var commentaire = $("#reviewText").val();
			var articleID = $(".add-to-cart-btn").attr("id");
			
			$.ajax({
				url: "../public-includes/ajax_queries",
				method: "POST",
				dataType: "JSON",
				async: false,	
				data: { 
					function: "ReviewSubmit",
					titre: titre,
					commentaire: commentaire,
					niveau: niveau,
					articleID: articleID
				},
				beforeSend: function(){
					$(".review-form").append('<div class="loading-review-submit"><img src="img/loading145px.svg"></div>');
				},
				success: function(data){
					$("#btnSendReview").remove();
					setTimeout(function(){
						
						if(data != null)
							$("#review-form").load(" #review-form");
						else
							$(location).attr("href", "../register.php");
						
					}, 1800);
				}
				
			});
		}
	});
	
	$("input[name='rating']").click(function(){
		var value = $(this).val();
		for( let i = 1 ; i < value ; i++ )
		{
			$("input[value='"+i+"']").prop("checked", true);
		}
	});
	
	$(document).on("click",".qty-up, .qty-down",function(e){
		$(".qty-article").trigger("input");
	});
	
	function AfficherReviews(){
		var articleID = $(".add-to-cart-btn").attr("id");
		var page_nbr = $(".reviews-pagination > li[class*='active']").attr("id");
		
		$.ajax({
			url: "../public-includes/ajax_queries",
			method: "POST",
			dataType: "JSON",
			async: false,
			data: { 
				function: "AfficherReviews",
				articleID: articleID,
				page_nbr: page_nbr	  
			},
			success: function(data){
				if(data != null){
					
					$(".reviews").empty();
					
					for( let i = 0; i < data.length ; i++)
					{
						var starts = "<i class='fa fa-star'></i>";
						for( let j = 1 ; j < Math.round(data[i].niveau) ; j++)
						{
							starts += "<i class='fa fa-star'></i>";
						}

						for( let j = 5 ;  j > Math.round(data[i].niveau) ; j-- )
						{
							starts += "<i class='fa fa-star-o'></i>";
						}

						$(".reviews").append("<li><div class='review-heading'><h5 class='name'>"+ data[i].prenom + " " + data[i].nom +"</h5><p class='date'>"+ data[i].dateComm +"</p><div class='review-rating'>"+ starts +"</div></div><div class='review-body'><div class='review-title-ctr'><span class='review-title'><h5>"+ data[i].titre +"</h5></span></div><p>"+ data[i].commentaire +"</p></div></li>");
					}
				}
			}
		});
		
	}
	
	function ReviewsPagination(){
		var articleID = $(".add-to-cart-btn").attr("id");
		$.ajax({
			url: "../public-includes/ajax_queries",
			method: "POST",
			dataType: "JSON",
			async: false,
			data: { 
				function: "ReviewsPagination",
				articleID: articleID
			},
			success: function(data){

				if(data != null){
					for( var i=1 ; i <= data.nbr_pages ; i++ ){
						if(1 == i)
							$(".reviews-pagination").append("<li id='"+i+"' class='active pagination'>"+i+"</li>");
						else
							$(".reviews-pagination").append("<li id='"+i+"' class='pagination'>"+i+"</li>");
					}
				}
				else
					$(".reviews-pagination").html("<div class='msg text-center'>Aucun Commentaire Pour Cette Article</div>");
			}
		});
	}
	
	function ReviewsTotalStars(){
		var articleID = $(".add-to-cart-btn").attr("id");
		$.post(
			"../public-includes/ajax_queries",
			{ 
				function: "ReviewsTotalStars", 
				articleID: articleID 
			},
			function(data){
				if(data !== null){
					
					$(".rating-avg-stars").empty();
					
					$("#ratingAvg").text(data[0].avg);
					
					for( let i = 0 ; i < Math.round(data[0].avg) ; i++ )
					{
						$(".rating-avg-stars").append("<i class='fa fa-star'></i>");
					}
					
					for( let i = 5 ; i > Math.round(data[0].avg) ; i-- )
					{
						$(".rating-avg-stars").append("<i class='fa fa-star-o'></i>");
					}
					
					for( let i = 0 ; i < data.length ; i++ )
					{
						if( i !== 0){ // override first object
							$("#sumReviews5").text(data[i].niveau5);
							$("#sumReviews4").text(data[i].niveau4);
							$("#sumReviews4").text(data[i].niveau4);
							$("#sumReviews3").text(data[i].niveau3);
							$("#sumReviews2").text(data[i].niveau2);
							$("#sumReviews1").text(data[i].niveau1);
						}
					}
				}
				else{
					$("#sumReviews5").text("0");
					$("#sumReviews4").text("0");
					$("#sumReviews4").text("0");
					$("#sumReviews3").text("0");
					$("#sumReviews2").text("0");
					$("#sumReviews1").text("0");
					$(".rating-avg-stars").append("0 ");
					for( let i = 0 ; i < 5 ; i++){
						$(".rating-avg-stars").append("<i class='fa fa-star-o'></i>");
					}
				}
			},
			"JSON"
		);
	}
	
</script>

<?php include_once "includes/footer.php" ?>
