$(document).ready(function(){
    
    RemplirPanier();
    StorePagination();
    AfficherProduitsFilter();
    AfficherMarques();  
    
    $(".dropdown").on("click", function () {
        $(".cart-dropdown").toggle();
    });
    
    $('.cart-summary, .cart-btns').on('click', function (e) {
		e.stopPropagation();
	});
    
    $(document).on("click",".add-to-cart-btn", function(e){
        $(this).children(".fa-shopping-cart").toggleClass("produit-panier-icon");
        $(this).toggleClass("produit-panier");  

        var articleID = $(this).attr("id");
        $.ajax({
            url: '../public-includes/ajax_queries',
            method: 'POST',
            data: {
                function: 'AjouterAuPanier', 
                articleID: articleID
            },
            dataType: 'JSON',
            success: function(data){
                if(data != false){      
                    $("#audio")[0].play();
                    RemplirPanier();
                }
                else
                    $(location).attr('href', '../login.php');
            }
        })
        
    }); 
    
    $(document).on("click",".delete",function(){
    
        var articleID = $(this).attr("id");
        $.ajax({
            url: "../public-includes/ajax_queries",
            method: "POST",
            data: {
                function: "SupprimerAuPanier",
                articleID: articleID
            },
            dataType: 'JSON',
            success: function (data) {
                if (data != false){
                    $("div#" + articleID + ".product-widget").remove();
                    RemplirPanier();
                    $(".cart-dropdown").toggle();
                }
            }
        });
    });
    
});

function StorePagination(){

    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });
    
    var marques = [];
    $(".marque-check").each(function () {
        if ($(this).prop("checked")) {
            marques.push($(this).attr("id"));
        }
    });

    var minPrix = $("#price-min").val();
    var maxPrix = $("#price-max").val();
    var filtrerpar = $("#filtrerPar option:selected").val();
    var afficherNbr = $("#afficherNbr option:selected").val();


    if(categoriesIDs != ''){
        $.ajax({
            url: "../public-includes/ajax_queries",
            method: "POST",
            data: {
                function: "StorePagination",
                categoriesIDs: JSON.stringify(categoriesIDs),
                marques: JSON.stringify(marques),
                minPrix: minPrix,
                maxPrix: maxPrix,
                filtrerPar: filtrerpar,
                afficherNbr: afficherNbr,
            },
            dataType: "JSON",
            async: false,
            success: function(data){
                if(data != null){
                    $(".store-pagination").empty();
                    for(var i=1; i<=data[0].nbr_pages; i++){
                        if(data[0].page_nbr == i)
                            $(".store-pagination").append("<li id='"+i+"' class='active pagination'>"+i+"</li>");
                        else
                            $(".store-pagination").append("<li id='"+i+"' class='pagination'><a>"+i+"</a></li>");
                    }
                }
            }
        });
    }
    else{
        $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
    }
        
};

