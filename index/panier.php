<?php include_once "includes/panierheader.php" ?>

		
		<?php
				
			if(isset($_POST['submit'])):
				$client = new Client();
				$panierID = $client->PanierClient();
				$_SESSION['panier'] = $panierID;
				header('Location: modelivraison.php');
				exit();
				
			endif;
	
	
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID'])):
				header('Location: ../login.php');
				exit();
			else:
			
		?>


		<!-- SECTION -->
		<div class="section" style="padding-top:90px;padding-bottom:60px">
			<!-- container -->
			<div class="container">
				<div class="row flex-container">
					<div class="col-xs-12 col-lg-8 lft-container">
						<div class="product-container">
							
						</div>
					</div>
					<div class="col-xs-12 col-lg-4 rgt-container">
						<div class="checkout-info">
							<div class="subtotal-price"><span class="pn-titre">Sous-Total : </span>
								<span id="subTotalPrix">
								</span>
							</div>
							<div class="line" style="border-top: 1px solid #ddd"></div>
							<div class="total-price-promotion"><span class="pn-titre">Promotion :</span>
								<span id="prixSansProm">
									- <span id="prixPromotion" class="product-old-price"></span>
								</span>
							</div>
							<div class="line" style="border-top: 1px solid #ddd"></div>
							<div class="total-price">
								<span class="pn-titre">Le Total :</span>
								<span id="totalPrix"></span>
							</div>
							<div class="line" style="border-top: 1px solid #ddd"></div>
							<div class="text-center"><span id="nbrArticles">Article(s)</span></div>
							<form action="" method="post">
								<div class="checkout-cnt">
									<button type="submit" name="submit" id="checkoutBtn" class="btn btn-dark-red">À La Caisse</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
		<?php include_once "includes/loading.html" ?>
		
		<script>
            $(document).ready(function(){
				RemplirPagePanier();
				
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
				
				(function SubstructArtilceDesc(){
					var descriptions = $(".produit-description > span");
					descriptions.each(function(){
						var desc = $(this).html();
						$(this).html(desc.substr(0, 120)+" ...");
					});
				}());
				
		
			});
			
			$(document).on("click", ".product-panier", function() {
				var articleID = $(this).attr("id");
				$(location).attr("href", "produit.php?id="+articleID);
			});
				
			$(document).on("click", ".btn-delete-panier", function(e){	
				e.stopPropagation();
				var articleID = $(this).attr("id");
				$.post(
					'../public-includes/ajax_queries',
					{ function: "SupprimerAuPanier", articleID: articleID },
					function(data){
						if (data != false) {
							RemplirPagePanier();
							RemplirPanier();
						}	
					},
					"JSON"
				);
			});
			
			$(document).on("click", ".qty-article", function(e){
				e.stopPropagation();
			});
			
			$(document).on("click",".qty-up, .qty-down",function(e){
				e.stopPropagation();
				
				input = $(this).parent().find(".qty-article");
				
				if($(this).hasClass("qty-up")){
					var oldValue = parseInt(input.val());
					if(oldValue < 20)
						input.val(oldValue + 1);
				}
				else{
					input = $(this).parent().find(".qty-article");
					var oldValue = parseInt(input.val());
					if(oldValue > 1)
						input.val(oldValue - 1);
				}
					
				$(".qty-article").trigger("input");
			});
			
			$(document).on("input", ".qty-article", function(){
				var articleID = $(this).attr("id");
				var qty = parseInt($(this).val());
				if(qty > 0 && qty < 20){
					$.ajax({
						url: '../public-includes/ajax_queries',
						method: 'POST',
						data: {
							function: "IncrementArticleQtyPanier",
							articleID: articleID,
							qty: qty
						},
						dataType: "JSON",
						beforeSend: function(){
							$(this).prop("disabled",true);
						},
						success: function(data){
							if(data != null)
							{
								RemplirCheckoutInfo();
							}
						}
					});
				}
			});
			
			function RemplirPagePanier(){
				$.ajax({
					url: '../public-includes/ajax_queries',
					type: 'POST',
					data: { function: "RemplirPagePanier" },
					dataType: "JSON",
					beforeSend: function(){
						Lodding($(".product-container"));
					},
					success: function(data){
						if(data != null){
							$("#subTotalPrix").html(data[data.length - 2]+ " DHS");
							$("#prixPromotion").html(data[data.length - 3]+ " DHS");
							$("#totalPrix").html(data[data.length - 4]+ " DHS");
							$("#nbrArticles").html(data[data.length - 1]+" Article(s)");
							LoadPagePanierData(data, $(".product-container"));
						}	
						else
							$(".flex-container").html("<div class='panier-vide-container text-center'><div class='vd-header'><span style='font-size:140%'>Votre panier est vide. Aller faire les courses!</span></div><div class='vd-img-body'><img src='img/shopping-cart2.png' style='width:17%;padding-top:18px'></div><div class='vd-action' style='padding-top:15px'><a href='index.php'><button type='button' class='btn btn-danger btn-dark-red' style='padding:10px 15px;font-weight:500'><i class='fa fa-home' style='font-size:120%'></i> Accueil</button></a></div></div>");	
					}
				});
			};
			
			function RemplirCheckoutInfo(){
				$.ajax({
					url: '../public-includes/ajax_queries',
					type: 'POST',
					data: { function: "RemplirPagePanier" },
					dataType: "JSON",
					success: function(data){
						if(data != null){
							$("#subTotalPrix").html(data[data.length - 2]+ " DHS");
							$("#prixPromotion").html(data[data.length - 3]+ " DHS");
							$("#totalPrix").html(data[data.length - 4]+ " DHS");
							$("#nbrArticles").html(data[data.length - 1]+" Article(s)");
						}		
					}
				});
			}
			
			function LoadPagePanierData(data, ele){	
				if(data != null)
				{
					ele.empty();
					for(var i=0;i<data.length - 4;i++)  
					{
						if(data[i].remiseDisponible == true)
							ele.append("<div id='" + data[i].articleID +"' class='product product-panier'><div class='product-body'><div class='product-header'><div class='produit-image'><img src='"+ data[i].imageArticle +"'></div><div class='product-name'><a href='produit.php?id='"+ data[i].articleID +"'>"+ data[i].articleNom +"</a></div></div><div class='produit-description'><span>" + data[i].articleDescription + "</span></div><div class='product-price'><span>"+data[i].articlePrixRemise+" DHS</span><del class='product-old-price'> "+ data[i].articlePrix +" DHS</del></div><div class='delete-favori'><button id='" + data[i].articleID +"' type='button' class='btn-delete-panier'><i class='fa fa-times-circle'></i></button></div><div class='quantite-ctn'><div class='input-number'><input id='"+ data[i].articleID +"' class='qty-article' type='number' min='1' max='20' value='"+data[i].quantite+"'><span class='qty-up'>+</span><span class='qty-down'>-</span></div></div></div></div>");
						else
							ele.append("<div id='" + data[i].articleID +"' class='product product-panier'><div class='product-body'><div class='product-header'><div class='produit-image'><img src='"+ data[i].imageArticle +"'></div><div class='product-name'><a href='produit.php?id='"+ data[i].articleID +"'>"+ data[i].articleNom +"</a></div></div><div class='produit-description'><span>" + data[i].articleDescription + "</span></div><div class='product-price'><span>"+ data[i].articlePrix +" DHS</span></div><div class='delete-favori'><button id='" + data[i].articleID +"' type='button' class='btn-delete-panier'><i class='fa fa-times-circle'></i></button></div><div class='quantite-ctn'><div class='input-number'><input id='"+ data[i].articleID +"' class='qty-article' type='number' min='1' max='20' value='"+data[i].quantite+"'><span class='qty-up'>+</span><span class='qty-down'>-</span></div></div></div></div>");
							
					}
				}
			}
			
				
		</script>
			

			
		<?php 
			endif;
		?>
		<?php include_once "includes/footer.php" ?>