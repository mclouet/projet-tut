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

    <main>
        <h2 class="titreBleu">Inscription</h2>

<!--
        <div id="reseauxConnexion">
            <div id="signup-facebook" class="signup-social">
                <a href="" target="_blank"><img src="../images/img-facebook-icon.png" alt="logo Facebook" /></a>
            </div>

            <div id="signup-twitter" class="signup-social">
                <a href="" target="_blank"><img src="../images/img-tweeter-icon.png" alt="logo Twitter" /></a>
            </div>

            <div id="signup-google" class="signup-social">
                <a href="" target="_blank"><img src="../images/img-googleplus-icon.png" alt="logo Google+" /></a>
            </div>
        </div>
-->

        <form action="" id="inscription" method="post" class="formulaire">
            <div>
                <label for="pseudo">Pseudo</label>
                <input id="pseudo" type="text" name="pseudo" required="required" />
            </div>

            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" required="required" />
            </div>

            <div>
                <label for="pass">Mot de passe</label>
                <input type="password" name="pass" id="pass" required="required" />
            </div>

            <div>
                <label for="pass">Vérification du mot de passe</label>
                <input type="password" name="pass" id="pass" required="required" />
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