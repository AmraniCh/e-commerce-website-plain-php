<?php include_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{   
            foreach(glob("../temp/*.*") as $filename)
            {
                unlink('../temp/'.$filename);
            }
            
                        
            if(isset($_GET['edit']))
            {
                $categorie = new Categorie();
                $articleID = $_GET['edit'];
                
                $article = new Article();
                $couleurs = $article->CouleursArticle($articleID);
                
                $query = $con->query("SELECT *
							FROM article 
							WHERE articleID = $articleID");
                
                while($row = $query->fetch_assoc())
                {
                    $articleNom = $row['articleNom'];
                    $articleDescription = $row['articleDescription'];
                    $articleMarque = $row['articleMarque'];
                    $categorieNom = $categorie->CategorieNomParID($row['categorieID']);
                    $categorieID = $row['categorieID'];
                    $articlePrix = $row['articlePrix'];
                    $unitesEnStock = $row['unitesEnStock'];
                    $articleDisponible = $row['articleDisponible'];
                    $remiseDisponible = $row['remiseDisponible'];
                    $tauxRemise = $row['tauxRemise'];
                    $articlePrixRemise = $row['articlePrixRemise'];
                }
                
                

            }                                       
                                                    

  ?>
  <div class="container-scroller">
  
    <?php include_once 'includes/navigation.php' ?>
  
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <?php include_once 'includes/sidebar.php' ?>
      
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
                          <form action="" method="post">
                            <div class="flex-container" style="display:flex">
                                <div class="left-flex-container col-md-6">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nom de produit :</label>
                                            <input id="nomPr" name="nomPr" type="text" class="form-control" placeholder="Le nom de produit" value="<?php if(isset($_GET['edit'])) echo $articleNom ?>">
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="nomPr_error_msg" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description :</label>
                                            <textarea id="descPr" name="descPr" class="form-control" rows="4"><?php if(isset($_GET['edit'])) echo $articleDescription ?></textarea>
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="descPr_error_msg" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Marque :</label>
                                            <input id="marque" name="marque" type="text" class="form-control" placeholder="Entrez la marque de produit si possible ! Ex: 'Sony'" value="<?php if(isset($_GET['edit'])) echo $articleMarque ?>">
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small id="marquePr_error_msg" class="form-text text-muted"></small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="inline-label">Categorie :</label>
                                            <select name="categorie" id="categorie" class="form-control inline-select">
                                                <?php 
                                                    $categorie = new Categorie();
                                                    $resultat = $categorie->AfficherCategories();
                                                    while($row = $resultat->fetch_assoc())
                                                    {
                                                        if(isset($_GET['edit'])){
                                                            if($row['categorieID'] == $categorieID)
                                                                echo '<option value="'.$row['categorieID'].'" selected>'.$row['categorieNom'].'</option>';
                                                            else
                                                               echo '<option value="'.$row['categorieID'].'">'.$row['categorieNom'].'</option>'; 
                                                        }
                                                        else
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
                                                <input type="text" id="prixPr" class="form-control font-large-input" placeholder="Prix initial" value="<?php if(isset($_GET['edit'])) echo $articlePrix ?>">
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
                                            <input type="text" name="unitesStock" id="unitesStock" class="form-control mini-input inline-input-group" placeholder="Ex: 100" value="<?php if(isset($_GET['edit'])) echo $unitesEnStock ?>">
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
                                            <label>Ce produit est disponible maintenant ?</label><br>

                                            <div class="form-radio form-in-blk col-md-3">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="radioDis" id="radioDisOui" <?php if(isset($_GET['edit'])) 
                                            { 
                                                if($articleDisponible == true) 
                                                    echo 'checked';
                                            }
                                            else 
                                                echo 'checked' ?>> Oui
                                                    <i class="input-helper"></i></label>
                                            </div>


                                            <div class="form-radio form-in-blk col-md-3">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="radioDis" id="radioDisNon" <?php
                                                if(isset($_GET['edit'])) 
                                            { 
                                                if($articleDisponible == false) 
                                                    echo 'checked';
                                            }?>> Non
                                                    <i class="input-helper"></i></label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Remise disponible ?</label><br>

                                            <div class="form-radio form-in-blk col-md-3">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="radioRemise" id="radioRemOui" <?php if(isset($_GET['edit'])) 
                                                                        { 
                                                                            if($remiseDisponible == true) 
                                                                                echo 'checked';
                                                                        }?>> Oui
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>


                                            <div class="form-radio form-in-blk col-md-3">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="radioRemise" id="radioRemNon" <?php if(isset($_GET['edit'])) 
                                                                        { 
                                                                            if($remiseDisponible == false) 
                                                                                echo 'checked';
                                                                        }
                                                                        else 
                                                                            echo 'checked' ?>> Non
                                                    <i class="input-helper"></i>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <div class="input-group inline-input-group">
                                                <label class="inline-label">Taux de remise :</label>
                                                <input type="text" name="taux" id="taux" class="form-control mini-input inline-input-group font-large-input" placeholder="Ex: 20%" disabled value="<?php if(isset($_GET['edit'])) echo $tauxRemise ?>">
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
                                                    <input id="prixFinal" type="text" class="form-control font-large-input" placeholder="0" disabled value="<?php if(isset($_GET['edit'])) echo $articlePrixRemise ?>">
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
                                            <label>Les couleurs disponibles :</label>
                                            <input type="text" id="couleurPr" class="form-control" placeholder="rouge, blue, blanc ..." value="<?php 
                                                    if(isset($_GET['edit'])){
                                                        if($couleurs[0] != null){
                                                            foreach($couleurs as $couleur){
                                                                echo $couleur.', ';
                                                            }
                                                        }
                                                        else 
                                                            echo 'N/A';
                                                    }
                                                ?>">
                                            <div class="container" style="padding:0;text-align:left;margin:0;">
                                                <small class="form-text text-muted">Séparer les couleur avec des virgules (,)</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                         <div class="photos-container">
                                             <label style="display:block">Ajouter des photos pour le produit ici :</label>
                                             <div class="add-photos-canvas col-xs-6">
                                                 <div class="form-group">
                                                     <label for="photoPr">
                                                         <img src="images/plus.png" class="img-responsive img-upload">
                                                     </label>
                                                     <input id="photoPr" name="files[]" type="file" multiple>
                                                 </div>
                                             </div>
                                             <form id="images_form" action="" method="post">
                                             <?php 
                                                if(isset($_GET['edit'])){
                                                    
                                                    $query = $con->query("SELECT * 
                                                                        FROM imagearticle 
                                                                        WHERE articleID = $articleID");
                                                    
                                                    while($row = $query->fetch_row()){
                                                        
                                                        if($row[2] == 1)
                                                            $class = 'class="photo-produit col-xs-6 col-sm-6 col-md-4 col-lg-6 selected-image"';
                                                        else
                                                            $class = 'class="photo-produit col-xs-6 col-sm-6 col-md-4 col-lg-6"';
                                                        
                                                        echo '<div '.$class.' style="background-image: url(../uploaded/articles-images/'.$row[0].');background-size: contain;background-repeat: no-repeat;background-position:center"><div class="supp-image"><button type="button" class="ovr-button-styles supp-image-btn"><i class="fa fa-times-circle"></i></button></div></div>';
                                                    }
                                                }
                                             ?>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-center">
                                    <?php
                                        if(isset($_GET['edit']))
                                            echo '<button id="btnModifier" type="submit" class="btn btn-blue">Modifier Produit</button>';
                                        else
                                            echo '<button id="btnAjouter" type="submit" class="btn btn-blue">Ajouter Produit</button>';
                                    ?>
                                </div>
                            </div>
                            <input type="hidden" id="articleID" value="<?php if(isset($_GET['edit'])) echo $articleID ?>">
                            <?php echo "<input type='hidden' id='HSV' value='".$_SESSION['admin']."'/>" ?>
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
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="messageModification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h5>Produit modifié avec success !</h5>
              </div>
            </div>
          </div>
        </div>
        
           <script>
            $(document).ready(function(){
                
                $(document).on("click", ".photo-produit", function(){
                    $(".selected-image").each(function(){
                       $(this).removeClass("selected-image"); 
                    });
          
                    $(this).addClass("selected-image"); 
                });
                
                $(document).on("click", ".supp-image-btn", function(){
                   
                    var imageNom = image_nom($(this).closest(".photo-produit"));    
                    
                    var $this = $(this);
                    $.post(
                        "../public-includes/ajax_queries",
                        { 
                            function: "SupprimerImageArticle",
                            imageNom: imageNom
                        },
                        function(data){
                            $this.closest(".photo-produit").remove();
                        },
                        "JSON"
                    );
                    
                });

                CalculerPrixFinal();
                
                function CalculerPrixInitial(){
                    var prixIn = $("#prixPr").val();
                    var taux = $("#taux").val();
                    if(taux != null && taux != ""){
                        return prixIn - prixIn * taux * 0.01;
                    }
                    else // première check
                        return prixIn;
                    return null;
                }
                
                function CalculerPrixFinal(){
                    if($("input[name='radioRemise']:checked").attr("id") == "radioRemOui"){
                        $("#taux").prop("disabled",false); 
                        $("#prixFinal").val(CalculerPrixInitial());
                    }
                    else{
                        $("#taux").prop("disabled",true);
                        var prixIn = $("#prixPr").val();
                        $("#prixFinal").val(prixIn);
                    }
                }
                
                $("#prixPr, #taux, input[name='radioRemise']").on("input",function(){      
                    CalculerPrixFinal();
                });
                
                $(document).on("change", "#photoPr", function(){
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
                            $(".photo-produit:first").addClass("selected-image");
                        }
                   });
               });
                
                $(document).on("click","#btnAjouter, #btnModifier",function(e){
                    e.preventDefault();
                    
                    var nomPr = $("#nomPr").val();
                    var descPr = $("#descPr").val();
                    var marquePr = $("#marque").val();
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
                    
                    var selected_image_name = image_nom($(".selected-image"));
                    
                    if($(this).attr("id") == "btnAjouter"){
                        
                        $.ajax({
                           url: '../public-includes/ajax_queries',
                            method: "POST",
                            dataType: "JSON",
                            data: { 
                                function: "AjouterArticle", 
                                imagePrincipal: selected_image_name,
                                couleurs: couleurs, 
                                articleNom: nomPr, 
                                articlePrix: prixPr, 
                                articlePrixRemise: prixFinal, 
                                artcileDescription: descPr, 
                                articleMarque: marquePr, 
                                tauxRemise: taux, 
                                remiseDisponible: remiseDisponible, 
                                unitesEnStock: unitesStock, 
                                articleDisponible: articleDisponible, 
                                categorieID: categorieID
                            },
                            success: function(data){
                                if(data != null){
                                    $('#messageAjoute').modal('toggle');
                                    var admin  = $("#HSV").val();
                                    setTimeout(function(){
                                       $(location).attr("href", "produits.php?admin="+admin); 
                                    }, 600);
                                }
                            }
                        });
                    }
                    
                    if($(this).attr("id") == "btnModifier"){
                        
                        var images_names = [];
                        
                        $(".photo-produit").each(function(){
                            images_names.push(image_nom($(this)));
                        });
                        
                        var articleID = $("#articleID").val();
                        
                        $.ajax({
                           url: '../public-includes/ajax_queries.php',
                            method: "POST",
                            dataType: "JSON",
                            data: { 
                                function: "ModifierArticle", 
                                imagePrincipal: selected_image_name,
                                imagesNoms: images_names,
                                couleurs: couleurs, 
                                articleID: articleID, 
                                articleNom: nomPr, 
                                articlePrix: prixPr, 
                                articlePrixRemise: prixFinal,
                                artcileDescription: descPr,
                                articleMarque: marquePr,
                                tauxRemise: taux,
                                remiseDisponible: remiseDisponible,
                                unitesEnStock: unitesStock,
                                articleDisponible: articleDisponible,
                                categorieID: categorieID
                            },
                            success: function(data){
                                if(data != null){
                                    $('#messageModification').modal('toggle');
                                    var admin  = $("#HSV").val();
                                    setTimeout(function(){
                                       $(location).attr("href", "produits.php?admin="+admin); 
                                    }, 600);
                                }
                            }
                        });
                    }
                    
                });
                
                function image_nom(ele){
                    if(ele != null){
                        var array = ele.css("background-image").split("/");
                        var filter = array[array.length - 1];
                        var name = filter.substr(0, filter.length - 2);

                        return name;
                    }
                    return null;
                }
            });
        </script>
                    
        
    <?php include_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: produit.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>