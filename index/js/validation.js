
// register page validation
$(function () {

    // validation variables
    var username_error = true;
    var email_error = true;
    var prenom_error = true;
    var nom_error = true;
    var adresse_error = true;
    var tele_error = true;
    var reponse_error = true;
    var password_error = true;
    var pass_match_error = true;
    var code_postal_error = true;

    // inputs
    var username = $("#username");
    var email = $("#email");
    var prenom = $("#prenom");
    var nom = $("#nom");
    var adresse = $("#adresse");
    var tele = $("#tele");
    var reponse = $("#reponse");
    var code_postal = $("#code_postal");
    var passowrd = $("#password");

    // detect text change 
    $('#username').on('input', function (ev) {
        check_username(ev);
    });

    $('#email').on('input', function (ev) {
        check_email(ev);
    });

    $('#prenom').on('input', function (ev) {
        check_prenom(ev);
    });

    $('#nom').on('input', function (ev) {
        check_nom(ev);
    });

    $('#adresse').on('input', function (ev) {
        check_adresse(ev);
    });

    $('#tele').on('input', function (ev) {
        check_tele(ev);
    });

    $('#reponse').on('input', function (ev) {
        check_reponse(ev);
    });

    $('#code_postal').on('input', function (ev) {
        check_code_postal(ev);
    });

    $('#password').on('input', function (ev) {
        check_password(ev);
    });

    $('#password2').on('input', function (ev) {
        check_password(ev);
    });

    // username validation
    function check_username(ev) {
        var icon = $("#username-ic-i");
        var span = $("#username-ic-span");

        if (!validLength(username, 5, 20)) {
            $("#username_error").css("visibility", "visible");
            $("#username_error").html("* Nom d'utilisateur doit contenir entre 5-20 catactères !");
            username_error = true;
            icon_change_color(span, icon);
        } else {
            username_error = false;
            $("#username_error").css("visibility", "hidden");
            $("#username_error").html("*");
            // icon change color
            icon_change_color(span, icon, "true");
        }
    }

    // email validation
    function check_email(ev) {
        var icon = $("#email-ic-i");
        var span = $("#email-ic-span");

        if (!validEmail(email)) {
            $("#email_error").css("visibility", "visible");
            $("#email_error").html("* Adresse email incorrect !");
            email_error = true;
            icon_change_color(span, icon);
        } else {
            $("#email_error").css("visibility", "hidden");
            email_error = false;
            $("#email_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // prenom validation
    function check_prenom(ev) {
        var icon = $("#prenom-ic-i");
        var span = $("#prenom-ic-span");

        if (!validLength(prenom, 3, 30)) {
            $("#prenom_error").css("visibility", "visible");
            $("#prenom_error").html("* Un prenom doit contenir entre entre 3-30 caractères !");
            prenom_error = true;
            icon_change_color(span, icon);
        } else if (!allLetters(prenom)) {
            $("#prenom_error").css("visibility", "visible");
            $("#prenom_error").html("* Un nom ne contient pas des numéros ou des espaces !");
            prenom_error = true;
            icon_change_color(span, icon);
        } else {
            $("#prenom_error").css("visibility", "hidden");
            prenom_error = false;
            $("#prenom_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // nom validation
    function check_nom(ev) {
        var icon = $("#nom-ic-i");
        var span = $("#nom-ic-span");

        if (!validLength(nom, 3, 30)) {
            $("#nom_error").css("visibility", "visible");
            $("#nom_error").html("* Un nom doit contenir entre 3-30 caractères !");
            nom_error = true;
            icon_change_color(span, icon);
        } else if (!allLettersWithSpace(nom)) {
            $("#nom_error").css("visibility", "visible");
            $("#nom_error").html("* Un nom ne contient pas de chiffres !");
            nom_error = true;
            icon_change_color(span, icon);
        } else {
            $("#nom_error").css("visibility", "hidden");
            nom_error = false;
            $("#nom_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // adresse validation
    function check_adresse(ev) {
        var icon = $("#adresse-ic-i");
        var span = $("#adresse-ic-span");

        if (!validLength(adresse, 3, 50)) {
            $("#adresse_error").css("visibility", "visible");
            $("#adresse_error").html("* Une adresse doit contenir entre minimaum 3 et maximaux 50 caractères !");
            adresse_error = true;
            icon_change_color(span, icon);
        } else {
            $("#adresse_error").css("visibility", "hidden");
            adresse_error = false;
            $("#adresse_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // tele validation
    function check_tele(ev) {
        var icon = $("#tele-ic-i");
        var span = $("#tele-ic-span");

        if (!check_numberPhone(tele) || !validLength(tele, 10, 10) && !validLength(tele, 13, 13)) {
            $("#tele_error").css("visibility", "visible");
            $("#tele_error").html("* Numéro de telephone incorrect !");
            tele_error = true;
            icon_change_color(span, icon);
        } else {
            $("#tele_error").css("visibility", "hidden");
            tele_error = false;
            $("#tele_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // reponse validation
    function check_reponse(ev) {
        var icon = $("#reponse-ic-i");
        var span = $("#reponse-ic-span");

        if (!validLength(reponse, 6, 50)) {
            $("#reponse_error").css("visibility", "visible");
            $("#reponse_error").html("* Une réponse doit contenir entre entre 6-50 caractères");
            reponse_error = true;
            icon_change_color(span, icon);
        } else if (!allLetters(reponse)) {
            $("#reponse_error").css("visibility", "visible");
            $("#reponse_error").html("* Une réponse faut pas contient des numéros ou des espaces !");
            reponse_error = true;
            icon_change_color(span, icon);
        } else {
            $("#reponse_error").css("visibility", "hidden");
            reponse_error = false;
            $("#reponse_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // code postal validation
    function check_code_postal(ev) {
        var icon = $("#postal-ic-i");
        var span = $("#postal-ic-span");

        if (!allNumbers(code_postal) || !validLength(code_postal, 4, 8)) {
            $("#code_postal_error").css("visibility", "visible");
            $("#code_postal_error").html("* Code postal incorrect !");
            code_postal_error = true;
            icon_change_color(span, icon);
        } else {
            $("#code_postal_error").css("visibility", "hidden");
            code_postal_error = false;
            $("#code_postal_error").html("*");
            icon_change_color(span, icon, "true");
        }
    }

    // check password
    function check_password(ev) {
        var icon = $("#password-ic-i");
        var span = $("#password-ic-span");


        var idInput = $(ev.target).attr('id');
        if (idInput == "password") {
            if (!validLength(passowrd, 8, 40)) {
                password_error = true;
                $("#password_error").css("visibility", "visible");
                $("#password_error").html("* Un mot de passe doit contenir 8-40 caractères");
                icon_change_color(span, icon);
            } else {
                $("#password_error").css("visibility", "hidden");
                icon_change_color(span, icon, "true");
                password_error = false;
                $("#password_error").html("*");
            }
        }


        if (idInput == "password2") {
            var icon = $("#password2-ic-i");
            var span = $("#password2-ic-span");
            if ($("#password").val() != $("#password2").val()) {
                $("#password2_error").css("visibility", "visible");
                pass_match_error = true;
                icon_change_color(span, icon);
                $("#password2_error").html("* Les deux mots de passe sont pas identiques ! Réssayez");
            } else {
                $("#password2_error").css("visibility", "hidden");
                pass_match_error = false;
                $("#password2_error").html("*");
                icon_change_color(span, icon, "true");
            }
        }
    }


    // submit
    $("#register-form").submit(function (ev) {
        check_username(ev);
        check_email(ev);
        check_prenom(ev);
        check_nom(ev);
        check_adresse(ev);
        check_tele(ev);
        check_code_postal(ev);
        check_reponse(ev);
        check_password(ev);

        if (username_error == false && email_error == false && prenom_error == false && nom_error == false && adresse_error == false && tele_error == false && code_postal_error == false && reponse_error == false && password_error == false && pass_match_error == false) {
            return true;
        } else {
            return false;
        }
    });
});

// login page validation
$(function(){

    // validation variables
    var username_error = true;
    var password_error = true;

    // inputs
    var username = $("#username-lg");
    var passowrd = $("#password-lg");

    // detect text change 
    $('#username-lg').on('input', function () {
        check_username();
    });

    $('#password-lg').on('input', function (ev) {
        check_password();
    });


    // username validation
    function check_username() {
        var icon = $("#username-ic-i");
        var span = $("#username-ic-span");

        var l = username.val().length;
        if (l <= 4 || l >= 20) {
            $("#username_error").css("visibility", "visible");
            $("#username_error").html("* Nom d'utilisateur faut être entre 5-20 catactères !");
            username_error = true;
            icon_change_color(span, icon);
        } else {
            username_error = false;
            $("#username_error").css("visibility", "hidden");
            $("#username_error").html("*");
            // icon change color
            icon_change_color(span, icon, "true");
        }
    }


    // check password
    function check_password() {
        var icon = $("#password-ic-i");
        var span = $("#password-ic-span");

            if (!validLength(passowrd, 8, 40)) {
                password_error = true;
                $("#password_error").css("visibility", "visible");
                $("#password_error").html("* Mot de passe faut être entre 8-40 caractères");
                icon_change_color(span, icon);
            } else {
                $("#password_error").css("visibility", "hidden");
                icon_change_color(span, icon, "true");
                password_error = false;
                $("#password_error").html("*");
            }
    }

    // submit
    $("#login-form").submit(function () {
        
        check_username();
        check_password();

        if (username_error == false && password_error == false) {
            return true;
        } else {
            return false;
        }
    });
});

// emailconfirmation validation
$(function(){
    
    // validation variables
    var codemail_error = true;
    
    // inputs
    var codemail = $("#codemail");
    
    // detect text change 
    $('#codemail').on('input', function () {
        check_codemail();
    });
    
    // code email validation
    function check_codemail() {
        var icon = $("#codemail-ic-i");
        var span = $("#codemail-ic-span");

        var l = codemail.val().length;
        if (l != 6) {
            $("#codemail_error").css("visibility", "visible");
            $("#codemail_error").html("* Le code ne doit contenir que 6 chiffres !");
            codemail_error = true;
            icon_change_color(span, icon);
        } else if (!allNumbers(codemail)) {
            $("#codemail_error").css("visibility", "visible");
            $("#codemail_error").html("* Le code ne doit contenir que des chiffres !");
            codemail_error = true;
            icon_change_color(span, icon);
        }else{
            codemail_error = false;
            $("#codemail_error").css("visibility", "hidden");
            $("#codemail_error").html("*");
            // icon change color
            icon_change_color(span, icon, "true");
        }
    }
    
    // submit
    $("#email-conf-form").submit(function () {
        
        check_codemail();

        if (codemail_error == false) {
            return true;
        } else {
            return false;
        }
    });
    
});

//validation ajouter article
$(function(){
    let startsubmit = false;

    $("#nomPr").focusout(function () {
        if ($(this).val().length<6||$(this).val()==""){
            $(this).css("background-color","red");
            startsubmit=false;
        }
        else {
            $(this).css("background-color","");
            startsubmit=true;
        }
    });


    function validenomPr(){
        if ($("#nomPr").val().length<6||$("#nomPr").val()==""){
            return false;
        }
        else {
            return true;
        }
    }



    $("#nomPr").focusout(function () {
        if (!validenomPr()){
            $(this).css("background-color","red");

        }
        else {
            $(this).css("background-color","");
        }
    });


    $("#prixPr").focusout(function () {
        if (!validNumber($("#prixPr"))) {
            $(this).css("background-color","red");
            startsubmit=false;
        }
        else {
            $(this).css("background-color","");
            startsubmit=true;

        }
    });



    $("#prixPr").focusout(function () {
        alert(validNumber($("#prixPr")));

        if (!validNumber($("#prixPr"))) {
            $(this).css("background-color","red");
        }
        else {
            $(this).css("background-color","");
        }
    });


    $("#unitesStock").focusout(function () {
        if (!validNumber($("#unitesStock"))) {
            $(this).css("background-color","red");

        }
        else {
            $(this).css("background-color","");
        }
    });



    function validation(){
        if ($("#nomPr").val()==""){
            $("#nomPr").css("background-color","red");
            return false;
        }


        if ($("#descPr").val()==""){
            $("#descPr").css("background-color","red");
            return false;
        }else {
            $("#descPr").css("background-color","");
        }

        if ($("#prixPr").val()==""){
            $("#prixPr").css("background-color","red");
            return false;
        }else {
            $("#prixPr").css("background-color","");
        }

        if ($("#unitesStock").val()==""){
            $("#unitesStock").css("background-color","red");
            return false;
        }else {
            $("#unitesStock").css("background-color","");
        }

        if (!validenomPr()||!validNumber($("#prixPr"))||!validNumber($("#unitesStock")))
            return false;

        return true;
    }

    $("#unitesStock").focusout(function () {
        if (!validNumber($("#unitesStock"))) {
            $(this).css("background-color","red");
            startsubmit=false;
        }
        else {
            $(this).css("background-color","");
            startsubmit=true;

        }
    });

    function validation(){
        alert(startsubmit);
        return startsubmit;
    }
});

