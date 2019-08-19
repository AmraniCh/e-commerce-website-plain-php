<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
    

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
                      <div class="categories-header header-adm">
                          <h3 class="title">Clients</h3>        
                      </div>
                      <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="dt_clients" class="table table-hover table-bordered small-col clients-table">
    
                                    </table>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        <!-- content-wrapper ends -->
        
        <div class="modal fade" id="suppressionClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression du compte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Vous êtes sur le point de supprimer ce compte, souhaitez-vous confirmer cette suppression?
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" id="activeAdd" class="form-check-input" checked> Envoyer une notification du suppression de compte 
                        </label>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Non, merci</button>
                    <button id="btnSupprimerDialog" type="button" class="btn btn-red btn-delete-cat">Confirmer</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
    <script>
        $(document).ready(function(){
            
            dataTableInitialize();
            
            var values = [];
            
            $(document).on('click','#btnSupprimer',function(){
                values = [];
                var clientID = $(this).closest("tr").children(".id").html();
                values.push(clientID);
            });
            
            $("#btnSupprimerDialog").click(function(){

                $.ajax({
                   url: '../public-includes/ajax_queries.php',
                    method: "POST",
                    data: {
                        function: "SupprimerClient", 
                        clientID: values[0]
                    },
                    async: false,
                    success: function(data){
                        if(data != null){
                            $("button[data-dismiss]").click(); 
                            dataTableInitialize();
                        }
                    }
                });
                
            });
            
            
        });
        
        // custom dataTable configurations
        function dataTableInitialize(){
            $('#dt_clients').dataTable({
                destroy: true,
                "order":[],
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
                    { title: 'Message' },
                    { title: 'Supprimer' },
                    { title: 'ID' },
                    { title: 'Pseudo' },
                    { title: 'Prenom' },
                    { title: 'Nom' },
                    { title: 'Email' },
                    { title: 'Email Validé' },
                    { title: 'Téléphone' },
                    { title: 'Adresse' },
                    { title: 'Ville'},
                    { title: 'Code Postal'}
                ],
                ajax: {
                    url: "../public-includes/ajax_queries",
                    data: {
                        function: "AfficherClients"
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
                                tds[i].setAttribute("class", "id");
                            break;
                        }
                    }
                }
            });
        };
                        
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