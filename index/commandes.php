<?php include_once "includes/header.php" ?>

		<?php include_once "includes/navigation.php" ?>


<?php
    
    if(!isset($_SESSION['clientID']) && empty($_SESSION['clientID'])):
        header('Location: ../login.php');
        exit();
    endif;
    
?>



			<div id="breadcrumb" class="section">
				
				<div class="container">
					
					<div class="row">
						<div class="col-md-12">
							<h3 class="breadcrumb-header"><a href="index.php">Accueil</a></h3>
							<ul class="breadcrumb-tree">
								<li class="active"><a href="#">/ Mes Commandes</a></li>
							</ul>
						</div>
					</div>
					
				</div>
				
			</div>
			

			
			<div class="section">
				
				<div class="container">
               
                   <div class="col-12">
                     
                       <table class="table dt-order">
                           <thead>
                               <tr>
                                   <th class="cart-description-product">Description</th>
                                   <th class="cart-total-amount">Total à payer</th>
                                   <th class="cart-quantite">Quantité</th>
                                   <th class="cart-status">Status</th>
                                   <th class="delivery-type">Type Livraison</th>
                                   <th clas="cart-operation">Operation</th>
                               </tr>
                           </thead>
                       </table>
                           
                        <div id="comm_tables_ctr">
                            
                        </div>
                         
                        <div class="empty-order-ctr">
                            <span class="empty-order-text"><i class="fa fa-search"></i> Vous avez aucun commande.</span>
                        </div>
                           
                        <table class="table dt-order">
                           <thead>
                               <tr>
                                   <th class="cart-description-product">Description</th>
                                   <th class="cart-total-amount">Total à payer</th>
                                   <th class="cart-quantite">Quantité</th>
                                   <th class="cart-status">Status</th>
                                   <th class="delivery-type">Type Livraison</th>
                                   <th clas="cart-operation">Operation</th>
                               </tr>
                           </thead>
                       </table>
                            
                            
                                                   
                        </div>
                    </div>

				</div>
			
        <script>
            $(function(){
                
                AfficherCommandes();    
                
                $(document).on("click", ".cancel-order", function(){
                    
                    var id_attribute_value = $(this).closest("table").attr("id");
                    var id = id_attribute_value.split("_")[2];
                    
                    if( id != NaN){
                        $.ajax({
                            url: "../public-includes/ajax_queries.php",
                            method: "POST",
                            dataType: "JSON",
                            data: { 
                                function: "AnnulerCommande",
                                id: id
                            },
                            success: function(data){
                                if(data != null){
                                    AfficherCommandes();
                                }
                            }
                        });
                    }
                });
                
                $(document).on("click", ".re-order", function(){
                    
                    var id_attribute_value = $(this).closest("table").attr("id");
                    var id = id_attribute_value.split("_")[2];
                    
                    if( id != NaN){
                        $.ajax({
                            url: "../public-includes/ajax_queries.php",
                            method: "POST",
                            dataType: "JSON",
                            data: { 
                                function: "RedemanderCommande",
                                id: id
                            },
                            success: function(data){
                                if(data != null){
                                    AfficherCommandes();
                                }
                            }
                        });
                    }
                });
                
                $(document).on("click", ".commande-supp-btn", function(){
                    
                    var id_attribute_value = $(this).closest("table").attr("id");
                    var id = id_attribute_value.split("_")[2];
                    
                    $.ajax({
                        url: "../public-includes/ajax_queries.php",
                        method: "POST",
                        dataType: "JSON",
                        data: { 
                            function: "SupprimerCommandeClient",
                            id: id
                        },
                        success: function(data){
                            AfficherCommandes();
                        }
                    });
                    
                });
                
                function AfficherCommandes(){

                    $.ajax({
                        url: "../public-includes/ajax_queries.php",
                        method: "POST",
                        dataType: "JSON",
                        data: { function: "AfficherCommandesClient" },
                        beforeSend: function(){
                          $('#overlayAjaxLoading').show();  
                        },
                        success: function(data){     
                            console.log(data);
                            if(data != null){
                                    
                                $("#comm_tables_ctr").empty();

                                $.each(data.data, function(index, element) {

                                     var table = '<table id="dt_commande_'+data.data[index][0]+'" class="table table-bordered dt-commandes"> <thead class="dt-commandes-thead"> </thead> <tbody class="dt-commandes-tbody"> </tbody> </table>';

                                    $("#comm_tables_ctr").append(table);

                                    var thead = $(".dt-commandes-thead:last"),
                                        tbody = $(".dt-commandes-tbody:last");

                                    var supp = '<div class="commande-supp-ctr"><button class="commande-supp-btn ovr-button-styles">supprimer</button></div>';
            
                                    if($(data.data[index][2]).text() == "Confirmé")
                                        thead.append('<tr><th class="commande-th-head" colspan="6"> <div class="commande-no-ctr">Commande No : <span class="cart-id-text">'+data.data[index][0]+'</span></div><div class="commande-date-ctr"><i class="fa fa-clock-o"></i><span class="cart-date-text">  '+data.data[index][1]+'</span></div></th></tr>');
                                    else
                                        thead.append('<tr><th class="commande-th-head" colspan="6"> <div class="commande-no-ctr">Commande No : <span class="cart-id-text">'+data.data[index][0]+'</span></div><div class="commande-date-ctr"><i class="fa fa-clock-o"></i><span class="cart-date-text">  '+data.data[index][1]+'</span></div>'+supp+'</th></tr>');


                                    tbody.append('<tr> <td class="cart-description-product"> <div class="cart-image-ctr"> <img class="cart-image" src="'+data.data[index][7]+'"> </div><div class="cart-description"><span>'+data.data[index][8]+'<span></div><div class="cart-color"><i class="fa fa-tags cart-color-icon"></i>Couleur : <span class="cart-color-text">'+data.data[index][9]+'</span></div></td><td class="cart-total-amount"> <span class="total-amount">'+data.data[index][4]+' DHS</span> </td><td class="cart-quantite"> <span class="cart-quantite-text">'+data.data[index][3]+'</span> </td><td class="cart-status"> '+data.data[index][2]+' </td><td class="delivery-type"> <span class="delivery-type-text">'+data.data[index][5]+'</span> </td><td class="cart-operation">'+data.data[index][10]+'</td></tr>');


                                });
                                
                                
                                $.each(data.data2, function(index, element) {

                                    var table = '<table id="dt_commande_'+data.data2[index][0][0]+'" class="table table-bordered dt-commandes"> <thead class="dt-commandes-thead"> </thead> <tbody class="dt-commandes-tbody"> </tbody> </table>';

                                    $("#comm_tables_ctr").append(table);

                                    var thead = $(".dt-commandes-thead:last"),
                                        tbody = $(".dt-commandes-tbody:last");
                                    
                                    var supp = '<div class="commande-supp-ctr"><button class="commande-supp-btn ovr-button-styles">supprimer</button></div>';
                                    
                                    if($(data.data2[index][0][2]).text() == "Confirmé")
                                        thead.append('<tr><th class="commande-th-head" colspan="6"> <div class="commande-no-ctr">Commande No : <span class="cart-id-text">'+data.data2[index][0][0]+'</span></div><div class="commande-date-ctr"><i class="fa fa-clock-o"></i><span class="cart-date-text">'+data.data2[index][0][1]+'</span></div></th></tr>');
                                    else
                                        thead.append('<tr><th class="commande-th-head" colspan="6"> <div class="commande-no-ctr">Commande No : <span class="cart-id-text">'+data.data2[index][0][0]+'</span></div><div class="commande-date-ctr"><i class="fa fa-clock-o"></i><span class="cart-date-text">'+data.data2[index][0][1]+'</span></div>'+supp+'</th></tr>');
                                    
                                    $.each(data.data2[index], function(index2, element){
                                         
                                        tbody.append('<tr> <td class="cart-description-product"> <div class="cart-image-ctr"> <img class="cart-image" src="'+data.data2[index][index2][7]+'"> </div><div class="cart-description"><span>'+data.data2[index][index2][8]+'<span></div><div class="cart-color"><i class="fa fa-tags cart-color-icon"></i>Couleur : <span class="cart-color-text">'+data.data2[index][index2][9]+'</span></div></td><td class="cart-quantite"> <span class="cart-quantite-text">'+data.data2[index][index2][3]+'</span> </td></tr>');
                                                     
                                     });
                                    
                                    var total = '<td rowspan="'+data.data2[index].length+'" class="cart-total-amount"> <span class="total-amount">'+data.data2[index][0][4]+' DHS</span> </td>';
                                    $("#dt_commande_"+data.data2[index][0][0]+" .cart-description-product:first").after(total);
                                    
                                    
                                    var status = '<td rowspan="'+data.data2[index].length+'"  class="cart-status"> '+data.data2[index][0][2]+' </td>';
                                    $("#dt_commande_"+data.data2[index][0][0]+" .cart-quantite:first").after(status);
                                    
                                    var typeLivraison = '<td rowspan="'+data.data2[index].length+'" class="delivery-type"> <span class="delivery-type-text">'+data.data2[index][0][5]+'</span> </td>';
                                    $("#dt_commande_"+data.data2[index][0][0]+" .cart-status:first").after(typeLivraison);
                                    
                                    var operation = '<td rowspan="'+data.data2[index].length+'" class="cart-operation">'+data.data2[index][0][10]+'</td>';
                                    $("#dt_commande_"+data.data2[index][0][0]+" .delivery-type:first").after(operation);
                                });
                                
                                //$('.dt-commandes').hide().fadeIn(299);
                            }
                            if(data == null){
                                $(".empty-order-ctr").show();
                                $("#comm_tables_ctr").empty();
                            }
                        },
                        complete: function(){
                            setTimeout(function(){
                                $('#overlayAjaxLoading').hide();
                            }, 300);
                            
                        }
                    });

                }
                
            });
        
        </script>

		<?php include_once "includes/newsletter.php" ?>

		<?php include_once "includes/footer.php" ?>