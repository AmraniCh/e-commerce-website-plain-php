$(document).ready(function(){
    
    RemplirPanier();
    StorePagination();
    AfficherMarques();
    
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
        $(".cart-dropdown").css("opacity","1");
        $(".cart-dropdown").css("visibility","visible");
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
                }
            }
        });
    });
    
    
});


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
        success: function (data) {
            $(".marques-produit").html(data);
        }
    });
}

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
            beforeSend: function(){
                Lodding($(".produits-filter"));
            },
            success: function (data) {

                if(data != '')
                    $(".produits-filter").html(data);
                else
                    AucunResultat($(".produits-filter"));
            }
        });
    } 
    else
        $(".produits-filter").empty();
    
}

function StorePagination(){
    var afficherNbr = $("#afficherNbr option:selected").val();
    
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
        success: function(data){

                $(".store-pagination").empty();
                for(var i=1; i<=data[0].nbr_pages; i++){
                    if(data[0].page_nbr == i)
                        $(".store-pagination").append("<li id='"+i+"' class='active pagination'>"+i+"</li>");
                    else
                        $(".store-pagination").append("<li id='"+i+"' class='pagination'><a>"+i+"</a></li>");
                }
        
                AfficherProduitsFilter();
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
            success: function (data) {
                ele.slick('slickRemove', null, null, true); // remove slide data
                ele.html(data);
                // refersh scripts
                setTimeout(function () {
                    ele.slick('unslick');
                    $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
                }, 10);
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
        beforeSend: function () {
            Lodding(ele);
        },
        success: function (data) {
            ele.slick('slickRemove', null, null, true); // remove slide data
            ele.html(data);
            // refersh scripts
            setTimeout(function () {
                ele.slick('unslick');
                $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
            }, 10);
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
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            ele.append(data['tab1']);
            ele.append(data['tab2']);
            // refersh scripts
            setTimeout(function () {
                $("div[data-nav='#slick-nav-1']").slick('unslick');
                $("div[data-nav='#slick-nav-2']").slick('unslick');
                $("div[data-nav='#slick-nav-3']").slick('unslick');
                $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
            }, 10);
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
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            ele.append(data['tab1']);
            ele.append(data['tab2']);
            // refersh scripts
            setTimeout(function () {
                $("div[data-nav='#slick-nav-1']").slick('unslick');
                $("div[data-nav='#slick-nav-2']").slick('unslick');
                $("div[data-nav='#slick-nav-3']").slick('unslick');
                $("div[data-nav='#slick-nav-4']").slick('unslick');
                $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
            }, 10);
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
        success: function (data) {
            // remove slide data
            ele.slick('slickRemove', null, null, true);
            ele.append(data['tab1']);
            ele.append(data['tab2']);
            // refersh scripts
            setTimeout(function () {
                $("div[data-nav='#slick-nav-1']").slick('unslick');
                $("div[data-nav='#slick-nav-2']").slick('unslick');
                $("div[data-nav='#slick-nav-3']").slick('unslick');
                $("div[data-nav='#slick-nav-4']").slick('unslick');
                $("div[data-nav='#slick-nav-5']").slick('unslick');
                $('<script>').attr('src', "js/refersh-slick.js").appendTo('.scripts');
            }, 10);
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

function Lodding(ele){
    ele.html("<div class='row text-center'><img src='img/Rolling-0.7s-157px.svg' style='padding: 5% 0'></div>");
}

function AucunResultat(ele){
    ele.html('<div class="row"><div class="col-12 text-center" style="padding:20% 0"><h2><img src="img/not-found.png"><span style="color:#D10024">Oups</span> ! Aucun resultat..</h2></div></div>');
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

/****** END VALIDATION FUNCTIONS *****/
