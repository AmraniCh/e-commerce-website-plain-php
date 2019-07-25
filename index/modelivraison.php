<?php include_once "includes/panierheader.php" ?>
		
		<?php
			
			if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID']) || !isset($_SESSION['panier'])):
				header('Location: ../login.php');
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

			
		?>

		<!-- SECTION -->
		<div class="section" style="padding-top:90px;padding-bottom:70px">
			<!-- container -->
			<div class="container">
				<div class="row flex-container" style="display:flex;justify-content:space-between">
                    <div class="lt-container">
                   		<div class="mth-container">
                   			<div class="mth-header">
                   				Vous etes au ville de case ?
                   			</div>
                   			<div class="mth-image" style="background-image:url('img/Livraison-Gratuite-175x219@2x.png');">
                   				
                   			</div>
                   			<div class="mth-btn">
                   				<button type="button" id="mthBtn1" class="btn btn-danger btn-blue">Choisir</button>
                   			</div>
                   		</div>
					</div>
               		<div class="rt-container">
                   		<div class="mth-container">
                   			<div class="mth-header">
                   				Vous etes Hors de ville de case ?
                   			</div>
                   			<div class="mth-image" style="background-image:url('img/icon_amana.png');">
                   			</div>
                   			<form action="" method="post">
                   			<div class="mth-btn">
                   				<button type="button" id="mthBtn1" class="btn btn-danger btn-blue">Choisir</button>
                   			</div>
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
				
				
			});
		</script>
		<?php include_once "includes/footer.php" ?>