<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="../index.php">Accueil</a></li>
						<?php
							$result = $con->query("SELECT * FROM categorie ORDER BY categorieNom");
							while($row = $result->fetch_row())
							{
								echo '<li><a href="#">'.$row[1].'</a></li>';
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
				})
			});
		</script>
	
