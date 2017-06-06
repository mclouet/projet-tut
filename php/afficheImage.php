<?php
    header("Content-type: text/html");
?>
    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>TITRE &#124; CDLS</title>
        <!-- AFFICHER LE TITRE DE L'OEUVRE -->
        <meta name="description" content="Description de votre image ... pour notre concours Cabadix !" />
        <!-- AFFICHER TITRE DE L'OEUVRE -->
        <meta name="keywords" content="oeuvre, description, concours, sacs plastique, pollution, affiches, vidéos, clips audio" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>

    <body>
        <header>
            <div class="reseauxSoc">
                <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo facebook" /></a>
                <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo twitter" /></a>
                <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="../images/img-pinterest-icon.png" alt="logo pinterest" /></a>
                <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="../images/img-instagram-icon.png" alt="logo instagram" /></a>
                <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo google+" /></a>
            </div>

            <h1>C'est dans le sac !</h1>

            <div class="compte">
                <a>Mon compte</a>
                <img src="../images/img-profil-photo.png" alt="image profil"/>
                <div class="log">
                    <a href="" title="Se connecter"><img src="../images/img-login.png" alt="logo connexion"/></a>
                    <a href="" title="Se déconnecter"><img src="../images/img-logout.png" alt="logo déconnexion"/></a>
                </div>
            </div>
        </header>

        <nav>
            <ul>
                <li>
                    <a href="../index.html">Accueil</a>
                </li>
                <li>
                    <a href="./galerie.php">Galerie</a>
                </li>
                <li>
                    <a href="../contact.html">Nous contacter</a>
                </li>
                <li>
                    <a href="./participation.php">Je participe</a>
                </li>
            </ul>
        </nav>

        <main>
            <h2 class="titreDesc">
                <?php
                    if (isset ($_GET["image"])) {
                         echo($_GET["image"]);
                    } else if (isset ($_GET["video"])) {
                        echo($_GET["video"]);
                    } else if (isset ($_GET["audio"])) {
                        echo($_GET["audio"]);
                    }
                ?> 
            </h2>

            <?php
                if (isset ($_GET["image"])) {
                    $nomImage = $_GET["image"] ;
            ?>

                <div id="image">
                    <img src="./images/grande_<?php echo ($nomImage); ?>" alt="<?php echo ($nomImage); ?>" class="grandeOeuvre" />
                </div>
            
            <?php
                } else if (isset ($_GET["video"])) {
                    $nomVideo = $_GET["video"];
            ?>
            
                <div id="video">
                    <video controls preload="metadata" data-format="video" class="grandeOeuvre">
                        <source src="./<?php echo($nomFichier); ?>" type="video/mp4"/>
                    </video>
                </div>
            
            <?php
                } else if (isset ($_GET["audio"])) {
                    $nomAudio = $_GET["audio"];
            ?>
            
                <div id="audio">
                    <audio src="./<?php echo($nomAudio); ?>" controls preload="metadata" data-format="audio" class="grandeOeuvre"></audio>
                </div>
            
            <?php
                     }
            ?>

            <p class="descOeuvre">
                Description de l'oeuvre par l'auteur
                <br />
                <?php
                    if (isset ($_GET["image"])) {
                         echo($_GET["image"]);
                    } else if (isset ($_GET["video"])) {
                        echo($_GET["video"]);
                    } else if (isset ($_GET["audio"])) {
                        echo($_GET["audio"]);
                    }
                ?>
            </p>
        </main>

        <footer>
            <div class="txtFooter">
                <p><a href="">Mentions légales</a></p>
                <p><a href="../contact.html">Formulaire de contact</a></p>
                <p><a href="../modalites.html">Modalités du concours</a></p>
            </div>
            <div>
                <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo Facebook" /></a>
                <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo Twitter" /></a>
                <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="../images/img-pinterest-icon.png" alt="logo Pinterest" /></a>
                <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="../images/img-instagram-icon.png" alt="logo Instagram" /></a>
                <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo Google+" /></a>
            </div>
        </footer>
    </body>

    </html>