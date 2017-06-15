(function () { // fonction anonyme pour éviter les conflits en cas de plusieurs pages de script 
    
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

        //gestion Popup connexion
        $('<div id="popupCo"></div>').prependTo("main"); //création d'une div dans laquelle on mettra les messages
        
        var boutonLogIn = $("#logIn");
        boutonLogIn.click(afficherDialog);
        
        var popupCo = $("#popupCo");
        
        popupCo.dialog({
            autoOpen: false,
            modal: true,
            title: "Connexion",
            width: 500,
            height: 300
        })
        
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
    
    function afficherDialog(evt){
        $("#popupCo").load('./connexion.php', function(){
            $("#popupCo").dialog("open");
        })
    }
}())