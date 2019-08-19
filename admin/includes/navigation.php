<?php
      $query = mysqli_query($con,"SELECT * FROM admin WHERE adminName = '".$_SESSION['admin']."'");
      if($query->num_rows > 0){
        $row = $query->fetch_assoc();
        $prenom = $row['prenom'];
        $nom = $row['nom'];
        
        
        
        
?>
  
  
   <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="../index/">
          <img src="../index/img/logo.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html">
          <img src="images/logo-mini.svg" alt="logo" />
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
          
          
          
          <li class="nav-item dropdown notification-li">
            <a class="nav-link count-indicator dropdown-toggle" href="#">
              <i class="mdi mdi-bell"></i>
              <span class="count not-count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list notification-ctr">
              <a class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">Vous avez <span class="not-count"></span> nouvelle(s) notification(s)
                </p>
                  <span class="badge badge-pill badge-warning float-right">Afficher tous</span>
              </a>

            </div>
          </li>
          
          
          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text">Bienvenue, <?php echo $prenom.' '.$nom ?></span>
              <img class="img-xs rounded-circle" src="images/boss.png" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
              </a>
              <a class="dropdown-item mt-2" href="profile.php?admin=<?php echo $_SESSION['admin'] ?>">
                Mon Profil
              </a>
              <a class="dropdown-item" href="includes/logout.php">
                Déconnecter
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
      <input type="hidden" name="HSV" value="<?php echo $_SESSION['admin'] ?>">
    </nav>
    <?php
      }
    ?>