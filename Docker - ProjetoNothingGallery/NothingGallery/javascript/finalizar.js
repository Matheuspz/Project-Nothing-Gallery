function pagarCartao() {
    alert("Toda e qualquer 'compra' é fictícia, escreva apenas o modelo de um cartão de crédito (Ex: 1234 5678 9012 3456), nenhum cartão será cobrado");

    const idsToHide = ["metodoPag", "metodoPag2", "metodoPag3", "quantidade"];
    const idsToShow = ["formC", "btnVoltar"];

    idsToHide.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = "none";
    });

    idsToShow.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            if(id === "formC") el.style.display = "flex";
            else el.style.display = "block";
        }
    });

    const titulo = document.getElementById('titulo');
    if (titulo) {
        titulo.innerHTML = "Cartão";
        titulo.style.width = "15vmin";
    }
}

function pagVoltar() {
    const idsToShowFlex = ["metodoPag", "metodoPag2", "metodoPag3", "quantidade"];
    const idsToHide = ["formC", "comprarPix", "btnVoltar"];

    idsToShowFlex.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = "flex";
    });

    idsToHide.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = "none";
    });

    const titulo = document.getElementById('titulo');
    if (titulo) {
        titulo.innerHTML = "Selecione a forma de pagamento";
        titulo.style.width = "";
    }
}

function pagarPix() {
    const idsToHide = ["metodoPag", "metodoPag2", "metodoPag3", "quantidade"];
    const idsToShow = ["comprarPix", "btnVoltar"];

    idsToHide.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.style.display = "none";
    });

    idsToShow.forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            if(id === "comprarPix") el.style.display = "flex";
            else el.style.display = "block";
        }
    });

    const titulo = document.getElementById('titulo');
    if (titulo) {
        titulo.innerHTML = "Pix";
        titulo.style.width = "10vmin";
    }
}


function Validar() {
    let labelC = document.getElementById("labelC");

    let numCart = document.forms["formC"]["numCart"].value;
    numCart = numCart.replace(/[^\d]/g, '');
    let nomeCart = document.forms["formC"]["nomeCart"].value;
    let vencC = document.forms["formC"]["vencC"].value;
    let codsegC = document.forms["formC"]["codsegC"].value;
    let enderecoC = document.forms["formC"]["enderecoC"].value;

    let regexNumC = /^(?:\d[\s\.-]?){13,19}$/;
    let regexNome = /^[A-Za-zÀ-ÖØ-öø-ÿ\s]{3,50}$/;
    let regexVenc = /^(0[1-9]|1[0-2])\/\d{2}$/;
    let regexCodSeg = /^\d{3}$/;
    let regexEndereco = /^[\p{L}0-9\s.,ºª°\-\/#]{5,100}$/u;

    let vrnum = regexNumC.test(numCart);
    let vrn = regexNome.test(nomeCart);
    let vrv = regexVenc.test(vencC);
    let vrcs = regexCodSeg.test(codsegC);
    let vre = regexEndereco.test(enderecoC);

    if( vrnum == false ) {
        labelC.innerHTML = "Numero Inválido";
        labelC.style.display = "block"
        return false;
    } else if(vrn == false) {
        labelC.innerHTML = "Nome Inválido";
        labelC.style.display = "block"        
        return false;
    } else if(vrv == false) {
        labelC.innerHTML = "Validade Inválida";
        labelC.style.display = "block"
        return false;
    } else if(vrcs == false) {
        labelC.innerHTML = "Codigo de Segurança Inválido";
        labelC.style.display = "block"
        return false;
    } else if(vre == false) {
        labelC.innerHTML = "Endereço Inválido";
        labelC.style.display = "block"
        return false;
    }

}

function finalizarPix(event) {

    event.preventDefault();

    let enderecoPix = document.forms["formPix"]["enderecoPix"].value;
    let regexEnd1 = /^[a-z]+\ [0-9]+$/;

    let vreA = regexEnd1.test(enderecoPix); 

    if( vreA == false ) {
        document.getElementById("error").style.display = "block";
        return false;
    } else {
        document.getElementById("comprarPix").style.display = "none";
        document.getElementById("btnVoltar").style.display = "none";
        document.getElementById('titulo').innerHTML = "Leia QRCODE da chave Pix";
        document.getElementById('qrcode').style.display = "flex"
        document.getElementById('titulo').style.width = "";

        return true;
    }


}