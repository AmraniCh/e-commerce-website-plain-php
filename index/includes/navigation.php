<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<?php
							if(isset($_GET['categorie']))
								echo '<li><a href="index.php">Accueil</a></li>';
							else 
								echo '<li class="active"><a href="index.php" >Accueil</a></li>';
							$result = $con->query("SELECT * FROM categorie ORDER BY categorieNom");
							while($row = $result->fetch_row())
							{
								if(isset($_GET['categorie']))
								{
									$categorie = $_GET['categorie']; 
									if($row[0] == $categorie){
										echo '<li class="active"><a href="menu.php?categorie='.$row[0].'">'.$row[1].'</a></li>';
									}
									else
										echo '<li><a  href="menu.php?categorie='.$row[0].'">'.$row[1].'</a></li>';
								}
								else
									echo '<li><a href="menu.php?categorie='.$row[0].'">'.$row[1].'</a></li>';
							}
						?>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
		<script>
			$(document).ready(function(){
				// Mobile Nav toggle
				$('.menu-toggle > a').on('click', function (e) {
					e.preventDefault();
					$('#responsive-nav').toggleClass('active');
				});
			});
		</script>
		
		<!-- full container -->
		<div class="full-container">
