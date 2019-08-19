<?php require_once 'includes/header.php' ?>

 <?php
  if(isset($_GET['admin']) && isset($_SESSION['admin'])){
		if($_GET['admin'] == $_SESSION['admin'])
		{
        
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
          
          // revenu total
          $query = $con->query(" SELECT SUM(totalApayer)
                                FROM commande
                                WHERE status = 1 ");
          $row = $query->fetch_row();
          if($row[0] != null)
            $revenu_total = $row[0].' DHS';
          else
            $revenu_total = '0 DHS';
          // commandes
          $query = $con->query(" SELECT COUNT(*)
                                FROM commande ");
          $row = $query->fetch_row();
          $commandes = $row[0];
          
          // ventes
          $query = $con->query(" SELECT COUNT(*)
                                FROM commande 
                                WHERE status = 1 ");
          $row = $query->fetch_row();
          $ventes = $row[0];
            
          // client
          $query = $con->query(" SELECT COUNT(*)
                                FROM client ");
          $row = $query->fetch_row();
          $clients = $row[0];
          
          // taux profit par rapport hier
          $query = $con->query(" SELECT SUM(totalApayer)
                                FROM commande
                                WHERE status = 1
                                AND DATE(commandeDate) = DATE(NOW() - INTERVAL 1 DAY) ");
          $row = $query->fetch_row();
          if($row[0] != null){
            $profit_hier = $row[0];
          
            $query = $con->query(" SELECT SUM(totalApayer)
                                FROM commande
                                WHERE status = 1
                                AND DATE(commandeDate) = DATE(NOW()) ");
            $row = $query->fetch_row();
          
            if($row[0] != null):
          
              $profit_aujourd = $row[0];  

              $taux_profit = number_format(( $profit_aujourd * 100 ) / $profit_hier , 2). '%';
          
            else:
                
                $taux_profit = 0 . '%';
          
            endif;
            
          }
          else
            $taux_profit = 0 . '%';
          
          // taux visites par rapport hier
          $query = $con->query(" SELECT COUNT(*) 
                                FROM statistiques 
                                WHERE type = 'visite'
                                AND DATE(dateStat) = DATE( now() - INTERVAL 1 DAY ) ");
          $row = $query->fetch_row();
          $visites_hier = $row[0];
          
          $query = $con->query(" SELECT COUNT(*) 
                                FROM statistiques 
                                WHERE type = 'visite'
                                AND DATE(dateStat) = DATE(now()) ");
          $row = $query->fetch_row();
          $visites_aujourd = $row[0];
          
          $taux_visites = ( $visites_aujourd * 100 ) / $visites_hier . '%';
          
        
  
  ?>
  <div class="container-scroller">
  
    <?php require_once 'includes/navigation.php' ?>
  
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      
      <?php require_once 'includes/sidebar.php' ?>
      
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
                        <h3 class="font-weight-medium text-right mb-0 revenu-total font-115"><?php echo $revenu_total ?></h3>
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
                        <h3 class="font-weight-medium text-right mb-0 total-commandes font-115"><?php echo $commandes ?></h3>
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
                        <h3 class="font-weight-medium text-right mb-0 total-ventes font-115"><?php echo $ventes ?></h3>
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
                        <h3 class="font-weight-medium text-right mb-0 tota-clients font-115"><?php echo $clients ?></h3>
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
                      <p class="display-3 font-weight-light"><?php
                        
                        if((int)$taux_profit >= 100)
                          echo '<span class="stat-success">'.$taux_profit.'</span>';
                        else
                          echo '<span class="stat-normal">'.$taux_profit.'</span>';

                        ?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">Profit Aujourd'hui : 500 DHS</small>
                    
                    </div>
                  </div>
                  <div class="wrapper d-flex justify-content-between">
                    <div class="side-left">
                      <p class="mb-2">Taux de visites</p>
                      <p class="display-3 font-weight-light"><?php
            
                        if((int)$taux_visites >= 100)
                          echo '<span class="stat-success">'.$taux_visites.'</span>';
                        else
                          echo '<span class="stat-normal">'.$taux_visites.'</span>';
                        
                        ?></p>
                    </div>
                    <div class="side-right">
                      <small class="text-muted">2015</small>
                    </div>
                  </div>
                  <div class="wrapper">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Profits</p>
                      <p class="mb-2 text-primary">
                        <?php
                              echo '<span class="stat-normal">'.$taux_profit.'</span>';
                        ?>
                      </p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" role="progressbar" style="width: 
                      <?php 
                        if((int)$taux_profit >= 100)
                          echo '100%';
                        else
                          echo (int)$taux_profit."%";
                           ?>" aria-valuenow="<?php echo (int)$taux_profit ?>"
                        aria-valuemin="0" aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                  <div class="wrapper mt-4">
                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Visites</p>
                      <p class="mb-2 text-info"><?php
            
                          echo '<span class="stat-normal">'.$taux_visites.'</span>';
                        
                        ?></p>
                    </div>
                    <div class="progress">
                      <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 
                      <?php 
                        if((int)$taux_visites >= 100)
                          echo '100%';
                        else
                          echo (int)$taux_visites."%";
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
                      <h5 class="text-primary">Unique Visitors</h5>
                      <p>34657</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Bounce Rate</h5>
                      <p>45673</p>
                    </div>
                    <div class="col-4">
                      <h5 class="text-primary">Active session</h5>
                      <p>45673</p>
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
                  <h4 class="card-title">Les Orders</h4>
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>
                            #
                          </th>
                          <th>
                            nom et prenom
                          </th>
                          <th>
                            Progress
                          </th>
                          <th>
                            Amount
                          </th>
                          <th>
                            Sales
                          </th>
                          <th>
                            Deadline
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="font-weight-medium">
                            1
                          </td>
                          <td>
                            Herman Beck
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-success progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.64%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            2
                          </td>
                          <td>
                            Messsy Adam
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $245.30
                          </td>
                          <td class="text-success"> 24.56%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            July 1, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            3
                          </td>
                          <td>
                            John Richards
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $138.00
                          </td>
                          <td class="text-danger"> 28.76%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            Apr 12, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            4
                          </td>
                          <td>
                            Peter Meggik
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 77.99
                          </td>
                          <td class="text-danger"> 53.45%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            May 15, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            5
                          </td>
                          <td>
                            Edward
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-danger progress-bar-striped" role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 160.25
                          </td>
                          <td class="text-success"> 18.32%
                            <i class="mdi mdi-arrow-up"></i>
                          </td>
                          <td>
                            May 03, 2015
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-medium">
                            6
                          </td>
                          <td>
                            Henry Tom
                          </td>
                          <td>
                            <div class="progress">
                              <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                aria-valuemax="100"></div>
                            </div>
                          </td>
                          <td>
                            $ 150.00
                          </td>
                          <td class="text-danger"> 24.67%
                            <i class="mdi mdi-arrow-down"></i>
                          </td>
                          <td>
                            June 16, 2015
                          </td>
                        </tr>
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
                  <h5 class="card-title mb-4">Manage Tickets</h5>
                  <div class="fluid-container">
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="images/faces/face1.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">James :</p>
                          <p class="text-primary mr-1 mb-0">[#23047]</p>
                          <p class="mb-0 ellipsis">Donec rutrum congue leo eget malesuada.</p>
                        </div>
                        <p class="text-gray ellipsis mb-2">Donec rutrum congue leo eget malesuada. Quisque velit nisi, pretium ut lacinia in, elementum id enim
                          vivamus.
                        </p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Last responded :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">3 hours ago</small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted text-muted">Due in :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted text-muted">2 Days</small>
                          </div>
                        </div>
                      </div>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-reply fa-fw"></i>Quick reply</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row ticket-card mt-3 pb-2 border-bottom pb-3 mb-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="images/faces/face2.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">Stella :</p>
                          <p class="text-primary mr-1 mb-0">[#23135]</p>
                          <p class="mb-0 ellipsis">Curabitur aliquet quam id dui posuere blandit.</p>
                        </div>
                        <p class="text-gray ellipsis mb-2">Pellentesque in ipsum id orci porta dapibus. Sed porttitor lectus nibh. Curabitur non nulla sit amet
                          nisl.
                        </p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Last responded :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">3 hours ago</small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Due in :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">2 Days</small>
                          </div>
                        </div>
                      </div>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-reply fa-fw"></i>Quick reply</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row ticket-card mt-3">
                      <div class="col-md-1">
                        <img class="img-sm rounded-circle mb-4 mb-md-0" src="images/faces/face3.jpg" alt="profile image">
                      </div>
                      <div class="ticket-details col-md-9">
                        <div class="d-flex">
                          <p class="text-dark font-weight-semibold mr-2 mb-0 no-wrap">John Doe :</p>
                          <p class="text-primary mr-1 mb-0">[#23246]</p>
                          <p class="mb-0 ellipsis">Mauris blandit aliquet elit, eget tincidunt nibh pulvinar.</p>
                        </div>
                        <p class="text-gray ellipsis mb-2">Nulla quis lorem ut libero malesuada feugiat. Proin eget tortor risus. Lorem ipsum dolor sit amet.</p>
                        <div class="row text-gray d-md-flex d-none">
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Last responded :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">3 hours ago</small>
                          </div>
                          <div class="col-4 d-flex">
                            <small class="mb-0 mr-2 text-muted">Due in :</small>
                            <small class="Last-responded mr-2 mb-0 text-muted">2 Days</small>
                          </div>
                        </div>
                      </div>
                      <div class="ticket-actions col-md-2">
                        <div class="btn-group dropdown">
                          <button type="button" class="btn btn-success dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Manage
                          </button>
                          <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-reply fa-fw"></i>Quick reply</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-history fa-fw"></i>Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-check text-success fa-fw"></i>Resolve Issue</a>
                            <a class="dropdown-item" href="#">
                              <i class="fa fa-times text-danger fa-fw"></i>Close Issue</a>
                          </div>
                        </div>
                      </div>
                    </div>
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
            success: function(data){
              console.log(data);
              $(".weather-location").text(data['ville']);
              $(".weather-date").text(data['date']);
              $(".weather-day").text(data['jour']);
              $(".weather-temp").prepend(data['temp']);
              $(".weather-sky-status").append(data['icon']);
              $(".wind-speed").append(data['vitesse_vent']);
              $(".humidity").append(data['humidite']);
            }
          });
          
        });
        
      </script>
        
    <?php require_once 'includes/footer.php' ?>
<?php
        }
      else
          header ('location: index.php?admin='.$_SESSION['admin']);
    }
      else
          header ('location: login.php');
?>