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
      
    var ele = $("div[data-nav='#slick-nav-1']");
    $.ajax({
        url: "../public-includes/ajax_queries.php",
        method: "POST",
        data: {
            function: "RechargerTab",
            categorie: categorie
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

