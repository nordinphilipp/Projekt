function validateLogin() {
    var emailFormat = /^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/;		//Fixa denna så att den enbart kollar .@.
    var pwFormat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    var errormsg = "";

    var email = document.getElementById('staticEmail');
    var password = document.getElementById('inputPassword');

    if (email.value.trim() == "") 				    // Kollar om "namn" i form är tom efter borttagning av whitspace
    {
        errormsg = errormsg + "\n Du har missat att fylla i email";
    }
    if (password.value.trim() == "")	            // Kollar password är tomt efter borttagning av whitespace.
    {
        errormsg = errormsg  + "\n Du har missat att välja ett lösenord";
    }
    if(!email.value.match(emailFormat)){
        errormsg = errormsg + "\n Fel format för email";
    }
    if(!password.value.match(pwFormat)){
        errormsg = errormsg + "\n Fel format för lösenord";
    }
    if(email.value.match(emailFormat) && password.value.match(pwFormat)){
        return true;
    }else{
        alert(errormsg);
        password.value="";
        return false;
    }
}

function validateReg() {
    var emailFormat = /^[a-zA-Z]+[a-zA-Z0-9_.-]*@[a-zA-Z0-9-.]+\.[a-zA-Z.]{2,5}$/;
    var pwFormat = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;

    var errormsg = "";

    var email = document.getElementById('staticEmail');
    var password = document.getElementById('inputPassword');
    var pwConf = document.getElementById('repeatPassword');

    if (email.value.trim() == "") 				// Kollar om "namn" i form är tom  OBS!! Fixa så att en tom sträng inte fungerar för att uppfylla detta villkor!!
    {
        errormsg = errormsg + "\n Du har missat att fylla i namn";
    }
    if (password.value.trim() == "")	            // Kollar om "m i form är skrivet i rätt format i form.
    {
        errormsg = errormsg + "\n Du har missat att välja ett lösenord";
    }
    if (!email.value.match(emailFormat)) {
        errormsg = errormsg + "\n Fel format för email";
    }
    if (!password.value.match(pwFormat)) {
        errormsg = errormsg + "\n Fel format för lösenord";
    }
    if(password.value !== pwConf.value){
        errormsg = errormsg + "\n Lösenorden stämmer inte överens";
    }
    if (email.value.match(emailFormat) && password.value.match(pwFormat) && password.value === pwConf.value) {
        return true;
    } else {
        alert(errormsg);
        password.value = "";
        pwConf.value = "";
        return false;
    }
}