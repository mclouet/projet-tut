<?php
    header("Content-type: text/html");
?>
    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Participez ! &#124; CDLS</title>
        <meta name="description" content="Page de participation du concours Cabadix !" />
        <meta name="keywords" content="participation, concours, lots, sacs plastique, pollution, affiches, vidéos, clips audio" />
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
                <img src="../images/img-profil-photo.png" />
                <div class="log">
                    <a href="" title="Se connecter"><img src="../images/img-login.png" /></a>
                    <a href="" title="Se déconnecter"><img src="../images/img-logout.png" /> </a>
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
            <h2 id="participer">Participez !</h2>
            <div id="divParticipation">
                <form action="participation.php" enctype="multipart/form-data" method="post" id="participation">
                    <ol>
                        <!-- 1 -->
                        <li>Choisissez votre catégorie</li>
                        <div>
                            <input type="radio" name="categorie" value="affiche" id="radioAffiche" />
                            <label for="affiche">Affiche</label>
                            <input type="radio" name="categorie" value="video" id="radioVideo" />
                            <label for="video">Vidéo</label>
                            <input type="radio" name="categorie" value="audio" id="radioAudio" />
                            <label for="audio">Clip Audio</label>
                        </div>
                        <!-- 2 -->
                        <li>Importez votre travail</li>
                        <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />
                        <!-- 31457280 octets = 30Mo -->
                        <input name="monFichier" type="file" />
                        <!-- 3 -->
                        <li>Partagez avec vos amis !</li>
                        <div class="reseauxSoc">
                            <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo Facebook" /></a>
                            <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo Twitter" /></a>
                            <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="../images/img-pinterest-icon.png" alt="logo Pinterest" /></a>
                            <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="../images/img-instagram-icon.png" alt="logo Instagram" /></a>
                            <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo Google+" /></a>
                        </div>
                        <!-- 4 -->
                        <li>
                            <label for="titre">Donnez un titre à votre oeuvre !</label>
                        </li>
                        <input type="text" name="titre" id="titre" required="required" />
                        <!-- 5 -->
                        <li>
                            <label for="desc">Décrivez votre oeuvre !</label>
                        </li>
                        <textarea name="desc" rows="10" cols="35" required="required"></textarea>
                        <!-- Envoyer -->
                        <input type="submit" value="Envoyer" class="inputSubmit" /> </ol>
                </form>

                <div> <img src="../images/img-test-participation.png" alt="" /> </div>
            </div>
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


    <!------------------- PHP ------------------>

    <?php        
                    if (isset($_FILES["monFichier"])) {
                        
                        if ($_FILES["monFichier"]["name"] != ".htaccess") { // Si le fichier est différent de .htaccess
                        
                            if ($_POST["categorie"] == "affiche") { // Si la catégorie choisie est image
                                
                                if ($_FILES["monFichier"]["type"] == "image/jpeg" || $_FILES["monFichier"]["type"] == "image/pjpeg" || $_FILES["monFichier"]["type"] == "image/png") { // Si le format est .jpeg, .jpg ou .png
                                    copy($_FILES["monFichier"]["tmp_name"], "./images/grande_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./images/
                                    require("convertirImage700x700.inc.php");
                                    convertirImage700x700($_FILES["monFichier"]["tmp_name"], "vignette_".$_FILES["monFichier"]["name"]); // Copie de la vignette dans .
                                    echo('<script language="javascript">');
                                    echo('alert("Votre fichier a été enregistré !")');
                                    echo('</script>');
                                } else { // Si le format est différent de ceux attendus
                                    echo('<script language="javascript">');
                                    echo('alert("Les formats acceptés sont .jpeg, .jpg et .png.")');
                                    echo('</script>');
                                } // Fin condition format image
                                
                            } else if ($_POST["categorie"] == "video") { // Si la catégorie choisie est vidéo
                                
                                if ($_FILES["monFichier"]["type"] == "video/mp4") { // Si le fichier est en .mp4
                                    copy($_FILES["monFichier"]["tmp_name"], "./vid_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./videos/
                                    
                                    echo('<script language="javascript">');
                                    echo('alert("Votre fichier a été enregistré !")');
                                    echo('</script>');
                                } else { // Si le format est différent de celui attendu
                                    echo('<script language="javascript">');
                                    echo('alert("Le format accepté est .mp4.")');
                                    echo('</script>');
                                } // Fin condition format vidéo
                                
                            } else if ($_POST["categorie"] == "audio") { // Si la catégorie choisie est clip audio
                                
                                if ($_FILES["monFichier"]["type"] == "audio/mpeg" || $_FILES["monFichier"]["type"] == "audio/x-wav" || $_FILES["monFichier"]["type"] == "audio/wav") { // Si le format est .mpeg ou .wav
                                    copy($_FILES["monFichier"]["tmp_name"], "./aud_".$_FILES["monFichier"]["name"]); // Copie du fichier dans ./clips-audio/
                                    echo('<script language="javascript">');
                                    echo('alert("Votre fichier a été enregistré !")');
                                    echo('</script>');
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
                            
                            
                            // Début copie titre
                            $fic_titres = fopen("./titres.txt","a+");
                            if (isset($_POST["titre"])) {
                                fwrite($fic_titres, $_FILES["monFichier"]["name"].",".$_POST["titre"].";\n");
                            }                           
                            fclose($fic_titres);
                            // Fin copie titre
                            
                            // Début copie description
                            $fic_desc = fopen("./descriptions.txt","a+");
                            if (isset($_POST["desc"])) {
                                fwrite($fic_desc, $_FILES["monFichier"]["name"].",".$_POST["desc"].";\n");
                            }
                            fclose($fic_desc);
                            // Fin copie description
                        
                        } // Fin condition fichier différent de .htaccess
                    } // Fin condition fichier isset
        
                ?>

        <!------------------------FIN PHP------------------->

    </html>