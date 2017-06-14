<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>C'est dans le sac ! &#124; CDLS</title>
    <meta name="description" content="Rejoignez notre concours pour lutter contre les sacs plastique et proposez un clip audio, une vidéo ou une affiche pour tenter de gagner un prix" />
    <meta name="keywords" content="c'est dans le sac, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
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
                <a href="./index.php" class="actif">Accueil</a>
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
    <main class="illustrationsIndex">
        <h2 class="titreVert">Bonjour et bienvenue !</h2>
        <div id="presentationSite">
            <p>
                Ici, nous avons à coeur la protection de la planète et nous organisons un concours pour lutter contre un fléau encore trop présent : les sacs plastiques.
                <br/>Vous pourrez libérer votre créativité au travers d'affiches, de clips audio et de vidéos.
                <br/>Les 10 gagnants se verront remettre des lots, dont des sacs CABADIX !
            </p>
        </div>
        <div>
            <p id="baleine" class="textGif">Chaque année, 500 milliards de sacs plastique sont distribués. Environ 100 millions de tonnes de plastique ont été déversées en un siècle dans le monde.</p>
            <img src="./images/img-illustration-1.gif" alt="Baleine en détresse" />
        </div>
        <div>
            <p id="usine" class="textGif">Un sac plastique est utilisé en moyenne 20 minutes par le consommateur mais prend 400 ans pour disparaître.</p>
            <img src="./images/img-illustration-2.gif" alt="Usine à sacs plastiques" />
        </div>
        <div>
            <p id="magicien" class="textGif">Depuis juillet 2016, les sacs plastiques jetables sont interdits en France : il est donc temps d'utiliser des sacs réutilisables respectueux de l'environnement !</p>
            <img src="./images/img-illustration-3.gif" alt="Transformation d'un sac plastique en sac Cabadix" />
        </div>
        <div id="liensIndex">
            <a href="https://packingsorted.fr/" target="_blank">Boutique</a>
            <a href="./participation.php">Je Participe !</a>
        </div>
    </main>
    <footer>
        <div class="txtFooter">
            <p><a href="./mentions.php">Mentions légales</a></p>
            <p><a href="./contact.php">Formulaire de contact</a></p>
            <p><a href="./modalites.php">Modalités du concours</a></p>
            <p><a href="./sponsors.php">Sponsors</a></p>
        </div>
        <div>
            <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="Logo Facebook" /></a>
            <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="Logo Twitter" /></a>
            <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="Logo Pinterest" /></a>
            <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="Logo Instagram" /></a>
            <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="Logo Google+" /></a>
        </div>
    </footer>
</body>

</html>