"use strict";

document.addEventListener("DOMContentLoaded", initialiser);

function initialiser(evt) {
    var btnRadioVideo = document.getElementById("radioVideo");
    var btnRadioAudio = document.getElementById("radioAudio");
    var btnRadioAffiche = document.getElementById("radioAffiche");

    btnRadioAffiche.addEventListener("click", supprimerBtnIco);
    btnRadioVideo.addEventListener("click", afficherBtnIco);
    btnRadioAudio.addEventListener("click", afficherBtnIco);

    btnRadioVideo.addEventListener("click", arreter);
    btnRadioAudio.addEventListener("click", arreter);
}

function afficherBtnIco(evt) { // Afficher un bouton permettant à l'utilisateur d'ajouter une vignette pour vidéo ou clip audio

    var inputBtnIco = document.createElement("input");
    var labelBtnIco = document.createElement("label");

    var listeNum = document.querySelector("#participation>#listeForm");
    var liNum3 = document.querySelector(".liste:nth-child(7)");

    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");

    var participation = document.getElementById("participation");

    // Type file
    inputBtnIco.name = "vignetteMonFichier";
    inputBtnIco.type = "file";
    inputBtnIco.id = "ajoutIco";
    listeNum.insertBefore(inputBtnIco, liNum3);

    // Label pour input
    labelBtnIco.for = "vignette";
    labelBtnIco.innerHTML = "Ajoutez une vignette !";
    labelBtnIco.style.display = "inline-flex";
    labelBtnIco.style.fontFamily = "Open Sans Condensed";
    labelBtnIco.id = "labelIco";
    listeNum.insertBefore(labelBtnIco, inputBtnIco);

    // CHANGER FRERE PRECEDENT INPUT

    participation.style.width = "550px";
}

function arreter(evt) {
    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");
    btnVideo.removeEventListener("click", afficherBtnIco);
    btnAudio.removeEventListener("click", afficherBtnIco);
}

function supprimerBtnIco(evt) { // Supprimer le bouton permettant à l'utilisateur d'ajouter une vignette pour vidéo ou clip audio
    var btnAjoutIco = document.getElementById("ajoutIco");
    var labelAjoutIco = document.getElementById("labelIco");

    var btnVid = document.getElementById("radioVideo");
    var btnAud = document.getElementById("radioAudio");

    var background = document.getElementById("participation");

    if (btnAjoutIco && labelAjoutIco) {
        btnAjoutIco.remove();
        labelAjoutIco.remove();
        background.style.width = "500px";
    }

    // A REVOIR : remettre écouteur de clic après avoir cliqué sur affiche
    // btnVid.addEventListener("click", afficherBtnIco);
    // btnAud.addEventListener("click", afficherBtnIco);
}