function AfficherProduitsFilter() {
    
    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });

    var marques = [];
    $(".marque-check").each(function () {
        if ($(this).prop("checked")) {
            marques.push($(this).attr("id"));
        }
    });

    var minPrix = $("#price-min").val();
    var maxPrix = $("#price-max").val();
    var filtrerpar = $("#filtrerPar option:selected").val();
    var afficherNbr = $("#afficherNbr option:selected").val();
    var page_nbr = $(".store-pagination li[class*='active']").attr("id");   
    if(page_nbr === undefined) // cannot page_nbr be undefined or null
        page_nbr = 1;
    
    if (categoriesIDs[0] != null && minPrix != '' && maxPrix != '') {
        $.ajax({
            url: '../public-includes/ajax_queries',
            method: 'POST',
            data: {
                function: "AfficherProduitsFilter",
                categoriesIDs: JSON.stringify(categoriesIDs),
                marques: JSON.stringify(marques),
                minPrix: minPrix,
                maxPrix: maxPrix,
                filtrerPar: filtrerpar,
                afficherNbr: afficherNbr,
                page_nbr: page_nbr
            },
            dataType: "JSON",
            async: false,
            beforeSend: function(){
                Lodding($(".produits-filter"));
            },
            success: function (data) {    
                if(data != null){
                    $(".produits-filter").empty();
                    for(var i=0;i<data.length - 2;i++)
                    {
                        if(data[i].remiseDisponible == true){
                            $(".produits-filter").append("<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'><div class='product pro-tab1'><div class='product-img no-slick-product' style='background-image:url("+data[i].imageArticle+")'><div class='product-label'><span class='sale'>"+data[i].tauxRemise+"%</span><span class='new'>Nouveau</span></div></div><div class='product-body'><p class='product-category'>"+data[i].categorieNom+"</p><h3 class='product-name'><a href='#'>"+data[i].articleNom+"</a></h3><h4 class='product-price'>"+data[i].articlePrixRemise+" DHS<del class='product-old-price'>"+data[i].articlePrix+"</del></h4><div class='product-rating'>"+data[i].niveau+"</div><div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div></div><div class='add-to-cart'><button id='"+data[i].articleID+"' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>");
                        }
                        else
                            $(".produits-filter").append("<div class='col-xs-12 col-sm-6 col-md-4 col-lg-4'><div class='product pro-tab1'><div class='product-img no-slick-product' style='background-image:url("+data[i].imageArticle+")'><div class='product-label'><span class='new'>Nouveau</span></div></div><div class='product-body'><p class='product-category'>"+data[i].categorieNom+"</p><h3 class='product-name'><a href='#'>"+data[i].articleNom+"</a></h3><h4 class='product-price'>"+data[i].articlePrix+" DHS</h4><div class='product-rating'>"+data[i].niveau+"</div><div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div></div><div class='add-to-cart'><button id='"+data[i].articleID+"' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div></div>");
                    }
                    $(".store-qty").html("Affichés "+data[data.length - 1] +" Sur "+data[data.length -2 ]);
                }
                else{
                    AucunResultat($(".produits-filter"));
                    $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
                }
            }
        });
    }
    else{
        AucunResultat($(".produits-filter"));
        $(".store-pagination").html("<li id='-1' class='active pagination'>1</li>");
    }
    
}

function AfficherMarques() {
    var categoriesIDs = [];
    $(".cat-check").each(function () {
        if ($(this).prop("checked")) {
            categoriesIDs.push($(this).attr("id"));
        }
    });

    $.ajax({
        url: '../public-includes/ajax_queries',
        method: 'POST',
        data: {
            function: "AfficherMarquesFilter",
            categoriesIDs: JSON.stringify(categoriesIDs),
        },
        dataType: "JSON",
        async: false,
        success: function (data) {
            if(data != null){
                $(".marques-produit").empty();
                for(var i=0;i<data.length;i++){
                    $(".marques-produit").append("<div class='input-checkbox'><input class='marque-check' type='checkbox' id='"+data[i].articleMarque+"'><label for='"+data[i].articleMarque+"'><span></span>"+data[i].articleMarque+"<small>"+data[i].nbr_produits+"</small></label></div>");
                }
            }
            else
                $(".marques-produit").html("<span>Aucun marque trouvé !</span>");
        }
    });
}

function RemplirPanier(){
	$.ajax({
	    url: '../public-includes/ajax_queries',
	    method: 'POST',
	    data: {
	        function: 'RemplirPanier'
	    },
	    dataType: 'JSON',
	    success: function (data) {
	        $(".cart-list").html(data['data']);
	        $("#prixTotal").html(data['prixTotal']+ " DHS");
            $(".qty-panier, #nbrArticles").html(data['qty-panier']);
	    }
	});
}

function reload_js(src) {
    $('script[src="' + src + '"]').remove();
    $('<script>').attr('src', src).appendTo('.scripts');
}

function SlickNav1() {

    var eles = $(".tab1");
    $(eles).each(function () {
        if ($(this).hasClass("active"))
            categorie = $(this).attr("id");
    });
      
    if(categorie.length > 0){
        var ele = $("div[data-nav='#slick-nav-1']");
        $.ajax({
            url: "../public-includes/ajax_queries.php",
            method: "POST",
            data: {
                function: "RechargerTab",
                categorie: categorie
            },
            beforeSend: function(){
                Lodding(ele);
            },
            dataType: "JSON",
            async: false,
            success: function (data) {
                LoadSildeData(data, ele);
            }
        });    
    }
}

