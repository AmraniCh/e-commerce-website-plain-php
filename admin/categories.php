<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
            
      
            final class categorie{
                private $con;
                
                function __construct(){
                    global $con;
                    $this->con = $con;
                }
                
                public function AfficherCategories(){ 
                    $result = $this->con->query("SELECT * FROM categorie ORDER BY categorieID");
                    return $result;
                }
                
                public function echoBadge($active){
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
                                     <div class="table-responsive">
                                          <table class="table table-hover categories-table">
                                              <thead>
                                                  <tr>
                                                      <th>ID</th>
                                                      <th>Nom Catégorie</th>
                                                      <th>Description</th>
                                                      <th>Status</th>
                                                      <th class="font-awsome-large"><i class="fas fa-edit"></i></th>
                                                      <th class="font-awsome-large"><i class="fas fa-trash"></i></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                 <?php 
                                                    $categorie = new categorie();
                                                    $result = $categorie->AfficherCategories();
                                                    while($row = $result->fetch_row()){
                                                        $badge = $categorie->echoBadge($row[3]);
                                                        echo '<tr><td class="id" id="'.$row[0].'">'.$row[0].'</td>';
                                                        echo '<td class="nom">'.$row[1].'</td>';
                                                        echo '<td class="description">'.$row[2].'</td>';
                                                        echo '<td class="active" id='.$row[3].'>'.$badge.'</td>';
                                                        echo '<td><button type="button" class="btn btn-blue btn-update-dialog open-dialog" data-toggle="modal" data-target="#modifierCategorie">Modifier</button></td>';
                                                        echo '<td><button type="button" class="btn btn-red open-dialog" data-toggle="modal" data-target="#suppressionCategorie">Supprimer</button></td>';
                                                        echo '</tr>';
                                                    }
                                                ?>                                  
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
        <!-- content-wrapper ends -->
        
        <div class="modal fade" id="suppressionCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Vous Voulez Vraiment Supprimé Cette Categorie ?
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Non, merci</button>
                    <button type="button" class="btn btn-red btn-delete-cat">Oui</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="ajouterCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une Catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <label class="label">Catégorie Nom :</label>
                        <div class="input-group">
                            <input type="text" id="nomCatAdd" class="form-control" placeholder="Catégore Nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Catégorie Déscription :</label>
                        <div class="input-group">
                            <input type="text" id="descCatAdd" class="form-control" placeholder="Catégore Déscription">
                        </div>
                    </div>
                    <div class="form-group">
                       <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" id="activeAdd" class="form-check-input" checked> Active
                            </label>
                          </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button type="button" class="btn btn-red btn-add-cat">Ajouter Catégorie</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
       
       
       <div class="modal fade" id="modifierCategorie" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une Catégorie</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <label class="label">Catégorie Nom :</label>
                        <div class="input-group">
                            <input type="text" id="nomCatUpdate" class="form-control" placeholder="Catégore Nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Catégorie Déscription :</label>
                        <div class="input-group">
                            <input type="text" id="descCatUpdate" class="form-control" placeholder="Catégore Déscription">
                        </div>
                    </div>
                    <div class="form-group">
                       <div class="form-check">
                            <label class="form-check-label">
                              <input type="checkbox" id="activeUpdate" class="form-check-input" checked> Active
                            </label>
                          </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button type="button" class="btn btn-red btn-update-cat">Mise à jour</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
    <script>
        $(document).ready(function(){
            var values = [];
            
            $(document).on("click", ".open-dialog", function() {
                values = [];
                var idCat = $(this).closest("tr").children(".id").html();
                var nomCat = $(this).closest("tr").children(".nom").html();
                var descCat = $(this).closest("tr").children(".description").html();
                var active = $(this).closest("tr").children(".active").attr("id");
            
                
                values.push(idCat,nomCat,descCat,active);
            });
            
            $(document).on("click", ".btn-delete-cat", function () {
                var idCat = values[0];
                $.ajax({
                    url: '../public-includes/ajax_queries.php',
                    type: "POST",
                    data: {function: "SupprimerCategorie", idCat: idCat},
                    success: function()
                    {
                        $(".categories-table").load(" .categories-table");
                        $(".close").click();
                    }
                });
            });
            
            $(document).on("click", ".btn-add-cat", function () {
                var nomCat = $("#nomCatAdd").val();
                var descCat = $("#descCatAdd").val();
                var active = $("#activeAdd").prop("checked");
        
                $.ajax({
                    url: '../public-includes/ajax_queries.php',
                    type: "POST",
                    data: {function: "AjouterCategorie", nomCat: nomCat, descCat: descCat, active: active},
                    success: function()
                    {
                        $(".categories-table").load(" .categories-table");
                        $(".close").click();
                    }
                });
            });
            
            $(document).on("click",".btn-update-cat",function(){
                var nomCat = $("#nomCatUpdate").val();
                var descCat = $("#descCatUpdate").val();
                var active = $("#activeUpdate").prop("checked");
                $.ajax({
                    url: '../public-includes/ajax_queries.php',
                    type: "POST",
                    data: {function: "MiseCategorie", idCat: values[0], nomCat: nomCat, descCat: descCat, active: active},
                    success: function()
                    {
                        $(".categories-table").load(" .categories-table");
                        $(".close").click();
                    }
                });
            });
            
            $(document).on("click",".btn-update-dialog",function(){
                setDialogInputs();
            });

            function setDialogInputs(){
              $("#nomCatUpdate").val(values[1]);
                $("#descCatUpdate").val(values[2]);
                if(values[3] == 0)
                    $("#activeUpdate").prop("checked", false);
                else
                    $("#activeUpdate").prop("checked", true);
            }
        });
                        
    </script>
        
    <?php require_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: categories.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>