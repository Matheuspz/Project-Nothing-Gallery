function lValidar() {
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let regexSenha = /^.{8,20}$/gm;/*
    let regexEmailAdmin = /^[a-z0-9]+W*(@admin.com.org)\W*$/gm;*/

    let lEmailF = document.forms["loginForm"]["loginEmail"].value;
    let lSenhaF = document.forms["loginForm"]["loginSenha"].value;

    let lEmail = document.getElementById("loginEmail");
    let lSenha = document.getElementById("loginSenha");
    let lErro = document.getElementById("lError");

    lEmail.style.backgroundColor = "#ffffff"; 
    lSenha.style.backgroundColor = "#ffffff";


    /* Email *//*
    let emailVerifyAdmin = regexEmailAdmin.test(lEmailF);*/
    let emailVerify = regexEmail.test(lEmailF);
    if (emailVerify == false) {
        lEmail.style.backgroundColor = "#ff9d9d";
        
        lErro.style.opacity = 1;
        lErro.innerHTML = "Email inválido";

        return false;
    } else { lEmail.style.backgroundColor = "#9dffba" }

    /* Senha */
    let senhaVerity = regexSenha.test(lSenhaF);
    if (senhaVerity == false) {
        lSenha.style.backgroundColor = "#ff9d9d";
        
        lErro.style.opacity = 1;
        lErro.innerHTML = "Senha deve conter no minimo 8 digitos";

        return false;
    } else { lSenha.style.backgroundColor = "#9dffba" }
}






function cValidar() {
    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let regexEmailAdmin = /^[a-z0-9]+W*(@admin.com.org)\W*$/gm;
    let regexSenha = /^.{8,20}$/gm;

    let cNameF = document.forms["cadastroForm"]["cadastroNome"].value;
    let cSobrenomeF = document.forms["cadastroForm"]["cadastroSobrenome"].value;
    let cEmailF = document.forms["cadastroForm"]["cadastroEmail"].value;
    let cSenhaF = document.forms["cadastroForm"]["cadastroSenha"].value;
    let cSenhaConF = document.forms["cadastroForm"]["cadastroConfSenha"].value;

    let cErro = document.getElementById("cError");
    let cNome = document.getElementById("cadastroNome");
    let cSobrenome = document.getElementById("cadastroSobrenome");
    let cEmail = document.getElementById("cadastroEmail");
    let cSenha = document.getElementById("cadastroSenha");
    let cConfSenha = document.getElementById("cadastroConfSenha");

    cSobrenome.style.backgroundColor = "#ffffff";
    cNome.style.backgroundColor = "#ffffff";
    cEmail.style.backgroundColor = "#ffffff";
    cSenha.style.backgroundColor = "#ffffff";
    cConfSenha.style.backgroundColor = "#ffffff";

    /* Nome */
    if (cNameF == "") {

        cNome.style.backgroundColor = "#ff9d9d";
        
        cErro.style.opacity = 1;
        cErro.innerHTML = "Nome inválido";

        return false;
    } else { cNome.style.backgroundColor = "#9dffba" }

    /* Sobrenome */
    if (cSobrenomeF == "") {
        cSobrenome.style.backgroundColor = "#ff9d9d";
        
        cErro.style.opacity = 1;
        cErro.innerHTML = "Sobrenome inválido";

        return false;
    } else { cSobrenome.style.backgroundColor = "#9dffba" }

    /* Email */
    let emailVerify = regexEmail.test(cEmailF);
    if (emailVerify == false ) {
        cEmail.style.backgroundColor = "#ff9d9d";
        
        cErro.style.opacity = 1;
        cErro.innerHTML = "Email inválido";

        return false;
    } else { cEmail.style.backgroundColor = "#9dffba" }

    /* Senha */ 
    let senhaVerity = regexSenha.test(cSenhaF);
    if (senhaVerity == false) {
        cSenha.style.backgroundColor = "#ff9d9d";
        
        cErro.style.opacity = 1;
        cErro.innerHTML = "Senha deve conter no minimo 8 digitos";

        return false;
    } else { cSenha.style.backgroundColor = "#9dffba" }

    /* Confirmar Senha */
    if (cSenhaConF != cSenhaF) {
        cConfSenha.style.backgroundColor = "#ff9d9d";

        cErro.style.opacity = 1;
        cErro.innerHTML = "Senhas não coincidem";

        return false;
    } else { cConfSenha.style.backgroundColor = "#9dffba" }
}