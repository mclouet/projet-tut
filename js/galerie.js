"use strict";
document.addEventListener("DOMContentLoaded", initialiser);
document.addEventListener("DOMContentLoaded", lancer);

function initialiser(evt) {
    var lesBoutonsTri = document.querySelectorAll("#selecGalerie>p"); //mise en place de l'écouteur sur les boutons de la galerie
    var boutonsNavi = document.getElementsByClassName("boutonNavi");
    for (var unBouton of lesBoutonsTri) {
        unBouton.style.cursor = "pointer";
        unBouton.addEventListener("click", trierGalerie);
    }
    for (var unBoutonNavi of boutonsNavi) {
        unBoutonNavi.style.cursor = "pointer";
        unBoutonNavi.addEventListener("click", naviguerGalerie);
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

function naviguerGalerie(evt) {
/*    var ulGalerie = document.getElementById("imgGalerie");
    var liGalerie = document.querySelectorAll("#imgGalerie li");
    
    if(this.dataset.navi == "avancer"){
        ulGalerie.transform = "translateX(636px);"
    }else{
        
    }
    */
    
    var ulGalerie = $("#imgGalerie");
    var pourcentage = 100/(ulGalerie.length); //pourcentage que prend un li dans imgGalerie
    var bouton = $(this);
    
    if (bouton.data("navi") == "avancer"){
        ulGalerie.css({
            transform: "translateX(-636px)"     
        })
    }else{
         ulGalerie.css({
            transform: "translateX(0px)"
        })
    }
}
