<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Contactez-nous ! &#124; CDLS</title>
        <meta name="description" content="Une question ou une réclamation ? N'hésitez pas à nous contacter en remplissant ce petit formulaire !" />
        <meta name="keywords" content="contact, sponsors, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="icon" type="image/png" href="./images/img-favicon.png">
    </head>

    <body>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("entete.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <nav>
                <ul>
                    <li>
                        <a href="./index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="./galerie.php">Galerie</a>
                    </li>
                    <li>
                        <a href="./contact.php" class="actif">Nous contacter</a>
                    </li>
                    <li>
                        <a href="./participation.php">Je participe</a>
                    </li>
                    <li>
                        <a href="./modalites.php">Modalités</a>
                    </li>
                </ul>
            </nav>

            <main>
                <h2 class="titreVert">Contactez-nous !</h2>

                <form method="post" action="contact.php" class="formulaire contact">
                    <div class="radioContact">
                        <input type="radio" name="contact" value="participation" id="radioParticipation" />
                        <label for="radioParticipation">Participation</label>
                        <input type="radio" name="contact" value="sponsor" id="radioSponsor" />
                        <label for="radioSponsor">Devenir sponsor</label>
                        <input type="radio" name="contact" value="autre" id="radioAutre" />
                        <label for="radioAutre">Autre</label>
                    </div>
                    <div>
                        <label for="nom">Nom<span class="formObli">*</span></label>
                        <input id="nom" name="nom" type="text" placeholder="CABADIX" required="required" />
                    </div>
                    <div>
                        <label for="prenom">Prénom<span class="formObli">*</span></label>
                        <input id="prenom" name="prenom" type="text" placeholder="Cabadix" required="required" />
                    </div>
                    <div>
                        <label for="mail">Adresse e-mail<span class="formObli">*</span></label>
                        <input id="mail" name="mail" type="email" placeholder="cabadix@cabadix.com" required="required" />
                    </div>
                    <div>
                        <label for="tel">Téléphone</label>
                        <input id="tel" name="tel" type="tel" placeholder="0600660066" />
                    </div>
                    <div>
                        <label for="message">Message<span class="formObli">*</span></label>
                        <textarea name="message" id="message" placeholder="A bientôt !" rows="10" required="required"></textarea>
                    </div>
                    <input type="submit" value="Envoyer" class="inputSubmit btnHover" />
                </form>
            </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
        
        require("pied.inc.php");
    
    // Configuration avant l'envoi du mail
    $destinataire = "marie.clouet.etu@univ-lemans.fr" . ", "; // Destinataire de l'email
    
    //variables popup
        $classMessage = "";
    
    if (isset($_POST["nom"]) and isset($_POST["contact"])) { // Si le formulaire a été envoyé et qu'un bouton radio est coché

        if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST["mail"])) { // Si l'email est valide

            if ($_POST["contact"] == "participation") { // Si le bouton radio coché est "Participation"
                $objet = "Contact participation &#124; CDLS";
            } else if ($_POST["contact"] == "sponsor") { // Si le bouton radio coché est "Sponsor"
                $objet = "Contact sponsor &#124; CDLS";
            } else if ($_POST["contact"] == "autre") { // Si le bouton radio coché est "Autre"
                $objet = "Contact autre &#124; CDLS";
            }

            // Stockage des coordonnées
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $mail = $_POST["mail"];
            if (isset($_POST["tel"])) {
                $tel = $_POST["tel"];
                $coordonnees = "Coordonnées de l'expéditeur :\r\n".$nom." ".$prenom."\r\nNuméro de téléphone : ".$tel."\r\nAdresse email : ".$mail;
            } else {
                $coordonnees = "Coordonnées de l'expéditeur :\r\n".$nom." ".$prenom."\r\n".$mail;
            }

            // Stockage du message
            $message = $coordonnees."\r\nMessage :\r\n".$_POST["message"];

            // Remplacement de certains caractères spéciaux
            $objet = str_replace("&#124;","|",$objet);

            // Envoi du message
            if(mail($destinataire, $objet, $message)){
                $classMessage = "visible";
                $titrePopup = "Message envoyé";
                $messagePopup = "Votre message a bien été envoyé !";
            }
            
        } else { // Si l'email n'est pas valide
            //POPUP
            $classMessage = "visible";
            $messagePopup = "Votre email n\'est pas valide. Veuillez la ressaisir";
            $titrePopup = "Email Invalide";
            
        } // Fin condition email

    } else if (isset($_POST["nom"]) and !isset($_POST["contact"])) { // Si aucune bouton radio n'est coché
        $classMessage = "visible";
        $message = "Veuillez choisir un objet";
    } // Fin condition si le formulaire est envoyé
    
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div class="flou <?php echo($classMessage) ?>">
                <div class="popup <?php echo($classMessage) ?>">
                    <h3><?php echo($titrePopup) ?></h3>
                    <p><?php echo($messagePopup) ?></p>
                    <button class="fermer">Fermer</button>
                </div>
            </div>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>

    </html>