var MenuItens = document.getElementById("MenuItens");

MenuItens.style.maxHeight = "0px";

function menucelular(){
    if(MenuItens.style.maxHeight == "0px"){
        MenuItens.style.maxHeight = MenuItens.scrollHeight + "px";
    } else {
        MenuItens.style.maxHeight = "0px";
    }
}

var produtoImg = document.getElementById("produtoImg");
var produtoMiniatura = document.getElementsByClassName("miniatura-do-produto");

produtoMiniatura[0].onclick = function(){
    produtoImg.src = produtoMiniatura[0].src;
}
produtoMiniatura[1].onclick = function(){
    produtoImg.src = produtoMiniatura[1].src;
}
produtoMiniatura[2].onclick = function(){
    produtoImg.src = produtoMiniatura[2].src;
}

