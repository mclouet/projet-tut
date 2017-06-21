(function () {

    "use strict";

    document.addEventListener("DOMContentLoaded", initialiser);

    function initialiser(evt) {
        var couleurs = new Array("#eebd30", "#91dfd6", "#a1cd69", "#fe5d99", "#ffbad4");
        var nbCouleurs = couleurs.length;
        var actif = document.getElementsByClassName("actif");
        var nav = document.querySelectorAll("nav a");

        for (var unNav of nav) {
            unNav.addEventListener("mouseenter", changerCouleur);
            unNav.addEventListener("mouseleave", supprimerCouleur);
        }

        // Choix de la couleur aléatoire
        var laCouleur = Math.round(Math.random() * nbCouleurs);

        for (var unActif of actif) {
            unActif.style.color = couleurs[laCouleur];
            unActif.removeEventListener("mouseenter", changerCouleur);
            unActif.removeEventListener("mouseleave", supprimerCouleur);
        }

        if (document.querySelector(".descOeuvre")) {
            var descOeuvre = document.querySelector(".descOeuvre");
            descOeuvre.style.color = couleurs[laCouleur];
        }

        if (document.querySelector(".compte a")) {
            var lienCompte = document.querySelector(".compte a");
            lienCompte.addEventListener("mouseenter", changerCouleur);
            lienCompte.addEventListener("mouseleave", supprimerCouleur);
        }

        // Ecouteur sur le bouton pour fermer les popups d'erreur
        $(".fermer").click(fermerPopup);
        $(".btnConfirm").click(fermerPopup);

        // Popup de confirmation avant suppression
        // $(".btnSupprConfirm").click(confirmer);
        
        // COMPTE : SI SRC DE L'IMG EST APERCU PAR DEFAUT, NE PAS METTRE ECOUTEUR DE CLIC
        if(document.getElementsByClassName("oeuvreCompte")) { // Si oeuvreCompte
            var oeuvresCompte = document.getElementsByClassName("oeuvreCompte");
            var btnSupprConfirm = document.getElementsByClassName("btnSupprConfirm");
            
            for(var uneOeuvreCompte of oeuvresCompte) { // For oeuvres
                if(uneOeuvreCompte.src == "./images/img-apercu-defaut-carre.png") { // Si l'auteur n'a pas déposé d'oeuvre pour cette catégorie
                    // L'écouteur de clic n'est pas mis sur le bouton
                } else { // Si l'auteur a déposé une oeuvre pour cette catégorie
                    for(var unBtnSupprConfirm of btnSupprConfirm) {
                        if(unBtnSupprConfirm.dataset.btn == uneOeuvreCompte.dataset.img) { // Si le data du bouton vaut celui de l'oeuvre
                            unBtnSupprConfirm.addEventListener("click", confirmer);
                        } // Fin condition data
                    } // Fin for boutons
                } // Fin condition src img
            } // Fin for oeuvres
        } // Fin condition si oeuvreCompte
    }

    function fermerPopup(evt) {
        var divMessage = $(".popup.visible");
        var divFlou = $(".flou.visible");

        divFlou.css({
            display: "none"
        });

        divMessage.css({
            display: "none"
        });

        location.assign(location.href);
    }

    function confirmer(evt) {
        var txt;
        var r = confirm("Voulez-vous vraiment supprimer cette œuvre ?");
        if (r == true) {
            
        } else {
            evt.preventDefault();
        }
        document.getElementById("demo").innerHTML = txt;
    }


    function supprimerCouleur(evt) {
        var actif = document.getElementsByClassName("actif");

        for (var unActif of actif) {
            if (this != unActif) {
                this.style.color = "#000000";
            }
        }
    }

    function changerCouleur(evt) {
        var couleurs = new Array("#eebd30", "#91dfd6", "#a1cd69", "#fe5d99", "#ffbad4");
        var nbCouleurs = couleurs.length;
        var laCouleur = Math.round(Math.random() * nbCouleurs);

        this.style.color = couleurs[laCouleur];
    }

    function supprimerCouleur(evt) {
        this.style.color = "#000000";

    }

}())