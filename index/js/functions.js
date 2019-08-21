$(document).ready(function(){

    RemplirPanier();
    RemplirFavoris();
    
    $(".pan-toggle").on("click", function () {
        $(".fav-dropdown").css("display", "none");
        if($(".pan-dropdown").css("display") == "none"){
            $(".pan-dropdown").css("animation", "dropdownAnimation .3s");
            $(".pan-dropdown").show();
        }
        else
            $(".pan-dropdown").hide();
    });

    $(".fav-toggle").click(function () {
        $(".pan-dropdown").css("display", "none");
        if($(".fav-dropdown").css("display") == "none"){
            $(".fav-dropdown").css("animation", "dropdownAnimation .3s");
            $(".fav-dropdown").show();
        }
        else
            $(".fav-dropdown").hide();
    });
    
    $('.cart-summary, .cart-btns').on('click', function (e) {
        e.stopPropagation();
    });
    
    $(".scroll-top-body").click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() > 0)
            $(".scroll-top-body").show();
        else
            $(".scroll-top-body").hide();
    });
});

$(window).load(function () {
    $('#overlayLoadingPage').fadeOut();
});
    
$(document).on("click", function(event){
    element = $(event.target);
    
    if( !element.parents().hasClass("pan-toggle"))
        $(".pan-dropdown").hide();
    
    if( !element.parents().hasClass("fav-toggle"))
        $(".fav-dropdown").hide();

});

$(document).on("click", ".quick-view", function(){
   
    var url = $(this).children("a").attr("href");
    $(location).attr("href", url);
    
});

$(document).on("click", ".add-to-cart-btn", function(){

	$(this).children(".fa-shopping-cart").removeClass("produit-panier-icon");
	$(this).removeClass("produit-panier");
	
	setTimeout(function(){
		$(".add-to-cart-btn").children(".fa-shopping-cart").addClass("produit-panier-icon");
		$(".add-to-cart-btn").addClass("produit-panier");
	}, 10);
	
    var articleID = $(this).attr("id");
	var qty = 1;
	var couleur = "N/A";
    
	if(location.pathname.split('/').slice(-1)[0] === "produit.php"){
		qty = parseInt($(".qty-article").val());
        couleur = $("#couleurPrd option:selected").val().trim();
    }
	
    $.ajax({
        url: '../public-includes/ajax_queries',
        method: 'POST',
        data: {
            function: 'AjouterAuPanier', 
            articleID: articleID,
            qty: qty,
            couleur: couleur
        },
        dataType: 'JSON',
        success: function(data){
            //alert(data);
            if(data != null && data != false && data != -1){      
                $("#popupSound")[0].currentTime = 0;
                $("#popupSound")[0].play();
                RemplirPanier();
            }
            if(data == -1)
            {
                $(".produit-panier").css("animation", "none");
                $(".produit-panier-icon").css("animation", "none");
                if($("#overlayAjaxError").css("display") == "none"){
                    $("#overlayAjaxError").show();
                    $("#ajaxErrorText").text("Il n'y a pas assez de produits en stock.");
                    hideErrorDiv();
                }
            }
            if(data == false)
                 $(location).attr('href', '../login.php');
        }
    });
        
}); 
    
$(document).on("click", ".add-to-wishlist", function(){
	
	$(this).removeClass('favoris-anim');
    setTimeout(function(){
		$(".add-to-wishlist").addClass('favoris-anim');
	}, 10);
	
    var articleID = $(this).attr("id");
    $.ajax({
        url: '../public-includes/ajax_queries',
        method: 'POST',
        data: {
            function: 'AjouterAuxFavoris',
            articleID: articleID
        },
        dataType: 'JSON',
        success: function (data) {
            if (data != false) {
                $("#popupSound")[0].currentTime = 0;
                $("#popupSound")[0].play();
                RemplirFavoris();
            } 
            else
                $(location).attr('href', '../login.php');
        }
    });   
});

$(document).on("click",".supp-favoris",function(){
    
    var articleID = $(this).attr("id");
    
    $.ajax({
        url: "../public-includes/ajax_queries",
        method: "POST",
        data: {
            function: "SupprimerAuFavoris",
            articleID: articleID
        },
        dataType: 'JSON',
        beforeSend: function () {
            $('#overlayAjaxLoading').show();
        },
        success: function (data) {
            if (data != false) {
                $("div#" + articleID + ".pw-favoris").remove();
                RemplirFavoris();
                $(".fav-dropdown").css("animation", "none");
            }
        },
        complete: function () {
            setTimeout(function () {
                $('#overlayAjaxLoading').hide();
                $(".fav-dropdown").show();
            }, 300);
        }
    });
});

