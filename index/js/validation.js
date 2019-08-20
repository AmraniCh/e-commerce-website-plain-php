"use strict";

(function () {

    // validation variables
    var username_error = true,
        email_error = true,
        prenom_error = true,
        nom_error = true,
        adresse_error = true,
        tele_error = true,
        reponse_error = true,
        password_error = true,
        pass_match_error = true,
        code_postal_error = true,
        username = $("#username"),
        email = $("#email"),
        prenom = $("#prenom"),
        nom = $("#nom"),
        adresse = $("#adresse"),
        tele = $("#tele"),
        reponse = $("#reponse"),
        code_postal = $("#code_postal"),
        passowrd = $("#password");

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

        if (!validLength(reponse, 3, 50)) {
            $("#reponse_error").css("visibility", "visible");
            $("#reponse_error").html("* Une réponse doit contenir entre entre 3-50 caractères");
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
                $("#password2_error").html("* Les mots de passe ne correspondent pas.");
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
}());

(function(){

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
}());

(function(){
    
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

        if (codemail.length > 5) {
            alert();
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
    
}());

function ValidationProfile(){
    
    $("#validMsg").empty();
    
    var username_error = true,
        email_error = true,
        prenom_error = true,
        nom_error = true,
        adresse_error = true,
        ville_error = true,
        tele_error = true,
        code_postal_error = true,
        adresse_error = true,
        reponse_error = true,
        password_error,
        pass_match_error,
        username = $("#username"),
        email = $("#email"),
        prenom = $("#prenom"),
        nom = $("#nom"),
        adresse = $("#adresse"),
        ville = $("#ville"),
        tele = $("#tele"),
        reponse = $("#reponse"),
        code_postal = $("#code_postal"),
        motdepasse = $("#motdepasse"),
        motdepasse2 = $("#cnfPasse");

    function check_prenom() {
        if (!validName(prenom)) {
            showValidationMsg("* Un prénom doit contient des caractères entre 3 et 30 & contient uniquement des caractères.");
            prenom_error = true;
        }
        else
            prenom_error = false;
        
        return prenom_error;
    }
    
    function check_nom() {

        if (!validName(nom)) {
            showValidationMsg("* Un nom doit contient des caractères entre 3 et 30 & contient uniquement des caractères.");
            nom_error = true;
        }
        else
            nom_error = false;

        return nom_error;
    }
    
    function check_email() {
        
        if (!validEmail(email)) {
            showValidationMsg("* Adresse email incorrect.");
            email_error = true;
        }
        else
            email_error = false;
    }
    
    function check_adresse() {
        
        if (!validLength(adresse, 3, 50)) {
            showValidationMsg("* Une adresse doit contient au minimaum 3 caractères et maximaux 50.");
            adresse_error = true;
        } 
        else
            adresse_error = false;
    }
    
    function check_ville() {
        
        if (!validLength(ville, 3, 30)) {
            showValidationMsg("* Un nom de ville ddoit contient des caractères entre 3 et 30.");
            ville_error = true;
        } 
        else
            ville_error = false;
    }
    
    function check_postal() {
        
         if (!allNumbers(code_postal) || !validLength(code_postal, 4, 8)) {
            showValidationMsg("* Code postal invalide.");
            code_postal_error = true;
        } 
        else
            code_postal_error = false;
    }
    
    function check_tele() {
        
        if (!check_numberPhone(tele) || !validLength(tele, 10, 10) && !validLength(tele, 13, 13)){
            showValidationMsg("* Numéro téléphone invalide.");
            tele_error = true;
        } 
        else
            tele_error = false;
    }
    
    function check_reponse() {

        if (!validName(reponse)) {
            showValidationMsg("* Un réponse doit contient des caractères entre 3 et 30 & contient uniquement des caractères.");
            reponse_error = true;
        }
        else
            reponse_error = false;

        return reponse_error;
    }
    
    function check_password() {

        if(motdepasse.val().length > 0){
            password_error = true;
            if (!validLength(motdepasse, 3, 30)) {
                showValidationMsg("* Un mot de passe doit contient des caractères entre 3 et 30.");
                password_error = true;
            }
            else
                password_error = false;
        }

        return password_error;
       
    }
    
    function check_password2() {
        
        if(motdepasse.val().length > 0){
            pass_match_error = true;
            if(motdepasse2.val() != motdepasse.val()){
                showValidationMsg("* Les mots de passe ne correspondent pas.");
                pass_match_error = true;
            }
            else
                pass_match_error = false;
        }

        return pass_match_error;
    }
    
    function showValidationMsg(msg){
        $("#validMsg").removeClass("valid-msg-success").addClass("valid-msg-error");
        $("#validMsg").append(msg+"<br>");
    }
    
    check_prenom();
    check_nom();
    check_email();
    check_adresse();
    check_ville();
    check_postal();
    check_tele();
    check_reponse();
    check_password();
    check_password2();

    if(prenom_error == false && nom_error == false && email_error == false && adresse_error == false && ville_error == false && code_postal_error == false && tele_error == false && reponse_error == false && password_error != true && pass_match_error != true){
        $("#validMsg").empty();
        return true;
    }
    else
        return false;
    
};