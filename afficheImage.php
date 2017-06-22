<?php
    header("Content-type: text/html");
    require("config.inc.php");

    if(isset($_SESSION["pseudoCo"])){
        //ETAPE 1: connexion à la base de données
        require("param.inc.php");
        $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
        $pdo -> query("SET NAMES utf8");
        $pdo -> query("SET CHARACTER SET 'utf8'");  

        //ETAPE 2: Envoyer une requête SQL
        $sql = "SELECT Admin, Pseudo FROM UTILISATEUR WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";

        $statement = $pdo->prepare($sql);
        $statement->execute();

        //ETAPE 3: Traiter les données retournées.
        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
        if($ligne["Admin"] == 1){
            $admin = "oui";
        }else{
            $admin = "non";
        }

        $pdo = null;
    }
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Oeuvre &#124; CDLS</title>
        <meta name="description" content="Description d'une oeuvre déposée pour le concours C'est dans le sac !" />
        <meta name="keywords" content="oeuvre, description, concours, sacs plastique, pollution, affiches, vidéos, clips audio" />
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

        <main> 
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            // AFFICHER TITRE, OEUVRE, AUTEUR, BIODRAPHIE, DESCRITPION
            //ETAPE 1: connexion à la base de données
            require("param.inc.php");
            $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            $pdo -> query("SET NAMES utf8");
            $pdo -> query("SET CHARACTER SET 'utf8'");  

            //ETAPE 2: Envoyer une requête SQL
            if(isset ($_GET["idImg"])){ // Si l'idOeuvre a été passée par l'URL
                
                $idOeuvre = $_GET["idImg"];
                
                $sql = "SELECT u.Pseudo, u.Biographie, o.GdeOeuvre, o.DescOeuvre, o.Titre, o.Type 
	               FROM OEUVRE o
	               INNER JOIN UTILISATEUR u
    	               ON u.Pseudo = o.Pseudo
                    WHERE o.IdOeuvre='".$idOeuvre."'";
                
                $statement = $pdo->prepare($sql);
                $statement->execute();

            //ETAPE 3: Traiter données retournées
            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
?> 
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <h2 class="titreDesc titreRose"><?php echo($ligne["Titre"]); ?></h2>
                <div class="retour">
                    <a href="./galerie.php">
                        <img src="./css/images-css/img-fleche-precedent.png" alt="Flèche page précedente"/>
                    </a>                
                    <p id="nomAuteur">Réalisé par <?php echo($ligne["Pseudo"]) ?></p>
                </div>

                <div class="flou visible" id="popupBioAI">
                    <div class="popup visible">
                        <h3>Biographie de <?php echo($ligne["Pseudo"]); ?></h3>
                        <p><?php echo($ligne["Biographie"]); ?></p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
              
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                if($ligne["Type"] == "affiche") {
                    
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                    <div>
                        <img src="./php/images/<?php echo($ligne["GdeOeuvre"]) ?>" alt="Image <?php $ligne["Titre"] ?>" class="grandeOeuvre" />
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->            
<?php
                } else if($ligne["Type"] == "video") {
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->    
                    <div>
                        <video controls preload="metadata" data-format="video" class="grandeOeuvre">
                            <source src="./php/videos/<?php echo($ligne["GdeOeuvre"]) ?>" type="video/mp4" />
                        </video>
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                } else {
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                    <div>
                        <audio src="./php/clips-audio/<?php echo($ligne["GdeOeuvre"]) ?>" controls preload="metadata" data-format="audio" class="grandeOeuvre">
                        </audio>
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                } // Fin if type
                
    
            } else { // Si idOeuvre n'existe pas
                header("Location: ./galerie.php");
            }

            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER NOTE
            $sql = "SELECT Note, Pseudo, IdOeuvre FROM NOTE WHERE IdOeuvre = '".$idOeuvre."' AND Pseudo = '".$_SESSION["pseudoCo"]."'";

            $statement = $pdo->query($sql);

            // Etape 3 : traitement des données retournées
            $ligneNote = $statement->fetch(PDO::FETCH_ASSOC);

            if($ligneNote != false) { // Si l'utilisateur a déjà noté cette oeuvre
                if($ligneNote["Note"] == '0') { // Si il a supprimé son vote
                    $srcBtn = "./images/img-bouton-voter.png";
                } else { // Si son vote pour cette oeuvre est à 1
                    $srcBtn = "./images/img-bouton-favori.png";
                }
            } else { // Si l'utilisateur n'a encore jamais noté cette oeuvre
                $srcBtn = "./images/img-bouton-voter.png";
            } // Fin condition si l'utilisateur a déjà noté cette oeuvre

