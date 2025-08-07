function userLogin() {
    document.getElementById("btnEntrar").style.display = "none";
    document.getElementById("userIconBtn").style.display = "block";
}   

var x = false;
function userIconToggle() {
    if(x) {
        // Fechar
        document.getElementById("userInfos").style.display = "none";
        x = false;
    } else {
        // Abrir
        document.getElementById("userInfos").style.display = "block";
        x = true;
    }
}
