<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
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
           //ETAPE 1: connexion à la base de données
            require("param.inc.php");
            $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
            $pdo -> query("SET NAMES utf8");
            $pdo -> query("SET CHARACTER SET 'utf8'");  

            //ETAPE 2: Envoyer une requête SQL
            if(isset ($_GET["idImg"])){ //si l'idOeuvre a été passée par l'URL
                
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
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                if($ligne["Type"] == "affiche"){
                    
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                    <div>
                        <img src="./php/images/<?php echo($ligne["GdeOeuvre"]) ?>" alt="Image <?php $ligne["Titre"] ?>" class="grandeOeuvre" />
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->            
<?php
                }else if($ligne["Type"] == "video"){
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->    
                    <div>
                        <video controls preload="metadata" data-format="video" class="grandeOeuvre">
                            <source src="./php/videos/<?php echo($ligne["GdeOeuvre"]) ?>" type="video/mp4" />
                        </video>
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                }else{
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                    <div>
                        <audio src="./php/clips-audio/<?php echo($ligne["GdeOeuvre"]) ?>" controls preload="metadata" data-format="audio" class="grandeOeuvre">
                        </audio>
                    </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->      
<?php
                } //fin if type
            }else { //si idImg n'existe pas
                     header("Location: ./galerie.php");
            }            
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <div>
                <h3>Description par l'auteur</h3>
                <p class="descOeuvre">
                    <?php
                    echo($ligne["DescOeuvre"]);
                    ?>
                </p>
            </div>
        </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("pied.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
        <script src="./js/script.js" type="text/javascript"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    </body>
</html>