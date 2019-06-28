  <?php 
      $result = mysqli_query($con,"SELECT * FROM admin WHERE adminName = '".$_SESSION['admin']."'");
      if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        $role = $row['role'];
        
  ?>
    <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="images/faces/face1.jpg" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?php echo $prenom.' '.$nom ?></p>
                  <div>
                    <small class="designation text-muted"><?php echo $role ?></small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-red btn-block">Nouveau Produit
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?admin=<?php echo $_SESSION['admin'] ?>">
              <i class="menu-icon mdi mdi-view-dashboard"></i>
              <span class="menu-title">Accueil</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon fab fa-product-hunt"></i>
              <span class="menu-title">Les Produits</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="produit.php?admin=<?php echo $_SESSION['admin']?>">Ajouter Produit</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="produits.php?admin=<?php echo $_SESSION['admin'] ?>">Afficher Les Produits</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="categories.php?admin=<?php echo $_SESSION['admin'] ?>">
              <i class="menu-icon fas fa-th-large"></i>
              <span class="menu-title">Les Catégories</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
              <i class="menu-icon fas fa-truck"></i>
              <span class="menu-title">Les Ordres</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
              <i class="menu-icon fas fa-users"></i>
              <span class="menu-title">Clients</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/icons/font-awesome.html">
              <i class="menu-icon fas fa-history"></i>
              <span class="menu-title">Historique de Livraison</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon fas fa-cog"></i>
              <span class="menu-title">Administration</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="profile.php?admin=<?php echo $_SESSION['admin']?>">Paramètres du compte</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <?php
        
      }
      ?>