<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) || isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
            
      
            class categorie{
                public $con;
                
                function __construct(){
                    global $con;
                    $this->con = $con;
                }
                
                function getCategories(){
                    
                    $result = $this->con->query("SELECT * FROM categorie ORDER BY categorieID");
                    return $result;
                }
                
                function deleteCategorie($idCat){
                    global $con;
                    $result = $con->query("DELETE FROM categorie WHERE categorieID = $idCat");
                    
                }
                
                function echoBadge($active){
                    if($active == 0)
                        return "<label class='badge badge-danger'>Pas Active</label>";
                    else
                        return "<label class='badge badge-success'>Active</label>";
                    return null;
                }
            }
    

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
                      <div class="categories-header" style="display:flex;flex-wrap:nowrap;justify-content:space-between">
                          <h3 class="title">Les Catégories</h3>
                          <button type="button" class="btn btn-dark-blue btn-sm" data-toggle="modal" data-target="#ajouterCategorie"><i class="fas fa-plus-circle"></i>Ajouter Catégorie</button>               
                      </div>
                      <div class="profile-content">
                          <form action="" id="profile" method="post">
                              <div class="row">
                                  <div class="col-md-12">
                                     
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
      else
          header ('location: ajouterproduit.php?admin='.$_SESSION['admin']);
    }
?>