function SlickNav2() {
    var eles = $(".tab2");
    $(eles).each(function () {
        if ($(this).hasClass("active"))
            categorie = $(this).attr("id");
    });
      
    var ele = $("div[data-nav='#slick-nav-2']");
    $.ajax({
        url: "../public-includes/ajax_queries.php",
        method: "POST",
        data: {
            function: "RechargerTab",
            categorie: categorie
        },
        dataType: "JSON",
        async: false,
        beforeSend: function () {
            Lodding(ele);
        },
        success: function (data) {
            LoadSildeData(data, ele);
        }
    });    
}

function SlickWidget1(){
    var categorie = $(".categorie-widget1").attr("id");
    var ele = $("div[data-nav='#slick-nav-3']");

    $.ajax({
        url: "../public-includes/ajax_queries.php",
        method: "POST",
        data: {
            function: "RechargerTabWidget",
            categorie: categorie
        },
        dataType: "JSON",
        async: false,
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            LoadSlideWidgetData(data['tab1'], ele);
            LoadSlideWidgetData(data['tab2'], ele);
            // refersh slick scripts
            UnslickSlideWidget();
        }
    });     
}

function SlickWidget2(){
    var categorie = $(".categorie-widget2").attr("id");
    var ele = $("div[data-nav='#slick-nav-4']");
    $.ajax({
        url: "../public-includes/ajax_queries.php",
        method: "POST",
        data: {
            function: "RechargerTabWidget",
            categorie: categorie
        },
        dataType: "JSON",
        async: false,
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            LoadSlideWidgetData(data['tab1'], ele);
            LoadSlideWidgetData(data['tab2'], ele);
            // refersh slick scripts
            UnslickSlideWidget();
        }
    });     
}

function SlickWidget3(){
    var categorie = $(".categorie-widget3").attr("id");
    var ele = $("div[data-nav='#slick-nav-5']");
    $.ajax({
        url: "../public-includes/ajax_queries.php",
        method: "POST",
        data: {
            function: "RechargerTabWidget",
            categorie: categorie
        },
        dataType: "JSON",
        async: false,
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            LoadSlideWidgetData(data['tab1'], ele);
            LoadSlideWidgetData(data['tab2'], ele);
            // refersh slick scripts
            UnslickSlideWidget();
        }
    });     
}

function LoadSildeData(data, ele){
    if(data != null){
        ele.slick('slickRemove', null, null, true); // remove slide data
        ele.empty();
        for (var i = 0; i < data.length; i++) {
            if (data[i].remiseDisponible == true) {
                ele.append("<div class='product pro-tab1' style='visibility:hidden'> <div class='product-img'><img src='" + data[i].imageArticle + "' alt='" + data[i].imageArticle + "'> <div class='product-label'><span class='sale'>" + data[i].tauxRemise + "%</span><span class='new'>Nouveau</span></div></div><div class='product-body'><p class='product-category'>" + data[i].categorieNom + "</p><h3 class='product-name'><a href='#'>" + data[i].articleNom + "</a></h3> <h4 class='product-price'>" + data[i].articlePrixRemise + " DHS<del class='product-old-price'>" + data[i].articlePrix + "</del></h4> <div class='product-rating'>" + data[i].niveau + "</div><div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div></div><div class='add-to-cart'><button id='" + data[i].articleID + "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div>");
            }
            else
                ele.append("<div class='product pro-tab1' style='visibility:hidden'> <div class='product-img'><img src='" + data[i].imageArticle + "' alt='" + data[i].imageArticle + "'> <div class='product-label'><span class='new'>Nouveau</span></div></div><div class='product-body'> <p class='product-category'>" + data[i].categorieNom + "</p><h3 class='product-name'><a href='#'>" + data[i].articleNom + "</a></h3> <h4 class='product-price'>" + data[i].articlePrix + " DHS</h4> <div class='product-rating'>" + data[i].niveau + "</div><div class='product-btns'><button class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button><button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button><button class='quick-view'><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button></div></div><div class='add-to-cart'><button id='" + data[i].articleID + "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div>");
        }
        UnslickSlide(ele);
    }
    else
        AucunResultat(ele);
}

