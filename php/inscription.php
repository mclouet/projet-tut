<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Inscription &#124; CDLS</title>
    <meta name="description" content="Inscrivez-vous pour participer au concours C'est dans le sac !" />
    <meta name="keywords" content="inscription, concours, sacs plastique, pollution, lots, gains, affiches, vidéos, clips audio" />
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>

<body>
    <header>
        <div class="reseauxSoc">
            <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo facebook" /></a>
            <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo twitter" /></a>
            <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="../images/img-pinterest-icon.png" alt="logo pinterest" /></a>
            <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="../images/img-instagram-icon.png" alt="logo instagram" /></a>
            <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo google+" /></a>
        </div>

        <h1>C'est dans le sac !</h1>

        <div class="compte">
            <a>Mon compte</a>
            <img src="../images/img-profil-photo.png" />
            <div class="log">
                <a href="" title="Se connecter"><img src="../images/img-login.png" /></a>
                <a href="" title="Se déconnecter"><img src="../images/img-logout.png" />
                </a>
            </div>
        </div>
    </header>


    <nav>
        <ul>
            <li>
                <a href="../index.html">Accueil</a>
            </li>
            <li>
                <a href="./galerie.php">Galerie</a>
            </li>
            <li>
                <a href="../contact.html">Nous contacter</a>
            </li>
            <li>
                <a href="./participation.php">Je participe</a>
            </li>
            <li>
                <a href="../modalites.html">Modalités</a>
            </li>
        </ul>
    </nav>

    <!-- ---------------------- PHP ----------------- -->

    <?php
    
        if (isset($_POST["pseudo"]) and $_POST["pseudo"] != "") { // Si le formulaire a été envoyé
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
                            $sql = "SELECT Pseudo FROM UTILISATEUR WHERE Pseudo = '".$_POST["pseudo"]."'";
                            $statement = $pdo->query($sql);

                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                            if ($ligne != false) { // Si le pseudo existe déjà
                                echo('<script language="javascript">');
                                echo('alert("Le pseudo existe déjà")');
                                echo('</script>');
                            } else { // Si le pseudo n'existe pas
                                $sql = "INSERT INTO UTILISATEUR(Pseudo, AdMail, MotDePasse, Admin) VALUES (:paramPseudo, :paramMail, :paramMdp, :paramAdmin)";
                                $statement = $pdo->prepare($sql);
                                $statement->execute(array(":paramPseudo" => $pseudo, ":paramMail" => $email, ":paramMdp" => $motDePasse, ":paramAdmin" => "0"));
                                echo('<script language="javascript">');
                                echo('alert("Votre insciption a été prise en compte")');
                                echo('</script>');
                                // AJOUTER LOCATION VERS AUTRE PAGE
                            }
                             
                            $pdo = null;
                         } catch(Exception $e) {
                             echo("Exception :".$e->getMessage());
                         }
                        
                        
                    } else { // Fin condition si l'email est valide
                        $message = "L'email n'est pas valide";
                        echo("EMAIL NON VALIDE");
                    } // Fin condition si l'email n'est pas valide
                } else { // Fin condition si le mot de passe contient au moins 6 caractères
                    $message = "Le mot de passe doit contenir au moins 6 caractères";
                    echo("MOT DE PASSE : AU MOINS 6 CARACTERES");
                } // Fin condition si le mot de passe ne contient pas au moins 6 caractères
            } else { // Fin condition si le mot de passe de vérification correspond au mot de passe
                $message = "Les mots de passe saisis ne sont pas égaux";
                echo("MOT DE PASSE ET VERIFICATION PAS OK");
            } // Fin condition si le mot de passe de vérification ne correspond pas au mot de passe
        } // Fin condition si formulaire envoyé
    
    ?>

        <!-- ---------------------- FIN PHP ----------------- -->







        <main>
            <h2 class="titreBleu">Inscription</h2>

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
                    <input type="password" name="motDePasse" id="motDePasse" required="required" pattern=".{6,}" />
                </div>

                <div>
                    <label for="verifMdp">Confirmation du mot de passe</label>
                    <input type="password" name="verifMdp" id="verifMdp" required="required" pattern=".{6,}" />
                </div>

                <div>
                    <input type="submit" value="Envoyer" class="inputSubmit" />
                </div>
            </form>

        </main>

        <footer>
            <div class="txtFooter">
                <p><a href="../mentions.html">Mentions légales</a></p>
                <p><a href="../contact.html">Formulaire de contact</a></p>
                <p><a href="../modalites.html">Modalités du concours</a></p>
                <p><a href="../sponsors.html">Sponsors</a></p>
            </div>
            <div>
                <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo Facebook" /></a>
                <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo Twitter" /></a>
                <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="../images/img-pinterest-icon.png" alt="logo Pinterest" /></a>
                <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="../images/img-instagram-icon.png" alt="logo Instagram" /></a>
                <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo Google+" /></a>
            </div>
        </footer>
</body>

</html>