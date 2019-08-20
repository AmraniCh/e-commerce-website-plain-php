<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>
		
		<?php
			
			if(!isset($_GET['categorie']) && empty($_GET['categorie']) || !is_numeric($_GET['categorie'])):
				header('Location: ../errors/400.php');
				exit();
			else:
				$categorieID = filter_var($_GET['categorie'], FILTER_SANITIZE_NUMBER_INT);

                $categorie = new Categorie();
			
		?>

		<div id="breadcrumb" class="section">
			
			<div class="container">
				
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
				
			</div>
			
		</div>
		

		
		<div class="section">
			
			<div class="container">
				
				<div class="row">
					
					<div id="aside" class="col-md-3">
						
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
						

						
						<div class="aside">
							<h3 class="aside-title">Prix</h3>
							<div class="price-filter">
								<div id="price-slider"></div>
								<div class="input-number price-min">
									<input id="price-min" type="number" min="0" max="9999" value="0">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
								<span>-</span>
								<div class="input-number price-max">
									<input id="price-max" type="number" min="0" max="9999" value="9999">
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
						</div>
						

						
						<div class="aside">
							<h3 class="aside-title">Marque</h3>
							<div class="checkbox-filter marques-produit">

							</div>
						</div>
						

						
						<div class="aside">
							<h4 id="<?php $randomCat = $categorie->RandomCategoriesWidget(); echo $randomCat ?>" class="title categorie-aside"><?php echo $randomCat ?></h4>
							<div class="section-nav">

							</div>
						</div>
						
					</div>
					

					
					<div id="store" class="col-md-9">
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
                                    Sort By : 
									<select id="filtrerPar" class="input-smp">
										<option value="Nouveau">Nouveau</option>
										<option value="Prix-low">Moins cher</option>
										<option value="Prix-high">Plus cher</option>
									</select>
								</label>

								<label>
									Afficher : 
									<select id="afficherNbr" class="input-smp">
										<option value="10">10</option>
										<option value="20">20</option>
										<option value="50">50</option>
									</select>
								</label>
								
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
							</ul>
						</div>
						

						
						<div class="row produits-filter">
							
							
							
						</div>
						

						
						<div class="store-filter clearfix">
							<span class="store-qty"></span>

							<ul class="store-pagination">

								
							</ul>
						</div>
						
					</div>
					
				</div>
				
			</div>
			
		</div>

		<?php include_once "includes/newsletter.php" ?>
		
		<script>
		$(document).ready(function(){
            
            exec_filterFunctions();
			
            $(".qty-up, .qty-down").click(function(){
                exec_filterFunctions();
            });
            
			$(".noUi-handle").on("click", function(){
				exec_filterFunctions();
			});
				
			$(document).on("input", ".cat-check, #price-max, #price-min, #afficherNbr, #filtrerPar", function(){
                exec_filterFunctions();
			});
			
			$(document).on("input", ".marque-check",function(){
				StorePagination();
                AfficherProduitsFiltrer();
			});
			
			$(document).on("click", ".pagination",function(e){
				
				$(".pagination").each(function(){
					if($(this).hasClass("active")){
						$(this).removeClass("active");
						$(this).children("a").css("color","#333");
					}
				});
				
				$(this).toggleClass("active");
				$(this).children("a").css("color","#fff");
			
			
				AfficherProduitsFiltrer();
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
			
        function exec_filterFunctions(){
            StorePagination();
            AfficherProduitsFiltrer();
            AfficherMarques(); 
        }
            
        function StorePagination(){

    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });
    
    var marques = [];
    $(".marque-check").each(function () {
        if ($(this).prop("checked")) {
            marques.push($(this).attr("id"));
        }
    });

    var minPrix = $("#price-min").val();
    var maxPrix = $("#price-max").val();
    var filtrerpar = $("#filtrerPar option:selected").val();
    var afficherNbr = $("#afficherNbr option:selected").val();


    if(categoriesIDs != ''){
        $.ajax({
            url: "../public-includes/ajax_queries",
            method: "POST",
            data: {
                function: "StorePagination",
                categoriesIDs: JSON.stringify(categoriesIDs),
                marques: JSON.stringify(marques),
                minPrix: minPrix,
                maxPrix: maxPrix,
                filtrerPar: filtrerpar,
                afficherNbr: afficherNbr,
            },
            dataType: "JSON",
            async: false,
            success: function(data){
                if(data != null){
                    $(".store-pagination").empty();
                    for(var i=1; i<=data[0].nbr_pages; i++){
                        if(1 == i)
                            $(".store-pagination").append("<li id='"+i+"' class='active pagination'>"+i+"</li>");
                        else
                            $(".store-pagination").append("<li id='"+i+"' class='pagination'><a>"+i+"</a></li>");
                    }
                }
            }
        });
    }
    else{
        $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
    }
        
};

        function AfficherProduitsFiltrer() {
    
    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });

    var marques = [];
    $(".marque-check").each(function () {
        if ($(this).prop("checked")) {
            marques.push($(this).attr("id"));
        }
    });

    var minPrix = $("#price-min").val();
    var maxPrix = $("#price-max").val();
    var filtrerpar = $("#filtrerPar option:selected").val();
    var afficherNbr = $("#afficherNbr option:selected").val();
    var page_nbr = $(".store-pagination li[class*='active']").attr("id");   
    if(page_nbr === undefined) // cannot page_nbr be undefined or null
        page_nbr = 1;
    
    if (categoriesIDs[0] != null && minPrix != '' && maxPrix != '') {
        $.ajax({
            url: '../public-includes/ajax_queries',
            method: 'POST',
            data: {
                function: "AfficherProduitsFiltrer",
                categoriesIDs: JSON.stringify(categoriesIDs),
                marques: JSON.stringify(marques),
                minPrix: minPrix,
                maxPrix: maxPrix,
                filtrerPar: filtrerpar,
                afficherNbr: afficherNbr,
                page_nbr: page_nbr
            },
            dataType: "JSON",
            async: false,
            beforeSend: function(){
                Lodding($(".produits-filter"));
            },
            success: function (data) {    
                if(data != null){
                    $(".produits-filter").empty();
                    for(var i=0;i<data.length - 2;i++)
                    {
                        if(data[i].remiseDisponible == true){
                            $(".produits-filter").append("<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'><div class='product pro-tab1'><a href='produit.php?produit=" + data[i].param + "'><div class='product-img no-slick-product' style='background-image:url("+data[i].imageArticle+")'><div class='product-label'><span class='sale'>"+data[i].tauxRemise+"%</span><span class='new'>Nouveau</span></div></div></a><div class='product-body'><p class='product-category'>"+data[i].categorieNom+"</p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>"+data[i].articleNom+"</a></h3><h4 class='product-price'>"+data[i].articlePrixRemise+" DHS<del class='product-old-price'>"+data[i].articlePrix+"</del></h4><div class='product-rating'>"+data[i].niveau+"</div><div class='product-btns'><button id='" + data[i].articleID + "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='quick-view'><a href='produit.php?produit=" + data[i].param + "'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='"+data[i].articleID+"' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>");
                        }
                        else
                            $(".produits-filter").append("<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'><div class='product pro-tab1'><a href='produit.php?produit=" + data[i].param + "'><div class='product-img no-slick-product' style='background-image:url("+data[i].imageArticle+")'><div class='product-label'><span class='new'>Nouveau</span></div></div></a><div class='product-body'><p class='product-category'>"+data[i].categorieNom+"</p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>"+data[i].articleNom+"</a></h3><h4 class='product-price'>"+data[i].articlePrix+" DHS</h4><div class='product-rating'>"+data[i].niveau+"</div><div class='product-btns'><button id='" + data[i].articleID + "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='quick-view'><a href='produit.php?produit=" + data[i].param + "'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='"+data[i].articleID+"' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>");
                    }
                    $(".store-qty").html("Affichés "+data[data.length - 1] +" Sur "+data[data.length -2 ]);
                }
                else{
                    AucunResultat($(".produits-filter"));
                    $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
                }
            }
        });
    }
    else{
        AucunResultat($(".produits-filter"));
        $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
    }
    
}
            
        function AfficherMarques() {
    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });
    $.ajax({
        url: '../public-includes/ajax_queries',
        method: 'POST',
        data: {
            function: "AfficherMarquesFiltrer",
            categoriesIDs: JSON.stringify(categoriesIDs),
        },
        dataType: "JSON",
        async: false,
        success: function (data) {
            if(data != null){
                $(".marques-produit").empty();
                for(var i=0;i<data.length;i++){
                    $(".marques-produit").append("<div class='input-checkbox'><input class='marque-check' type='checkbox' id='"+data[i].articleMarque+"'><label for='"+data[i].articleMarque+"'><span></span>"+data[i].articleMarque+"<small> ("+data[i].nbr_produits+")</small></label></div>");
                }
            }
            else
                $(".marques-produit").html("<span>Aucun marque trouvé !</span>");
        }
    });
}
			
		</script>
			

			
		<?php 
			endif;
		?>
		<?php include_once "includes/footer.php" ?>