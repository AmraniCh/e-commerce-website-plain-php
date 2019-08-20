<?php include_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
          
          $statistiques = new Statistiques();
          $profit_data = $statistiques::profit_statistiques();
          $visites_data = $statistiques::visites_statistiques();
          
        
          $query = $con->query(" SELECT COUNT(*)
                                FROM commande 
                                WHERE status = 0");
          
          $row = $query->fetch_row();
          if( $row[0] != 0 ):
          
            $not_commandes = '<div class="row purchace-popup">
                              <div class="col-12">
                                <span class="d-block d-md-flex align-items-center">
                                  <p>Vous avez <span class="count-comm">'.$row[0].'</span> nouvelle(s) commande(s) ! Voulez-vous les voir maintenant ?</p>
                                  <a class="btn btn-red ml-auto download-button d-none d-md-block" href="commandes.php?admin='.$_SESSION['admin'].'">Voir les commandes</a>
                                  <a class="btn btn-blue purchase-button popup-dismiss mt-4 mt-md-0">Pas Maintenant</a>
                                </span>
                              </div>
                            </div>';
            
          endif;
          
          $query = $con->query(" SELECT COUNT(*)
                                FROM commentaire 
                                WHERE accepte = 0");
          
          $row = $query->fetch_row();
          if( $row[0] != 0 ):
          
            $not_commentaires = '<div class="row purchace-popup">
                              <div class="col-12">
                                <span class="d-block d-md-flex align-items-center">
                                  <p>Vous avez <span class="count-comm">'.$row[0].'</span> nouvelle(s) commentaire(s) en attente d\'acceptation ! Voulez-vous les voir maintenant ?</p>
                                  <a class="btn btn-red ml-auto download-button d-none d-md-block" href="commentaires.php?admin='.$_SESSION['admin'].'">Voir les commentaires</a>
                                  <a class="btn btn-blue purchase-button popup-dismiss mt-4 mt-md-0">Pas Maintenant</a>
                                </span>
                              </div>
                            </div>';
          
          endif;
  ?>
  <div class="container-scroller">
  
    <?php include_once 'includes/navigation.php' ?>
  
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <?php include_once 'includes/sidebar.php' ?>
      
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php

            if(isset($not_commandes) && $_SESSION['not_vu'] == 0)
              echo $not_commandes;
            if(isset($not_commentaires) && $_SESSION['not_vu'] == 0)
              echo $not_commentaires;
          
            if(isset($not_commandes) || isset($not_commentaires))
              $_SESSION['not_vu'] = 1;
    
          ?>
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-cube text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Revenu Total</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0 revenu-total font-115"><?php echo $statistiques->revenut_total(). ' DHS' ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i>Revenu Total
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Commandes</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0 total-commandes font-115"><?php echo $statistiques->total_commandes() ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i>Total des commandes
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-poll-box text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Total Ventes</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0 total-ventes font-115"><?php echo $statistiques->total_ventes() ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i>Total des ventes
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-account-location text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">Clients</p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0 tota-clients font-115"><?php echo $statistiques->total_clients() ?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Les clients enregistrés
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-7 grid-margin stretch-card">
              <!--weather card-->
              <div class="card card-weather">
                <div class="card-body">
                  <div class="weather-date-location">
                    <h3 class="weather-day"></h3>
                    <p class="text-gray">
                      <span class="weather-date">
                      </span>
                      <span class="weather-location"></span>
                    </p>
                  </div>
                  <div class="weather-sky-status">Ciel </div>
                  <div class="weather-data d-flex">
                    <div class="mr-auto">
                      <h4 class="display-3 weather-temp">
                        <span class="symbol">&deg;</span>C
                      </h4>
                      <h5 class="wind-speed blue-sky">
                        <i class="mdi mdi-weather-windy font-100"></i>
                      </h5>
                      <h6 class="humidity blue-sky"></h6>
                    </div>
                  </div>
                </div>
              </div>
              <!--weather card ends-->
            </div>
            <div class="col-lg-5 grid-margin stretch-card">
              <div class="card card-performance">
                <div class="card-body">
                  <h2 class="card-title text-primary mb-4">Taux de Profit &amp; Visites d'aujoud'hui par rapport hier </h2>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Taux de profit</p>
                      <p class="display-3 font-weight-light mb-4"><?php
                        
                        if($profit_data['taux_profit'] >= 100)
                          echo '<span class="stat-success"> ' . $profit_data['taux_profit'] . ' %</span>';
                        else
                          echo '<span class="stat-normal">' . $profit_data['taux_profit'] . ' %</span>';

                        ?></p>
                    </div>
                    <div class="side-right">
                      <div>
                        <small class="text-muted">Profit d'aujourd'hui : <?php 
                            echo $profit_data['profit_aujourd']. ' DHS';
                          ?></small>
                      </div>
                      <div>
                        <small class="text-muted">Profit d'hier : <?php 
                           echo $profit_data['profit_hier']. ' DHS';
                          ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Taux de visites</p>
                      <p class="display-3 font-weight-light mb-4"><?php
            
                        if($visites_data['taux_visites'] >= 100)
                          echo '<span class="stat-success">'.$visites_data['taux_visites'].' %</span>';
                        else
                          echo '<span class="stat-normal">'.$visites_data['taux_visites'].' %</span>';
                        
                        ?></p>
                    </div>
                    <div class="side-right">
                     <div>
                      <small class="text-muted">Visites d'aujoud'hui : <?php 
                             echo $visites_data['visites_aujourd'] . ' Visite(s)';
                          ?></small>
                      </div>
                      <div>
                      <small class="text-muted">Visites d'hier : <?php 
                             echo $visites_data['visites_hier'] . ' Visite(s)';
                          ?></small>
                      </div>
                    </div>
                  </div>
                  <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Profits</p>
                      <p class="mb-2 text-primary">
                        <?php
                            echo '<span class="stat-normal">'.$profit_data['taux_profit'].' %</span>';
                        ?>
                      </p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 
                      <?php 
                        if($profit_data['taux_profit'] >= 100)
                          echo '100%';
                        else
                          echo $profit_data['taux_profit']." %";
                           ?>" aria-valuenow="<?php echo $profit_data['taux_profit'] ?>"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                  <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Visites</p>
                      <p class="mb-2 text-info"><?php
            
                          echo '<span class="stat-normal">'.$visites_data['taux_visites'].' %</span>';
                        
                        ?></p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 
                      <?php 
                        if($visites_data['taux_visites'] >= 100)
                          echo '100%';
                        else
                          echo $visites_data['taux_visites']."%";
                           ?>" aria-valuenow="56"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="row d-none d-sm-flex mb-4">
                    <div class="col-4">
                      <h5 class="text-primary">Total Visites</h5>
                      <p>
                        <?php 
                          echo $statistiques::total_visites();
                        ?>
                      </p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Page vues</h5>
                      <p><?php echo $statistiques::total_page_vues() ?></p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Visiteurs Actuels</h5>
                      <p>
                       <?php
                          echo $statistiques::visiteurs_actuels();
                       ?> 
                      </p>
                    </div>
                  </div>
                  <div class="chart-container">
                    <canvas id="dashboard-area-chart" height="80"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Les dernières livraisons</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th> #</th>
                          <th>Client</th>
                          <th>Status</th>
                          <th>type</th>
                          <th>NB Articles</th>
                          <th>Montant</th>
                          <th>Date</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $client = new Client();
                            $query = $con->query(" SELECT * 
                                                FROM livraison l INNER JOIN commande c
                                                ON l.commandeID = c.commandeID
                                                WHERE c.status = 1
                                                ORDER BY confirmationDate DESC
                                                lIMIT 7 ");
                            if( $query->num_rows > 0 ):
                            while($row = $query->fetch_assoc()){
                                
                                $nom_prenom = $client->ClientNomPrenom($row['clientID']);
                                $status = '<label class="badge badge-success">Confirmé</label>';
                                
                                echo '<tr>';
                                echo '<td>'.$row['livraisonID'].'</td>';
                                echo '<td>'.$nom_prenom.'</td>';
                                echo '<td>'.$status.'</td>';
                                echo '<td>'.$row['typeLivraison'].'</td>';
                                echo '<td>'.$row['nbrArticles'].'</td>';
                                echo '<td>'.$row['totalApayer'].' DHS</td>';
                                echo '<td>'.$row['confirmationDate'].'</td>';
                                echo '</tr>';
                                
                            }
                            else:
                            
                                echo '<tr>';
                                echo '<td colspan="7">Aucun livraison trouvé</td>';
                                echo '</tr>';
                        
                            endif;
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Manager les commentaires</h5>
                  <div class="fluid-container commentaires-ctr">

      
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        
      <script>
      
        $(function(){
            
            $.ajax({
                url: "../public-includes/WEATHER_API.php",
                method: "POST",
                dataType: "JSON",
                async: false,
                success: function(data){
                  $(".weather-location").text(data['ville']);
                  $(".weather-date").text(data['date']);
                  $(".weather-day").text(data['jour']);
                  $(".weather-temp").prepend(data['temp']);
                  $(".weather-sky-status").append(data['icon']);
                  $(".wind-speed").append(data['vitesse_vent']);
                  $(".humidity").append(data['humidite']);
                }
            });
          
            Commentaires();
            
            $(document).on("click", ".supp-comm", function(){
                
                var commID = $("div[data-src='commID']").attr("data-id");

                $.post(
                    "../public-includes/ajax_queries",
                    { 
                        function: "SupprimerCommentaire",
                        commID: commID
                    },
                    function (data){
                        if(data != null){
                            Commentaires();
                            NotificationsCout();
                        }
                    },
                    "JSON"
                );
               
           });
            
            $(document).on("click", ".accepte-comm", function(){
              
                var commID = $("div[data-src='commID']").attr("data-id");
                
                $.post(
                    "../public-includes/ajax_queries",
                    { 
                        function: "AccepterCommentaire",
                        commID: commID
                    },
                    function (data){
                        if(data != null){
                            Commentaires();
                            NotificationsCout();
                        }
                    },
                    "JSON"
                );
               
           });
          
        });
          
        function Commentaires(){
            
            $.ajax({
                url: "../public-includes/ajax_queries",
                method: "POST",
                dataType: "JSON",
                data: { function: "CommentairesAdmin" },
                success: function(data){
                    
                    if(data != null){
                        
                        $(".commentaires-ctr").empty();
                        
                        $.each(data, function(index, element){
                           
                            var html = '<div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3" data-src="commID" data-id="'+data[index]['id']+'"> <div class="col-md-1"> <img class="img-sm rounded-circle mb-4 mb-md-0" src="images/user.png"> </div><div class="ticket-details col-md-9"> <div class="d-flex"> <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">'+data[index]['nom_prenom']+'</p><p class="text-primary mr-1 mb-0">[#'+data[index]['id']+']</p><p class="mb-0 ellipsis">'+data[index]['titre']+'</p></div><p class="text-gray ellipsis mb-2">'+data[index]['text']+' </p><div class="row text-gray d-md-flex d-none"> <div class="col-4 d-flex"><small class="Last-responded mr-2 mb-0 text-muted">'+data[index]['date']+'</small> </div> </div></div><div class="ticket-actions col-md-2"> <div class="btn-group dropdown"> <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Manage </button> <div class="dropdown-menu"> <a class="dropdown-item accepte-comm"> <i class="fa fa-check text-success fa-fw"></i>Accepter</a> <a class="dropdown-item supp-comm"> <i class="fa fa-times text-danger fa-fw"></i>Refuser</a> </div></div></div></div>';
                            
                            $(".commentaires-ctr").append(html);
                            
                        });
                        
                    }
                    else
                        $(".commentaires-ctr").html("<div class='aucun-commentaire-msg'><span class='text-muted'>Vous n'avez pas des nouvelles commentaires.</span></div>");
                    
                }
            });
            
        }
          
        
      </script>
        
    <?php include_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: index.php?admin='.$_SESSION['admin']);
    }
      else
          header ('location: login.php');
?>