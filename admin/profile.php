<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
            if(isset($_POST['submit']))
            {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $motdepasse = $_POST['motdepasse'];
                $con->query("UPDATE admin SET nom = '$nom', prenom = '$prenom', motdepasse = '$motdepasse'");
                
            }
            
            
            $result = mysqli_query($con,"SELECT * FROM admin WHERE adminName = '".$_SESSION['admin']."'");
            if(mysqli_num_rows($result)>0){
                $row = mysqli_fetch_assoc($result);
                $adminame = $row['adminName'];
                $prenom = $row['prenom'];
                $nom = $row['nom'];
                $role = $row['role'];
                $motdepasse = $row['motdepasse'];
  ?>
  <div class="container-scroller">
  
    <?php require_once 'includes/navigation.php' ?>
  
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <?php require_once 'includes/sidebar.php' ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="header">
                          <h3 class="title">Edit Profile</h3>
                      </div>
                      <div class="profile-content">
                          <form action="profile.php?admin=<?php   ?>" id="profile" method="post">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="form-group">
                                          <label>Nom d'utilisateur</label>
                                          <input id="adminame" name="adminame" type="text" class="form-control" disabled value="<?php echo $adminame ?>">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Prénom</label>
                                          <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom" value="<?php echo $prenom ?>">
                                          <div class="container" style="padding:0;text-align:left;margin:0;">
                                              <small id="nom_error_msg" class="form-text text-muted"></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Nom</label>
                                          <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" value="<?php echo $nom ?>">
                                          <div class="container" style="padding:0;text-align:left;margin:0;">
                                              <small id="prenom_error_msg" class="form-text text-muted"></small>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Mot de passe</label>
                                          <input type="password" name="motdepasse" class="form-control" placeholder="Mot de passe" value="<?php echo $motdepasse ?>">
                                          <div class="container" style="padding:0;text-align:left;margin:0;">
                                              <small id="pass_error_msg" class="form-text text-muted"></small>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Role</label>
                                          <select name="role" class="form-control form-control-lg" style="width:100%;display:block">
                                             <option value="administrateur"<?php if($role == 'adminitrateur') echo 'selected' ?>>administrateur</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                 <div class="col-md-12">
                                      <div class="text-center">
                                            <button type="submit" name="submit" class="btn btn-blue">Enregistrer les modifications</button>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        <!-- content-wrapper ends -->
        
    <?php require_once 'includes/footer.php' ?>
<?php
            }
        }
      else
          header ('location: profile.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>