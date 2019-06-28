<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{   
            final class article{
                private $con;
                
                function __construct(){
                    global $con;
                    $this->con = $con;
                }
                
                public function AfficherArtciles(){
                    $result = $this->con->query("SELECT * FROM article");
                    return $result;
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
                     <div class="table-responsive">
                        <table id="produitsTable" class="table table-hover table-bordered">
                            <thead>
                                <tr class="table-primary">
                                    <th>ID</th>
                                    <th>Nom Produit</th>
                                    <th>Description</th>
                                    <th>Couleurs</th>
                                    <th>Prix Initial</th>
                                    <th>Remise Disponible</th>
                                    <th>Prix Avec Remise</th>
                                    <th>Taux Remise</th>
                                    <th>En Stock</th>
                                    <th>Sur Commande</th>
                                    <th>Produit Disponible</th>
                                    <th>Niveau</th>
                                    <th>Categorie</th>
                                    <th>Modifier</th>
                                    <th>Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $article = new article();
                                    $query_res1 = $article->AfficherArtciles();
                                    while($row = $query_res1->fetch_assoc()){
                                        $categorieNom = CategorieNomParID($row['categorieID']);
                                        $couleurs = CouleursArticle($row['articleID']);
                                        ($row['articleDisponible'] == true) ? $articleDisponibe = "oui" : $articleDisponibe = "non";
                                        ($row['remiseDisponible'] == true) ? $remiseDisponible = "oui" : $remiseDisponible = "non";
                                        echo '<tr><td id="articleID">'.$row['articleID'].'</td>';
                                        echo '<td>'.$row['articleNom'].'</td>';
                                        echo '<td>'.$row['articleDescription'].'</td>';
                                        echo '<td>';
                                        if($couleurs != null){
                                            foreach($couleurs as $couleur){ echo $couleur.', '; };
                                        }
                                        else
                                            echo 'N/A';
                                        echo '</td>';
                                        echo '<td>'.$row['articlePrix'].' DHS</td>';
                                        echo '<td>'.$remiseDisponible.'</td>';
                                        if($remiseDisponible == "non"){
                                            echo '<td class="mask-column">N/A</td>';
                                            echo '<td class="mask-column">N/A</td>';
                                        }
                                        else{
                                            echo '<td>'.$row['articlePrixRemise'].' DHS</td>';
                                            echo '<td>'.$row['tauxRemise'].'%</td>';
                                        } 
                                        echo '<td>'.$row['unitesEnStock'].'</td>';
                                        echo '<td>'.$row['unitesSurCommande'].'</td>';
                                        echo '<td>'.$articleDisponibe.'</td>';
                                        echo '<td>';
                                        $count = $row['niveau'];
                                        for($i=0;$i<$count;$i++){
                                            echo '<i class="fas fa-star"></i>';
                                        }
                                        echo '</td>';
                                        echo '<td>'.$categorieNom.'</td>';
                                        echo '<td><button type="button" id="btnModifier" class="btn btn-blue btn-column-icon"><i class="fas fa-edit icon-colonne"></i></button></td>';
                                        echo '<td><button id="btnSupprimer" type="button" class="btn btn-red btn-column-icon" data-toggle="modal" data-target="#messageSuppresion"><i class="fas fa-trash icon-colonne"></i></button></td>';
                                        echo '</tr>';
                                    }
                                  ?>
                            </tbody>
                            <?php echo "<input type='hidden' id='HSV' value='".$_SESSION['admin']."'/>" ?>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <div class="modal fade" id="messageSuppresion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h5>Vous voulez vraiment supprimer ce produit ?</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                <button id="btnSupprimerDialog" type="button" class="btn btn-light btn-red">Supprimer ce produit</button>
              </div>
            </div>
          </div>
        </div>
        
        <script>
            
            $(document).ready(function(){
                
                var values = [];
                
                $(document).on("click","#btnSupprimer",function(){
                    values = [];
                    var articleID = $(this).closest("tr").children("#articleID").html();
                    values.push(articleID);
                    
                });
                
                $("#btnSupprimerDialog").click(function(e){
                    $.ajax({
                        url: '../public-includes/ajax_queries.php',
                        method: 'POST',
                        data: {function: "SupprimerArticle", articleID: values[0]},
                        success: function(data){
                            (data == true) ? $("#produitsTable").load(" #produitsTable") : null;
                            $("button[data-dismiss]").click();
                        }
                        
                    }); 
                });
                
                
                $(document).on("click","#btnModifier",function(){
                    var admin  = $("#HSV").val();
                    var id = $(this).closest("tr").children("#articleID").html();              
                    window.location.href = "produit.php?admin="+admin+"&edit="+id;
               });

            });
            
            
        </script>
                    
        
    <?php require_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: produits.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>