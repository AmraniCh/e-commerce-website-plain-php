<?php 
	ob_start();
	session_start();
	require_once "../public-includes/config.php";
	require_once "../public-includes/classes.php";
	require_once "../public-includes/notification.class.php";
	require_once "../public-includes/statistique.class.php";

	if(isset($_POST['submit']) && !empty($_POST['search'])):

		$search = $_POST['search'];
		$categorie = $_POST['categorie'];
		header('location: rechercher.php?categorie='.$categorie.'&rechercher='.$search);
        exit();

    endif;
    
    if(isset($_POST['sbmlogout'])):
    
        header('Location: ../public-includes/logout.php');
        exit();

    endif;

    $sessionID = session_id();

    $query = $con->query(" SELECT * FROM visiteurs WHERE sessionID = '$sessionID' ");

    if( $query->num_rows == 0 ):

        $con->query(" INSERT INTO visiteurs VALUES('$sessionID', default) ");
    
    else:
        
        $con->query(" UPDATE visiteurs SET dateVisite = now() WHERE sessionID = '$sessionID' ");

    endif;

    $con->query(" DELETE FROM visiteurs WHERE dateVisite < dateVisite - INTERVAL 1 MINUTE ");

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
   <noscript>
   <style>
	   #overlayLoadingPage, body{
		   display: none;
	   }
	   </style>
			
		</noscript>
    </head>
	<body>
		<header>
			<div id="top-header">
				<div class="container">
				    <form action="" method="post">
                        <ul class="header-links pull-left">
                            <li><a><i class="fa fa-phone"></i> 0522 50 30 30</a></li>
                            <li><a><i class="fa fa-envelope-o"></i> contact@mga.ma</a></li>
                            <li><a><i class="fa fa-map-marker"></i> Hay Moulay Abdellah Rue 74 N°54 ,Casablanca</a></li>
                        </ul>
                        <ul class="header-links pull-right">
                            <li><a><i class="fa fa-dollar"></i> MAD</a></li>
                            <?php
                                if(isset($_SESSION['clientID'])):
                                    echo '<li><a href="commandes.php"><i class="fa fa-th-list"></i> Mes commandes</a></li>';
                                    echo '<li><a href="profile.php"><i class="fa fa-user-o"></i> Mon compte</a></li>';
                                    echo '<li><a><button type="submit" name="sbmlogout" class="ovr-button-styles"><i class="fa fa-sign-in"></i> Se déconnecter</button></a></li>';
                                else:
                                    echo '<li><a href="../login.php"><i class="fa fa-sign-in"></i> Se connecter</a></li>';
                                endif;
                            ?>
                        </ul>
                    </form>
				</div>
			</div>
			<div id="header">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>

						<div class="col-md-6">
							<div class="header-search">
								<form action="" method="post">
									<select name="categorie" class="input-select form-control">
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

						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Favoris -->
								<div class="dropdown fav-toggle">
									<a class="dropdown-toggle">
										<i class="fa fa-heart-o"></i>
										<span>Mes Favoris</span>
										<div class="qty qty-favori">0</div>
									</a>	
									<div class="cart-dropdown fav-dropdown" >
										<div class="cart-list cart-list-favori">
											
											
										</div>
										<div class="cart-summary">
											<small>
											<span id="nbrArticlesFavoris"></span>
											Articles(s)
											</small>
										</div>
										<div class="cart-btns">
											<a href='favoris.php'><button type="button" class="ovr-button-styles">Mes Favoris</button></a>
										</div>
									</div>
								</div>

								<div class="dropdown pan-toggle">
									<a class="dropdown-toggle">
										<i class="fa fa-shopping-cart"></i>
										<span>Panier</span>
										<div class="qty qty-panier"></div>
									</a>	
									<div id="pd" class="cart-dropdown pan-dropdown" >
										<div class="cart-list cart-list-panier">
											
										</div>
										<div class="cart-summary">
											<small>
												<span id="nbrArticlesPanier"></span>
												Articles(s)
											</small>
											<h5>Total: <span id="prixTotal">0 DHS</span></h5>
										</div>
										<div class="cart-btns">
											<a href="panier.php"><button type="button" class="ovr-button-styles">Voir mon Panier</button></a>
										</div>
									</div>
								</div>

								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
