"use strict";

document.addEventListener("DOMContentLoaded", initialiser);

function initialiser(evt) {
    var btnRadioVideo = document.getElementById("radioVideo");
    var btnRadioAudio = document.getElementById("radioAudio");
    var btnRadioAffiche = document.getElementById("radioAffiche");
//    var inputMonFichier = document.getElementById("monFichier");

    btnRadioAffiche.addEventListener("click", supprimerBtnIco);
    btnRadioVideo.addEventListener("click", afficherBtnIco);
    btnRadioAudio.addEventListener("click", afficherBtnIco);

    btnRadioVideo.addEventListener("click", arreter);
    btnRadioAudio.addEventListener("click", arreter);

//    inputMonFichier.addEventListener("change", previewFile);
    
    if (document.querySelector("#vignetteMonFichier")) {
        var inputImage = document.querySelector("#vignetteMonFichier");
    } else {
        var inputImage = document.querySelector("#monFichier");
    }
    
    inputImage.addEventListener("change", previewFile);
//    inputImage.addEventListener("change", verifierFichier);
}

function afficherBtnIco(evt) { // Afficher un bouton permettant à l'utilisateur d'ajouter une vignette pour vidéo ou clip audio

    var inputBtnIco = document.createElement("input");
    var labelBtnIco = document.createElement("label");

    var listeForm = document.querySelector("#participation>#listeForm");
    var pChildCinq = document.querySelector(".liste:nth-child(5)");

    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");

    var participation = document.getElementById("participation");

    var inputMonFichier = document.getElementById("monFichier");

    // Label pour input
    labelBtnIco.setAttribute("for", "vignetteMonFichier");
    labelBtnIco.innerHTML = "Vignette";
    labelBtnIco.id = "labelIco";
    labelBtnIco.className = "labelFile";
    listeForm.insertBefore(inputBtnIco, pChildCinq);

    // Type file
    inputBtnIco.name = "vignetteMonFichier";
    inputBtnIco.type = "file";
    inputBtnIco.id = "vignetteMonFichier";
    inputBtnIco.addEventListener("change", previewFile);
    listeForm.insertBefore(labelBtnIco, inputBtnIco);

    participation.style.width = "550px";

    inputMonFichier.removeEventListener("change", previewFile);

    btnVideo.addEventListener("click", supprimerApercu);
    btnAudio.addEventListener("click", supprimerApercu);
    //supprimerApercu();
}

function arreter(evt) {
    var btnVideo = document.getElementById("radioVideo");
    var btnAudio = document.getElementById("radioAudio");
    btnVideo.removeEventListener("click", afficherBtnIco);
    btnAudio.removeEventListener("click", afficherBtnIco);
    btnVideo.removeEventListener("click", arreter);
    btnAudio.removeEventListener("click", arreter);
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
        btnVid.addEventListener("click", afficherBtnIco);
        btnAud.addEventListener("click", afficherBtnIco);
        btnVid.addEventListener("click", arreter);
        btnAud.addEventListener("click", arreter);
        
        //supprimerApercu();
        btnVid.addEventListener("click", supprimerApercu);
        btnAud.addEventListener("click", supprimerApercu);
    }
}

function previewFile() { // Aperçu de la vignette
    var btnRadioAffiche = document.getElementById("radioAffiche");

//    if (document.querySelector("#vignetteMonFichier")) {
//        var file = document.querySelector("#vignetteMonFichier").files[0];
//        btnRadioAffiche.addEventListener("click", supprimerBtnIco);
//    } else {
//        var file = document.querySelector("#monFichier").files[0];
//    }
    
    var file = this.files[0];

    var preview = document.querySelector("#apercu");
    var reader = new FileReader();

    reader.addEventListener("loadend", function (evt) {
        console.log(evt.loaded);
        preview.src = reader.result;
        console.log(reader.result);
    }, false);

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}

function supprimerApercu() { // Aperçu par défaut
    var apercu = document.getElementById("apercu");
    apercu.src = "./images/img-apercu-defaut.jpg";

}

//function verifierFichier() {
//    var formData = new FormData();
//    formData.append("vignette", file);
//}