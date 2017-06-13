"use strict";
document.addEventListener("DOMContentLoaded", initialiser);
document.addEventListener("DOMContentLoaded", lancer);
var compteurPage = 0;


function initialiser(evt) {
    var lesBoutonsTri = document.querySelectorAll("#selecGalerie>p"); //mise en place de l'écouteur sur les boutons de la galerie
    var boutonsNavi = document.getElementsByClassName("boutonNavi");
    for (var unBouton of lesBoutonsTri) {
        unBouton.style.cursor = "pointer";
        unBouton.addEventListener("click", trierGalerie);
    }
    for (var unBoutonNavi of boutonsNavi) {
        unBoutonNavi.style.cursor = "pointer";
        
        if(unBoutonNavi.dataset.navi == "avancer"){             
            unBoutonNavi.addEventListener("click", avancer);
        }else{
            if(compteurPage > 0){
               compteurPage++;
               }
            unBoutonNavi.addEventListener("click", reculer);
        }
    }
}

function lancer(evt) { //au chargement de la page, les affiches seront les seules à s'afficher par défaut
    var elementsGalerie = document.querySelectorAll("#imgGalerie *"); //selection de tous les éléments enfants de la div #galerie
    for (var unEnfant of elementsGalerie) {
        if (unEnfant.dataset.format == "audio" || unEnfant.dataset.format == "video") {
            unEnfant.style.display = "none";
        }
    }
}

function trierGalerie(evt) {
    var elementsGalerie = document.querySelectorAll(".enfantGalerie"); //selection de tous les éléments enfants de la div #galerie
    for (var unElement of elementsGalerie) {
        if (this.dataset.format == unElement.dataset.format) {
            unElement.style.display = "inline-flex";
        }
        else {
            unElement.style.display = "none";
        }
    }
}

function avancer(evt) {
    var nbLi = ($("#imgGalerie li").length)-1; // nombre d'enfants li de imgGalerie
    
    if(compteurPage < nbLi){
        compteurPage++;
    }
    
    var ul = $("#imgGalerie");
    
    ul.css({
        transform: "translateX("+(-636*compteurPage)+"px)"
    })
}

function reculer(evt) {
    var ulGalerie = $("#imgGalerie");
    if(compteurPage > 0){
        compteurPage--;
    }
    ulGalerie.css({
        transform: "translateX("+-636*compteurPage+"px)"
    })
    
    
    
    
    /*var nbLi = ($("#imgGalerie li").length); // nombre d'enfants li de imgGalerie
    var calcul = 100/nbLi;
    var ul = $("#imgGalerie");
    var prevPage ;
    
    
    
    if(compteurPage > 0){
        prevPage = compteurPage - 1;
        alert(prevPage);
    }else{
        prevPage = compteurPage;
        alert(prevPage);
    }
    
    ul.css({
        transform: "translateX("+(636*prevPage)+"%)"
    })
    
    compteurPage = prevPage;*/
}
 

