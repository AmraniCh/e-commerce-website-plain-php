<?php include_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{    

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
                      <div class="categories-header header-adm">
                          <h3 class="title">Les Catégories</h3>
                          <button type="button" class="btn btn-dark-blue btn-sm" data-toggle="modal" data-target="#ajouterCategorie"><i class="fas fa-plus-circle"></i>Ajouter Catégorie</button>               
                      </div>
                      <div class="profile-content">
                          <form action="" id="profile" method="post">
                              <div class="row">
                                  <div class="col-md-12">
                                     <div class="table-responsive">
                                          <table id="dt_categories" class="table table-hover categories-table">
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
                    <form id="ajtCat_form">
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
                    </form>
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
                
                dataTableInitialize();
                
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
                        dataType: "JSON",
                        data: {
                            function: "SupprimerCategorie", 
                            idCat: idCat
                        },
                        async: false,
                        success: function(data){
                            if(data != null){
                                dataTableInitialize();
                                $(".close").click();
                            }
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
                        dataType: "JSON",
                        data: {
                            function: "AjouterCategorie", 
                            nomCat: nomCat, 
                            descCat: descCat, 
                            active: active
                        },
                        async: false,
                        success: function(data)
                        {
                            if(data != null){
                                dataTableInitialize();
                                $("#ajtCat_form")[0].reset();
                                $(".close").click();
                            }
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
                        dataType: "JSON",
                        data: {
                            function: "MiseCategorie", 
                            idCat: values[0], 
                            nomCat: nomCat, 
                            descCat: descCat, 
                            active: active
                        },
                        async: false,
                        success: function(data)
                        {
                            if(data != null){
                                dataTableInitialize();
                                $(".close").click();
                            }
                        }
                    });
                });

                $(document).on("click",".btn-update-dialog",function(){
                   
                    $("#nomCatUpdate").val(values[1]);

                    $("#descCatUpdate").val(values[2]);
                    if(values[3] == "false")
                        $("#activeUpdate").prop("checked", false);
                    else
                        $("#activeUpdate").prop("checked", true);
                    
                });
                
            });
        
            function dataTableInitialize(){
                $('#dt_categories').dataTable({
                    destroy: true,
                    "order":[[1, "asc"]],
                    "pagingType": "simple_numbers",
                    "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "Tous"] ],
                    "language": {
                        "sProcessing": "Traitement en cours ...",
                        "sLengthMenu": "Afficher _MENU_ lignes",
                        "sZeroRecords": "Aucun résultat trouvé",
                        "sEmptyTable": "Aucune donnée disponible",
                        "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                        "sInfoEmpty": "Aucune ligne affichée",
                        "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                        "sInfoPostFix": "",
                        "sSearch": "Chercher:",
                        "sUrl": "",
                        "sInfoThousands": ",",
                        "oPaginate": {
                            "sFirst": "Premier",
                            "sLast": "Dernier",
                            "sNext": "Suivant",
                            "sPrevious": "Précédent"
                        },
                        "oAria": {
                            "sSortAscending": ": Trier par ordre croissant",
                            "sSortDescending": ": Trier par ordre décroissant"
                        }
                    },
                    columns: [
                        { title: 'ID' },
                        { title: 'Nom Catégorie' },
                        { title: 'Description' },
                        { title: 'Status' },
                        { title: 'Modifier' },
                        { title: 'Supprimer' },
                      ],
                    ajax: {
                        url: "../public-includes/ajax_queries.php",
                        data: {
                            function: "AfficherCategories"
                        },
                        method: "post",
                        dataType: "json",
                        async: false
                    },
                    'createdRow': function( row, data, dataIndex ) {
                        var tds = $(row).children("td");
                        for(let i = 0; i < tds.length ; i++){
                            switch(i){ 
                                case 0:
                                    tds[i].setAttribute("class", "id");
                                    tds[i].setAttribute("id", data[0]);
                                break;
                                case 1:
                                    tds[i].setAttribute("class", "nom");
                                break;
                                case 2:
                                    tds[i].setAttribute("class", "description");
                                break;
                                case 3:
                                    if(tds[i].innerText == "Active")
                                        var bool = true;
                                    else
                                        var bool = false;
                                    tds[i].setAttribute("id", bool);
                                    tds[i].setAttribute("class", "active");
                                break;
                            }
                        }
                    }
                });
            }

                        
        </script>
        
    <?php include_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: categories.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>