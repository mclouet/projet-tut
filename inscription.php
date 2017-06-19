<?php
    header("Content-type: text/html");
    require("config.inc.php");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Inscription &#124; CDLS</title>
    <meta name="description" content="Inscrivez-vous pour participer au concours C'est dans le sac !" />
    <meta name="keywords" content="inscription, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
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
        $form = "";
        $message = "";
        $classInscrit = "";
        if (isset($_POST["pseudo"]) and $_POST["pseudo"] != "") { // Si le formulaire a été envoyé
            if (isset($_POST["accepterModalite"])) { // Si le bouton accepter les modalités a été coché
                if ($_POST["motDePasse"] == $_POST["verifMdp"]) { // Si le mot de passe de vérification correspond au mot de passe
                    if (strlen($_POST["motDePasse"]) >= 6) { // Si le mot de passe contient au moins 6 caractères
                        if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST["email"])) { // Si l'email est valide
                            $pseudo = addslashes($_POST["pseudo"]);
                            $email = addslashes($_POST["email"]);
                            $motDePasse = addslashes($_POST["motDePasse"]);

                            // Vérification si pseudo n'existe pas déjà
                             try {
                                // Etape 1 : connexion au serveur de base de données
                                require("param.inc.php");
                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                $pdo->query("SET NAMES utf8");
                                $pdo->query("SET CHARACTER SET 'utf8'");

                                // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO
                                $sql = "SELECT Pseudo FROM UTILISATEUR WHERE Pseudo = '".$pseudo."'";
                                $statement = $pdo->query($sql);

                                // Etape 3 : traitement des données retournées
                                $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                if ($ligne != false) { // Si le pseudo existe déjà
                                    $message = "Le pseudo existe déjà";
                                    $form = true;
                                } else { // Si le pseudo n'existe pas
                                    $sql = "INSERT INTO UTILISATEUR(Pseudo, AdMail, MotDePasse, Admin) VALUES (:paramPseudo, :paramMail, :paramMdp, :paramAdmin)";
                                    $statement = $pdo->prepare($sql);
                                    $statement->execute(array(":paramPseudo" => $pseudo, ":paramMail" => $email, ":paramMdp" => md5($motDePasse), ":paramAdmin" => "0"));
                                    $message = "Votre inscription a bien été enregistrée !";
                                    $form = false;
                                    /*header("Location: ./connexion.php");*/
                                    $classInscrit = "visible";
                                    // POPUP VOTRE INSCRIPTION A ETE PRISE EN COMPTE
                                    ?>

                                    <div class="flou <?php echo($classInscrit) ?>">
                                        <div class="popup <?php echo($classInscrit) ?>">
                                            <h3>Bravo !</h3>
                                            <p><?php echo($message) ?>
                                            </br>Connectez vous et rendez vous sur la page "Je Participe !"</p>
                                            <a href="./connexion.php" class="titreRose">Se connecter !</a>
                                        </div>
                                    </div>        

                                    <?php
                                }

                                $pdo = null;
                             } catch(Exception $e) {
                                 echo("Exception :".$e->getMessage());
                             }

                        } else { // Fin condition si l'email est valide
                            $message = "L'email n'est pas valide";
                            $form = true;

                          ?>

                            <div class="flou visible">
                                <div class="popup visible">
                                    <h3>Erreur</h3>
                                    <p><?php echo($message) ?></p>
                                    <button class="fermer">Fermer</button>
                                </div>
                            </div>        

                            <?php

                        } // Fin condition si l'email n'est pas valide
                    } else { // Fin condition si le mot de passe contient au moins 6 caractères
                        $message = "Le mot de passe doit contenir au moins 6 caractères";
                        $form = true;

                          ?>

                            <div class="flou visible">
                                <div class="popup visible">
                                    <h3>Erreur</h3>
                                    <p><?php echo($message) ?></p>
                                    <button class="fermer">Fermer</button>
                                </div>
                            </div>        

                            <?php

                    } // Fin condition si le mot de passe ne contient pas au moins 6 caractères
                } else { // Fin condition si le mot de passe de vérification correspond au mot de passe
                    $message = "Les mots de passe saisis ne sont pas égaux";
                    $form = true;

                      ?>

                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Erreur</h3>
                                <p><?php echo($message) ?></p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>        

                    <?php

                } // Fin condition si le mot de passe de vérification ne correspond pas au mot de passe
            } else { // Si l'utilisateur n'a pas accepté les modalités du concours
                $message = "Vous devez accepter les modalités et mentions légales avant de poursuivre";
                $form = true;
 ?>
                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Erreur</h3>
                                <p><?php echo($message) ?></p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>        
<?php
                
            } // Fin condition modalités
        } else { // Fin condition si formulaire envoyé
            $form = true;
        } // Fin condition si formulaire pas envoyé
    
        
    ?>
        
        <!-- ---------------------- FIN PHP ----------------- -->

        <main>
            <h2 class="titreBleu">Inscription</h2>
            
        <!-- ---------------------- PHP ----------------- -->

            
            <?php
                    if ($form) { // Si le formulaire doit être ré-affiché
            ?>
            
            <!-- ---------------------- FIN PHP ----------------- -->


            <form action="inscription.php" id="inscription" method="post" class="formulaire">
                <div>
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" type="text" name="pseudo" required="required" />
                </div>

                <div>
                    <label for="email">E-mail</label>
                    <input type="text" name="email" id="email" required="required" />
                </div>

                <div>
                    <label for="motDePasse">Mot de passe</label>
                    <input type="password" name="motDePasse" id="motDePasse" required="required" pattern=".{6,}" title="Le mot de passe doit faire au moins 6 caractères"/>
                </div>

                <div>
                    <label for="verifMdp">Confirmation du mot de passe</label>
                    <input type="password" name="verifMdp" id="verifMdp" required="required" pattern=".{6,}" />
                </div>
                
                <div>
                    <input type="checkbox" name="accepterModalite" id="accepterModalite" required="required"/>
                    <label for="accepterModalite">J'ai lu et j'accepte les modalités et mentions légales du concours</label>
                </div> 

                <div>
                    <input type="submit" value="Envoyer" class="inputSubmit" />
                </div>
            </form>
            
            <!-- ---------------------- PHP ----------------- -->
    
    <?php
        }
    ?>
    
    <!-- ---------------------- FIN PHP ----------------- -->
        </main>
        
    <?php
        require("pied.inc.php");
    ?>

    <script type="text/javascript" src="./js/inscription.js"></script>
    <script type="text/javascript" src="./js/script.js"></script>
    <script src="./js/jquery-3.2.1.js"></script>
</body>

</html>