function LoadSlideWidgetData(data, ele){
    var json = JSON.parse(data);
    if(json != null){
        var html = "";
        for(var i=0;i<json.length;i++){
            if(i === 0)
                html+= "<div>";
            if(json[i].remiseDisponible == true)
                html+= "<div class='product-widget'> <div class='product-img'> <img src='"+json[i].imageArticle+"' alt='"+json[i].imageArticle+"'> </div><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='#'>"+json[i].articleNom+"</a></h3> <h4 class='product-price'>"+json[i].articlePrix+"<del class='product-old-price'>"+json[i].articlePrixRemise+"</del></h4> </div></div>";
            else
                html+= "<div class='product-widget'> <div class='product-img'> <img src='"+json[i].imageArticle+"' alt='"+json[i].imageArticle+"'> </div><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='#'>"+json[i].articleNom+"</a></h3> <h4 class='product-price'>"+json[i].articlePrix+"</h4> </div></div>";
            if(i=== json.length - 1)
                html+= "</div>";
        }
        ele.append(html);
    }
}

function LoadAsideData(data, ele) {
    var json = JSON.parse(data);
    if (json != null) {
        var html = "";
        for (var i = 0; i < json.length; i++) {
            if (json[i].remiseDisponible == true)
                html += "<div class='product-widget'> <div class='product-img'> <img src='" + json[i].imageArticle + "' alt='" + json[i].imageArticle + "'> </div><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='#'>" + json[i].articleNom + "</a></h3> <h4 class='product-price'>" + json[i].articlePrix + "<del class='product-old-price'>" + json[i].articlePrixRemise + "</del></h4> </div></div>";
            else
                html += "<div class='product-widget'> <div class='product-img'> <img src='" + json[i].imageArticle + "' alt='" + json[i].imageArticle + "'> </div><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='#'>" + json[i].articleNom + "</a></h3> <h4 class='product-price'>" + json[i].articlePrix + "</h4> </div></div>";
        }
        ele.append(html);
    }
}

function Lodding(ele){
    ele.html("<div class='row text-center'><img src='img/Rolling-0.7s-157px.svg' style='padding: 5% 0'></div>");
}

function AucunResultat(ele){
    ele.html('<div class="row"><div class="col-12 text-center" style="padding:20% 0"><h2><img src="img/not-found.png"><span style="color:#D10024">Oups</span> ! Aucun resultat..</h2></div></div>');
}

function UnslickSlide(ele){
    ele.slick('unslick');
    $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
}

function UnslickSlideWidget(){
    $("div[data-nav='#slick-nav-1']").slick('unslick');
    $("div[data-nav='#slick-nav-2']").slick('unslick');
    $("div[data-nav='#slick-nav-3']").slick('unslick');
    $("div[data-nav='#slick-nav-4']").slick('unslick');
    $("div[data-nav='#slick-nav-5']").slick('unslick');
    $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
}

/****** VALIDATION FUNCTIONS *****/

// check if email is valid
function validEmail(email) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email.val().match(mailformat))
        return true;
    else
        return false;
}

// Validate numbers
function allNumbers(number) {
    var numbers = /^[0-9]*$/;
    if (number.val().match(numbers))
        return true;
    else
        return false;
}

// Validate length
function validLength(input, min, max) {
    var l = input.val().length;
    if (l >= min && l <= max)
        return true;
    else
        return false;
}

// check if all letters are string words without space
function allLetters(name) {
    var letters = /^[A-Za-z]+$/;
    if (name.val().match(letters))
        return true;
    else
        return false;
}

// check if all letters are string words with space
function allLettersWithSpace(name) {
    var letters = /^[A-Za-z\s]+$/g;
    if (name.val().match(letters))
        return true;
    else
        return false;
}


// check telephone string format
function check_numberPhone(number) {
    let numberPhone = /(\+212|0)([ \-_/]*)(\d[ \-_/]*){9}$/g;
    if ((number.val().match(numberPhone)))
        return true;
    else
        return false;
}

function validNumber(number)
{
    var numbers = /^\d+$/g;
    if(number.val().match(numbers))
        return true;
    else
        return false;
}

// change icon color when input is validated or is not
function icon_change_color(span, icon, ifcorrect) {
    if (ifcorrect == "true") {
        span.css("background-color", "#67daa1");
        icon.css("color", "#fff");
    }
    else {
        span.css("background-color", "initial");
        icon.css("color", "#b6bbc2");
    }
}

function compteIntrouvable()
{
    $("#username_error").css("visibility", "visible");
    $("#username_error").html("* Nom d'utilisateur ou le mot de passe est incorrect");
}

function emailCodeIncorrect(){
    $("#codemail_error").css("visibility", "visible");
    $("#codemail_error").html("* Code de confirmation email est incorrect");
}

/****** END VALIDATION FUNCTIONS *****/
