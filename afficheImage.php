<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>
    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Oeuvre &#124; CDLS</title>
        <!-- AFFICHER LE TITRE DE L'OEUVRE -->
        <meta name="description" content="Description d'une oeuvre déposée pour le concours C'est dans le sac !" />
        <!-- AFFICHER TITRE DE L'OEUVRE -->
        <meta name="keywords" content="oeuvre, description, concours, sacs plastique, pollution, affiches, vidéos, clips audio" />
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
            </ul>
        </nav>

        <main>
        <?php
           //ETAPE 1: connexion à la base de données
            require("param.inc.php");
            $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            $pdo -> query("SET NAMES utf8");
            $pdo -> query("SET CHARACTER SET 'utf8'");  

            //ETAPE 2: Envoyer une requête SQL
            if(isset ($_GET["idImg"])){ //si l'idOeuvre a été passée par l'URL
                $idOeuvre = $_GET["idImg"];
                $sql = "SELECT IdOeuvre, Titre, Vignette, Type, DescOeuvre FROM oeuvre WHERE IdOeuvre='".$idOeuvre."'";

                $statement = $pdo->prepare($sql);
                $statement->execute();

            //ETAPE 3: Traiter données retournées
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                
        ?> 
            <h2 class="titreDesc">
        <?php
                echo($ligne["Titre"]);
                
        ?>
            </h2>

           <!-- <div id="image">
                <img src="./php/images/grande_<?php ?>" alt="" class="grandeOeuvre" />
            </div>

            <div id="video">
                <video controls preload="metadata" data-format="video" class="grandeOeuvre">
                    <source src="./php/videos/<?php echo($nomFichier); ?>" type="video/mp4" />
                </video>
            </div>

            <div id="audio">
                <audio src="./php/clips-audio/<?php echo($nomAudio); ?>" controls preload="metadata" data-format="audio" class="grandeOeuvre"></audio>
            </div>
-->
            <?php
                } else { //si idImg n'existe pas
                         header("Location: ./galerie.php");
                }            
            ?>

            <p class="descOeuvre">
                Description de l'oeuvre par l'auteur
                <br />
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
        
        <script type="text/javascript" src="./js/script.js"></script>
    </body>

    </html>