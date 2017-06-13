(function () {
    "use strict";
    $(document).ready(initialiser); //Mise en place de l'écouteur 'le DOM est prêt'

    function initialiser(evt) {
        if ($("#message")) {
            var message = $("#message");

            message.css({
                borderColor: "red"
            });

            //            $("#messsage").dialog({
            //                autoOpen: false,
            //                /*au lancement de la page, la boite de dialogue n'est pas visible */
            //                width: 500,
            //                /*la boite de dialogue a une largeur de 500px */
            //                modal: true,
            //                /* elle est modale, c'est à dire que l'internaute doit obligatoirement fermer la boite pour continuer ses intéractions */
            //                title: "Confirmer la suppression" /*on définit son titre */
            //            });

        }
    }

});