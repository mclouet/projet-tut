<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="utf-8" />
        <title>Mon compte &#124; CDLS</title>
        <meta name="description" content="Inscrivez-vous pour participer au concours C'est dans le sac !" />
        <meta name="keywords" content="inscription, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
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
                <h2 class="titreVert">Mon compte</h2>

                <?php
            //echo 'pseudo : '.$_SESSION["pseudoCo"].' mdp : '.$_SESSION["motDePasseCo"];
            
            
//            try {
//                        // Etape 1 : connexion au serveur de base de données
//                        require("param.inc.php");
//                        $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
//                        $pdo->query("SET NAMES utf8");
//                        $pdo->query("SET CHARACTER SET 'utf8'");
//
//                        // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MOT DE PASSE
//                        $sql = "SELECT Pseudo, MotDePasse FROM UTILISATEUR WHERE Pseudo = '".$pseudoCo."'";
//                        $statement = $pdo->query($sql);
//
//                        // Etape 3 : traitement des données retournées
//                        $ligne = $statement->fetch(PDO::FETCH_ASSOC);
//                        
//                        if (md5($motDePasseCo) == $ligne["MotDePasse"] and $pseudoCo == $ligne["Pseudo"]) {
//                            /*echo("Vos mot de passe et pseudo existent dans la BDD");*/
//                            $classConnecte = "visible";
////                            $form = false;
//                            $_SESSION["pseudoCo"] = $pseudoCo;
//                            $_SESSION["motDePasseCo"] = $motDePasseCo;
//                            /*header("Location: ./index.php");*/
//                        }
//                       /* echo("La connexion a échoué");*/
//                        $pdo = null;
//                    } catch(Exception $e) {
//                        echo("Exception :".$e->getMessage());
//                    }
            
?>

                    <div id="monCompte">
                        <div>
                            <!-- Modifier la biographie -->
                            <form action="compte.php" id="formBio" method="post" class="">
                                <div>
                                    <label for="newBio">Nouvelle biographie</label>
                                    <textarea name="newBio" rows="7" cols="35" id="newBio" required="required"></textarea>
                                </div>
                                <div>
                                    <input type="submit" value="Mettre à jour" class="inputSubmit" />
                                </div>
                            </form>
                        </div>

                        <div>
                            <!-- Modifier le mot de passe -->
                            <form action="compte.php" id="formMdp" method="post" class="formulaireCompte">
                                <div>
                                    <label for="oldMdp">Ancien mot de passe</label>
                                    <input type="password" name="oldMdp" id="oldMdp" required="required" pattern=".{6,}" />
                                </div>
                                <div>
                                    <label for="newMdp">Nouveau mot de passe</label>
                                    <input type="password" name="newMdp" id="newMdp" required="required" pattern=".{6,}" />
                                </div>

                                <div>
                                    <label for="newMdpVerif">Confirmation du mot de passe</label>
                                    <input type="password" name="newMdpVerif" id="newMdpVerif" required="required" pattern=".{6,}" />
                                </div>
                                <div>
                                    <input type="submit" value="Mettre à jour" class="inputSubmit" />
                                </div>
                            </form>

                            <!-- Modifier l'adresse email -->
                            <form action="compte.php" id="formMail" method="post" class="formulaireCompte">
                                <div>
                                    <label for="oldMail">Adresse email</label>
                                    <input type="mail" name="oldMail" id="oldMail" required="required" pattern="^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$" />
                                </div>
                                <div>
                                    <label for="newMail">Nouvelle adresse email</label>
                                    <input type="mail" name="newMail" id="newMail" required="required" pattern="^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$" />
                                </div>

                                <div>
                                    <label for="newMailVerif">Confirmation de l'email</label>
                                    <input type="mail" name="newMailVerif" id="newMailVerif" required="required" pattern="^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$" />
                                </div>
                                <div>
                                    <input type="submit" value="Mettre à jour" class="inputSubmit" />
                                </div>
                            </form>
                        </div>

                        <h3 class="titreRose">Mes oeuvres</h3>

                        <div>
                            <img src="./images/img-apercu-defaut.jpg" alt="" class="oeuvreCompte" />
                            <img src="./images/img-apercu-defaut.jpg" alt="" class="oeuvreCompte" />
                            <img src="./images/img-apercu-defaut.jpg" alt="" class="oeuvreCompte" />
                            <div>
                                <img src="./images/img-bouton-supprimer.png" alt="" />
                                <img src="./images/img-bouton-supprimer.png" alt="" />
                                <img src="./images/img-bouton-supprimer.png" alt="" />
                            </div>
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

            <script type="text/javascript" src="./js/inscription.js"></script>
            <script type="text/javascript" src="./js/script.js"></script>
    </body>

    </html>