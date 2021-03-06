<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Galerie &#124; CDLS</title>
        <meta name="description" content="Regardez vos oeuvres et celles des autres participants dans notre galerie" />
        <meta name="keywords" content="galerie, représentations, concours, lots, sacs plastique, pollution, affiches, vidéos, clips audio" />
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
                    <a href="./galerie.php" class="actif">Galerie</a>
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
            <h2 class="titreBleu">Réalisations</h2>
            <div id="selecGalerie">
                <p data-format="image">Affiches</p>
                <p data-format="video">Vidéos</p>
                <p data-format="audio">Clips audio</p>
            </div>
            <div class="naviGalerie">
                <img src="./images/img-page-precedente.png" alt="Flèche page précedente" class="boutonNavi" data-navi="reculer" />
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 1" />
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 2" />
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 3" />
                <img src="./images/img-page-suivante.png" alt="Flèche page suivante" class="boutonNavi" data-navi="avancer" />
            </div>
            <div id="galerie">
                <ul id="imgGalerie">
                    <li data-numero = "1">
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                
                try {        
                    //boucle sur chaque oeuvre (depuis BDD)
                    //ETAPE 1: connexion à la base de données
                    require("param.inc.php");
                    $pdo = new PDO("mysql:host=".MYHOST.";dbname=".MYDB,MYUSER,MYPASS);
                    $pdo -> query("SET NAMES utf8");
                    $pdo -> query("SET CHARACTER SET 'utf8'");
                    
                    $compteur = 0;
                    $dataNum = 2;
                    //ETAPE 2: Envoyer une requête SQL
                    $sql = "SELECT IdOeuvre, Vignette, Type, DescOeuvre FROM OEUVRE";

                    $statement = $pdo->prepare($sql);
                    $statement->execute();
                    
                    //ETAPE 3: Traiter les données retournées
                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                    //Boucle sur chaque oeuvre (depuis la BDD)
                    while($ligne != false){
                        
                        if($ligne["Type"] == "affiche"){ //si le document est de type affiche
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                            <a href="./afficheImage.php?idImg=<?php echo($ligne["IdOeuvre"]) ?>">
                                <img  alt="vignette de <?php echo($ligne["DescOeuvre"]); ?>" src="./php/vignettes/<?php echo($ligne["Vignette"]); ?>" data-format="image" class="enfantGalerie"/>
                            </a> 
                        
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php           
                        $compteur++;
                            
                        }else if($ligne["Type"] == "video"){ //si le doc est de type vidéo
                                       
?>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
                            <a href="./afficheImage.php?idImg=<?php echo($ligne["IdOeuvre"]) ?>">
                                <img alt="vignette de <?php echo($ligne["DescOeuvre"]); ?>" src="./php/vignettes/<?php echo($ligne["Vignette"]); ?>" data-format="video" class="enfantGalerie"/>
                            </a>
                                <!-- Vidéo de démonstration :
                        Author: mskrzyp
                        Author webpage: https://vimeo.com/mskrzyp125 
                        Licence: ATTRIBUTION LICENSE 3.0 (http://creativecommons.org/licenses/by/3.0/us/)
                        Downloaded at Mazwai.com -->
    <!-- - - - - - - - - - PHP - - - - - - - - - -->                   
<?php
                        $compteur++;                                                                                      
                        }else{ // si le doc est un audio
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                            <a href="./afficheImage.php?idImg=<?php echo($ligne["IdOeuvre"]) ?>">
                                <img alt="vignette de <?php echo($ligne["DescOeuvre"]); ?>" src="./php/vignettes/<?php echo($ligne["Vignette"]); ?>" data-format="audio" class="enfantGalerie"/>
                            </a>                     
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php       
                        $compteur++;
                        }
                        
                        if($compteur == 3){
                            $compteur = 0;
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                        </li>
                        <li data-numero ="<?php echo($dataNum++) ?>">            
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
                        }
                        
                    
                //image suivante
                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                    } //fin while
                //ETAPE 4: Déconnexion
                $pdo = null;    
                    
            } catch(Exception $e){
                    echo("Exception :".$e->getMessage());
            }
?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
    
                        <a href="./participation.php">                            
                            <img src="./images/img-fin-galerie.png" alt="image de fin de galerie"/>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="naviGalerie"> 
                <img src="./images/img-page-precedente.png" alt="Flèche page précedente" class="boutonNavi" data-navi="reculer"/> 
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 1" /> 
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 2" /> 
                <img src="./images/img-numero-page-droite.png" alt="Bouton de navigation 3" /> 
                <img src="./images/img-page-suivante.png" alt="Flèche page suivante" class="boutonNavi" data-navi="avancer"/> 
            </div>
        </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
<?php
            require("pied.inc.php");
?>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
    </body>
        <script type="text/javascript" src="./js/galerie.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
    </html>