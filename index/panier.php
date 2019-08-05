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
		
		<div id="breadcrumb" class="section">
				
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header"><a href="index.php">Accueil</a></h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a>/ Mon Panier</a></li>
						</ul>
					</div>
				</div>

			</div>
				
		</div>


		<div class="section panier-section">
			
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
								<span id="totalPrix" class="price-produit"></span>
							</div>
							<div class="line" style="border-top: 1px solid #ddd"></div>
							<div class="text-center"><span id="nbrArticles">Article(s)</span></div>
							<form action="" method="post">
								<div class="checkout-cnt">
									<button type="submit" name="submit" id="checkoutBtn" class="btn btn-dark-red etapes-btn">Étape Suivant<i class="fa fa-chevron-circle-right"></i></button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		
		<?php include_once "includes/loading.html" ?>
		
		<script>
            $(function(){
				
				var cpnBtnClick = false;
				
				RemplirPagePanier();
				
				(function StickyBarConfig(){
					var ele = $(".rgt-container");
					var $stickyTop = ele.offset().top;

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
					$(".qty-article").trigger("input");
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
							async: false,
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
						
						if($("#appliquerCpnBtn").data("clicked"))
							$("#appliquerCpnBtn").trigger("click");
					}
				});
				
				$("#appliquerCpnBtn").click(function(){
					
					$(this).data("clicked", true);
					
					var cpnCode = $("#cpnCode").val().trim();
					
					AppliquerCoupon(cpnCode);
				
					
				});
				
				function AppliquerCoupon(cpnCode){
					
						if(cpnCode != ''){
							$.ajax({
								url: "../public-includes/ajax_queries",
								method: "POST",
								dataType: "JSON",
								async: false,
								data: {
									function: "AppliquerCoupon",
									cpnCode: cpnCode,
								},
								beforeSend: function(){

									$("#cpnCode").attr("disabled", true);
									$(this).attr("disabled", true);

								},
								success: function(data){

									$("#cpnCode").attr("disabled", false);
									$(this).attr("disabled", false);

									if(data != -1 && data != null){
										$("#totalPayerCpn").text(data.total + "DHS");
										$("#cpnError").html("Coupon Valide. <span id='cpnTaux'> - "+data.taux+" %</span> pour les produits auxquels s'applique ce coupon.");
										$("#cpnError").removeClass("cpn-invalide");
										$("#cpnError").addClass("cpn-valide");
									}
									if(data == -1)
									{
										$("#cpnError").text("Coupon Invalide.");
										$("#cpnError").removeClass("cpn-valide");
										$("#cpnError").addClass("cpn-invalide");
										RemplirCheckoutInfo();
									}
								}
							});
						}
					}

				function RemplirPagePanier(){
					
					$.ajax({
						url: '../public-includes/ajax_queries',
						type: 'POST',
						data: { function: "RemplirPagePanier" },
						dataType: "JSON",
						beforeSend: function(){
							Lodding($(".product-container"));
						},
						async: false,
						success: function(data){
							//alert(data);
							if(data != null){
								$("#subTotalPrix").text(data[data.length - 2]+ " DHS");
								$("#prixPromotion").text(data[data.length - 3]+ " DHS");
								$("#totalPrix").text(data[data.length - 4]+ " DHS");
								$("#totalPayerCpn").text(data[data.length - 4]+ " DHS");
								$("#nbrArticles").text(data[data.length - 1]+" Article(s)");
								LoadPagePanierData(data, $(".product-container"));
							}	
							else{
								$(".flex-container").html("<div class='panier-vide-container text-center'><div class='vd-header'><span class='panier-vide-msg'>Votre panier est vide. Aller faire les courses!</span></div><div class='vd-img-body'><img class='vd-img' src='img/shopping-cart.png'></div><div class='vd-action'><a href='index.php'><button type='button' class='btn btn-danger btn-dark-red'><i class='fa fa-home' style='font-size:120%'></i> Accueil</button></a></div></div>");	
								$(".coupon-div-ctr").hide();
							}
						}
					}).done(function(){
						$.ajax({
							url: "../public-includes/ajax_queries",
							method: "POST",
							dataType: "JSON",
							async: false,
							data: { 
								function: "ReAppliquerCoupon",
							},
							success: function(data){
								if(data != null){
									AppliquerCoupon(data);
									$("#cpnCode").val(data);
								}
							}
						});
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
								$("#subTotalPrix").text(data[data.length - 2]+ " DHS");
								$("#prixPromotion").text(data[data.length - 3]+ " DHS");
								$("#totalPrix").text(data[data.length - 4]+ " DHS");
								$("#totalPayerCpn").text(data[data.length - 4]+ " DHS");
								$("#nbrArticles").text(data[data.length - 1]+" Article(s)");
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
								ele.append("<div id='" + data[i].articleID +"' class='product product-panier'><div class='product-body'><div class='product-header'><div class='produit-image'><img src='"+ data[i].imageArticle +"'></div><div class='product-name'><a href='produit.php?id="+ data[i].articleID +"'>"+ data[i].articleNom +"</a></div></div><div class='produit-description'><span>" + data[i].articleDescription + "</span></div><div class='product-price'><span>"+data[i].articlePrixRemise+" DHS</span><del class='product-old-price'> "+ data[i].articlePrix +" DHS</del></div><div class='delete-favori'><button id='" + data[i].articleID +"' type='button' class='btn-delete-panier'><i class='fa fa-times-circle'></i></button></div><div class='quantite-ctn'><div class='input-number'><input id='"+ data[i].articleID +"' class='qty-article' type='number' min='1' max='20' value='"+data[i].quantite+"'><span class='qty-up'>+</span><span class='qty-down'>-</span></div></div></div></div>");
							else
								ele.append("<div id='" + data[i].articleID +"' class='product product-panier'><div class='product-body'><div class='product-header'><div class='produit-image'><img src='"+ data[i].imageArticle +"'></div><div class='product-name'><a href='produit.php?id="+ data[i].articleID +"'>"+ data[i].articleNom +"</a></div></div><div class='produit-description'><span>" + data[i].articleDescription + "</span></div><div class='product-price'><span>"+ data[i].articlePrix +" DHS</span></div><div class='delete-favori'><button id='" + data[i].articleID +"' type='button' class='btn-delete-panier'><i class='fa fa-times-circle'></i></button></div><div class='quantite-ctn'><div class='input-number'><input id='"+ data[i].articleID +"' class='qty-article' type='number' min='1' max='20' value='"+data[i].quantite+"'><span class='qty-up'>+</span><span class='qty-down'>-</span></div></div></div></div>");

						}
					}
				}
				
			});
			
				
		</script>
			

			
		<?php 
			endif;
		?>
       
       <div class="coupon-div-ctr">
				
				<div class="apply-coupon-div">
					
					<span class="coupon-cpn-span">Appliquer Coupon : </span>
					
					<input type="text" id="cpnCode" class="form-control" placeholder="Entrer Le Code de Coupon">
					
					<button type="button" id="appliquerCpnBtn" class="btn btn-dark-red">Appliquer</button>
					
                   		<small id="cpnError" class="form-text text-muted"></small>
					
				</div>
				
				<div class="checkout-coupon-div">
					
					<span class="coupon-cpn-span">Total à Payer : </span>
					
					<span id="totalPayerCpn" class="total-payer-coupon price-produit"></span>
					
					
				</div>
				
				<div class="icons-coupon-div">
				
					
					<img class="img-amana-coupon" src="img/icon_amana.png">
					<img class="img-freeship-coupon" src="img/free.png">
					
				</div>
				
			</div>
       
       <?php include_once "includes/footer.php" ?>