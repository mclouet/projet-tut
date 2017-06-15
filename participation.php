<?php
    header("Content-type: text/html");
    require("config.inc.php");
    
    if (!isset($_SESSION["pseudoCo"])) {
        header("Location: ./connexion.php");
        // POPUP VOUS DEVEZ ETRE CONNECTE(E) POUR POSTER UNE OEUVRE
    }
?>

    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Participez ! &#124; CDLS</title>
        <meta name="description" content="Déposez votre fichier et remplissez sa description pour faire valoir votre oeuvre aux yeux des jurys" />
        <meta name="keywords" content="participation, concours, lots, sacs plastique, pollution, affiches, vidéos, clips audio" />
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
                    <a href="./participation.php" class="actif">Je participe</a>
                </li>
                <li>
                    <a href="./modalites.php">Modalités</a>
                </li>
            </ul>
        </nav>

        <main>
            <h2 class="titreJaune">Participez !</h2>
            <div id="divParticipation">
                <form action="participation.php" enctype="multipart/form-data" method="post" id="participation">
                    <div id="listeForm">
                        <!-- 1 -->
                        <p class="liste">1. Choisissez votre catégorie</p>
                        <div>
                            <input type="radio" name="categorie" value="affiche" id="radioAffiche" />
                            <label for="radioAffiche">Affiche</label>
                            <input type="radio" name="categorie" value="video" id="radioVideo" />
                            <label for="radioVideo">Vidéo</label>
                            <input type="radio" name="categorie" value="audio" id="radioAudio" />
                            <label for="radioAudio">Clip Audio</label>
                        </div>
                        <!-- 2 -->
                        <p class="liste">2. Importez votre travail</p>
                        <div class="parentInputFile">
                            <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
                            <!-- 31457280 octets = 30Mo -->
                            <label for="monFichier" class="labelFile">Fichier</label>
                            <input name="monFichier" type="file" id="monFichier" />
                        </div>
                        <!-- 3 -->
                        <p class="liste">3. Partagez avec vos amis !</p>
                        <div class="reseauxSoc">
                            <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="Logo Facebook" /></a>
                            <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="Logo Twitter" /></a>
                            <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="Logo Pinterest" /></a>
                            <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="Logo Instagram" /></a>
                            <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="Logo Google+" /></a>
                        </div>
                        <!-- 4 -->
                        <label for="titre" class="liste">4. Donnez un titre à votre oeuvre !</label>
                        <input type="text" name="titre" id="titre" required="required" />
                        <!-- 5 -->
                        <label for="desc" class="liste">5. Décrivez votre oeuvre !</label>
                        <textarea name="desc" rows="10" cols="35" id="desc" required="required"></textarea>
                        <!-- Envoyer -->
                        <input type="submit" value="Envoyer" class="inputSubmit" />
                    </div>
                </form>

                <div> <img src="./images/img-apercu-defaut.jpg" alt="Aperçu de l'image téléchargée" id="apercu" /> </div>
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
        
        <!-- ----------------- PHP ---------------- -->

    <?php        
                    if (isset($_FILES["monFichier"])) {
                        
                        if ($_FILES["monFichier"]["name"] != ".htaccess") { // Si le fichier est différent de .htaccess
                            
//                            $taille_max = 31457280;
//                            $taille_fichier = filesize($_FILES["monFichier"]["tmp_name"]);
//                            
//                            if ($taille_fichier > $taille_max) { // Si fichier trop lourd
//                                echo('<script language="javascript">');
//                                echo('alert("Votre fichier est trop lourd (30Mo)")');
//                                echo('</script>');
//                            } else { // Si taille fichier ok
                        
                                if ($_POST["categorie"] == "affiche") { // Si la catégorie choisie est IMAGE

                                    if ($_FILES["monFichier"]["type"] == "image/jpeg" || $_FILES["monFichier"]["type"] == "image/pjpeg" || $_FILES["monFichier"]["type"] == "image/png") { // Si le format est .jpeg, .jpg ou .png

                                        copy($_FILES["monFichier"]["tmp_name"], "./php/images/grande_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./images/

                                        require("convertirImage700x700.inc.php");
                                        convertirImage700x700($_FILES["monFichier"]["tmp_name"], "./php/vignettes/vignette_".$_FILES["monFichier"]["name"]); // Copie de la vignette dans ./vignettes/

                                        try {
                                            // Etape 1 : connexion au serveur de base de données
                                            require("param.inc.php");
                                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                            $pdo->query("SET NAMES utf8");
                                            $pdo->query("SET CHARACTER SET 'utf8'");

                                            // Etape 2 : envoi de la requête SQL au serveur INSERER IMAGE
                                            $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Note, Titre, Type, Pseudo) VALUES (:paramDesc, :paramGde, :paramVig, :paramNote, :paramTitre, :paramType, :paramPseudo)";
                                            $statement = $pdo->prepare($sql);
                                            $statement->execute(array(":paramDesc" => $_POST["desc"], ":paramGde" => "grande_".$_FILES["monFichier"]["name"], ":paramVig" => "vignette_".$_FILES["monFichier"]["name"], ":paramNote" => "0", ":paramTitre" => $_POST["titre"], ":paramType" => "affiche", ":paramPseudo" => $_SESSION["pseudoCo"]));

                                            echo('<script language="javascript">');
                                            echo('alert("Votre fichier a été enregistré, rendez-vous dans la galerie pour consulter les œuvres !")');
                                            echo('</script>');

                                            $pdo = null;
                                        } catch(Exception $e) {
                                            echo("Exception :".$e->getMessage());
                                        }

                                    } else { // Si le format est différent de ceux attendus
                                        echo('<script language="javascript">');
                                        echo('alert("Les formats acceptés sont .jpeg, .jpg et .png.")');
                                        echo('</script>');
                                    } // Fin condition format image

                                } else if ($_POST["categorie"] == "video") { // Si la catégorie choisie est VIDEO

                                    if ($_FILES["monFichier"]["type"] == "video/mp4") { // Si le fichier est en .mp4
                                        if ($_FILES["vignetteMonFichier"]["type"] == "image/jpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/pjpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/png") { // Si une vignette est téléchargée et au bon format (jpeg, jpg, png)

                                            copy($_FILES["monFichier"]["tmp_name"], "./php/videos/vid_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./videos/

                                            require("convertirImage700x700.inc.php");
                                            convertirImage700x700($_FILES["vignetteMonFichier"]["tmp_name"], "./php/vignettes/vignette_".$_FILES["vignetteMonFichier"]["name"]); // Copie de la vignette dans ./vignettes/

                                            try {
                                                // Etape 1 : connexion au serveur de base de données
                                                require("param.inc.php");
                                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                $pdo->query("SET NAMES utf8");
                                                $pdo->query("SET CHARACTER SET 'utf8'");

                                                // Etape 2 : envoi de la requête SQL au serveur INSERER VIDEO
                                                $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Note, Titre, Type, Pseudo) VALUES (:paramDesc, :paramVid, :paramVig, :paramNote, :paramTitre, :paramType, :paramPseudo)";

                                                $statement = $pdo->prepare($sql);
                                                $statement->execute(array(":paramDesc" => $_POST["desc"], ":paramVid" => "vid_".$_FILES["monFichier"]["name"], ":paramVig" => "vignette_".$_FILES["vignetteMonFichier"]["name"], ":paramNote" => "0", ":paramTitre" => $_POST["titre"], ":paramType" => "video", ":paramPseudo" => $_SESSION["pseudoCo"]));

                                                echo('<script language="javascript">');
                                                echo('alert("Votre fichier a été enregistré, rendez-vous dans la galerie pour consulter les œuvres !")');
                                                echo('</script>');

                                                $pdo = null;
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }

                                        } else { // Si aucune vignette n'a été choisie
                                            echo('<script language="javascript">');
                                            echo('alert("Vous devez choisir une vignette au format .jpeg, .jpg ou .png.")');
                                            echo('</script>');
                                        } // Fin condition vignette

                                    } else { // Si le format est différent de celui attendu
                                        echo($_FILES["monFichier"]["type"]);
                                      /*  echo('<script language="javascript">');
                                        echo('alert("Le format accepté est .mp4.")');
                                        echo('</script>');*/
                                    } // Fin condition format vidéo

                                } else if ($_POST["categorie"] == "audio") { // Si la catégorie choisie est clip AUDIO

                                    if ($_FILES["monFichier"]["type"] == "audio/mpeg" || $_FILES["monFichier"]["type"] == "audio/x-wav" || $_FILES["monFichier"]["type"] == "audio/wav") { // Si le format est .mpeg ou .wav
                                        if ($_FILES["vignetteMonFichier"]["type"] == "image/jpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/pjpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/png") { // Si une vignette est téléchargée et au bon format (jpeg, jpg, png)
                                            
                                            copy($_FILES["monFichier"]["tmp_name"], "./php/clips-audio/aud_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./clips-audio/

                                            require("convertirImage700x700.inc.php");
                                            convertirImage700x700($_FILES["vignetteMonFichier"]["tmp_name"], "./php/vignettes/vignette_".$_FILES["vignetteMonFichier"]["name"]); // Copie de la vignette dans ./vignettes/

                                            try {
                                                // Etape 1 : connexion au serveur de base de données
                                                require("param.inc.php");
                                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                $pdo->query("SET NAMES utf8");
                                                $pdo->query("SET CHARACTER SET 'utf8'");

                                                // Etape 2 : envoi de la requête SQL au serveur INSERER AUDIO
                                                $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Note, Titre, Type, Pseudo) VALUES (:paramDesc, :paramAud, :paramVig, :paramNote, :paramTitre, :paramType, :paramPseudo)";

                                                $statement = $pdo->prepare($sql);
                                                $statement->execute(array(":paramDesc" => $_POST["desc"], ":paramAud" => "aud_".$_FILES["monFichier"]["name"], ":paramVig" => "vignette_".$_FILES["vignetteMonFichier"]["name"], ":paramNote" => "0", ":paramTitre" => $_POST["titre"], ":paramType" => "audio", ":paramPseudo" => $_SESSION["pseudoCo"]));

                                                echo('<script language="javascript">');
                                                echo('alert("Votre fichier a été enregistré, rendez-vous dans la galerie pour consulter les œuvres !")');
                                                echo('</script>');

                                                $pdo = null;
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }
                                            
                                        } else { // Si aucune vignette n'a été choisie
                                            echo('<script language="javascript">');
                                            echo('alert("Vous devez choisir une vignette au format .jpeg, .jpg ou .png.")');
                                            echo('</script>');
                                        } // Fin condition vignette

                                    } else { // Si le format est différent de ceux attendus
                                        echo('<script language="javascript">');
                                        echo('alert("Les formats acceptés sont .mp3 et .wav.")');
                                        echo('</script>');
                                    } // Fin condition format clip audio

                                } else { // Si aucune catégorie n'est choisie
                                    echo('<script language="javascript">');
                                    echo('alert("Veuillez choisir une catégorie.")');
                                    echo('</script>');
                                } // Fin condition aucune catégorie choisie
                                
//                            } // Fin condition taille fichier
                        
                        } // Fin condition fichier différent de .htaccess
                    } // Fin condition fichier isset
        
                ?>

        <!-- ---------------------- FIN PHP ----------------- -->

        <script type="text/javascript" src="./js/participation.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
    </body>

</html>