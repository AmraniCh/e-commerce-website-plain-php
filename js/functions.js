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
function validNumber(number) {
    var numbers = /[0-9]/g;
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
function allLettersWithSpace(ev) {
    var name = $(ev.target);
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

/****** END VALIDATION FUNCTIONS *****/

