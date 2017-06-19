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
                
                    if(isset($_SESSION["pseudoCo"])) { // Si l'utilisateur est connecté
                        /*$pseudoCo = addslashes($_POST["pseudoCo"]);
                        $motDePasseCo = addslashes($_POST["motDePasseCo"]);*/
                ?>

                    <div id="monCompte">
                        <div>
                            <div id="bio">
                            <h3 class="titreBleu">Biographie</h3>
                            <p>
                            <?php
                                // Afficher la biographie actuelle de l'utilisateur
                                try {
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER BIOGRAPHIE
                                    $sql = "SELECT Biographie FROM UTILISATEUR WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                    if ($ligne != false) {
                                        echo $ligne["Biographie"];
                                    }

                                    $pdo = null;
                                } catch(Exception $e) {
                                    echo("Exception :".$e->getMessage());
                                }
                            ?>
                            </p>
                        </div>
                            <!-- Modifier la biographie -->
                            <form action="compte.php" id="formBio" method="post" class="">
                                <div>
                                    <label class="titreBleu" for="newBio">Nouvelle biographie</label>
                                    <textarea name="newBio" rows="7" cols="35" id="newBio" required="required">
                                    </textarea>
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

                        <h3 id="titreMoncompteOeuvres" class="titreRose">Mes oeuvres</h3>

                        <div>
                            
                    <?php
                        
                        // Afficher les oeuvres de l'auteur
                        
                        try {
                            // Etape 1 : connexion au serveur de base de données
                            require("param.inc.php");
                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                            $pdo->query("SET NAMES utf8");
                            $pdo->query("SET CHARACTER SET 'utf8'");

                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER AFFICHE DE L'AUTEUR
                            $sql = "SELECT Titre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'affiche'";
                            $statement = $pdo->query($sql);
                            
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            if($ligne != false) { // Si l'auteur a déposé une affiche
                                $afficheUtilisateur = "./php/vignettes/".$ligne["Vignette"];
                                $titreAffiche = $ligne["Titre"];
                            } else { // Si l'auteur n'a pas déposé d'affiche
                                $afficheUtilisateur = "./images/img-apercu-defaut-carre.png";
                                $titreAffiche = "Vous n'avez pas encore déposé d'affiche";
                            }
                            

                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER VIDEO DE L'AUTEUR
                            $sql = "SELECT Titre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'video'";
                            $statement = $pdo->query($sql);
                            
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            if($ligne != false) { // Si l'auteur a déposé une affiche
                                $videoUtilisateur = "./php/vignettes/".$ligne["Vignette"];
                                $titreVideo = $ligne["Titre"];
                            } else { // Si l'auteur n'a pas déposé d'affiche
                                $videoUtilisateur = "./images/img-apercu-defaut-carre.png";
                                $titreVideo = "Vous n'avez pas encore déposé de vidéo";
                            }
                            
                            
                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER AUDIO DE L'AUTEUR
                            $sql = "SELECT Titre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'audio'";
                            $statement = $pdo->query($sql);
                            
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            if($ligne != false) { // Si l'auteur a déposé une affiche
                                $audioUtilisateur = "./php/vignettes/".$ligne["Vignette"];
                                $titreAudio = $ligne["Titre"];
                            } else { // Si l'auteur n'a pas déposé d'affiche
                                $audioUtilisateur = "./images/img-apercu-defaut-carre.png";
                                $titreAudio = "Vous n'avez pas encore déposé de clip audio";
                            }
                            
                            $pdo = null;

                        } catch(Exception $e) {
                            echo("Exception :".$e->getMessage());
                        }
                        
                    ?>
                            
                            <a title="<?php echo($titreAffiche); ?>" >
                                <img src="<?php echo($afficheUtilisateur); ?>" alt="Affiche de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" />
                            </a>
                            <a title="<?php echo($titreVideo); ?>">
                                <img src="<?php echo($videoUtilisateur); ?>" alt="Vidéo de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" />
                            </a>
                            <a title="<?php echo($titreAudio); ?>">
                                <img src="<?php echo($audioUtilisateur); ?>" alt="Clip audio de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" />
                            </a>
                            <form action="compte.php" method="post">
                                <button type="submit" name="supprAffiche"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression de l'affiche" /></button>
                                <button type="submit" name="supprVideo"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression de la vidéo" /></button>
                                <button type="submit" name="supprAudio"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression du clip audio" /></button>
                            </form>
                        </div>
                    </div>

                <?php
                        if(isset($_POST["newBio"])) { // Si l'utilisateur modifie sa biographie : traitement textarea
                            
                            $biographie = addslashes($_POST["newBio"]);
                            try {
                                // Etape 1 : connexion au serveur de base de données
                                require("param.inc.php");
                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                $pdo->query("SET NAMES utf8");
                                $pdo->query("SET CHARACTER SET 'utf8'");

                                // Etape 2 : envoi de la requête SQL au serveur AJOUTER BIOGRAPHIE
                                $sql = "UPDATE UTILISATEUR SET Biographie = '".$biographie."' WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                $statement = $pdo->query($sql);

                                $pdo = null;
                                
                                // POPUP
                            ?>
                
                
                            <?php
                            } catch(Exception $e) {
                                echo("Exception :".$e->getMessage());
                            }
                           
                            
                        } else if(isset($_POST["oldMdp"])) { // Si l'utilisateur modifie son mot de passe : traitement form 1

                            if($_POST["newMdp"] == $_POST["newMdpVerif"]) { // Si le mot de passe et le mot de passe de vérification sont identiques
                                
                                if (strlen($_POST["newMdp"]) >= 6) { // Si le mot de passe contient au moins 6 caractères
                                
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MOT DE PASSE
                                    $sql = "SELECT Pseudo, MotDePasse FROM UTILISATEUR WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                    if ($ligne != false) {
                                        $utilisateur = $ligne["Pseudo"];
                                        $mdpUtilisateur = $ligne["MotDePasse"];

                                        if(md5($_POST["oldMdp"]) == $mdpUtilisateur) { // Si le mot de passe entré est bon et qu'il correspond à celui de l'utilisateur connecté
                                            
                                                $motDePasse = addslashes($_POST["newMdp"]);
                                                $mdp = md5($motDePasse);
                                                try {
                                                    // Etape 1 : connexion au serveur de base de données
                                                    require("param.inc.php");
                                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                    $pdo->query("SET NAMES utf8");
                                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                                    // Etape 2 : envoi de la requête SQL au serveur AJOUTER NOUVEAU MOT DE PASSE
                                                    $sql = "UPDATE UTILISATEUR SET MotDePasse = '".$mdp."' WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                                    $statement = $pdo->query($sql);

                                                    $pdo = null;
                                                    echo 'Mot de passe bien modifié'; // POPUP
                                                } catch(Exception $e) {
                                                    echo("Exception :".$e->getMessage());
                                                }

                                        } else { // Si l'ancien mot de passe entré n'est pas bon
                                            echo 'mauvais ancien mot de passe'; // POPUP
                                        }
                                    }

                                    if($pdo != null) {
                                        $pdo = null;
                                    }
                                
                                } else { // Si le mot de passe contient moins de 6 caractères
                                            echo 'mdp trop court'; // POPUP
                                }
                            } else { // Si le mot de passe et le mot de passe de vérification sont différents
                                echo 'mdp et mdp verif différents'; // POPUP
                            } // Fin condition mot de passe et vérification
                            
                            
                        } else if(isset($_POST["oldMail"])) { // Si l'utilisateur modifie son adresse email : traitement form 2
                            
                            if($_POST["newMail"] == $_POST["newMailVerif"]) { // Si les champs nouvelle adresse et vérification sont identiques
                                if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST["newMail"])) { // Si la nouvelle adresse entrée est au bon format
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MAIL
                                    $sql = "SELECT Pseudo, AdMail FROM UTILISATEUR WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                    if($ligne != false) {
                                        $utilisateur = $ligne["Pseudo"];
                                        $mailUtilisateur = $ligne["AdMail"];

                                        if($_POST["oldMail"] == $mailUtilisateur) { // Si l'adresse email entrée est bonne et qu'elle correspond à celle de l'utilisateur connecté
                                            $mail = addslashes($_POST["newMail"]);
                                            
                                            try {
                                                // Etape 1 : connexion au serveur de base de données
                                                require("param.inc.php");
                                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                                $pdo->query("SET NAMES utf8");
                                                $pdo->query("SET CHARACTER SET 'utf8'");

                                                // Etape 2 : envoi de la requête SQL au serveur AJOUTER NOUVELLE ADRESSE EMAIL
                                                $sql = "UPDATE UTILISATEUR SET AdMail = '".$mail."' WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                                $statement = $pdo->query($sql);

                                                $pdo = null;
                                                echo 'Adresse email bien modifiée'; // POPUP
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }
                                            
                                        } else { // Si l'ancienne adresse email entrée n'est pas bonne
                                            echo 'mauvaise ancienne adresse email'; // POPUP
                                        } // Fin condition ancienne adresse email entrée
                                    }

                                    if($pdo != null) {
                                        $pdo = null;
                                    }
                                    
                                } else { // Si la nouvelle adresse email entrée n'est pas au bon format
                                    echo 'mauvais format de mail'; // POPUP
                                } // Fin condition format adresse email
                            } else { // Si les champs nouvelle adresse et vérification sont différents
                                echo 'Champs mail et vérification différents';
                            } // Fin condition nouvelle adresse et vérification
                            
                            
                        } else if(isset($_POST["supprAffiche"])) { // Si l'utilisateur supprime une affiche


                            // Etape 1 : connexion au serveur de base de données
                            require("param.inc.php");
                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                            $pdo->query("SET NAMES utf8");
                            $pdo->query("SET CHARACTER SET 'utf8'");

                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER TITRE
                            $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'affiche'";
                            $statement = $pdo->query($sql);     
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            
                            if($ligne == false) { // Si l'auteur n'a pas d'affiche à supprimer
                ?>
                
                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Suppression</h3>
                                <p>Il n'y a pas d'affiche à supprimer</p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>
                
                <?php
                            } else { // Si l'auteur a une affiche à supprimer
                                unlink("./php/images/".$ligne["GdeOeuvre"]);
                                unlink("./php/vignettes/".$ligne["Vignette"]);
                                
                                // Etape 1 : connexion au serveur de base de données
                                require("param.inc.php");
                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                $pdo->query("SET NAMES utf8");
                                $pdo->query("SET CHARACTER SET 'utf8'");

                                // Etape 2 : envoi de la requête SQL au serveur SUPPRIMER AFFICHE
                                $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND TYPE = 'affiche'";
                                $statement = $pdo->query($sql);

                                // Etape 3 : traitement des données retournées
                                $ligne = $statement->fetch(PDO::FETCH_ASSOC);

                                $pdo = null;
                ?>
                
                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Suppression</h3>
                                <p>Votre affiche a bien été supprimée</p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>
                
                <?php
                            } // Fin condition si l'auteur a une affiche à supprimer
                            
                                                        
                        } else if(isset($_POST["supprVideo"])) { // Si l'utilisateur supprime une vidéo
                            
                            // Etape 1 : connexion au serveur de base de données
                            require("param.inc.php");
                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                            $pdo->query("SET NAMES utf8");
                            $pdo->query("SET CHARACTER SET 'utf8'");

                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER TITRE
                            $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'video'";
                            $statement = $pdo->query($sql);     
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            
                            if($ligne == false) { // Si l'auteur n'a pas de vidéo à supprimer
                                
                ?>
                
                        <div class="flou visible">
                                <div class="popup visible">
                                    <h3>Suppression</h3>
                                    <p>Il n'y a pas de vidéo à supprimer</p>
                                    <button class="fermer">Fermer</button>
                                </div>
                        </div>
                
                <?php
                            } else { // Si l'auteur a une vidéo à supprimer
                                unlink("./php/videos/".$ligne["GdeOeuvre"]);
                                unlink("./php/vignettes/".$ligne["Vignette"]);
                                
                                try {
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MAIL
                                    $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND TYPE = 'video'";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                } catch(Exception $e) {
                                    echo("Exception :".$e->getMessage());
                                }

                                $pdo = null;
                ?>
                
                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Suppression</h3>
                                <p>Votre vidéo a bien été supprimée</p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>
                
                <?php
                                } // Fin condition si l'auteur a une vidéo à supprimer
                                
                            
                        } else if(isset($_POST["supprAudio"])) { // Si l'utilisateur supprime un clip audio
                            
                            // Etape 1 : connexion au serveur de base de données
                            require("param.inc.php");
                            $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                            $pdo->query("SET NAMES utf8");
                            $pdo->query("SET CHARACTER SET 'utf8'");

                            // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER TITRE
                            $sql = "SELECT Titre, GdeOeuvre, Vignette FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND Type = 'audio'";
                            $statement = $pdo->query($sql);     
                            // Etape 3 : traitement des données retournées
                            $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                            
                            if($ligne == false) { // Si l'auteur n'a pas de clip audio à supprimer
                ?>
                
                        <div class="flou visible">
                                <div class="popup visible">
                                    <h3>Suppression</h3>
                                    <p>Il n'y a pas de clip audio à supprimer</p>
                                    <button class="fermer">Fermer</button>
                                </div>
                        </div>
                
                <?php
                            } else { // Si l'auteur a un clip audio à supprimer
                                unlink("./php/clips-audio/".$ligne["GdeOeuvre"]);
                                unlink("./php/vignettes/".$ligne["Vignette"]);
                                
                                try {
                                    // Etape 1 : connexion au serveur de base de données
                                    require("param.inc.php");
                                    $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                    $pdo->query("SET NAMES utf8");
                                    $pdo->query("SET CHARACTER SET 'utf8'");

                                    // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER PSEUDO ET MAIL
                                    $sql = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."' AND TYPE = 'audio'";
                                    $statement = $pdo->query($sql);

                                    // Etape 3 : traitement des données retournées
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                } catch(Exception $e) {
                                    echo("Exception :".$e->getMessage());
                                }
                                
                                $pdo = null;
                ?>
                
                        <div class="flou visible">
                            <div class="popup visible">
                                <h3>Suppression</h3>
                                <p>Votre clip audio a bien été supprimé</p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div>
                
                <?php
                            } // Fin condition si l'auteur a un clip audio à supprimer
                            
                                
                        } // Fin condition si l'utilisateur modifie l'un des champs (bio, mdp, mail, supprimer affiche, vidéo, audio)
                        
                        
                    } else { // Si l'utilisateur n'est pas connecté
                        header("Location: connexion.php");
                    }
                ?>

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
            <script src="./js/jquery-3.2.1.js"></script>
    </body>

    </html>