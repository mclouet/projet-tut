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
    <link rel="icon" type="image/png" href="./images/img-favicon.png">
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
        <h2 class="titreVert">Concours Cabadix</h2>
        <div id="presentationSite">
            <p>
                Bonjour et bienvenue !</br>
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
    
    <?php
        require("pied.inc.php");
    ?>

    <script src="./js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
    <script src="./jquery-ui-1.12.1.custom/jquery-ui.js"></script>

</body>

</html>