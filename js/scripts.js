// Muda a cor do items do menu se a página estiver activa
let pageUrl = window.location.pathname;
let getNav = document.querySelectorAll("nav div ul li a");

for (let i = 0; i < getNav.length; i++) {
    // Obtem o URL
    let pageUrlName = pageUrl.split("/");
    let pageUrlLength = pageUrlName.length - 1;
    // Guarda os links
    let pageNav = getNav[i].pathname;
    let pageNavName = pageNav.split("/");
    let pageNavLength = pageNavName.length - 1;
    let pageFinalName = pageNavName[pageNavLength];
    let pageNavExists = pageUrl.includes(pageFinalName);
    // Muda a cor do link
    if (pageNavExists == true) {
        getNav[i].style.cssText = "color: #31a6ff;";
    }
    else if (pageUrlName[pageUrlLength] == "") {
        getNav[0].style.cssText = "color: #31a6ff;";
    }
}