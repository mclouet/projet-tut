"use strict";
 
document.addEventListener("DOMContentLoaded", initialiser);
 
function initialiser(evt) {
    var couleurs = new Array("#eebd30", "#91dfd6", "#a1cd69", "#fe5d99", "#ffbad4");
    var nbCouleurs = couleurs.length;
    var actif = document.getElementsByClassName("actif");
 
 
    // Choix de la couleur aléatoire
    var laCouleur = Math.round(Math.random() * nbCouleurs);
 
    for (var unActif of actif) {
        unActif.style.color = couleurs[laCouleur];
    }
 
    var nav = document.querySelectorAll("nav a");
    for (var unNav of nav) {
        unNav.addEventListener("mouseenter", changerCouleur);
        unNav.addEventListener("mouseleave", supprimerCouleur);
    }
    
     if(document.querySelector(".descOeuvre")){
        var descriptionAfficheOeuvre = document.querySelector(".descOeuvre");
        descriptionAfficheOeuvre.style.color = couleurs[laCouleur];

    }
}

function changerCouleur(evt) {
    var couleurs = new Array("#eebd30", "#91dfd6", "#a1cd69", "#fe5d99", "#ffbad4");
    var nbCouleurs = couleurs.length;
    var laCouleur = Math.round(Math.random() * nbCouleurs);
    var actif = document.getElementsByClassName("actif");
 
    for (var unActif of actif) {
        if (this != unActif) {
            this.style.color = couleurs[laCouleur];
        }
    }
}
 
function supprimerCouleur(evt) {
    var actif = document.getElementsByClassName("actif");
 
    for (var unActif of actif) {
        if (this != unActif) {
            this.style.color = "#000000";
        }
    }
}

