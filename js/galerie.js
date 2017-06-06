"use strict";
"use strict";
document.addEventListener("DOMContentLoaded", initialiser);
document.addEventListener("DOMContentLoaded", lancer);

function initialiser(evt) {
    var lesBoutons = document.querySelectorAll("#selecGalerie>p"); //mise en place de l'écouteur sur les boutons de la galerie
    for (var unBouton of lesBoutons) {
        unBouton.style.cursor = "pointer";
        unBouton.addEventListener("click", trierGalerie);
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
    var elementsGalerie = document.querySelectorAll("#imgGalerie *"); //selection de tous les éléments enfants de la div #galerie
    for (var unElement of elementsGalerie) {
        if (unElement.dataset.format == this.dataset.format && unElement.style.display == "none") {
            unElement.style.display = "inline-flex";
        }
        else {
            unElement.style.display = "none";
        }
    }
}