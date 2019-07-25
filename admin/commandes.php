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
                              <table id="commandesTable" class="table table-hover table-bordered small-col">
                                <thead>
                                  <tr>
                                    <th>ID</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                                          
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
        
    <script>
         
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