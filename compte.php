<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Inscription &#124; CDLS</title>
    <meta name="description" content="Inscrivez-vous pour participer au concours C'est dans le sac !" />
    <meta name="keywords" content="inscription, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
</head>

<body>
    
    <?php
        require("entete.inc.php");
    ?>


    <nav>
        <ul>
            <li>
                <a href="./index.php">Accueil</a>
            </li>
            <li>
                <a href="./galerie.php">Galerie</a>
            </li>
            <li>
                <a href="./contact.php">Nous contacter</a>
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
            <h2 class="titreBleu">MON COMPTE EN COURS</h2>
            
<?php
            echo 'EN COURS EN COURS EN COURS EN COURS EN COURS'
?>

            <form action="inscription.php" id="inscription" method="post" class="formulaire">
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" type="text" name="pseudo" required="required" />
                </div>

                <div>
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" required="required" />
                </div>

                <div>
                    <label for="motDePasse">Mot de passe</label>
                    <input type="password" name="motDePasse" id="motDePasse" required="required" pattern=".{6,}" />
                </div>

                <div>
                    <label for="verifMdp">Confirmation du mot de passe</label>
                    <input type="password" name="verifMdp" id="verifMdp" required="required" pattern=".{6,}" />
                </div>

                <div>
                    <input type="submit" value="Envoyer" class="inputSubmit" />
                </div>
            </form>

        </main>
    
    


        <footer>
            <div class="txtFooter">
                <p><a href="./mentions.php">Mentions légales</a></p>
                <p><a href="./contact.php">Formulaire de contact</a></p>
                <p><a href="./modalites.php">Modalités du concours</a></p>
                <p><a href="./sponsors.php">Sponsors</a></p>
            </div>
            <div>
                <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="logo Facebook" /></a>
                <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="logo Twitter" /></a>
                <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="logo Pinterest" /></a>
                <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="logo Instagram" /></a>
                <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="logo Google+" /></a>
            </div>
        </footer>
    <script type="text/javascript" src="./js/inscription.js"></script>
</body>

</html>