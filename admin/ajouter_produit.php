<?php require_once 'includes/header.php' ?>



 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{ 
            // regénérer (random prefix file)
            $_SESSION['randomPrefix'] = rand(1111,9999);   // utilisé pour la fonction ajouter article
            
            final class article{
                private $con;
                
                function __construct(){
                    global $con;
                    $this->con = $con;
                }
                
                public function afficherCategories(){
                    $result = $this->con->query("SELECT * FROM categorie");
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
                      <div class="categories-header" style="display:flex;flex-wrap:nowrap;justify-content:space-between">
                          <h3 class="title">Ajouter Produit</h3>             
                      </div>
                      <div class="profile-content">
                          <form id="ajouterArtcileForm" onsubmit="return validation()" action="" method="post">
                            <div class="flex-container" style="display:flex">
                                <div class="left-flex-container col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nom de produit :</label>
                                            <input id="nomPr" name="nomPr" type="text" class="form-control" placeholder="Le nom de produit">
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="nomPr_error_msg" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description :</label>
                                            <textarea id="descPr" name="descPr" class="form-control" rows="4"></textarea>
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="descPr_error_msg" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="inline-label">Categorie :</label>
                                            <select name="categorie" id="categorie" class="form-control inline-select">
                                                <?php 
                                                    $article = new article();
                                                    $resultat = $article->afficherCategories();
                                                    while($row = $resultat->fetch_assoc())
                                                    {
                                                        echo '<option value="'.$row['categorieID'].'">'.$row['categorieNom'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group inline-input-group">
                                                <label class="inline-label">Prix initial :</label>
                                                <div class="input-group-prepend prepend-inline">
                                                    <span class="input-group-text prepend-text">$</span>
                                                </div>
                                                <input type="text" id="prixPr" class="form-control font-large-input" placeholder="Prix initial">
                                                <div class="input-group-append">
                                                    <span class="input-group-text append-text">DHS</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="input-group inline-input-group">
                                            <label class="inline-label">Unités en stock :</label>
                                            <input type="text" name="unitesStock" id="unitesStock" class="form-control mini-input inline-input-group" placeholder="Ex: 100">
                                            <div class="input-group-append">
                                                    <span class="input-group-text append-text">Un</span>
                                            </div>
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="unitesStock_error_msg" class="form-text text-muted"></small>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Ce produit est disponible maintenant?</label><br>
                                            <input type="radio" id="radioDisOui" name="radioDis" class="form-control" checked><label class="radio-label" for="radioDisOui">Oui</label>
                                            <input type="radio" id="radioDisNon" name="radioDis" class="form-control"><label class="radio-label" for="radioDisNon">Non</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remise disponible ?</label><br>
                                            <input type="radio" id="radioRemOui" name="radioRemise" class="form-control"><label class="radio-label" for="radioDisOui">Oui</label>
                                            <input type="radio" id="radioRemNon" name="radioRemise" class="form-control" checked><label class="radio-label" for="radioDisNon">Non</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="input-group inline-input-group">
                                                <label class="inline-label">Taux de remise :</label>
                                                <input type="text" name="taux" id="taux" class="form-control mini-input inline-input-group font-large-input" placeholder="Ex: 20%" disabled>
                                                <div class="input-group-append">
                                                        <span class="input-group-text append-text">%</span>
                                                </div>
                                                <div class="container" style="padding:0;text-align:left;margin:0;">
                                                    <small id="taux_error_msg" class="form-text text-muted"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group inline-input-group">
                                                    <label class="inline-label">Prix final :</label>
                                                    <div class="input-group-prepend prepend-inline">
                                                        <span class="input-group-text prepend-text">$</span>
                                                    </div>
                                                    <input id="prixFinal" type="text" class="form-control font-large-input" placeholder="0" disabled>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text append-text">DHS</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="right-flex-container col-md-6">
                                   <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label>Les couleurs disponibles du produits :</label>
                                                <input type="text" id="couleurPr" class="form-control block-input" placeholder="rouge, blue, blanc ...">
                                                <div class="container" style="padding:0;text-align:left;margin:0;">
                                                    <small class="form-text text-muted">Séparer les couleur avec des virgules (,)</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="photos-container" style="max-width:100%;width:100%">
                                             <label style="display:block">Ajouter des photos pour le produit ici :</label>
                                             <div class="add-photos-canvas col-xs-6" style="display:inline-block">
                                                 <div class="form-group">
                                                     <label for="photoPr">
                                                         <img src="plus.png" class="img-responsive img-upload" style="cursor:pointer;border-radius:10px">
                                                     </label>
                                                     <input id="photoPr" name="files[]" type="file" multiple style="display:none">
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-blue">Ajouter Produit</button>
                                </div>
                            </div>
                          </form>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        <!-- content-wrapper ends -->
        <div class="modal fade" id="messageAjoute" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h5>Produit ajouté avec success !</h5>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light btn-red" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Ok</button>

              </div>
            </div>
          </div>
        </div>
        
           <script>
            $(document).ready(function(){
                
                function CalculerPrix(){
                    var prixIn = $("#prixPr").val();
                    var taux = $("#taux").val();
                    if(taux != null && taux != ""){
                        return prixIn - prixIn * taux * 0.01;
                    }
                    else // première check
                        return prixIn;
                    return null;
                }
                
                $("#prixPr, #taux, input[name='radioRemise']").on("input",function(){
                    
                    if($("input[name='radioRemise']:checked").attr("id") == "radioRemOui"){
                        $("#taux").prop("disabled",false); 
                        $("#prixFinal").val(CalculerPrix());
                    }
                    else{
        
                        $("#taux").prop("disabled",true);
                        var prixIn = $("#prixPr").val();
                        $("#prixFinal").val(prixIn);
                    }
                    
                
                });
                
               $(document).on("change","#photoPr",function(){
                   var formData = new FormData();
                   
                   [].forEach.call(this.files, function (file) {
                        formData.append('files[]', file);
                    });
                   formData.append('function','uploadMutiplePhotos');
                   $.ajax({
                        url: '../public-includes/ajax_queries.php',
                        method: "POST",
                       data: formData,
                        contentType: false,
                        processData: false,
                        success: function(data){
                            $(".photos-container").append(data);
                        }
                   });
               });
                

                $(document).on("submit","#ajouterArtcileForm",function(e){
                    e.preventDefault();
                    
                    var nomPr = $("#nomPr").val();
                    var descPr = $("#descPr").val();
                    var categorieID = $("#categorie option:selected").val();
                    var prixPr = $("#prixPr").val();
                    var unitesStock = $("#unitesStock").val();
                    var taux = "default";
                    var prixFinal = "default";
                    var remiseDisponible = 0;
                    if($("input[name='radioRemise']:checked").attr("id") == "radioRemOui")
                    {
                        var remiseDisponible = 1;
                        var taux = $("#taux").val();
                        var prixFinal = $("#prixFinal").val();
                    }
                    
                    if($("input[name='radioDis']:checked").attr("id") == "radioDisOui")
                        var articleDisponible = 1;
                    else
                        var articleDisponible = 0;
                    
                    var couleurs = $("#couleurPr").val();
                    
                    $.ajax({
                       url: '../public-includes/ajax_queries.php',
                        method: "POST",
                        data: { function: "AjouterArtcile", couleurs: couleurs, artcileNom: nomPr, articlePrix: prixPr, articlePrixRemise: prixFinal, artcileDescription: descPr, tauxRemise: taux, remiseDisponible: remiseDisponible, unitesEnStock: unitesStock, articleDisponible: articleDisponible, categorieID: categorieID},
                        success: function(data){
                            $("body").append(data);
                            alert(data);
                        }
                    });
                });
            });
        </script>
                    
        
    <?php require_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: ajouterproduit.php?admin='.$_SESSION['admin']);
    }
?>