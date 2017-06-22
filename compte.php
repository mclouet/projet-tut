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
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
                <?php
            //echo 'pseudo : '.$_SESSION["pseudoCo"].' mdp : '.$_SESSION["motDePasseCo"];
                
                    if(isset($_SESSION["pseudoCo"])) { // Si l'utilisateur est connecté
                        /*$pseudoCo = addslashes($_POST["pseudoCo"]);
                        $motDePasseCo = addslashes($_POST["motDePasseCo"]);*/
                        
                        $titrePopup ="";
                        $messagePopup = "";
                        $conditionPopup = "";
                ?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                    <div id="monCompte">
                        <div>
                            <div id="bio">
                            <h3 class="titreBleu">Biographie</h3>
                            <p>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
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
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
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
    <!-- - - - - - - - - - PHP - - - - - - - - - -->             
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
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->     
                            <a title="<?php echo($titreAffiche); ?>" >
                                <img src="<?php echo($afficheUtilisateur); ?>" alt="Affiche de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" data-img="affiche" />
                            </a>
                            <a title="<?php echo($titreVideo); ?>">
                                <img src="<?php echo($videoUtilisateur); ?>" alt="Vidéo de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" data-img="video" />
                            </a>
                            <a title="<?php echo($titreAudio); ?>">
                                <img src="<?php echo($audioUtilisateur); ?>" alt="Clip audio de <?php echo($_SESSION["pseudoCo"]); ?>" class="oeuvreCompte" data-img="audio" />
                            </a>
                            <form action="./compte.php" method="post">
                                <button type="submit" name="supprAffiche" class="btnSupprConfirm" data-btn="affiche"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression de l'affiche" /></button>
                                <button type="submit" name="supprVideo" class="btnSupprConfirm" data-btn="video"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression de la vidéo" /></button>
                                <button type="submit" name="supprAudio" class="btnSupprConfirm" data-btn="audio"><img src="./images/img-bouton-supprimer.png" alt="Bouton de suppression du clip audio" /></button>
                            </form>
                        </div>
                    </div>
                
                <form action="./compte.php" method="post">
                    <button type="submit" name="supprCompte">Supprimer mon compte</button>
                </form>
                
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
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
                                $titrePopup ="Mise à jour";
                                $messagePopup = "Votre biographie a été mise à jour !";
                                $conditionPopup = "visible";
                                    
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
                                                    
                                                    $titrePopup ="Mise à jour";
                                                    $messagePopup = "Votre mot de passe a bien été modifié";
                                                    $conditionPopup = "visible";
                                                    
                                                } catch(Exception $e) {
                                                    echo("Exception :".$e->getMessage());
                                                }

                                        } else { // Si l'ancien mot de passe entré n'est pas bon
                                            $titrePopup ="Erreur";
                                            $messagePopup = "L'ancien mot de passe saisi est incorrect";
                                            $conditionPopup = "visible";
                                        }
                                    }

                                    if($pdo != null) {
                                        $pdo = null;
                                    }
                                
                                } else { // Si le mot de passe contient moins de 6 caractères
                                    $titrePopup ="Erreur";
                                    $messagePopup = "Le nouveau mot de passe contient moins de 6 caractères";
                                    $conditionPopup = "visible";
                                }
                            } else { // Si le mot de passe et le mot de passe de vérification sont différents
                                    $titrePopup ="Erreur";
                                    $messagePopup = "Les deux mots de passes ne sont pas identiques";
                                    $conditionPopup = "visible";
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
                                                
                                                $titrePopup ="Mise à jour";
                                                $messagePopup = "Votre mot de passe a été mise à jour !";
                                                $conditionPopup = "visible";
                                                
                                            } catch(Exception $e) {
                                                echo("Exception :".$e->getMessage());
                                            }
                                            
                                        } else { // Si l'ancienne adresse email entrée n'est pas bonne
                                            $titrePopup ="Erreur";
                                            $messagePopup = "";
                                            $conditionPopup = "visible";
                                        } // Fin condition ancienne adresse email entrée
                                    }

                                    if($pdo != null) {
                                        $pdo = null;
                                    }
                                    
                                } else { // Si la nouvelle adresse email entrée n'est pas au bon format
                                    $titrePopup ="Erreur";
                                    $messagePopup = "La nouvelle adresse email n'est pas valide";
                                    $conditionPopup = "visible";
                                } // Fin condition format adresse email
                            } else { // Si les champs nouvelle adresse et vérification sont différents
                                    $titrePopup ="Erreur";
                                    $messagePopup = "Les deux adresses email sont différentes";
                                    $conditionPopup = "visible";
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
                                $titrePopup ="Erreur";
                                $messagePopup = "Il n'y a pas d'affiche à supprimer";
                                $conditionPopup = "visible";
                                
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
                                
                                $titrePopup ="Suppression";
                                $messagePopup = "Votre affiche a bien été suppprimée";
                                $conditionPopup = "visible";
                                
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
                            
                                $titrePopup ="Erreur";
                                $messagePopup = "Il n'y a pas de vidéo à supprimer";
                                $conditionPopup = "visible";
                            
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
                                
                                $titrePopup ="Suppression";
                                $messagePopup = "La vidéo a bien été supprimée";
                                $conditionPopup = "visible";
        
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
                                
                                $titrePopup ="Erreur";
                                $messagePopup = "Il n'y a pas de clip audio à supprimer";
                                $conditionPopup = "visible";
                                
                                
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
                                
                                $titrePopup ="Suppression";
                                $messagePopup = "Votre clip audio a bien été supprimé";
                                $conditionPopup = "visible";
                                
                            } // Fin condition si l'auteur a un clip audio à supprimer
               
                        } else if(isset($_POST["supprCompte"])) { // Si l'utilisateur veut supprimer son compte
                            try {
                                // Etape 1 : connexion au serveur de base de données
                                require("param.inc.php");
                                $pdo=new PDO("mysql:host=".MYHOST.";dbname=".MYDB, MYUSER, MYPASS) ;
                                $pdo->query("SET NAMES utf8");
                                $pdo->query("SET CHARACTER SET 'utf8'");

                                // Etape 2 : envoi de la requête SQL au serveur SELECTIONNER IdOeuvre
                                $sql = "SELECT IdOeuvre, Pseudo, GdeOeuvre, Vignette, Type FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."'";
                                $statement = $pdo->query($sql);
                                
                                // Etape 3 : traitement des données retournées
                                $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                
                                while($ligne != false) {
                                    if($ligne["Type"] == "affiche") { // Si l'oeuvre est une affiche
                                        unlink("./php/images/".$ligne["GdeOeuvre"]);
                                        unlink("./php/vignettes/".$ligne["Vignette"]);
                                    } else if($ligne["Type"] == "video") { // Si l'oeuvre est une vidéo
                                        unlink("./php/videos/".$ligne["GdeOeuvre"]);
                                        unlink("./php/vignettes/".$ligne["Vignette"]);
                                    } else if($ligne["Type"] == "audio") { // Si l'oeuvre est un clip audio
                                        unlink("./php/clips-audio/".$ligne["GdeOeuvre"]);
                                        unlink("./php/vignettes/".$ligne["Vignette"]);
                                    } // Fin condition type oeuvre
                                    
                                    $requete = "DELETE FROM NOTE WHERE IdOeuvre = '".$ligne["IdOeuvre"]."'"; // Supprimer notes oeuvres auteur
                                    $statement = $pdo->query($requete);
                                    
                                    $requeteDeux = "DELETE FROM NOTE WHERE Pseudo = '".$ligne["Pseudo"]."'"; // Supprimer les votes que l'auteur a effectués
                                    $statement = $pdo->query($requeteDeux);
                                                                    
                                    $ligne = $statement->fetch(PDO::FETCH_ASSOC);
                                } // Fin boucle
                                                            
                                $requeteSupprOe = "DELETE FROM OEUVRE WHERE Pseudo = '".$_SESSION["pseudoCo"]."'"; // Supprimer les oeuvres de l'utlisateur
                                $statement = $pdo->query($requeteSupprOe);
                                                            
                                $requeteSupprUs = "DELETE FROM UTILISATEUR WHERE Pseudo = '".$_SESSION["pseudoCo"]."'"; // Supprimer l'utilisateur
                                $statement = $pdo->query($requeteSupprUs);
                                
                            } catch(Exception $e) {
                                echo("Exception :".$e->getMessage());
                            }
                                
                                $pdo = null;
                            
                            session_destroy();
                            
                ?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                <div class="flou visible">
                     <div class="popup visible">
                        <h3>Suppression</h3>
                        <p>Vous avez bien supprimé votre compte. A bientôt !</p>
                        <button class="fermer">Fermer</button>
                    </div>
                </div>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
                <?php
                            
                        } // Fin condition si l'utilisateur modifie l'un des champs (bio, mdp, mail, supprimer affiche, vidéo, audio)
           
                ?>   
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
                          <div class="flou <?php echo($conditionPopup) ?>">
                            <div class="popup <?php echo($conditionPopup) ?>">
                                <h3><?php echo($titrePopup)?></h3>
                                <p><?php echo($messagePopup) ?></p>
                                <button class="fermer">Fermer</button>
                            </div>
                        </div> 
                
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
                <?php
                        
                    } else { // Si l'utilisateur n'est pas connecté
                        header("Location: connexion.php");
                    }
                ?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            </main>
    <!-- - - - - - - - - - PHP - - - - - - - - - -->
            <?php
                require("pied.inc.php");

            ?>
    <!-- - - - - - - - - - FIN PHP - - - - - - - - - -->
            <script type="text/javascript" src="./js/script.js"></script>
            <script src="./js/jquery-3.2.1.js"></script>
    </body>

    </html>