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
                     <div class="commandes-header" style="display:flex;flex-wrap:nowrap;justify-content:space-between">
                          <h3 class="title">Commandes</h3>        
                      </div>
                      <div class="profile-content">
                        <div class="row">
                          <div class="col-md-12">
                            <div class="table-responsive">
                              <table id="dt_commandes" class="table table-hover table-bordered small-col">

                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
        <!-- content-wrapper ends -->
        
        <div class="modal fade" id="infoClientMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aperçu client profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                  <div class="row">
                       <div class="col-sm-4">
                           <div class="card client-stat">
                               <div class="client-stat-icon">
                                   <i class="mdi mdi-cube text-danger icon-lg"></i>
                               </div>
                               <div class="client-stat-info">
                                   <p class="mb-0">Total payé</p>
                                   <div class="fluid-container">
                                       <span class="mb-0" id="ttlPayer"></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                       <div class="col-sm-4">
                           <div class="card client-stat">
                               <div class="client-stat-icon">
                                   <i class="mdi mdi-poll-box text-success icon-lg"></i>
                               </div>
                               <div class="client-stat-info">
                                   <p class="mb-0">Total d'achats</p>
                                   <div class="fluid-container">
                                       <span class="mb-0" id="ttlAchats"></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                       <div class="col-sm-4">
                           <div class="card client-stat">
                               <div class="client-stat-icon">
                                   <i class="mdi mdi-receipt text-warning icon-lg"></i>
                               </div>
                               <div class="client-stat-info">
                                   <p class="mb-0">Total d'articles</p>
                                   <div class="fluid-container">
                                       <span class="mb-0" id="ttlArticles"></span>
                                   </div>
                               </div>
                           </div>
                       </div>
                       
                  </div>
                  <div class="form-group">
                      <label class="label">Prénom :</label>
                      <div class="input-group">
                          <input type="text" id="prenomCli" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Nom :</label>
                      <div class="input-group">
                          <input type="text" id="nomCli" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Email :</label>
                      <div class="input-group">
                          <input type="email" id="emailCli" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Téléphone :</label>
                      <div class="input-group">
                          <input type="email" id="teleCli" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Adresse :</label>
                      <div class="input-group">
                          <textarea class="form-control" id="adresseCli" readonly>
                              
                          </textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Ville :</label>
                      <div class="input-group">
                           <input type="email" id="villeCli" class="form-control" readonly>
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="label">Code Postal :</label>
                      <div class="input-group">
                          <input type="email" id="codePostalCli" class="form-control" readonly>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Ok</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="infoArticlesMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" id="overrideWidth" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Les articles commandées</h5>
                <button type="button" class="close" data-cls="rtn-first-modal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="table-responsive">
                   <table id="dt_articles_comm" class="table table-hover dt-pag-btrp">

                     </table>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-cls="rtn-first-modal" data-dismiss="modal">OK</button>
                  </form>
              </div>
            </div>
          </div>
        </div>   
        
        <div class="modal fade" id="qtyInvalideMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quantite Invalide</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                La quantite commandé est supérieure à la quantité en stock 
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Ok</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="spmCommMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression du commande</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Vous Voulez Vraiment Supprimé Cette commande, Toutes les information concernant cette commande cera supprimé, voulez vous continuez ?
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Non, merci</button>
                    <button type="button" id="suppCommBtn" class="btn btn-red">Oui</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <script>
            
            $(function(){
                
                var commID;
                
                dataTableCommandesInitialize(); 
                
                (function(){
                    $.post(
                        "../public-includes/notifications",
                        { function: "CommandesVues" },
                    )
                }());
                
                $(document).on("click", ".btn-info-client", function(){
                    commID = $(this).closest("tr").find("td[data-id]").attr("data-id");
                    $.post(
                        "../public-includes/ajax_queries",
                        { 
                            function: "AfficherClientStat",
                            commID: commID
                        },
                        function(data){
                            $("#prenomCli").val(data.prenom);
                            $("#nomCli").val(data.nom);
                            $("#emailCli").val(data.email);
                            $("#teleCli").val(data.tele);
                            $("#adresseCli").text(data.adresse);
                            $("#villeCli").val(data.ville);
                            $("#codePostalCli").val(data.postal);
                            $("#ttlPayer").text(data.totalpayer+" DHS");
                            $("#ttlAchats").text(data.totalachats);
                            $("#ttlArticles").text(data.totalarticles);
                        },
                        "JSON"
                    );
                    
                });
                
                $(document).on("click", ".btn-info-articles", function(){
                    commID = $(this).closest("tr").find("td[data-id]").attr("data-id");
                    dataTableArticlesInitialize(commID);  
                });
                
                $(document).on("click", ".refuse-second-action", function(){
                    commID = $(this).closest("tr").find("td[data-id]").attr("data-id");
                    $.ajax({
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: { 
                            function: "MisEnAttenteCommande", 
                            commID: commID
                        },
                        success: function(data){
                            if(data != null)
                                dataTableCommandesInitialize();
                        }
                    });
                    
                });
                
                $(document).on("click", ".refuser-btn",function(){
                    
                    commID = $(this).closest("tr").find("td[data-id]").attr("data-id");
                    
                    $.ajax({
                       
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            function: "SuppressionCommande",
                            commID: commID
                        },
                        success: function(data){
                            if( data != null ){
                                $("button[data-dismiss]").click();
                                NotificationsCout();
                                dataTableCommandesInitialize();
                            }
                        }
                        
                    });
                    
                });
                
                $(document).on("click", ".comm-liv", function(){
                    
                    var commID = $(this).closest("tr").find("td[data-id]").attr("data-id");

                    $.ajax({
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: {
                            function: "ConfirmerCommande",
                            commID: commID
                        },
                        success: function(data){
                            if( data != null && data != -1){
                                $("button[data-dismiss]").click();
                                NotificationsCout();
                                dataTableCommandesInitialize();
                            }
                            if(data == -1){
                                $("button[data-dismiss]").click();
                                $("#qtyInvalideMDL").modal("show");
                            }
                        }
                        
                    });
                    
                });
                
                $(document).on("click", ".btn-supp-comm", function(){
                    commID = $(this).closest("tr").find("td[data-id]").attr("data-id");
                });
                
                $("#suppCommBtn").click(function(){
                   
                    $.post(
                        "../public-includes/ajax_queries",
                        { 
                            function: "SupprimerCommande",
                            commID: commID
                        },
                        function(data){
                            if(data != null){
                                dataTableCommandesInitialize();
                                NotificationsCout();
                                $("button[data-dismiss='modal']").click();
                            }
                        },
                        "JSON"
                    );
                    
                });
                
            });
    
            function dataTableCommandesInitialize(){   
                $('#dt_commandes').dataTable({
                    destroy: true,
                    "order":[[4, "desc"]],
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
                        { title: 'Confirmer' },
                        { title: 'Refuser' },
                        { title: 'ID' },
                        { title: 'Client' },
                        { title: 'Commande Date' },
                        { title: 'Status' },
                        { title: 'Livraison' },
                        { title: 'Coupon' },
                        { title: 'NB Articles' },
                        { title: 'Total à payer' },
                        { title: 'Supprimer' }
                    ],
                    ajax: {
                        url: "../public-includes/ajax_queries",
                        data: {
                            function: "AfficherCommandes"
                        },
                        method: "post",
                        dataType: "json",
                        async: false
                    },
                    'createdRow': function( row, data, dataIndex ) {           
                        if($(data[5]).text() == "Réfusé")
                            $(row).closest("tr").addClass("refused-order-row")
                        var tds = $(row).children("td");
                        for(let i = 0; i < tds.length ; i++){
                            switch(i){ 
                                case 2:
                                    tds[i].setAttribute("data-id", data[2]);
                                break;
                            }
                        }
                    }
                });
            }
            
            function dataTableArticlesInitialize(commID){
                $('#dt_articles_comm').dataTable({
                    destroy: true,
                    "order":[[0, "desc"]],
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
                        { title: 'Image' },
                        { title: 'Nom' },
                        { title: 'Description' },
                        { title: 'Couleur' },
                        { title: 'Quantite' },
                        { title: 'Prix' },
                        { title: 'Taux Remise' },
                        { title: 'Prix Remise' }
                      ],
                    ajax: {
                        url: "../public-includes/ajax_queries",
                        data: {
                            function: "AfficherArticlesComm",
                            commID: commID
                        },
                        method: "post",
                        dataType: "json",
                        async: false
                    }
                });
            }
         
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