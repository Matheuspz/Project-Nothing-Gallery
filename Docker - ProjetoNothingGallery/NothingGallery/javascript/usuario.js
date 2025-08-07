function validarUpd(event) {
    event.preventDefault();

    let regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let regexSenha = /^.{8,20}$/gm;

    let email = document.forms["formUpd"]["email"].value;
    let senha = document.forms["formUpd"]["senha_atual"].value;

    let errorUpd = document.getElementById("errorUpd");

    let cEmail = document.getElementById("email");
    let cSenha = document.getElementById("senha_atual");

    let isValid = true;
    // Resetar as cores de fundo

    cEmail.style.backgroundColor = "#1a1a1a";
    cSenha.style.backgroundColor = "#1a1a1a";

    /* Email */
    if (email !== ""){
        let emailVerify = regexEmail.test(email);
        if (emailVerify == false ) {
            cEmail.style.backgroundColor = "#ff9d9d";
            cEmail.style.color = "#000000"
            isValid = false;
        }
    }

    /* Senha */
    if (senha !== "") {
        let senhaVerity = regexSenha.test(senha);
        if (senhaVerity == false) {
            cSenha.style.backgroundColor = "#ff9d9d";
            cSenha.style.color = "#000000"
            isValid = false;
        }
    }

    if (isValid) {
        // Todas as validações passaram
        errorUpd.style.opacity = 0;
        document.forms["formUpd"].submit(); // Enviar o formulário
    } else {
        // Pelo menos uma validação falhou
        errorUpd.style.opacity = 1;
        errorUpd.innerHTML = "Por favor, corrija os campos inválidos.";
    }
}