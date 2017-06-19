<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Modalités &#124; CDLS</title>
    <meta name="description" content="Modalités du concours C'est dans le sac ! se déroulant du 20 août au 30 septembre 2017" />
    <meta name="keywords" content="modalités, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
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
                <a href="./modalites.php" class="actif">Modalités</a>
            </li>
        </ul>
    </nav>

    <main id="modalites">
        <h2 class="titreRose">Modalités du concours</h2>

        <h3>Société organisatrice</h3>
        <p>
            Le site C’est Dans Le Sac, dans le cadre de la première année de DUT Métiers du Multimédia et de l’Internet (MMI) à Laval, organise un concours sur le thème de la pollution par les sacs plastiques. Le concours est commun à la France métropolitaine et aux départements d’outre-mer. Le classement est unique pour tous les départements. Les candidats seront classés en fonction du nombre de votes pour leur(s) oeuvre(s).
        </p>
        <p>
            Un nombre total de 10 lots environ est proposé.
        </p>

        <h3>Inscription et participation</h3>
        <p>
            Pour participer au concours, les candidats doivent s'inscrire en complétant le formulaire d'inscription. Les participants font élection de domicile à l'adresse qu'ils auront indiquée. Une inscription incomplète, inexacte ou fantaisiste ne sera pas prise en compte.
            <br/> Chaque candidat a la possibilité de déposer une oeuvre dans chacune des trois catégories de médias suivantes : affiche, clip vidéo, et clip audio. Les affiches doivent obligatoirement être au format <span class="gras">.jpeg</span> ou <span class="gras">.png</span>, les vidéos doivent être au format <span class="gras">.mp4</span> et les clips audios doivent être au format <span class="gras">.mp3</span> ou autre <span class="gras">.mpeg</span>.
            <br/> La participation au concours implique pour tout participant l'acceptation complète et sans réserve du présent règlement. Le site se réserve le droit de procéder à toutes vérifications pour la bonne application du présent article. Le site ne peut être tenu responsable en cas de mauvaise réception des inscriptions par voie électronique, quelle qu'en soit la raison.
        </p>

        <h3>Contrainte de vote</h3>
        <p>
            Les candidats ainsi que l’ensemble des internautes visitant le site du concours ont la possibilité de voter pour une oeuvre unique par catégorie. Ceux-ci peuvent à tout moment décider de donner leur voix à une autre oeuvre, en considération du fait que leur précédente voix sera estimée nulle et ce durant toute la période du concours.
        </p>

        <h3>Données personnelles</h3>
        <p>Il est rappelé que pour participer au concours, les candidats doivent nécessairement fournir certaines données personnelles. Ces informations sont enregistrées et sauvegardées dans un fichier informatique et sont nécessaires à la prise en compte de leur participation. Ces informations sont exclusivement destinées à C’est Dans Le Sac. En participant au concours, le candidat pourra également solliciter son inscription à un courrier électronique d’information de C’est Dans Le Sac. Les données ainsi recueillies pourront être utilisées dans un cadre légal. Conformément à la réglementation en vigueur, les informations collectées sont destinées exclusivement à la société organisatrice et ne seront ni vendues, ni cédées à des tiers, de quelque manière que ce soit.
        </p>

        <h3>Date du concours</h3>
        <p> La date du concours est du <span class="gras">20 août</span> au <span class="gras">30 septembre 2017</span>.
        </p>
        <p>
            En cas d’incivilité ou de toute autre pratique portant atteinte au respect d’autrui, les oeuvres ou comptes concernés pourront être supprimés et la participation et les votes du ou des auteurs éventuellement incriminés, considérés comme nuls.
        </p>
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
    <script src="./js/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
</body>

</html>