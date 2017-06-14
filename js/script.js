"use strict";

document.addEventListener("DOMContentLoaded", initialiser);

function initialiser(evt) {

    var couleurs = new Array("#eebd30","#91dfd6","#a1cd69","#fe5d99","#ffbad4");

    var nbCouleurs = couleurs.length;
    var laCouleur; 

    laCouleur = Math.round(Math.random()*nbCouleurs);
    
    var actif = document.getElementsByClassName("actif");
    for (var unActif of actif) {
        unActif.style.color = couleurs[laCouleur];
    }

}