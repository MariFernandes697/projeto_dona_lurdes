var MenuItens = document.getElementById("MenuItens");

MenuItens.style.maxHeight = "0px";

function menucelular(){
    if(MenuItens.style.maxHeight == "0px"){
        MenuItens.style.maxHeight = MenuItens.scrollHeight + "px";
    } else {
        MenuItens.style.maxHeight = "0px";
    }
}

function toggleMenu() {
    var menu = document.getElementById('menuPerfil');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
