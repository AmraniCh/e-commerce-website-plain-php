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
                          <h3 class="title">Clients</h3>        
                      </div>
                      <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="dt_commentaires" class="table table-hover table-bordered small-col clients-table">
    
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
            
            SubstructComment();
            SubstructTitles();
            
            $(document).on("click", ".supp-comm", function(){
              
                var commID = $(this).closest("tr").find("td[data-src='id']").attr("data-id");
                
                $.post(
                    "../public-includes/ajax_queries",
                    { 
                        function: "SupprimerCommentaire",
                        commID: commID
                    },
                    function (data){
                        if(data != null){
                            NotificationsCout();
                            dataTableInitialize();  
                            SubstructComment();
                            SubstructTitles();
                        }
                    },
                    "JSON"
                );
               
           });
            
            $(document).on("click", ".accepte-comm", function(){
              
                var commID = $(this).closest("tr").find("td[data-src='id']").attr("data-id");
                
                $.post(
                    "../public-includes/ajax_queries",
                    { 
                        function: "AccepterCommentaire",
                        commID: commID
                    },
                    function (data){
                        if(data != null){
                            dataTableInitialize();
                            NotificationsCout();
                            SubstructComment();
                            SubstructTitles();
                        }
                    },
                    "JSON"
                );
               
           });
            
            $(document).on("click", ".dots", function(){
                var span = $(this).parent().find(".show-more");
                if(!span.hasClass("active"))
                    span.toggleClass("active");
                else
                    span.removeClass("active");
            });
            
        });
        
        function SubstructComment(){
            
            var tds = $("td[data-src='commentaire']");

            tds.each(function(){

                var text = $(this).text();

                $(this).empty();

                for(let i = 0 ; i < text.length ; i++){

                    if( i < 35)
                        $(this).append(text[i]);

                    if( i === 35 ){
                        $(this).append("-<span class='dots'> . . . </span>");
                        $(this).append("<span class='show-more'></span>");  
                    }

                    var show_more = $(this).children("span[class*='show-more']");

                    if( i >= 35)
                        $(show_more).append(text[i]);

                    if( i >= 35 && ( i + 1 ) % 35 === 0 )
                        $(show_more).append("<br>");
                }
            });
        }
            
        function SubstructTitles(){ 
            
            var tds = $("td[data-src='titre']");

            tds.each(function(){

                var text = $(this).text();

                $(this).empty();

                for(let i = 0 ; i < text.length ; i++){

                    if( i < 25)
                        $(this).append(text[i]);

                    if( i === 25 ){
                        $(this).append("-<span class='dots'> . . . </span>");
                        $(this).append("<span class='show-more'></span>");  
                    }

                    var show_more = $(this).children("span[class*='show-more']");

                    if( i >= 25)
                        $(show_more).append(text[i]);

                    if( i >= 25 && ( i + 1 ) % 25 === 0 )
                        $(show_more).append("<br>");
                }
            
            });
        }
        
        // custom dataTable configurations
        function dataTableInitialize(){
            $('#dt_commentaires').dataTable({
                destroy: true,
                "order":[[8, "desc"]],
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
                    { title: 'Supprimer' },
                    { title: 'Accepter' },
                    { title: 'ID' },
                    { title: 'Client' },
                    { title: 'Titre' },
                    { title: 'Commentaire' },
                    { title: 'Status' },
                    { title: 'Niveau' },
                    { title: 'Date' }
                ],
                ajax: {
                    url: "../public-includes/ajax_queries",
                    data: {
                        function: "AfficherCommentaires"
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
                                tds[i].setAttribute("data-src", "id");
                                tds[i].setAttribute("data-id", data[2]);
                            break;
                            case 4:
                                tds[i].setAttribute("data-src", "titre");
                                $(tds[i]).css("width", "10%");
                            break;
                            case 5:
                                tds[i].setAttribute("data-src", "commentaire");
                                $(tds[i]).css("width", "10%");
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
              header ('location: categories.php?admin='.$_SESSION['admin']);
        }
        else
            header ('location: login.php');
    ?>