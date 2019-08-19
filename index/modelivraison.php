<?php include_once "includes/panierheader.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID']) || !isset($_SESSION['panier'])):

				header('Location: ../errors/400.php');
				exit();
			
			else:

				$client = new Client();
				$panierID = $client->PanierClient();
				$session_panierID = filter_var($_SESSION['panier'], FILTER_SANITIZE_NUMBER_INT);

				if($panierID != $session_panierID):
					header('Location: ../errors/400.php');
					exit();				
				endif;
			
			endif;

			switch(true){
					
				case isset($_POST['rtn']):
					header('Location: panier.php');
					exit();
				break;
				
				case isset($_POST['c1']):
					$_SESSION['typelivraison'] = "gratuit";
					header('Location: confirmation.php');
					exit();
				break;
					
				case isset($_POST['c2']):
					$_SESSION['typelivraison'] = "amana";
					header('Location: confirmation.php');
					exit();
				break;
			}	

			

			
		?>
		
		<div id="breadcrumb" class="section">
				
			<div class="container">

				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header"><a href="index.php">Accueil</a></h3>
						<ul class="breadcrumb-tree">
							<li class="active"><a href="panier.php">/ Mon Panier</a></li>
							<li class="active"><a>Type Livraison</a></li>
						</ul>
					</div>
				</div>

			</div>
				
		</div>
		

		<div class="section md-liv-section">
			
			<div class="container">
				<form action="" method="post">
					<div class="row flex-container md-liv-flex-div">
						<div class="lt-container">
							<div class="mth-container">
								<div class="mth-header">
									Vous êtes au ville de casablanca ?
								</div>
								<div class="mth-image">
								</div>
								<div class="mth-btn">
									<button type="submit" name="c1" id="mthBtn1" class="btn btn-danger blue-idx etapes-btn">Étape Suivant<i class="fa fa-chevron-circle-right"></i></button>
								</div>
							</div>
						</div>
						<div class="rt-container">
							<div class="mth-container">
								<div class="mth-header">
									Vous êtes hors de ville de casablanca ?
								</div>
								<div class="mth-image">
								</div>
								<div class="mth-btn">
									<button type="submit" name="c2" id="mthBtn1" class="btn btn-danger blue-idx etapes-btn">Étape Suivant<i class="fa fa-chevron-circle-right"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="previous-page-btn text-center">
						<button type="submit" name="rtn" id="retourpanierBtn" class="btn btn-dark-red etapes-btn"><i class="fa fa-chevron-circle-left"></i>Retour Au Panier</button>	
					</div>
				</form>
			</div>
			
		</div>
	
		
		<script>
            $(document).ready(function(){
				
				
			});
		</script>
		<?php include_once "includes/footer.php" ?>