$(document).on("click", ".supp-panier", function(){

    var articleID = $(this).attr("id");

    $.ajax({
        url: "../public-includes/ajax_queries",
        method: "POST",
        data: {
            function: "SupprimerAuPanier",
            articleID: articleID
        },
        dataType: 'JSON',
        async: false,
        beforeSend: function () {
            $('#overlayAjaxLoading').show();
        },
        success: function (data) {
            if (data != false) {
                $("div#" + articleID + ".pw-panier").remove();
                RemplirPanier();
                $(".pan-dropdown").css("animation", "none");
                
                var url = location.pathname.split('/').slice(-1)[0];
                if (url == 'panier.php')
                    RemplirPagePanier();
            }
        },
        complete: function () {
            setTimeout(function () {
                $('#overlayAjaxLoading').hide();
                $(".pan-dropdown").show();
            }, 300);
        }
    });
        
});

$('.menu-toggle > a').on('click', function (e) {
    e.preventDefault();
    $('#responsive-nav').toggleClass('active');
});

function RemplirFavoris(){
	$.ajax({
	    url: '../public-includes/ajax_queries',
	    method: 'POST',
	    data: {
	        function: 'RemplirFavoris'
	    },
        async: false,
	    dataType: 'JSON',
	    success: function (data) {
            if(data != null){
                $(".cart-list-favori").empty();
                for(var i=0;i<data.length - 1;i++){
                    $(".cart-list-favori").append("<div id='"+data[i].articleID+"' class='product-widget pw-favori'><a href='produit.php?id=" + data[i].articleID + "'><div class='product-img'><img src='"+data[i].imageArticle+"' alt='"+data[i].articleNom+"'></div></a><div class='product-body'><h3 class='product-name'><a href='produit.php?id=" + data[i].articleID + "'>"+data[i].articleNom+"</a></h3><h4 class='product-price'><span class='qty'></span>"+data[i].prix+" DHS</h4></div><button id='"+data[i].articleID+"' class='delete supp-favoris ovr-button-styles'><i class='fa fa-times-circle'></i></button></div>");
                }
                $(".qty-favori, #nbrArticlesFavoris").html(data[data.length - 1]);
            }
            else{
                $(".cart-list-favori").html("<div class='msg-vide text-center'>Vous n'avez actuellement aucun favori.</div><div class='msg-vide text-center'>Ajoutez des produits à vos favoris en cliquant sur <span><i class='fa fa-heart-o'></i></span> la page du produit!</div>");
                $(".qty-favori, #nbrArticlesFavoris").html("0");
            }
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
        async: false,
	    success: function (data) {
            if(data != null){
                $(".cart-list-panier").empty();
                for(var i=0;i<data.length - 2;i++){
                    if(data[i].remiseDisponible == 1)
                        $(".cart-list-panier").append("<div id='"+data[i].articleID+"' class='product-widget pw-panier'><a href='produit.php?produit=" + data[i].param + "'><div class='product-img'><img src='"+data[i].imageArticle+"' alt='"+data[i].articleNom+"'></div></a><div class='product-body'><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>"+data[i].articleNom+"</a></h3><h4 class='product-price'><span class='qty'>"+data[i].quantite+"x</span>" + data[i].prixRemise + " DHS<del class='product-old-price'> " + data[i].prix + " DHS</del></h4></div><button id='"+data[i].articleID+"' class='delete supp-panier ovr-button-styles'><i class='fa fa-times-circle'></i></button></div>");
                    else
                        $(".cart-list-panier").append("<div id='"+data[i].articleID+"' class='product-widget pw-panier'><a href='produit.php?produit=" + data[i].param + "'><div class='product-img'><img src='"+data[i].imageArticle+"' alt='"+data[i].articleNom+"'></div></a><div class='product-body'><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>"+data[i].articleNom+"</a></h3><h4 class='product-price'><span class='qty'>"+data[i].quantite+"x</span>"+data[i].prixRemise+" DHS</h4></div><button id='"+data[i].articleID+"' class='delete supp-panier ovr-button-styles'><i class='fa fa-times-circle'></i></button></div>");
                }
                $("#prixTotal").html(data[data.length - 2]+ " DHS");
                $(".qty-panier, #nbrArticlesPanier").html(data[data.length - 1]);
            }
            else{
                $("#prixTotal").html("0 DHS");
                $(".cart-list-panier").html("Votre panier est vide. Aller faire les courses!");
                $(".qty-panier, #nbrArticlesPanier").html("0");
            }
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
                ele.append("<div class='product pro-tab1' style='visibility:hidden'><a href='produit.php?produit=" + data[i].param + "'><div class='product-img'><img src='" + data[i].imageArticle + "' alt='" + data[i].articleNom + "'> <div class='product-label'><span class='sale'>" + data[i].tauxRemise + "%</span><span class='new'>Nouveau</span></div></div></a><div class='product-body'><p class='product-category'>" + data[i].categorieNom + "</p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>" + data[i].articleNom + "</a></h3> <h4 class='product-price'>" + data[i].articlePrixRemise + " DHS<del class='product-old-price'>" + data[i].articlePrix + "</del></h4> <div class='product-rating'>" + data[i].niveau + "</div><div class='product-btns'><button id='" + data[i].articleID + "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><a href='produit.php?produit=" + data[i].param + "'><button class='quick-view'><a href='produit.php?produit=" + data[i].param + "'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='" + data[i].articleID + "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div>");
            }
            else
                ele.append("<div class='product pro-tab1' style='visibility:hidden'> <a href='produit.php?produit=" + data[i].param + "'><div class='product-img'><img src='" + data[i].imageArticle + "' alt='" + data[i].articleNom + "'> <div class='product-label'><span class='new'>Nouveau</span></div></div></a><div class='product-body'> <p class='product-category'>" + data[i].categorieNom + "</p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>" + data[i].articleNom + "</a></h3> <h4 class='product-price'>" + data[i].articlePrix + " DHS</h4> <div class='product-rating'>" + data[i].niveau + "</div><div class='product-btns'><button id='" + data[i].articleID + "' class='add-to-wishlist'><i class='fa fa-heart-o'></i><span class='tooltipp'>Ajouter aux Favoris</span></button><button class='quick-view'><a href='produit.php?produit=" + data[i].param + "'><i class='fa fa-eye'></i><span class='tooltipp'>aperçu rapide</span></a></button></div></div><div class='add-to-cart'><button id='" + data[i].articleID + "' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i> Ajouter au panier</button></div></div>");
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
                html+= "<div class='product-widget'> <a href='produit.php?produit=" + json[i].param + "'><div class='product-img'> <img src='"+json[i].imageArticle+"' alt='"+json[i].articleNom+"'> </div></a><div class='product-body'> <p class='product-category'><span class='new-product-badge'>NEW</span></p><h3 class='product-name'><a href='produit.php?produit=" + json[i].param + "'>"+json[i].articleNom+"</a></h3> <h4 class='product-price'>"+json[i].articlePrix+"<del class='product-old-price'>"+json[i].articlePrixRemise+"</del></h4> </div></div>";
            else
                html+= "<div class='product-widget'> <a href='produit.php?produit=" + json[i].param + "'><div class='product-img'> <img src='"+json[i].imageArticle+"' alt='"+json[i].articleNom+"'> </div></a><div class='product-body'> <p class='product-category'><span class='new-product-badge'>NEW</span><h3 class='product-name'><a href='produit.php?produit=" + json[i].param + "'>"+json[i].articleNom+"</a></h3> <h4 class='product-price'>"+json[i].articlePrix+"</h4> </div></div>";
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
                html += "<div class='product-widget'> <a href='produit.php?produit=" + data[i].param + "'><div class='product-img'><img src='" + json[i].imageArticle + "' alt='" + json[i].articleNom + "'> </div><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>" + json[i].articleNom + "</a></h3> <h4 class='product-price'>" + json[i].articlePrix + "<del class='product-old-price'>" + json[i].articlePrixRemise + "</del></h4> </div></div>";
            else
                html += "<div class='product-widget'> <a href='produit.php?produit=" + data[i].param + "'><div class='product-img'> <img src='" + json[i].imageArticle + "' alt='" + json[i].articleNom + "'> </div></a><div class='product-body'> <p class='product-category'><img src='img/new.png'></p><h3 class='product-name'><a href='produit.php?produit=" + data[i].param + "'>" + json[i].articleNom + "</a></h3> <h4 class='product-price'>" + json[i].articlePrix + "</h4> </div></div>";
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

function hideErrorDiv(){
    setTimeout(function(){
        $("#overlayAjaxError").hide();
        $("#ajaxErrorText").empty();
    }, 1500);
}

function validEmail(email) {
    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    if (email.val().match(mailformat))
        return true;
    else
        return false;
}

function allNumbers(number) {
    var numbers = /^[0-9]*$/;
    if (number.val().match(numbers))
        return true;
    else
        return false;
}

function validLength(input, min, max) {
    var l = input.val().length;
    if (l >= min && l <= max)
        return true;
    else
        return false;
}

function validName(name) {
    var regex =  /^[a-zA-Z ]{3,30}$/;
    if (name.val().match(regex))
        return true;
    else
        return false;
}

function allLetters(name) {
    var letters = /^[A-Za-z]+$/;
    if (name.val().match(letters))
        return true;
    else
        return false;
}

function allLettersWithSpace(name) {
    var letters = /^[A-Za-z\s]+$/g;
    if (name.val().match(letters))
        return true;
    else
        return false;
}

function check_numberPhone(number) {
    let numberPhone = /(\+212|0)([ \-_/]*)(\d[ \-_/]*){9}$/g;
    if ((number.val().match(numberPhone)))
        return true;
    else
        return false;
}

function validNumber(number){
    var numbers = /^\d+$/g;
    if(number.val().match(numbers))
        return true;
    else
        return false;
}

function ValidAdress(adress){
   var rgx = /^[a-zA-Z0-9\s,'-]*$/g;
    if(adress.val().match(rgx))
        return true;
    else
        return false; 
}

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

function compteIntrouvable(){
    $("#username_error").css("visibility", "visible");
    $("#username_error").html("* Nom d'utilisateur ou le mot de passe est incorrect");
}

function emailCodeIncorrect(){
    $("#codemail_error").css("visibility", "visible");
    $("#codemail_error").html("* Code de confirmation email est incorrect");
}

