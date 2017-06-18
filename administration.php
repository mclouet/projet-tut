<?php
    header("Content-type: text/html");
    require("config.inc.php");

    if (!isset($_SESSION["pseudoCo"])) { // Si l'utilisateur n'est pas connecté
        
        // POPUP VOUS DEVEZ ETRE CONNECTE(E) POUR POSTER UNE OEUVRE
?>
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Vous devez être connecté(e) pour pouvoir accéder à l'espace d'administration.</p>
                    <a class="titreJaune" href="./connexion.php">Se connecter</a>
                </div>
            </div>
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
            <div class="flou visible">
                <div class="popup visible">
                    <h3>Erreur</h3>
                    <p>Vous n'avez pas les droits d'accès à cette page.</p>
                    <a class="titreJaune" href="./index.php">Retourner à l'accueil</a>
                </div>
            </div>
<?php  
            } // Fin condition si l'utilisateur n'est pas un admin
            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
        } // Fin traitement sur tous les utilisateurs admin
        
        $pdo = null;
        
    } // Fin condition si l'utilisateur est connecté
?>

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
                    <a href="./modalites.php">Modalités</a>
                </li>
            </ul>
        </nav>

        <main>
            <h2 class="titreJaune">Administration</h2>
            
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
            
                    <a title="Affiche &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Affiche de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
            
<?php
                } else if($ligne["Type"] == "video") { // Si l'oeuvre est une vidéo
?>
            
                    <a title="Vidéo &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Vidéo de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
            
<?php                    
                } else if($ligne["Type"] == "audio") { // Si l'oeuvre est un clip audio
?>
            
                    <a title="Clip audio &#124; Titre : <?php echo($titre); ?> &#124; Auteur : <?php echo($auteur); ?>">
                        <img src="<?php echo($vignette); ?>" alt="Clip audio de <?php echo($auteur); ?>" class="oeuvreAdministration" />
                    </a>
            
<?php                    
                } // Fin condition type oeuvre
                
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
            } // Fin boucle
            
            
            
            if($chef) { // Si l'utilisateur est le commanditaire, afficher la liste des utilisateurs, possibilité de modifier droits admin
?>
            
            <h3>Liste des utilisateurs du site</h3>
            
            <p id="preventionAdmin">
                En tant que commanditaire du site C'est dans le sac !, vous pouvez ajouter ou supprimer les droits d'administration aux différents utilisateurs du site.</br>
                Attention toutefois ! Un administrateur a la possibilité de supprimer n'importe quelle œuvre à partir du moment où il la juge contraire au règlement du concours.
            </p>
            
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
     
        <div id="tableUser">
            
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
     
            <p class="utilisateursAdmin" data-user="<?php echo($cpt) ?>"><?php echo($ligne["Pseudo"]); ?> &#124; Admin : <?php echo($admin); ?></p>
            <form action="administration.php" method="post">
                <button type="submit" name="admin" data-admin="<?php echo($cpt) ?>"><img src="<?php echo($srcBtn); ?>" alt="Bouton de modifications des droits d'administration" /></button>
            </form>
            
<?php
                    
                    // COMMENT ASSOCIER LE BOUTON AU <p></p> ET DONC A L'UTILISATEUR ET A LA VALEUR DE ADMIN ?
//                    $user.$cpt = array("pseudo".$cpt => $ligne["Pseudo"], "adminON".$cpt => $admin); // Tableau contenant le pseudo et les droits de l'utilisateur
//                    $tous = array();
//                    $tous = array_merge($tous, $user.$cpt);
                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                } // Fin boucle
?>
     
        </div>
            
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
            
        </main>

        <footer>
            <div class="txtFooter">
                <p><a href="./mentions.php">Mentions légales</a></p>
                <p><a href="./contact.php">Formulaire de contact</a></p>
                <p><a href="./modalites.php">Modalités du concours</a></p>
                <p><a href="./sponsors.php">Sponsors</a></p>
                <p><a href="./administration.php">Administration</a></p>
            </div>
            <div>
                <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="Logo Facebook" /></a>
                <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="Logo Twitter" /></a>
                <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="Logo Pinterest" /></a>
                <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="Logo Instagram" /></a>
                <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="Logo Google+" /></a>
            </div>
        </footer>
        
        <script type="text/javascript" src="./js/participation.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>

</html>