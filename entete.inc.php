<?php
    header("Content-type: text/html");
?>

    <header>
        <div class="reseauxSoc">
            <a href="https://www.facebook.com/Cest-dans-le-sac-1703344363292608/" target="_blank"><img src="./images/img-facebook-icon.png" alt="logo facebook" /></a>
            <a href="https://twitter.com/cestdanslesac" target="_blank"><img src="./images/img-tweeter-icon.png" alt="logo twitter" /></a>
            <a href="https://fr.pinterest.com/cdanslesac/" target="_blank"><img src="./images/img-pinterest-icon.png" alt="logo pinterest" /></a>
            <a href="https://www.instagram.com/cestdanslesac/" target="_blank"><img src="./images/img-instagram-icon.png" alt="logo instagram" /></a>
            <a href="https://plus.google.com/108664054375147502962" target="_blank"><img src="./images/img-googleplus-icon.png" alt="logo google+" /></a>
        </div>

        <h1>C'est dans le sac !</h1>

<?php
    if (isset($_SESSION["pseudoCo"])) {
    // Si la session existe (utilisateur connecté), affichage des logos "se déconnecter" et "mon compte"    
?>

            <div class="compte">
                <a href="./compte.php">Mon compte</a>
                <img src="./images/img-profil-photo.png" />
                <div class="log">
                    <a href="./connexion.php" title="Se déconnecter">
                        <img src="./images/img-logout.png" />
                    </a>
                </div>
            </div>

<?php
        } else {
        // Si la session n'existe pas (utilisateur déconnecté), affichage du logo "se connecter"
?>

                <div class="compte">
                    <div class="log">
                        <a href="./connexion.php" title="Se connecter">
                            <img src="./images/img-login.png" />
                        </a>
                    </div>
                </div>

<?php
    }
?>
    </header>