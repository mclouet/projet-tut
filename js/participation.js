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

    var listeForm = document.querySelector("#participation>#listeForm");
    var pChildCinq = document.querySelector(".liste:nth-child(5)");
    
    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");

    var participation = document.getElementById("participation");

    // Type file
    inputBtnIco.name = "vignetteMonFichier";
    inputBtnIco.type = "file";
    inputBtnIco.id = "vignetteMonFichier";
    inputBtnIco.onchange = "previewFile()";
    listeForm.insertBefore(inputBtnIco, pChildCinq);

    // Label pour input
    labelBtnIco.for = "vignetteMonFichier";
    labelBtnIco.innerHTML = "Vignette";
    labelBtnIco.id = "labelIco";
    listeForm.insertBefore(labelBtnIco, inputBtnIco);

    participation.style.width = "550px";
}

function arreter(evt) {
    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");
    btnVideo.removeEventListener("click", afficherBtnIco);
    btnAudio.removeEventListener("click", afficherBtnIco);
}

function supprimerBtnIco(evt) { // Supprimer le bouton permettant à l'utilisateur d'ajouter une vignette pour vidéo ou clip audio
    var btnAjoutIco = document.getElementById("vignetteMonFichier");
    var labelAjoutIco = document.getElementById("labelIco");

    var btnVid = document.getElementById("radioVideo");
    var btnAud = document.getElementById("radioAudio");

    var background = document.getElementById("participation");

    if (btnAjoutIco && labelAjoutIco) {
        btnAjoutIco.remove();
        labelAjoutIco.remove();
        background.style.width = "520px";
        // A REVOIR : remettre écouteur de clic après avoir cliqué sur affiche
        // btnVid.addEventListener("click", afficherBtnIco);
        // btnAud.addEventListener("click", afficherBtnIco);
    }
}

function previewFile() {
    var btnRadioAffiche = document.getElementById("radioAffiche");
    
    if (document.querySelector("#vignetteMonFichier")) {
        var file = document.querySelector("#vignetteMonFichier").files[0];
        btnRadioAffiche.addEventListener("click", supprimerBtnIco);
    } else {
        var file = document.querySelector("#monFichier").files[0];
    }
    
    var preview = document.querySelector("#apercu");
    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

//function reset() { // Supprimer les fichiers uploadés lors d'un clic sur un bouton radio
//    var inputFile = document.getElementById("monFichier");
//    var inputVig = document.getElementById("vignetteMonFichier");
//    
//    inputFile.reset();
//    inputVig.reset();
//}