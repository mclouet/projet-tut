<?php
    header("Content-type: text/html");
    require("config.inc.php");

    if (!isset($_SESSION["pseudoCo"])) { // Si l'utilisateur n'est pas connecté
        
        // POPUP VOUS DEVEZ ETRE CONNECTE(E) POUR POSTER UNE OEUVRE
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Vous devez être connecté(e) pour pouvoir accéder à l'espace d'administration.</p>
                    <a class="titreJaune" href="./connexion.php">Se connecter</a>
                </div>
            </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
    } else { // Si l'utilisateur est connecté
        
        // Etape 1 : connexion au serveur de base de données
        require("param.inc.php");
        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
        $pdo->query("SET NAMES utf8");
        $pdo->query("SET CHARACTER SET 'utf8'");

        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER LES UTILISATEURS
        $sql = "SELECT Pseudo, Admin FROM UTILISATEUR";
        $statement = $pdo->query($sql);

        // Etape 3 : traitement des données retournées
        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
        
        $stop = false;
        $chef = false;
        while($ligne != false and $stop == false) { // Traitement sur tous les utilisateurs admin
            if($ligne["Pseudo"] == $_SESSION["pseudoCo"] and $ligne["Admin"] == "1") { // Si l'utilisateur est un admin
                echo 'l\'utilisateur est un admin !';
                if($_SESSION["pseudoCo"] == "Cabadix") { // Si l'utilisateur est le commanditaire
                    $chef = true;
                } // Fin condition si l'utilisateur est le commanditaire
                $stop = true;
            } else if($ligne["Pseudo"] == $_SESSION["pseudoCo"] and $ligne["Admin"] == "0") { // Si l'utilisateur n'est pas un admin
                echo 'l\'utilisateur n\'est pas un admin !';
                $stop = true;
                // POPUP VOUS N'AVEZ PAS LES DROITS POUR ACCEDER A CETTE PAGE
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Vous n'avez pas les droits d'accès à cette page.</p>
                    <a class="titreJaune" href="./index.php">Retourner à l'accueil</a>
                </div>
            </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php  
            } // Fin condition si l'utilisateur n'est pas un admin
            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
        } // Fin traitement sur tous les utilisateurs admin
        
        $pdo = null;
        
    } // Fin condition si l'utilisateur est connecté
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->

    <!DOCTYPE html>

    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Administration &#124; CDLS</title>
        <meta name="description" content="Modérez les affiches, vidéos et clips audio déposés. Les œuvres ne doivent pas contredire les modalités du site." />
        <meta name="keywords" content="administration, gestion, modération, concours, lots, sacs plastique, pollution, affiches, vidéos, clips audio" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="icon" type="image/png" href="./images/img-favicon.png" />
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
            <h2 class="titreJaune">Administration</h2>
            
