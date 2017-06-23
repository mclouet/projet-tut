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
        <link rel="icon" type="image/png" href="./images/img-favicon.png">
    </head>

    <body>

    <?php
        require("entete.inc.php");
        
        if(isset($_SESSION["pseudoCo"])) { // Si l'utilisateur est connecté
            header("Location: ./index.php");
        } else { // Si l'utilisateur n'est pas connecté
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
                <h2 class="titreVert">Mot de passe oublié</h2>

                <!-- Mot de passe oublié -->
                <form action="oubli.php" id="oubliMdp" method="post" class="formulaire">
                    <div>
                        <label for="pseudoOubli">Pseudo</label>
                        <input type="text" name="pseudoOubli" id="pseudoOubli" required="required" />
                    </div>
                    <div>
                        <label for="adresseEmail">Adresse email</label>
                        <input type="mail" name="adresseEmail" id="adresseEmail" required="required" pattern="^[a-zA-Z][\w\.-]*[a-zA-Z0-9]@[a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z]$" />
                    </div>

                    <div>
                        <input type="submit" value="Envoyer" class="inputSubmit" />
                    </div>
                </form>
                
        </main>
        
        
<?php
        require("pied.inc.php");

        if(isset($_POST["adresseEmail"])) { // Si le formulaire est envoyé
            if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST["adresseEmail"])) { // Si l'email est valide (format)
                $email = $_POST["adresseEmail"];
                $pseudo = addslashes($_POST["pseudoOubli"]);

                // Etape 1 : connexion au serveur de base de données
                require("param.inc.php");
                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS);
                $pdo->query("SET NAMES utf8");
                $pdo->query("SET CHARACTER SET 'utf8'");

                // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER NOMS EMAIL
                $sql = "SELECT AdMail FROM UTILISATEUR WHERE AdMail = '".$email."' AND Pseudo = '".$pseudo."'";
                $statement = $pdo->query($sql);

                // Etape 3 : traitement des données retournées
                $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                if($ligne != false) { // Si l'utilisateur est bien dans la base de données avec ce pseudo et cette adresse email
                    // Génération d'un mot de passe aléatoire
                    $valeurs = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
                    $mdpAlea = "";
                    for($i = 0; $i < 10; $i++) {
                        $alea = $valeurs[rand(0,35)];
                        $mdpAlea = $mdpAlea.$alea;
                    } // Fin génération mot de passe aléatoire

                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER NOMS EMAIL
                    $mdpInsertion = md5($mdpAlea);
                    $sql = "UPDATE UTILISATEUR SET MotDePasse = '".$mdpInsertion."' WHERE Pseudo = '".$pseudo."'";
                    $statement = $pdo->query($sql);                

                    // Headers
                    $headers = "MIME-Version: 1.0"."\r\n";
                    $headers .= "Content-type: text/html; charset=utf-8"."\r\n";
                    // Le message
                    $cdls = "<a href='https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/'>C'est dans le sac !</a>";
                    $connexion = "<a href='https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/connexion.php'>connexion</a>";
                    $compte = "<a href='https://projets.iut-laval.univ-lemans.fr/16mmi1pj06/compte.php'>mon Compte</a>";
                    $message = "Vous venez de réinitialiser votre mot de passe sur le site ".$cdls."</br>Nous vous joignons un mot de passe temporaire. Veillez à rapidement le changer via la page '".$compte."' après votre ".$connexion.".</br>Votre mot de passe temporaire : ".$mdpAlea."</br>A bientôt sur notre site concours !</br>C'est dans le sac !";
                    // Plusieurs destinataires
                    $to = "marie.clouet.etu@univ-lemans.fr" . ", ";
                    $to .= $email;
                    // Objet
                    $objet = "Récupération de votre mot de passe &#124; CDLS";
                    // Remplacement de certains caractères
                    $objet = str_replace("&#124;","|",$objet);


                    // Envoi du mail
                    if(mail($to, $objet, $message, $headers)) {
?>           
        <!-- div popup email envoyé -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Félicitations</h3>
                <p>Votre message a bien été envoyé !</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
<?php   
                        }
                    } else { // Si l'adresse email et le pseudo ne correspondent pas dans la base de données
?>           
        <!-- div popup mauvais format d'email -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>Le pseudo et l'adresse email ne correspondent pas</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
<?php   
                    }

                    $pdo = null;
                } else { // Si l'email n'est pas valide (format)
?>           
        <!-- div popup mauvais format d'email -->
        <div class="flou visible">
            <div class="popup visible">
                <h3>Erreur</h3>
                <p>L'adresse email entrée n'est pas au bon format</p>
                <button class="fermer">Fermer</button>
            </div>
        </div>
<?php
                }

            }
        } // Fin condition si l'utilisateur est connecté
?>
        
        <script type="text/javascript" src="./js/script.js"></script>
        <script src="./js/jquery-3.2.1.js"></script>
    
    </body>
</html>