?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div id="descNote">
                <div id="descAut">
                    <h3>Description par l'auteur</h3>
                    <p class="descOeuvre">
                        <?php echo($ligne["DescOeuvre"]); ?>
                    </p>
                </div>
                <form action="afficheImage.php?idImg=<?php echo($idOeuvre) ?>" method="post">
                    <button type="submit" name="noterOeuvre">
                        <img src="<?php echo($srcBtn); ?>" alt="Bouton de notation de l'oeuvre" />
                    </button>
                </form>
                
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php

        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER TITRE
        $sql = "SELECT COUNT(Note) FROM NOTE WHERE IdOeuvre = '".$idOeuvre."' AND Note = '1'";
        $statement = $pdo->query($sql);

        // Etape 3 : traitement des données retournées
        $ligneVote = $statement->fetch(PDO::FETCH_ASSOC);
            
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <p>Nombre de votes :
                </br><span id="countNotes"><?php echo($ligneVote["COUNT(Note)"]) ?></span></p>
            </div>
        </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            $pdo = null;
        
            if(isset($_SESSION["pseudoCo"])) { // Si l'utilisateur est connecté
        
                if($admin == "oui") { // Affichage du bouton de suppression de l'oeuvre si l'utilisateur est admin
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <form action="afficheImage.php?idImg=<?php echo($idOeuvre) ?>" method="post" id="supprOeAdmin">
            <button type="submit" name="adminSupprOe" class="btnSupprConfirm supprAfficheImage">
                <img src="./images/img-bouton-supprimer.png" alt="bouton de suppression d'un oeuvre en tant qu'administrateur" />
            </button>
        </form>        
        
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
    <?php   
                
                    if(isset($_POST["adminSupprOe"])) { // Si l'utilisateur clique sur le bouton de suppression de l'oeuvre

                        // Etape 1 : connexion au serveur de base de données
                        require("param.inc.php");
                        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                        $pdo->query("SET NAMES utf8");
                        $pdo->query("SET CHARACTER SET 'utf8'");

                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER TITRE
                        $sql = "SELECT Pseudo, Titre, GdeOeuvre, Vignette, Type FROM OEUVRE WHERE IdOeuvre = '".$idOeuvre."'";
                        $statement = $pdo->query($sql);

                        // Etape 3 : traitement des données retournées
                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                        $auteur = $ligne["Pseudo"];

                        if($ligne["Type"] == "affiche") { // Si l'oeuvre est une affiche
                            unlink("./php/images/".$ligne["GdeOeuvre"]);
                            unlink("./php/vignettes/".$ligne["Vignette"]);
                            $type = "L'affiche";
                            $suppr = "supprimée";
                        } else if($ligne["Type"] == "video") { // Si l'oeuvre est une vidéo
                            unlink("./php/videos/".$ligne["GdeOeuvre"]);
                            unlink("./php/vignettes/".$ligne["Vignette"]);
                            $type = "La vidéo";
                            $suppr = "supprimée";
                        } else if($ligne["Type"] == "audio") { // Si l'oeuvre est un clip audio
                            unlink("./php/clips-audio/".$ligne["GdeOeuvre"]);
                            unlink("./php/vignettes/".$ligne["Vignette"]);
                            $type = "Le clip audio";
                            $suppr = "supprimé";
                        } // Fin condition type oeuvre

                        try {
                            // Etape 2 : envoi de la requête SQL au serveur SUPPRIMER TOUT
                            $sql = "DELETE FROM NOTE WHERE IdOeuvre = '".$idOeuvre."'";
                            $statement = $pdo->query($sql);
                            
                            $sql = "DELETE FROM OEUVRE WHERE IdOeuvre = '".$idOeuvre."'";
                            $statement = $pdo->query($sql);
                        } catch(Exception $e) {
                            echo("Exception :".$e->getMessage());
                        }

                        $pdo = null;
    ?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Suppression</h3>
                        <p><?php echo($type); ?> de <?php echo($auteur); ?> a bien été <?php echo($suppr); ?></p>
                        <button class="fermer afficheImage">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
    <?php

                    } // Fin condition si l'utilisateur clique sur le bouton de suppression de l'oeuvre
                } // Fin condition si l'utilisateur est un admin

                // VOTER
                if(isset($_POST["noterOeuvre"])){ // Si l'utilisateur clique sur le bouton de vote

                    // Etape 1 : connexion au serveur de base de données
                    require("param.inc.php");
                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                    $pdo->query("SET NAMES utf8");
                    $pdo->query("SET CHARACTER SET 'utf8'");

                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER OEUVRE
                    $sql = "SELECT Note, Pseudo, IdOeuvre FROM NOTE WHERE IdOeuvre = '".$idOeuvre."' AND Pseudo = '".$_SESSION["pseudoCo"]."'";

                    $statement = $pdo->query($sql);

                    // Etape 3 : traitement des données retournées
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                    if($ligne != false) { // Si l'utilisateur a déjà noté cette oeuvre
                        if($ligne["Note"] == '0') { // Si il a supprimé son vote
                            $sql = "UPDATE NOTE SET Note = '1' WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND IdOeuvre = '".$idOeuvre."'";
                            $statement = $pdo->query($sql);
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Bravo</h3>
                        <p>Votre vote a bien été pris en compte !</p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                        } else { // Si son vote pour cette oeuvre est à 1
                            $sql = "DELETE FROM NOTE WHERE IdOeuvre = '".$idOeuvre."' AND Pseudo = '".$_SESSION["pseudoCo"]."'";
                            $statement = $pdo->query($sql);
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Bravo</h3>
                            <p>Votre vote a bien été pris en compte !</br>
                            Vous avez supprimé votre vote pour cette oeuvre.
                            </p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                        }
                    } else { // Si l'utilisateur n'a encore jamais noté cette oeuvre
                        $sql = "INSERT INTO NOTE (Pseudo, IdOeuvre, Note) VALUES ('".$_SESSION["pseudoCo"]."','".$idOeuvre."', '1')";
                        $statement = $pdo->query($sql);
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Bravo</h3>
                        <p>Votre vote a bien été pris en compte !</p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                    } // Fin condition si l'utilisateur a déjà noté cette oeuvre

                    $pdo = null;
                } // Fin condition si l'utilisateur clique sur le bouton de vote
                
            } else { // Si l'utilisateur n'est pas connecté
                if(isset($_POST["noterOeuvre"])) {
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Erreur</h3>
                        <p>Vous devez vous connecter pour pouvoir voter.</p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                }
            }
        
            require("pied.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <script src="./js/script.js" type="text/javascript"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>
</html>