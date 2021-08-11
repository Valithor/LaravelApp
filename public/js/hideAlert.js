function animation(){
    var div = document.getElementById("login-verified");

    div.style.top= "-30px";
    div.style.animationName = "verified-hide";
    div.style.animationDuration = "1s";

    setTimeout(function(){div.remove();},1000);
}

document.getElementById("login-verified").onclick = function(){
    var div = document.getElementById("login-verified");

    div.style.top= "-30px";
    div.style.animationName = "verified-hide";
    div.style.animationDuration = "1s";

    setTimeout(function(){div.remove();},500);
}

setTimeout("animation()", 3000);