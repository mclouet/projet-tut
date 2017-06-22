<?php
    header("Content-type: text/html");
    require("config.inc.php");
    
    if (!isset($_SESSION["pseudoCo"])) {
        
        // POPUP VOUS DEVEZ ETRE CONNECTE(E) POUR POSTER UNE OEUVRE
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Vous devez être connecté(e) pour pouvoir poster une oeuvre</p>
                    <a class="titreJaune" href="./connexion.php">Se connecter</a>
                </div>
            </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
    }
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
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
<!--                            <input type="hidden" name="MAX_FILE_SIZE" value="31457280" />-->
                            <!-- 31457280 octets = 30Mo -->
                            <label for="monFichier" class="labelFile">Fichier</label>
                            <input name="monFichier" type="file" id="monFichier" />
                        </div>
                        <!-- 3 -->
                        <p class="liste">3. Partagez avec vos amis !</p>
                        <div class="reseauxSoc">
                            <a href="http://www.facebook.com/sharer.php?u=https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/" target="_blank"><img src="./images/img-facebook-icon.png" alt="Logo Facebook" /></a>
                            <a href="https://twitter.com/intent/tweet/?url=https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/" target="_blank"><img src="./images/img-tweeter-icon.png" alt="Logo Twitter" /></a>
                            <a href="https://pinterest.com/pin/create/button/?url=https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="Logo Pinterest" /></a>
                            <a href="https://plus.google.com/share?url=https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/" target="_blank"><img src="./images/img-googleplus-icon.png" alt="Logo Google+" /></a>
                        </div>
                        <!-- 4 -->
                        <label for="titre" class="liste">4. Donnez un titre à votre oeuvre !</label>
                        <input type="text" name="titre" id="titre" required="required" pattern=".{1,24}" title="Le titre doit faire au maximum 24 caractères" />
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
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("pied.inc.php");
        
                    if (isset($_FILES["monFichier"])) {
                        
                        if ($_FILES["monFichier"]["name"] != ".htaccess") { // Si le fichier est différent de .htaccess
                            
                            $taille_max = 31457280; // 31457280 octets = 30Mo
                            $taille_fichier = filesize($_FILES["monFichier"]["tmp_name"]);

                            if ($taille_fichier > $taille_max) { // Si fichier trop lourd                              
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup fichier trop lourd -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Votre fichier est trop lourd.</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                            }  else { // Si taille fichier ok
                                                                try {
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // TEST SI NOM FICHIER EXISTE DEJA OU PAS
                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER NOMS FICHIERS
                                    $sql = "SELECT GdeOeuvre FROM OEUVRE";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                    $stop = false;
                                    $fileName = $_FILES["monFichier"]["name"];
                                    while($ligne != false and $stop == false) { // Début tant que
                                        $token1 = strtok($ligne["GdeOeuvre"], "_"); // Séparer préfixe ajouté du nom du fichier
                                        $nomFichier = strtok(";"); // Car aucun ; dans un nom de fichier

                                        if($nomFichier == $_FILES["monFichier"]["name"]) { // Si le nom du fichier existe déjà
                                            $fileName = "a-".$_FILES["monFichier"]["name"];
                                            $stop = true;
                                        } // Fin condition existence nom fichier

                                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                    } // Fin tant que
                                    
                                    
                                    // TEST SI NOM VIGNETTE EXISTE DEJA OU PAS
                                    if(isset($_FILES["vignetteMonFichier"])) { // Si une vignette est téléchargée
                                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER NOMS VIGNETTES
                                        $sql = "SELECT Vignette FROM OEUVRE";
                                        $statement = $pdo->query($sql);

                                        // Etape 3 : traitement des données retournées
                                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                        $stop = false;
                                        $vigName = $_FILES["vignetteMonFichier"]["name"];
                                        while($ligne != false and $stop == false) { // Début tant que
                                            $token1 = strtok($ligne["Vignette"], "_"); // Séparer préfixe ajouté du nom du fichier
                                            $nomVignette = strtok(";"); // Car aucun ; dans un nom de fichier

                                            if($nomVignette == $_FILES["vignetteMonFichier"]["name"]) { // Si le nom de la vignette existe déjà
                                                $vigName = "a-".$_FILES["vignetteMonFichier"]["name"];
                                                $stop = true;
                                            } // Fin condition existence nom vignette

                                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                        } // Fin tant que
                                    } // Fin condition si une vignette est téléchargée

                                } catch(Exception $e) {
                                    echo("Exception :".$e->getMessage());
                                }

                                $pdo = null;
                                                    
                                if ($_POST["categorie"] == "affiche") { // Si la catégorie choisie est IMAGE

                                    if ($_FILES["monFichier"]["type"] == "image/jpeg" || $_FILES["monFichier"]["type"] == "image/pjpeg") { // Si le format est .jpeg ou .jpg
                                        
                                        // VERIFICATION SI L'AUTEUR A DEJA DEPOSE UNE AFFICHE
                                        // Etape 1 : connexion au serveur de base de données
                                        require("param.inc.php");
                                        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                        $pdo->query("SET NAMES utf8");
                                        $pdo->query("SET CHARACTER SET 'utf8'");

                                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER AFFICHE DE L'UTILISATEUR CO
                                        $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."'AND Type = 'affiche'";
                                        $statement = $pdo->query($sql);
                                        
                                        // Etape 3 : traitement des données retournées
                                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                        
                                        if ($ligne != false) { // Si l'utilisateur a déjà déposé une affiche
                                            
                                            unlink("./php/images/".$ligne["GdeOeuvre"]);
                                            unlink("./php/vignettes/".$ligne["Vignette"]);
                                            $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'affiche'";
                                            $statement = $pdo->query($sql);                                            
                                        }

                                        echo 'vous n\'avez pas plus d\'affiche';

                                        $pdo = null;

                                        copy($_FILES["monFichier"]["tmp_name"], "./php/images/grande_".$fileName); // Copie du fichier dans ./images/

                                        require("convertirImage200x200.inc.php");
                                        convertirImage200x200($_FILES["monFichier"]["tmp_name"], "./php/vignettes/vignette_".$fileName); // Copie de la vignette dans ./vignettes/

                                        try {
                                            // Etape 1 : connexion au serveur de base de données
                                            require("param.inc.php");
                                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                            $pdo->query("SET NAMES utf8");
                                            $pdo->query("SET CHARACTER SET 'utf8'");

                                            // Etape 2 : envoi de la requête SQL au serveur INSERER IMAGE
                                            $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Titre, Type, Pseudo) VALUES (:paramDesc, :paramGde, :paramVig, :paramTitre, :paramType, :paramPseudo)";
                                            $statement = $pdo->prepare($sql);
                                            $statement->execute(array(":paramDesc" => addslashes($_POST["desc"]), ":paramGde" => "grande_".$fileName, ":paramVig" => "vignette_".$fileName, ":paramTitre" => addslashes($_POST["titre"]), ":paramType" => "affiche", ":paramPseudo" => $_SESSION["pseudoCo"]));
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                                               <!-- div popup fichier enregistré-->
                                                    <div class="flou visible">
                                                        <div class="popup visible">
                                                            <h3>Félicitations !</h3>
                                                            <p>Votre fichier a bien été enregistré, rendez-vous dans la galerie pour consulter les oeuvres !</p>
                                                            <a href="./galerie.php" class="titreRose">Galerie</a>
                                                            <a href="./index.php" class="titreJaune">Retour à l'accueil</a>
                                                            <button class="fermer">Fermer</button>
                                                        </div>
                                                   </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                           /* echo('<script language="javascript">');
                                            echo('alert("Votre fichier a été enregistré, rendez-vous dans la galerie pour consulter les œuvres !")');
                                            echo('</script>');*/

                                            $pdo = null;
                                        } catch(Exception $e) {
                                            echo("Exception :".$e->getMessage());
                                        }

                                } else { // Si le format est différent de ceux attendus
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup mauvais format -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Les formats acceptés sont .jpeg et .jpg</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                        
                                    } // Fin condition format image

                                } else if ($_POST["categorie"] == "video") { // Si la catégorie choisie est VIDEO

                                    if ($_FILES["monFichier"]["type"] == "video/mp4") { // Si le fichier est en .mp4
                                        if ($_FILES["vignetteMonFichier"]["type"] == "image/jpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/pjpeg") { // Si une vignette est téléchargée et au bon format (jpeg, jpg)
                                            
                                            // VERIFICATION SI L'AUTEUR A DEJA DEPOSE UNE VIDEO
                                            // Etape 1 : connexion au serveur de base de données
                                            require("param.inc.php");
                                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                            $pdo->query("SET NAMES utf8");
                                            $pdo->query("SET CHARACTER SET 'utf8'");

                                            // Etape 2 : envoi de la requête SQL au serveur SELECTION VIDEO DE L'UTILISATEUR CO
                                            $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."'AND Type = 'video'";
                                            $statement = $pdo->query($sql);
                                            echo 'requete : '.$sql;

                                            // Etape 3 : traitement des données retournées
                                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                            if ($ligne != false) { // Si l'utilisateur a déjà déposé une affiche
                                                echo 'déjà une vidéo je te la supprime';

                                                unlink("./php/videos/".$ligne["GdeOeuvre"]);
                                                unlink("./php/vignettes/".$ligne["Vignette"]);
                                                $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'video'";
                                                $statement = $pdo->query($sql);                                            
                                            }

                                            echo 'vous n\'avez pas plus de video';

                                            $pdo = null;
                                            
                                            copy($_FILES["monFichier"]["tmp_name"], "./php/videos/vid_".$fileName); // Copie du fichier dans ./videos/

                                            require("convertirImage200x200.inc.php");
                                            convertirImage200x200($_FILES["vignetteMonFichier"]["tmp_name"], "./php/vignettes/vignette_".$vigName); // Copie de la vignette dans ./vignettes/

                                            try {
                                                // Etape 1 : connexion au serveur de base de données
                                                require("param.inc.php");
                                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                $pdo->query("SET NAMES utf8");
                                                $pdo->query("SET CHARACTER SET 'utf8'");

                                                // Etape 2 : envoi de la requête SQL au serveur INSERER VIDEO
                                                $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Titre, Type, Pseudo) VALUES (:paramDesc, :paramVid, :paramVig, :paramTitre, :paramType, :paramPseudo)";

                                                $statement = $pdo->prepare($sql);
                                                $statement->execute(array(":paramDesc" => addslashes($_POST["desc"]), ":paramVid" => "vid_".$fileName, ":paramVig" => "vignette_".$vigName, ":paramTitre" => addslashes($_POST["titre"]), ":paramType" => "video", ":paramPseudo" => $_SESSION["pseudoCo"]));
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <!-- div popup fichier enregistré -->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Félicitations !</h3>
                    <p>Votre fichier a bien été enregistré, rendez-vous dans la galerie pour consulter les oeuvres !</p>
                    <a href="./galerie.php" class="titreRose">Galerie</a>
                    <a href="./index.php" class="titreJaune">Retour à l'accueil</a>
                    <button class="fermer">Fermer</button>
                </div>
            </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php                                           
                                                $pdo = null;
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }

                                        } else { // Si aucune vignette n'a été choisie
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup pas de vignette choisie -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Votre vignette doit être au format .jpeg ou .jpg</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                        } // Fin condition vignette

                                    } else { // Si le format est différent de celui attendu
                                        echo($_FILES["monFichier"]["type"]);
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup mauvais format -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Le format accepté est .mp4</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                    } // Fin condition format vidéo

                                } else if ($_POST["categorie"] == "audio") { // Si la catégorie choisie est clip AUDIO

                                    if ($_FILES["monFichier"]["type"] == "audio/mpeg" || $_FILES["monFichier"]["type"] == "audio/x-wav" || $_FILES["monFichier"]["type"] == "audio/wav") { // Si le format est .mpeg ou .wav
                                        if ($_FILES["vignetteMonFichier"]["type"] == "image/jpeg" || $_FILES["vignetteMonFichier"]["type"] == "image/pjpeg") { // Si une vignette est téléchargée et au bon format (jpeg, jpg)
                                            
                                            // VERIFICATION SI L'AUTEUR A DEJA DEPOSE UN CLIP AUDIO
                                            // Etape 1 : connexion au serveur de base de données
                                            require("param.inc.php");
                                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                            $pdo->query("SET NAMES utf8");
                                            $pdo->query("SET CHARACTER SET 'utf8'");

                                            // Etape 2 : envoi de la requête SQL au serveur SELECTION VIDEO DE L'UTILISATEUR CO
                                            $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."'AND Type = 'audio'";
                                            $statement = $pdo->query($sql);
                                            echo 'requete : '.$sql;

                                            // Etape 3 : traitement des données retournées
                                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                            if ($ligne != false) { // Si l'utilisateur a déjà déposé une affiche
                                                echo 'déjà un clip audio je te le supprime';

                                                unlink("./php/clips-audio/".$ligne["GdeOeuvre"]);
                                                unlink("./php/vignettes/".$ligne["Vignette"]);
                                                $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'audio'";
                                                $statement = $pdo->query($sql);                                            
                                            }

                                            echo 'vous n\'avez pas plus de clip audio';

                                            $pdo = null;
                                            
                                            copy($_FILES["monFichier"]["tmp_name"], "./php/clips-audio/aud_".$fileName); // Copie du fichier dans ./clips-audio/

                                            require("convertirImage200x200.inc.php");
                                            convertirImage200x200($_FILES["vignetteMonFichier"]["tmp_name"], "./php/vignettes/vignette_".$vigName); // Copie de la vignette dans ./vignettes/

                                            try {
                                                // Etape 1 : connexion au serveur de base de données
                                                require("param.inc.php");
                                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                $pdo->query("SET NAMES utf8");
                                                $pdo->query("SET CHARACTER SET 'utf8'");

                                                // Etape 2 : envoi de la requête SQL au serveur INSERER AUDIO
                                                $sql = "INSERT INTO OEUVRE (DescOeuvre, GdeOeuvre, Vignette, Titre, Type, Pseudo) VALUES (:paramDesc, :paramAud, :paramVig, :paramTitre, :paramType, :paramPseudo)";

                                                $statement = $pdo->prepare($sql);
                                                $statement->execute(array(":paramDesc" => addslashes($_POST["desc"]), ":paramAud" => "aud_".$fileName, ":paramVig" => "vignette_".$vigName, ":paramTitre" => addslashes($_POST["titre"]), ":paramType" => "audio", ":paramPseudo" => $_SESSION["pseudoCo"]));
                                                
?>
    <!-- - - - - - - - - - FIN HP - - - - - - - - - -->
        <!-- div popup fichier enregistré -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Félicitations !</h3>
                <p>Votre fichier a bien été enregistré, rendez-vous dans la galerie pour consulter les oeuvres !</p>
                <a href="./galerie.php" class="titreRose">Galerie</a>
                <a href="./index.php" class="titreJaune">Retour à l'accueil</a>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                              $pdo = null;
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }
                                            
                                        } else { // Si aucune vignette n'a été choisie
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup pas de vignette choisie -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Vous devez choisir une vignette au format .jpeg ou .jpg.</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                        } // Fin condition vignette

                                    } else { // Si le format est différent de ceux attendus
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup mauvais format -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Les formats acceptés sont .mp3 et .wav</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                    } // Fin condition format clip audio

                                } else { // Si aucune catégorie n'est choisie
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <!-- div popup pas de catégorie choisie -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Vous devez choisir une catégorie.</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                                } // Fin condition aucune catégorie choisie
                                
                            } // Fin condition taille fichier
                        
                        } // Fin condition fichier différent de .htaccess
                    } // Fin condition fichier isset
        
?>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
        <script type="text/javascript" src="./js/participation.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>

</html>