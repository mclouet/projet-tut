<?php
    header("Content-type: text/html");
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Galerie &#124; CDLS</title>
        <meta name="description" content="Découvrez vos oeuvres et celles des autres participants dans notre galerie." />
        <meta name="keywords" content="galerie, représentations, concours, lots, sacs plastique, pollution, affiches, vidéos, clips audio" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <script type="text/javascript" src="../js/galerie.js"></script>
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
            <div class="compte"> <a>Mon compte</a> <img src="../images/img-profil-photo.png" alt="image profil" />
                <div class="log">
                    <a href="" title="Se connecter"><img src="../images/img-login.png" alt="logo connexion" /></a>
                    <a href="" title="Se déconnecter"><img src="../images/img-logout.png" alt="logo déconnexion" /></a>
                </div>
            </div>
        </header>
        <nav>
            <ul>
                <li> <a href="../index.html">Accueil</a> </li>
                <li> <a href="./galerie.php">Galerie</a> </li>
                <li> <a href="../contact.html">Nous contacter</a> </li>
                <li> <a href="./participation.php">Je participe</a> </li>
                <li> <a href="../modalites.html">Modalités</a> </li>
            </ul>
        </nav>
        <main>
            <div id="selecGalerie">
                <p data-format="image">Affiches</p>
                <p data-format="video">Vidéos</p>
                <p data-format="audio">Clips audio</p>
            </div>
            <div class="naviGalerie"> 
                <img src="../images/img-page-precedente.png" alt="Flèche page précedente" class="boutonNavi" data-navi="reculer"/> 
                <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 1"/> 
                <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 2" /> 
                <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 3" /> 
                <img src="../images/img-page-suivante.png" alt="Flèche page suivante" class="boutonNavi" data-navi="avancer"/> 
            </div>
            <div id="galerie">
                <ul id="imgGalerie">
                    <li>
        <!-- --------------------------- PHP ------------------------------------ -->
            <?php
                //boucle sur chaque oeuvre (depuis BDD)
                //ETAPE 1: connexion à la base de données
                require("param.inc.php");
                $pdo = new PDO("mysql:host=".MYHOST.";dbname".MYDB,MYUSER,MYPASS);
                $pdo -> query("SET NAMES utf8");
                $pdo -> query("SET CHARACTER SET 'utf8'");

                //ETAPE 2: Envoyer une requête SQL
                $sql = "SELECT Vignette, Type FROM OEUVRE";

                $statement = $pdo->prepare($sql);
                $statement = execute();
                        
                //ETAPE 3: Traiter les données retournées
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                //Boucle sur chaque catégorie (depuis la BDD)
                while($ligne != false){
            ?>
        <!-- ------------------------------------------------------------------ -->
                       <a>
                        <img src="<?php echo($ligne["vignette"]) ?>"/>
                        </a> 
                        
        <!-- --------------------------- PHP ------------------------------------ --> 
        <?php
            //article suivant
                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                } //fin while
            //ETAPE 4: Déconnexion
            $pdo = null;            
        ?>
                        
        <!-- ------------------------------------------------------------------ -->

                        
                    </li>
                </ul>
            </div>
            <div class="naviGalerie"> <img src="../images/img-page-precedente.png" alt="Flèche page précedente" /> <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 1" /> <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 2" /> <img src="../images/img-numero-page-droite.png" alt="Bouton de navigation 3" /> <img src="../images/img-page-suivante.png" alt="Flèche page suivante" /> </div>
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