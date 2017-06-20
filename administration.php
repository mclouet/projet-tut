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
            
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            // GERER SUPPRESSION OEUVRES NON NON NON COPIER SLIDER GALERIE ET AJOUTER BTN SUPPRESSION OU JUSTE AJOUTER BTN DANS GALERIE ET IF UTILISATEUR ADMIN ALORS PEUT SUPPRIMER
            // Etape 1 : connexion au serveur de base de données
            require("param.inc.php");
            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
            $pdo->query("SET NAMES utf8");
            $pdo->query("SET CHARACTER SET 'utf8'");

            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER LES OEUVRES
            $sql = "SELECT Pseudo, Titre, Vignette, Type FROM OEUVRE";
            $statement = $pdo->query($sql);

            // Etape 3 : traitement des données retournées
            $ligne = $statement->fetch(PDO::FETCH_ASSOC);

            while($ligne != false) { 
                $titre = $ligne["Titre"];
                $vignette = "./php/vignettes/".$ligne["Vignette"];
                $auteur = $ligne["Pseudo"];
                if($ligne["Type"] == "affiche") { // Si l'oeuvre est une affiche
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            
                    <a title="Affiche &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Affiche de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            
<?php
                } else if($ligne["Type"] == "video") { // Si l'oeuvre est une vidéo
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            
                    <a title="Vidéo &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Vidéo de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            
<?php                    
                } else if($ligne["Type"] == "audio") { // Si l'oeuvre est un clip audio
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            
                    <a title="Clip audio &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Clip audio de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
            
    <!-- - - - - - - - - - PHP - - - - - - - - - -->            
<?php                    
                } // Fin condition type oeuvre
                
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
            } // Fin boucle
            
            
            
            if($chef) { // Si l'utilisateur est le commanditaire, afficher la liste des utilisateurs, possibilité de modifier droits admin
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            
            <h3>Liste des utilisateurs du site</h3>
            
            <p id="preventionAdmin">
                En tant que commanditaire du site C'est dans le sac !, vous pouvez ajouter ou supprimer les droits d'administration aux différents utilisateurs du site.</br>
                Attention toutefois ! Un administrateur a la possibilité de supprimer n'importe quelle œuvre à partir du moment où il la juge contraire au règlement du concours.
            </p>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            
<?php
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
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                while($ligne != false) {
                    $cpt++;
                    $srcBtn = "./images/img-bouton-supprimer.png"; // A SUPPRIMER
                    if($ligne["Admin"] == "0") {
                        $admin = "Non";
                        // $srcBtn = le lien vers le bouton +
                    } else {
                        $admin = "Oui";
                        // $srcBtn = le lien vers le bouton -
                    }
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
     
            <p class="utilisateursAdmin" data-user="<?php echo($cpt) ?>"><?php echo($ligne["Pseudo"]); ?> &#124; Admin : <?php echo($admin); ?></p>
            <form action="administration.php" method="post">
                <button type="submit" name="admin" data-admin="<?php echo($cpt) ?>"><img src="<?php echo($srcBtn); ?>" alt="Bouton de modifications des droits d'administration" /></button>
            </form>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->    
<?php
                    
                    // COMMENT ASSOCIER LE BOUTON AU <p></p> ET DONC A L'UTILISATEUR ET A LA VALEUR DE ADMIN ?
//                    $user.$cpt = array("pseudo".$cpt => $ligne["Pseudo"], "adminON".$cpt => $admin); // Tableau contenant le pseudo et les droits de l'utilisateur
//                    $tous = array();
//                    $tous = array_merge($tous, $user.$cpt);
                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                } // Fin boucle
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->      
<?php
                $pdo = null;                
                
                if(isset($_POST["admin"])) { // Si le commanditaire clique sur l'un des boutons ajout / suppression droits admin
//                    $utilisateur = $tous["pseudo5"];
//                    echo 'utilisateur '.$utilisateur;
//                    $sql = "UPDATE UTILISATEUR SET Admin ='1' WHERE Pseudo ='".$utilisateur."'";
//                    echo 'sql : '.$sql;
                    
                } // Fin condition si le commanditaire clique sur l'un des boutons ajout / suppression droits admin
                
            } // Fin condition si l'utilisateur est le commanditaire
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->     
        </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("pied.inc.php");
?>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
        <script type="text/javascript" src="./js/participation.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>

</html>