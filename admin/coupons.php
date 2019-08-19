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
                          <h3 class="title">Les Coupons</h3>
                          <button type="button" class="btn btn-dark-blue btn-sm open-dialog" data-toggle="modal" data-target="#ajtCpnMDL"><i class="fas fa-plus-circle"></i>Ajouter Coupon</button>               
                      </div>
                      <div class="profile-content">
                          <form action="" id="profile" method="post">
                              <div class="row">
                                  <div class="col-md-12">
                                     <div class="table-responsive">
                                          <table id="dt_coupons" class="table table-hover coupons-table">
                                    
              
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
        
        <div class="modal fade" id="spmCpnMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Vous Voulez Vraiment Supprimé Ce Coupon ?
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-dismiss="modal">Non, merci</button>
                    <button type="button" id="suppCpnBtn" class="btn btn-red">Oui</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="ajtCpnMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                   <form id="form_ajtCpn">
                    <div class="form-group">
                        <label class="label">Nom de Coupon :</label>
                        <div class="input-group">
                            <input type="text" id="nomCpn" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Coupon Code :</label>
                        <div class="input-group">
                            <input type="text" id="codeCpn" class="form-control" placeholder="Coupon Code">
                            <div class="input-group-append gnr-cd-cpn">
                                <span class="input-group-text append-text" id="gnrCdCpn">Génerer<i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="cpnValid" class="form-check-input" checked> Coupon Valide
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Le Taux :</label>
                        <div class="input-group">
                            <input type="text" id="tauxCpn" class="form-control" placeholder="Ex : 20">
                            <div class="input-group-append append-initial-height">
                                <span class="input-group-text append-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Date De Début De Validité :</label>
                        <div class="input-group">
                            <input type="date" id="cpnDb" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Date De Fin De Validité :</label>
                        <div class="input-group">
                            <input type="date" id="cpnDf" class="form-control">
                        </div>
                        <div class="container text-error-ctr">
                            <small id="dateFinErreur"  class="form-text text-muted error-date-cpn"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Coupon Valide Pour : </label>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="tous" class="form-check-input" checked> Tous Les Produits
                            </label>
                        </div>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="categories" class="form-check-input"> Des Categories Spécifiques
                            </label>
                        </div>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="articles" class="form-check-input"> Des Produits Spécifiques
                            </label>
                        </div>
                    </div>
                    </form>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button id="ajtCpnMDLBtn" type="button" class="btn btn-red">Ajouter Coupon</button>
                  </form>
              </div>
            </div>
          </div>
        </div>          
        
        <div class="modal fade" id="mdfCpnMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier ce Coupon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <div class="form-group">
                        <label class="label">Nom de Coupon :</label>
                        <div class="input-group">
                            <input type="text" id="nomCpnMdf" class="form-control" placeholder="Nom">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Coupon Code :</label>
                        <div class="input-group">
                            <input type="text" id="codeCpnMdf" class="form-control" placeholder="Coupon Code">
                            <div class="input-group-append gnr-cd-cpn">
                                <span class="input-group-text append-text" id="gnrCdCpnMdf">Génerer<i class="fas fa-sync"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" id="cpnValidMdf" class="form-check-input" checked> Coupon Valide
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Le Taux :</label>
                        <div class="input-group">
                            <input type="text" id="tauxCpnMdf" class="form-control" placeholder="Ex : 20">
                            <div class="input-group-append append-initial-height">
                                <span class="input-group-text append-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Date De Début De Validité :</label>
                        <div class="input-group">
                            <input type="date" id="cpnDbMdf" class="form-control" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Date De Fin De Validité :</label>
                        <div class="input-group">
                            <input type="date" id="cpnDfMdf" class="form-control">
                        </div>
                        <div class="container text-error-ctr">
                            <small id="dateFinErreurMdf" class="form-text text-muted error-date-cpn"></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="label">Coupon Valide Pour : </label>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="tous" class="form-check-input" checked> Tous Les Produits
                            </label>
                        </div>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="categories" class="form-check-input"> Des Categories Spécifiques
                            </label>
                        </div>
                        <div class="form-radio">
                            <label class="form-check-label">
                                <input type="radio" name="cpnFilter" data-cls="cpn-filter" data-id="articles" class="form-check-input"> Des Produits Spécifiques
                            </label>
                        </div>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button id="mdfCpnMDLBtn" type="button" class="btn btn-red">Modifier Coupon</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
          
        <div class="modal fade" id="fltrCatMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Coupon Appliquer Aux Categories Sélécionnées Suivants : </h5>
                <button type="button" class="close" data-cls="rtn-first-modal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                    <?php
            
                        $categorie = new Categorie();
                        $query = $categorie->AfficherCategories();
                        if($query != null):

                            while($row = $query->fetch_assoc()){
                                echo '<div class="form-group">
                                       <div class="form-check">
                                            <label class="form-check-label">
                                                <input name="cpnCatFilter" type="checkbox" data-id="'.$row['categorieID'].'" class="form-check-input"> '.$row['categorieNom'].'
                                            </label>
                                        </div>
                                    </div>';
                            }
                        

                        endif;
                    ?>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-light" data-cls="rtn-first-modal" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button id="cpnCatFilter" type="button" data-cls="rtn-first-modal" class="btn btn-red">Ok</button>
                  </form>
              </div>
            </div>
          </div>
        </div>
        
        <div class="modal fade" id="fltrArtMDL" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" id="overrideWidth" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                <button type="button" class="close" data-cls="rtn-first-modal" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="container">
                  <div class="table-responsive">
                   <table id="dt_articles" class="table table-hover dt-pag-btrp">

                     </table>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <form action="" method="post">
                    <button type="button" class="btn btn-blueary" data-cls="rtn-first-modal" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i>Annuler</button>
                    <button type="button" id="cpnArtFilter" data-cls="rtn-first-modal" class="btn btn-red">Oui</button>
                  </form>
              </div>
            </div>
          </div>
        </div>   

        <script>
        
            $(function(){
                
                dataTableInitialize();
                SubstructCategories();
                 
                var cpnModalPassingData = [];
                var cpnData = [];
                var cpnDataFilterCat = [];
                var cpnDataFilterArt = [];
                var filter = "tous";

                $(document).on("click", ".dots", function(){
                    var span = $(this).parent().find(".show-more");
                    if(!span.hasClass("active"))
                        span.toggleClass("active");
                    else
                        span.removeClass("active");
                });

                document.getElementById('cpnDb').valueAsDate = new Date();
                
                $("#gnrCdCpn").click(function(){
                    $(this).css("padding", "0");

                    $.ajax({
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: { function: "GenererCodeCoupon" },
                        beforeSend: function(){
                            $("#gnrCdCpn").html('<div class="loading-review-submit"><img src="../index/img/loading145px.svg"></div>');
                        },
                        success: function(data){
                            setTimeout(function(){
                                $("#gnrCdCpn").css("padding", "0.56rem 0.8rem");
                                $("#gnrCdCpn").html("Génerer<i class='fas fa-sync'></i>");
                                $("#codeCpn").val(data);
                            }, 500);
                        }
                    });

                });

                $("#gnrCdCpnMdf").click(function(){
                    $(this).css("padding", "0");

                    $.ajax({
                        url: "../public-includes/ajax_queries",
                        method: "POST",
                        dataType: "JSON",
                        data: { function: "GenererCodeCoupon" },
                        beforeSend: function(){
                            $("#gnrCdCpnMdf").html('<div class="loading-review-submit"><img src="../index/img/loading145px.svg"></div>');
                        },
                        success: function(data){
                            setTimeout(function(){
                                $("#gnrCdCpnMdf").css("padding", "0.56rem 0.8rem");
                                $("#gnrCdCpnMdf").html("Génerer<i class='fas fa-sync'></i>");
                                $("#codeCpnMdf").val(data);
                            }, 500);
                        }
                    });

                });
                
                $("#ajtCpnMDLBtn").click(function(){

                    var nomCpn = $("#nomCpn").val().trim();
                    var codeCpn = $("#codeCpn").val().trim();
                    var tauxCpn = parseInt($("#tauxCpn").val());
                    var valideCpn = $("#cpnValid").prop("checked");
                    var cpnDb = $("#cpnDb").val();
                    var cpnDf = $("#cpnDf").val();

                    if(compareCouponDates(cpnDb, cpnDf) != null && nomCpn != "" && codeCpn != "" && tauxCpn != 0 && tauxCpn != NaN && tauxCpn < 100){

                        cpnData.push(nomCpn, codeCpn, valideCpn, tauxCpn, cpnDb, cpnDf);
                        
                        var filterData = (cpnDataFilterCat.length > 0) ? cpnDataFilterCat : (cpnDataFilterArt.length > 0) ? cpnDataFilterArt : null;
                        $.ajax({
                            url: "../public-includes/ajax_queries",
                            method: "POST",
                            data: { 
                                function: "AjouterCoupon",
                                cpnData: JSON.stringify(cpnData),
                                filterData: JSON.stringify(filterData),
                                filter: filter
                            },
                            dataType: "JSON",
                            async: false,
                            success: function(data){
            
                                if(data != null)
                                {
                                    $("#form_ajtCpn")[0].reset();
                                    resetFilterCat();
                                    resetFilterArt();
                                    document.getElementById('cpnDb').valueAsDate = new Date();
                                    cpnData = [];
                                    dataTableInitialize();
                                    $("button[data-dismiss='modal']").click();
                                }
                            }
                        });
                        
                        setTimeout(function(){
                             SubstructCategories();
                        }, 100);
                        
                    } 
                });
                
                $("#mdfCpnMDLBtn").click(function(){
                    
                    cpnData = [];
 
                    var nomCpn = $("#nomCpnMdf").val().trim();
                    var codeCpn = $("#codeCpnMdf").val().trim();
                    var tauxCpn = parseInt($("#tauxCpnMdf").val());
                    var valideCpn = $("#cpnValidMdf").prop("checked");
                    var cpnDb = $("#cpnDbMdf").val();
                    var cpnDf = $("#cpnDfMdf").val();
                    
                    if(compareCouponDates(cpnDb, cpnDf) != null && nomCpn != "" && codeCpn != "" && tauxCpn != 0 && tauxCpn != NaN && tauxCpn < 100){

                        cpnData.push(cpnModalPassingData[0], nomCpn, codeCpn, valideCpn, tauxCpn, cpnDb, cpnDf);

                        if(cpnDataFilterCat.length > 0){
                            filterData = cpnDataFilterCat;
                            filter = "categories";
                        }
                        else if(cpnDataFilterArt.length > 0){
                            filterData = cpnDataFilterArt;
                            filter = "articles";
                        }
                        else{
                            filterData = "tous";
                            filter = "tous";
                        }
                        
                        $.ajax({
                            url: "../public-includes/ajax_queries",
                            method: "POST",
                            data: { 
                                function: "ModifierCoupon",
                                cpnData: JSON.stringify(cpnData),
                                filterData: JSON.stringify(filterData),
                                filter: filter
                            },
                            dataType: "JSON",
                            async: false,
                            success: function(data){
                                if(data != null)
                                {
                                    resetFilterCat();
                                    resetFilterArt();
                                    $("button[data-dismiss='modal']").click();
                                    dataTableInitialize();
                                    SubstructCategories();
                                }
                            }
                        });
                    } 
                    
                });

                $("#cpnDf").on("input", function(){

                    var cpnDb = $("#cpnDb").val();
                    var cpnDf = $("#cpnDf").val();

                    compareCouponDates(cpnDb, cpnDf);
                    
                });
                
                $("#cpnDfMdf").on("input", function(){
                    
                    var cpnDb = $("#cpnDbMdf").val();
                    var cpnDf = $("#cpnDfMdf").val();

                    compareCouponDates(cpnDb, cpnDf);
                    
                });

                $(document).on("click", ".open-dialog", function(){

                    cpnModalPassingData = [];
                    cpnDataFilterCat = [];
                    cpnDataFilterArt = [];
                    
                    $(".error-date-cpn").empty();

                    var idCpn = $(this).closest("tr").children("[data-src='idCpn']").attr("data-id");
                    var nomCpn = $(this).closest("tr").children("[data-src='nomCpn']").attr("data-id");
                    var codeCpn = $(this).closest("tr").children("[data-src='codeCpn']").attr("data-id");
                    var tauxCpn = $(this).closest("tr").children("[data-src='tauxCpn']").attr("data-id");
                    var valideCpn = $(this).closest("tr").children("[data-src='valideCpn']").attr("data-id");
                    var dateDbCpn = $(this).closest("tr").children("[data-src='dateDbCpn']").attr("data-id");
                    var dateFinCpn = $(this).closest("tr").children("[data-src='dateFinCpn']").attr("data-id");

                    cpnModalPassingData.push(idCpn, nomCpn, codeCpn, tauxCpn, valideCpn, dateDbCpn, dateFinCpn);
                    
                });

                $("input[data-cls='cpn-filter']").on("change", function(){

                    var id = $(this).attr("data-id");

                    switch(id)
                    {
                        case "tous":
                            cpnDataFilterArt.length = 0;
                            cpnDataFilterCat.length = 0;
                            resetFilterArt();
                            resetFilterCat();break;
                        case "categories":
                            cpnDataFilterArt.length = 0;
                            resetFilterArt();
                            filter = "categories";
                            $("#ajtCpnMDL").css("visibility", "hidden");
                            $("#mdfCpnMDL").css("visibility", "hidden");
                            $("#fltrCatMDL").modal("toggle");break;
                        case "articles":
                            cpnDataFilterCat.length = 0;
                            resetFilterCat();
                            filter = "articles";
                            $("#ajtCpnMDL").css("visibility", "hidden");
                            $("#mdfCpnMDL").css("visibility", "hidden");
                            $("#fltrArtMDL").modal("toggle");break;
                    }

                });

                $("button[data-cls='rtn-first-modal']").on("click", function(){
                    var styles = {
                        visibility: "visible", 
                        overflow: "auto"
                    }
                    $("#ajtCpnMDL").css(styles);
                    $("#mdfCpnMDL").css(styles);
      
                });

                $("#suppCpnBtn").click(function(){

                    if(cpnModalPassingData[0] != "" && cpnModalPassingData[0] != NaN)
                    {
                        $.ajax({
                            url: '../public-includes/ajax_queries',
                            method: "post",
                            data: { 
                                function: "SupprimerCoupon",
                                idCpn: cpnModalPassingData[0]
                            },
                            dataType: "JSON",
                            async: false,
                            success: function(data){
                                if(data != null){
                                    $("button[data-dismiss='modal']").click();
                                    dataTableInitialize();
                                    SubstructCategories();
                                }
                            }
                        });
                    }

                });
                
                $("#cpnCatFilter").click(function(){

                    cpnDataFilterCat = [];

                    $("input[name='cpnCatFilter']").each(function(){

                        if($(this).prop("checked"))
                            cpnDataFilterCat.push($(this).attr("data-id"));

                    });

                    $("#fltrCatMDL").modal("hide");
                    $("#ajtCpnMDL").modal("visibility", "visible");

                });

                $("#cpnArtFilter").click(function(){

                    cpnDataFilterArt = [];

                    $("input[name='cpnArtFilter']").each(function(){

                        if($(this).prop("checked"))
                            cpnDataFilterArt.push($(this).attr("data-id"));

                    });

                    $("#fltrArtMDL").modal("hide");
                    $("#ajtCpnMDL").modal("visibility", "visible");

                });

                $(document).on("click", "button[data-target='#mdfCpnMDL']", function(){

                    if(cpnModalPassingData[4] === "false")
                        var bool = false;
                    else
                        var bool = true;

                    $("#nomCpnMdf").val(cpnModalPassingData[1]);
                    $("#codeCpnMdf").val(cpnModalPassingData[2]);
                    $("#tauxCpnMdf").val(cpnModalPassingData[3]);
                    $("#cpnValidMdf").prop("checked", bool);
                    $("#cpnDbMdf").val(cpnModalPassingData[5]);
                    $("#cpnDfMdf").val(cpnModalPassingData[6]);
                    
                    $.post(
                        "../public-includes/ajax_queries",
                        { 
                            function: "FilterCoupon",
                            cpnID: cpnModalPassingData[0]
                        },
                        function(data){
                            $("input[name='cpnFilter'][data-id='"+data.filter+"']").prop("checked", true);
                            if(data.filter == "articles")
                            {
                                $.each(data.data, function(index, element){
                                    cpnDataFilterArt.push(data.data[index]);
                                });
                            }
                        },
                        "json"
                    );

                });
            });
        
            function resetFilterCat(){
                $("input[name='cpnCatFilter']").each(function(){
                    $(this).prop("checked", false);
                });     
            }
            
            function resetFilterArt(){
                $("input[name='cpnArtFilter']").each(function(){
                    $(this).prop("checked", false);
                });     
            }
            
            function compareCouponDates(cpnDb, cpnDf){    

                if(cpnDf != ""){ // empty date string

                    var dateDb = new Date(cpnDb);

                    var dateFin = new Date(cpnDf);

                    if(dateDb > dateFin)
                        $(".error-date-cpn").text("Date fin validité ne peut pas etre supérieur au date début");
                    else{
                        $(".error-date-cpn").empty();
                        return true;
                    }

                }
                else
                    $(".error-date-cpn").text("Date fin validité obligatoire");

                return null;
            }
            
            function SubstructCategories(){
            
                var tds = $("td[data-src='appliquerAu']");
                
                tds.each(function(){
                    
                    var cats = $(this).text();
                
                    $(this).empty();

                    var cats_array = cats.split('|');
                    
                    if(cats_array[0] != "tous" && cats_array.length != 1){
                        
                        for(let i = 0 ; i < cats_array.length ; i++){
                            
                            if( i < 2 )
                                $(this).append(cats_array[i] + ' | ');
                            
                            if( i === 1 && cats_array.length != 2  )
                                $(this).append("<span class='dots'> . . . </span>");
                            
                            if( i === 2)
                                $(this).append("<span class='show-more'><br></span>");  
                            
                            var show_more = $(this).children("span[class*='show-more']");
                            
                            if( i >= 2)
                                $(show_more).append(cats_array[i] + ' | ');
                            
                            if( i > 2 && (i + 1) % 2 !== 0 )
                                $(show_more).append("<br>");

                        }
                        
                    }
                    else
                        $(this).text(cats_array[0]);
                    
                });
            }
            
            // custom dataTable configurations
            function dataTableInitialize(){
                
                $('#dt_coupons').dataTable({
                    destroy: true,
                    "order":[[10, "desc"]],
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
                        { title: '<i class="fas fa-edit icon-col"></i>' },
                        { title: '<i class="fas fa-trash"></i>' },
                        { title: 'ID' },
                        { title: 'Nom' },
                        { title: 'Code' },
                        { title: 'Valide' },
                        { title: 'Taux' },
                        { title: 'Appliqué Au' },
                        { title: 'Date Début' },
                        { title: 'Date D\'expiration' },
                        { title: 'Date D\'ajoute '},
                      ],
                    ajax: {
                        url: "../public-includes/ajax_queries",
                        data: {
                            function: "AfficherCoupons"
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
                                    tds[i].setAttribute("data-src", "idCpn");
                                    tds[i].setAttribute("data-id", data[2]);
                                break;
                                case 3: 
                                    tds[i].setAttribute("data-src", "nomCpn");
                                    tds[i].setAttribute("data-id", data[3]);
                                break;
                                case 4: 
                                    tds[i].setAttribute("data-src", "codeCpn");
                                    tds[i].setAttribute("data-id", data[4]);
                                break;
                                case 5: 
                                    if(tds[i].innerText == "Valide")
                                        var bool = true;
                                    else
                                        var bool = false;
                                    tds[i].setAttribute("data-src", "valideCpn");
                                    tds[i].setAttribute("data-id", bool);
                                break;
                                case 6: 
                                    tds[i].setAttribute("data-src", "tauxCpn"); 
                                    tds[i].setAttribute("data-id", data[6]);
                                break;
                                case 7: 
                                    tds[i].setAttribute("data-src", "appliquerAu"); 
                                    $(tds[i]).css("width", "10%"); 
                                break;
                                case 8: 
                                    tds[i].setAttribute("data-src", "dateDbCpn");
                                    tds[i].setAttribute("data-id", data[8]);
                                break;
                                case 9: 
                                    tds[i].setAttribute("data-src", "dateFinCpn");
                                    tds[i].setAttribute("data-id", data[9]);
                                break;
                                    
                            }
                        }
                    }
                });
                
                $('#dt_articles').dataTable({
                    destroy: true,
                    "order":[[1, "desc"]],
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
                        { title: '' },
                        { title: 'ID' },
                        { title: 'Image' },
                        { title: 'Nom' },
                        { title: 'Description' },
                        { title: 'Prix' },
                        { title: 'Taux Remise' },
                        { title: 'Prix Remise' }
                      ],
                    ajax: {
                        url: "../public-includes/ajax_queries",
                        data: {
                            function: "AfficherArticlesCoupon"
                        },
                        method: "post",
                        dataType: "json",
                        async: false
                    },
                    'createdRow': function( row, data, dataIndex ) {
                        var tds = $(row).children("td");
                        for(let i = 0; i < tds.length ; i++){
                            switch(i){ 
                                case 4: 
                                    tds[i].setAttribute("data-src", "description");
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