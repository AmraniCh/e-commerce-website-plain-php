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
                     <div class="table-responsive">
                        <table id="dt_produits" class="table table-hover table-bordered small-col">
                        </table>
                        <?php echo "<input type='hidden' id='HSV' value='".$_SESSION['admin']."'/>" ?>
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
        
        
        <div class="modal fade" id="artSuppDetailsMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="warningLabel"><i class="fas fa-exclamation-triangle"></i> Alerte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <span>Vous pouvez pas supprimer cette article car elle est en relation avec des commandes ou des livraisons.</span>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>OK</button>
              </div>
            </div>
          </div>
        </div>
        
        <script>
            
            $(document).ready(function(){
                
                dataTableInitialize();
                
                var values = [];
                
                $(document).on("click","#btnSupprimer",function(){
                    values = [];
                    var articleID = $(this).closest("tr").find("td[data-src='articleID']").attr("data-id");
                    values.push(articleID); 
                });
                
                $("#btnSupprimerDialog").click(function(e){

                    $.ajax({
                        url: '../public-includes/ajax_queries.php',
                        method: 'POST',
                        dataType: "JSON",
                        data: {
                            function: "SupprimerArticle", 
                            id: values[0]
                        },
                        success: function(data){
                            if(data != null && data != -1){
                                $("button[data-dismiss]").click();
                                dataTableInitialize();
                            }
                            if(data == -1){
                                $("button[data-dismiss]").click();
                                $("#artSuppDetailsMDL").modal("show");
                            }
                        }
                        
                    }); 
                });
            

                $(document).on("click","#btnModifier",function(){
                    var admin  = $("#HSV").val();
                    var id = $(this).closest("tr").find("td[data-src='articleID']").attr("data-id");       
                    window.location.href = "produit.php?admin="+admin+"&edit="+id;
               });

            });
            
            function dataTableInitialize(){
                $('#dt_produits').dataTable({
                    destroy: true,
                    "order":[[2, "desc"]],
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
                        { title: 'Modifier' },
                        { title: 'Supprimer' },
                        { title: 'ID' },
                        { title: 'Image' },
                        { title: 'Nom' },
                        { title: 'Description' },
                        { title: 'Marque' },
                        { title: 'Couleurs' },
                        { title: 'Prix Initial' },
                        { title: 'Remise Dispo' },
                        { title: 'Taux Remise'},
                        { title: 'Prix Remise' },
                        { title: 'En Stock'},
                        { title: 'Ventes'},
                        { title: 'Produit Dispo'},
                        { title: 'Niveau'},
                        { title: 'Categorie'}
                      ],
                    ajax: {
                        url: "../public-includes/ajax_queries.php",
                        data: {
                            function: "AfficherProduits"
                        },
                        method: "post",
                        dataType: "json",
                        async: false

                    },
                    'createdRow': function( row, data, dataIndex ) {
                        var tds = $(row).children("td");
                        for(let i = 0; i < tds.length ; i++){
                            switch(i){ 
                                case 2:
                                    tds[i].setAttribute("data-src", "articleID");
                                    tds[i].setAttribute("data-id", data[2]);
                                break;
                            }
                        }
                    }
                });
            };
            
        </script>
                    
        
    <?php include_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: produits.php?admin='.$_SESSION['admin']);
    }
    else
        header ('location: login.php');
?>