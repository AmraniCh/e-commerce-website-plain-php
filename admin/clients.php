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
                      <div class="categories-header" style="display:flex;flex-wrap:nowrap;justify-content:space-between">
                          <h3 class="title">Clients</h3>        
                      </div>
                      <div class="profile-content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="clientsTable" class="table table-hover table-bordered small-col">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Prenom</th>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Téléphone</th>
                                                <th>Adresse</th>
                                                <th>Ville</th>
                                                <th>Mot de passe</th>
                                                <th>Email validé</th>
                                                <th>Code postal</th>
                                                <th>Envoyer Message</th>
                                                <th>Supprimer le compte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                    $client = new client();
                                                    $result = $client->AfficherClients();
                                                    while($row = $result->fetch_array()){
                                                        $valide = $client->EmailValide($row['emailValid']);
                                                        echo '<tr><td class="id">'.$row[0].'</td>';
                                                        echo '<td>'.$row[1].'</td>';
                                                        echo '<td>'.$row[2].'</td>';
                                                        echo '<td>'.$row[3].'</td>';
                                                        echo '<td>'.$row[4].'</td>';
                                                        echo '<td>'.$row['telephone'].'</td>';
                                                        echo '<td>'.$row['adresse'].'</td>';
                                                        echo '<td>'.$row['ville'].'</td>';
                                                        echo '<td>'.$row['motdepasse'].'</td>';
                                                        echo '<td>'.$valide.'</td>';
                                                        echo '<td>'.$row['codePostal'].'</td>';
                                                        echo '<td><button type="button" id="btnMessage" class="btn btn-blue btn-column-icon"><i class="fas fa-envelope icon-col"></i></button></td>';
                                                        echo '<td><button id="btnSupprimer" type="button" class="btn btn-red btn-column-icon" data-toggle="modal" data-target="#suppressionClient"><i class="fas fa-trash icon-col"></i></button></td>';
                                                        echo '</tr>';
                                                    }
                                                ?>
                                        </tbody>
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
            var values = [];
            
            $(document).on('click','#btnSupprimer',function(){
                values = [];
                var clientID = $(this).closest("tr").children(".id").html();
                values.push(clientID);
            });
            
            $("#btnSupprimerDialog").click(function(){
               alert(values[0]);
                $.ajax({
                   url: '../public-includes/ajax_queries.php',
                    method: "POST",
                    data: {function: "SupprimerClient", clientID: values[0]},
                    success: function(){
                        $("#clientsTable").load(" #clientsTable");
                        $("button[data-dismiss]").click(); 
                    }
                });
                
            });
            
            
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