<?php            
            if($chef) { // Si l'utilisateur est le commanditaire, afficher la liste des utilisateurs, possibilité de modifier droits admin
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            
            <h3>Liste des utilisateurs du site</h3>
            
            <p class="preventionAdmin preventionCommanditaire">
                En tant que commanditaire du site C'est dans le sac !, vous pouvez ajouter ou supprimer les droits d'administration aux différents utilisateurs du site.</br>
                Attention toutefois ! Un administrateur a la possibilité de supprimer n'importe quelle œuvre à partir du moment où il la juge contraire au règlement du concours.
            </p>
        
     <!-- - - - - - - - - - PHP - - - - - - - - - -->   
<?php
                // AFFICHER LISTE UTILISATEURS
                // Etape 1 : connexion au serveur de base de données
                require("param.inc.php");
                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
                $pdo->query("SET NAMES utf8");
                $pdo->query("SET CHARACTER SET 'utf8'");

                // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER LES UTILISATEURS
                $sql = "SELECT Pseudo, Admin FROM UTILISATEUR";
                $statement = $pdo->query($sql);

                // Etape 3 : traitement des données retournées
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                
                $cpt = 0;
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
     
        <div id="tableUser">
            <div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                while($ligne != false) {
                    if($ligne["Admin"] == "0") {
                        $admin = "Non";
                    } else {
                        $admin = "Oui";
                    }
                    $pseudoAffichage = stripslashes($ligne["Pseudo"]);
?>
     
            <p class="utilisateursAdmin"><?php echo($pseudoAffichage); ?> &#124; Admin : <?php echo($admin); ?></p>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            
<?php
                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                } // Fin boucle
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            </div>
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                $pdo = null;
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <form method="post" action="./administration.php" class="formulaire">
                <div>
                    <label for="pseudoModif">Pseudo de l'utilisateur</label>
                    <input type="text" name="pseudoModif" required="required"/>
                </div>
                <div>
                    <input type="radio" name="boolAdmin" id="ajouterDroits" value="ajouter" required="required"/>
                    <label class="boolAdmin" for="ajouterDroits">Ajouter les droits</label>
                </div>
                <div>
                    <input type="radio" name="boolAdmin" id="supprimerDroits" value="supprimer" required="required"/>
                    <label class="boolAdmin" for="supprimerDroits">Supprimer les droits</label>
                </div>             
                <div>
                    <input type="submit" value="Modifier" class="inputSubmit btnHover" />
                </div>
            </form>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            
<?php
                if(isset($_POST["pseudoModif"])) { // Si le formulaire est envoyé
                    if(isset($_POST["boolAdmin"])) { // Si un bouton a été coché
                        $pseudoModif = addslashes($_POST["pseudoModif"]);
                        // SELECTIONNER L'UTILISATEUR ENTRE DANS LA BDD ET VERIFIER SI IL EXISTE
                        // Etape 1 : connexion au serveur de base de données
                        require("param.inc.php");
                        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
                        $pdo->query("SET NAMES utf8");
                        $pdo->query("SET CHARACTER SET 'utf8'");

                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER LES UTILISATEURS
                        $sql = "SELECT Pseudo, Admin FROM UTILISATEUR";
                        $statement = $pdo->query($sql);

                        // Etape 3 : traitement des données retournées
                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                        $pseudoExiste = false;
                        $stop = false;

                        while($ligne != false and $stop == false) {
                            if($ligne["Pseudo"] == $pseudoModif) { // C'EST ICI QUE CA NE MARCHE PAS
                                $pseudoExiste = true;
                                $stop = true;
                            }
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                        } // Fin boucle

                        if($pseudoExiste) { // Si le pseudo entré existe dans la BDD
                            if($_POST["boolAdmin"] == "ajouter") { // Si le commanditaire veut ajouter des droits
                                $sql = "UPDATE UTILISATEUR SET Admin = '1' WHERE Pseudo = '".$pseudoModif."'";
                                $statement = $pdo->query($sql);
?>
<!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <!-- div popup fichier ajout droits-->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Ajout</h3>
                    <p>Vous avez bien ajouté les droits d'administration à <?php echo(stripslashes($pseudoModif)); ?></p>
                    <button class="fermer">Fermer</button>
                </div>
            </div>
<!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                            } else if($_POST["boolAdmin"] == "supprimer") { // Si le commanditaire veut supprimer des droits
                                $sql = "UPDATE UTILISATEUR SET Admin = '0' WHERE Pseudo = '".$pseudoModif."'";
                                $statement = $pdo->query($sql);
?>
<!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <!-- div popup fichier suppression droits-->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Suppression</h3>
                    <p>Vous avez bien supprimé les droits d'administration de <?php echo(stripslashes($pseudoModif)); ?></p>
                    <button class="fermer">Fermer</button>
                </div>
            </div>
<!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                            } // Fin condition ajout ou suppression droits
                        } else { // Si le pseudo entré ne correspond à aucun psueod dans la BDD
?>
<!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <!-- div popup fichier pseudo pas dans la bdd-->
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Le pseudo entré n'existe pas dans la base de données.</p>
                    <button class="fermer">Fermer</button>
                </div>
            </div>
<!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                        }
                        
                        $pdo = null;
                        
                    } else { // Si aucun bouton n'est coché
                        echo 'vous devez cocher un bouton'; // POPUP
                    } // Fin condition boutons cochés
                } // Fin condition si le formulaire est envoyé
                
            } // Fin condition si l'utilisateur est le commanditaire
?> 
        
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <h3 class="titreAdmin">Gestion des oeuvres</h3>
            
                <p class="preventionAdmin lienInscription">
                    Votre rôle d'administrateur consiste à regarder fréquemment les œuvres déposées par les utilisateurs. Vous devez vérifier que celles-ci respectent les modalités du concours. Si ce n'est pas le cas, vous devez les supprimer via la page d'affichage de l'œuvre.</br>
                    Rendez-vous dans la <a href="./galerie.php">galerie</a> pour consulter les participations !
                </p>
        
        
            </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
        require("pied.inc.php");
?>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>

</html>