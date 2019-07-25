<?php 
	ob_start();
	session_start();
	require_once "../public-includes/config.php";
	include_once "../public-includes/functions.php";
	include_once "../public-includes/classes.php";

	if(isset($_POST['submit']) && !empty($_POST['search'])):
		$search = $_POST['search'];
		$categorie = $_POST['categorie'];
		header('location: rechercher.php?categorie='.$categorie.'&rechercher='.$search);
    endif;
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Electro - HTML Ecommerce Template</title>
		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>
		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>
		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>
		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
		<link type="text/css" rel="stylesheet" href="css/mainstyle.css"/>
		<link type="text/css" rel="stylesheet" href="css/animation.css"/>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!-- scripts -->
   		<script src="js/jquery.min.js"></script>
		<script src="js/functions.js"></script>
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a><i class="fa fa-phone"></i> 0522 50 30 30</a></li>
						<li><a><i class="fa fa-envelope-o"></i> contact@mga.ma</a></li>
						<li><a><i class="fa fa-map-marker"></i> Hay Moulay Abdellah Rue 74 N°54 ,Casablanca</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a><i class="fa fa-dollar"></i> MAD</a></li>
						<?php
							if(isset($_SESSION['clientID']))
								echo '<li><a href="profile.php?client='.$_SESSION['clientUserName'].'"><i class="fa fa-user-o"></i> Mon compte</a></li>';
							else
								echo '<li><a href="../login.php"><i class="fa fa-sign-in"></i>Se connecter</a></li>';
						?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="" method="post">
									<select name="categorie" class="input-select" style="width:23%">
										<option value="tout">Tout</option>
										<?php
											$query = $con->query("SELECT * FROM categorie ORDER BY categorieNom");
											if($query->num_rows > 0){
												while($row = $query->fetch_assoc())
												{
													if(isset($_GET['rechercher']) && isset($_GET['categorie'])){
														$categorie = $_GET['categorie'];
														if($row['categorieID'] == $categorie)
															echo '<option value='.$row['categorieID'].' selected>'.$row['categorieNom'].'</option>';
														else
															echo '<option value='.$row['categorieID'].'>'.$row['categorieNom'].'</option>';
													}
													else
														echo '<option class=""  value='.$row['categorieID'].'>'.$row['categorieNom'].'</option>';
												}
											}
										?>
									</select>
									<input class="input mini-input" name="search" placeholder="Chercher ici" value="<?php if(isset($_GET['rechercher']) && isset($_GET['categorie'])) echo $_GET['rechercher'] ?>" style="width:36%">
									<input type="submit" name="submit" class="search-btn" value="Rechercher"/>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Favoris -->
								<div class="dropdown fav-toggle" style="cursor:pointer">
									<a class="dropdown-toggle">
										<i class="fa fa-heart-o"></i>
										<span>Mes Favoris</span>
										<div class="qty qty-favori">0</div>
									</a>	
									<div class="cart-dropdown fav-dropdown" style="cursor:initial">
										<div class="cart-list cart-list-favori">
											
											
										</div>
										<div class="cart-summary">
											<small>
											<span id="nbrArticlesFavoris"></span>
											Artiles(s)
											</small>
										</div>
										<div class="cart-btns">
											<a href='favoris.php' style="width:100%">Mes Favoris</a>
										</div>
									</div>
								</div>
								<!-- /Favoris -->
								<!-- Cart -->
								<div class="dropdown pan-toggle" style="cursor:pointer">
									<a class="dropdown-toggle">
										<i class="fa fa-shopping-cart"></i>
										<span>Panier</span>
										<div class="qty qty-panier"></div>
									</a>	
									<div class="cart-dropdown pan-dropdown" style="cursor:initial">
										<div class="cart-list cart-list-panier">
											
											
										</div>
										<div class="cart-summary">
											<small>
											<span id="nbrArticlesPanier"></span>
											Artiles(s)
											</small>
											<h5>Total: <span id="prixTotal">0 DHS</span></h5>
										</div>
										<div class="cart-btns">
											<a href="panier.php">Voir mon Panier</a>
											<a>Checkout <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->
