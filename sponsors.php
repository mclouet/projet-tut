<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Sponsors &#124; CDLS</title>
    <meta name="description" content="Rejoignez C'est dans le sac ! en tant que sponsor et proposez des lots" />
    <meta name="keywords" content="sponsors, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
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
    <main id="sponsors">
        <h2 class="titreVert">Sponsors</h2>
        <div>
            <p>
                Bienvenue sur le site C'est dans le sac !
                <br/> Nous sommes un site concours pour la promotion de sacs respectueux de l'environnement, nous sommes à la recherches de sponsors pour porter notre projet.
                <br/> En contrepartie d'une visibilité ou d'une annonce sur votre réseau, d'un soutient financier pour les lots ou si vous en avez à proposer, vous disposerez d'un espace sur le site et un lien direct vers votre site internet.
                <br/> Afin de devenir partenaire, vous devez faire preuve ou avoir fait preuve d'intérêt envers le thème de la pollution, avoir un lot à proposer aux gagnants, un site internet (pour disposer d'un lien).
                <br/> Des ajustements pourront être apportés à ces conditions dans la mesure du possible, une fois la collaboration mise en place.
                <br/> Si vous souhaitez devenir sponsor, n'hésitez pas à nous contacter.
            </p>
        </div>
        <div>
            <a href="contact.php" class="titreBleu btnHover">Plus de renseignements</a>
            <a href="https://packingsorted.fr/" class="titreRose btnHover" target="_blank">Visitez la boutique</a>
        </div>
        <img src="./images/img-charte-cabadix.png" alt="Logo de Cabadix" />
        
    </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("pied.inc.php");
?>
   <!-- - - - - - - - - - FIN PHP - - - - - - - - - --> 
    <script src="./js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html>