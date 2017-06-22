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

        if (document.querySelector("#descAut>h3")) {
            var descAut = document.querySelector("#descAut>h3");
            descAut.style.color = couleurs[laCouleur];
        }

        if (document.querySelector(".compte a")) {
            var lienCompte = document.querySelector(".compte a");
            lienCompte.addEventListener("mouseenter", changerCouleur);
            lienCompte.addEventListener("mouseleave", supprimerCouleur);
        }
        
        if(document.getElementById("nomAuteur")) {
            var nomAuteur = document.getElementById("nomAuteur");
            nomAuteur.addEventListener("mouseenter", changerCouleur);
            nomAuteur.addEventListener("mouseleave", supprimerCouleur);
        }

        // Ecouteur sur le bouton pour fermer les popups d'erreur
        $(".fermer").click(fermerPopup);
        $(".fermer#afficheImage").off("click", fermerPopup);
        $(".fermer#afficheImage").click(fermerSuppr);
        $(".btnConfirm").click(fermerPopup);

        // Popup de confirmation avant la suppression d'oeuvres
        $(".btnSupprConfirm").click(confirmer);
        
        // Page afficheImage : afficher bio quand clic sur nom auteur
        $("#nomAuteur").click(afficherBio);
        
        // Popup de confirmation avant la suppression du compte
        $("#monCompte+form button").click(confirmerSupprCompte);
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
    
    function fermerSuppr(evt) {
        var divMessage = $(".popup.visible");
        var divFlou = $(".flou.visible");
        var url = "./galerie.php";

        divFlou.css({
            display: "none"
        });

        divMessage.css({
            display: "none"
        });
        
        location.assign(url);
    }

    function confirmer(evt) {
        var txt;
        var r = confirm("Voulez-vous vraiment supprimer cette œuvre ?");
        if (r == true) {
            
        } else {
            evt.preventDefault();
        }
    }

    function afficherBio(evt) {
        $("#popupBioAI").show();
    }
    
    function confirmerSupprCompte(evt) {
        var txt;
        var r = confirm("Voulez-vous vraiment supprimer votre compte ? \nAttention, cette action est irréversible.");
        if (r == true) {
            
        } else {
            evt.preventDefault();
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