<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Connexion &#124; CDLS</title>
        <meta name="description" content="Connecter-vous pour participer au concours C'est dans le sac !" />
        <meta name="keywords" content="connexion, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
        <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="icon" type="image/png" href="./images/img-favicon.png">
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

        <!-- ---------------------- PHP ----------------- -->

        <?php        
        $classConnecte = "";
        
            if(!isset($_SESSION["pseudoCo"])) { // Si la session n'existe pas = si l'utilisateur n'est pas connecté
                
                if (isset($_POST["pseudoCo"])) { // Si le formulaire a été envoyé
                    $pseudoCo = addslashes($_POST["pseudoCo"]);
                    $motDePasseCo = addslashes($_POST["motDePasseCo"]);
                    
                    try {
                        // Etape 1 : connexion au serveur de base de données
                        require("param.inc.php");
                        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                        $pdo->query("SET NAMES utf8");
                        $pdo->query("SET CHARACTER SET 'utf8'");

                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MOT DE PASSE
                        $sql = "SELECT Pseudo, MotDePasse FROM UTILISATEUR WHERE Pseudo = '".$pseudoCo."'";
                        $statement = $pdo->query($sql);

                        // Etape 3 : traitement des données retournées
                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                        
                        if($ligne == false){ //si le résultat retourné est vide > si l'utilisateur n'existe pas
                        ?>
                            <div class="flou visible">
                                 <div class="popup visible">
                                    <h3>Erreur</h3>
                                    <p>Ce pseudo n'existe pas</p>
                                    <button class="fermer">Fermer</button>
                                </div>
                            </div>
                        <?php
                        }else{ //si l'utilisateur existe                         
                            if (md5($motDePasseCo) == $ligne["MotDePasse"] and $pseudoCo == $ligne["Pseudo"]) {
                                /*echo("Vos mot de passe et pseudo existent dans la BDD");*/
                                $classConnecte = "visible";
                                $_SESSION["pseudoCo"] = $pseudoCo;
                                $_SESSION["motDePasseCo"] = $motDePasseCo;
                            }
                               /* echo("La connexion a échoué");*/
                                $pdo = null;
                            } //fin else
                    } catch(Exception $e) {
                        echo("Exception :".$e->getMessage());
                    }
                }// Fin condition si le formulaire a été envoyé
            } else {// Si la session existe = si l'utilisateur est connecté              
                
                //echo("Vous êtes maintenant déconnecté");
                ?>
                <div class="flou <?php echo($classConnecte)?>">
                     <div class="popup <?php echo($classConnecte) ?>">
                        <h3>Déconnexion</h3>
                        <p>Vous êtes maintenant déconnecté</p>
                        <a href="./index.php" class="titreRose">Retourner à l'accueil</a>
                    </div>
                </div>
        
        
        <?php
            session_destroy();
            } //fin else
        ?>


            <!-- ---------------------- FIN PHP ----------------- -->

            <main>
                <h2 class="titreBleu">Connexion</h2>

                <form action="connexion.php" id="connexion" method="post" class="formulaire">
                    <div>
                        <label for="pseudoCo">Pseudo</label>
                        <input id="pseudoCo" type="text" name="pseudoCo" required="required" />
                    </div>

                    <div>
                        <label for="motDePasseCo">Mot de passe</label>
                        <input type="password" name="motDePasseCo" id="motDePasseCo" required="required" pattern=".{6,}" />
                    </div>

                    <div>
                        <input type="submit" value="Se connecter" class="inputSubmit" />
                    </div>
                </form>
                
                <p class="lienInscription">Pas encore de compte ? <a href="./inscription.php">Inscrivez-vous !</a></p>
                <div class="flou <?php echo($classConnecte) ?>">
                    <div class="popup <?php echo($classConnecte) ?>">
                        <h3>Connexion</h3>
                        <p>Vous êtes bien connecté</p>
                        <a href="./index.php" class="titreRose">Retourner à l'accueil</a>
                    </div>
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
                    <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="logo Facebook" /></a>
                    <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="logo Twitter" /></a>
                    <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="logo Pinterest" /></a>
                    <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="logo Instagram" /></a>
                    <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="logo Google+" /></a>
                </div>
            </footer>
        <script src="./js/jquery-3.2.1.js"></script>
        <script type="text/javascript" src="./js/script.js"></script>
        
    </body>

    </html>