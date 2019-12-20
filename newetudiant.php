<?php
session_start();
if (!empty($_REQUEST['nom']) AND !empty($_REQUEST['prenom']) AND !empty($_REQUEST['email']) AND !empty($_REQUEST['mdp'])){
    $nom = htmlentities($_REQUEST["nom"]);
    $prenom = htmlentities($_REQUEST["prenom"]);
    $classe = htmlentities($_REQUEST["classe"]);
    $promotion  = htmlentities($_REQUEST["promotion"]);
    if (isset($_REQUEST["nomImage"])){
        $photo = htmlentities($_REQUEST["nomImage"]);
    }
    else $photo = "";
    $email = htmlentities($_REQUEST["email"]);
    $mdp = htmlentities($_REQUEST["mdp"]);

    $mdph = password_hash($mdp, PASSWORD_DEFAULT);
    
    /* * **********************************************************
 * Definition des constantes / tableaux et variables
 * *********************************************************** */

// Constantes
define('TARGET', 'images/');    // Repertoire cible
define('MAX_SIZE', 100000);    // Taille max en octets du fichier
define('WIDTH_MAX', 800);    // Largeur max de l'image en pixels
define('HEIGHT_MAX', 800);    // Hauteur max de l'image en pixels
// Tableaux de donnees
$tabExt = array('jpg', 'gif', 'png', 'jpeg');    // Extensions autorisees
$infosImg = array();

// Variables
$extension = '';
$message = '';
$nomImage = '';

/* * **********************************************************
 * Creation du repertoire cible si inexistant
 * *********************************************************** */
if (!is_dir(TARGET)) {
    if (!mkdir(TARGET, 0755)) {
        exit('Erreur : le répertoire cible ne peut-être créé ! Vérifiez que vous diposiez des droits suffisants pour le faire ou créez le manuellement !');
    }
}

/* * **********************************************************
 * Script d'upload
 * *********************************************************** */
if (!empty($_REQUEST)) {
    // On verifie si le champ est rempli
    if (!empty($_FILES['fichier']['name'])) {
        // Recuperation de l'extension du fichier
        $extension = pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION);

        // On verifie l'extension du fichier
        if (in_array(strtolower($extension), $tabExt)) {
            // On recupere les dimensions du fichier
            $infosImg = getimagesize($_FILES['fichier']['tmp_name']);

            // On verifie le type de l'image
            if ($infosImg[2] >= 1 && $infosImg[2] <= 14) {
                // On verifie les dimensions et taille de l'image
                if (($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['fichier']['tmp_name']) <= MAX_SIZE)) {
                    // Parcours du tableau d'erreurs
                    if (isset($_FILES['fichier']['error']) && UPLOAD_ERR_OK === $_FILES['fichier']['error']) {
                        // On renomme le fichier
//            $nomImage = md5(uniqid()) .'.'. $extension;
                        $nomImage = $_FILES['fichier']['name'];
                        $_SESSION ['nomImage'] = $nomImage;
                        //var_dump($_FILES['fichier']);
                        // Si c'est OK, on teste l'upload
                        if (move_uploaded_file($_FILES['fichier']['tmp_name'], TARGET . $nomImage)) {
                            $message = 'Upload réussi !';
                        } else {
                            // Sinon on affiche une erreur systeme
                            $message = 'Problème lors de l\'upload !';
                        }
                    } else {
                        $message = 'Une erreur interne a empêché l\'uplaod de l\'image';
                    }
                } else {
                    // Sinon erreur sur les dimensions et taille de l'image
                    $message = 'Erreur dans les dimensions de l\'image !';
                }
            } else {
                // Sinon erreur sur le type de l'image
                $message = 'Le fichier à uploader n\'est pas une image !';
            }
        } else {
            // Sinon on affiche une erreur pour l'extension
            $message = 'L\'extension du fichier est incorrecte !';
        }
    } else {
        // Sinon on affiche une erreur pour le champ vide
        $message = 'Veuillez remplir le formulaire svp !';
    }
}
    
?>
    <!DOCTYPE html>
    <html>
        <!--//permet d'enregistrer les infos rentrer lors de l'inscription d'un nouveau client-->
        <head>
            <title>Enregistrer</title>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <?php
            include 'connexion.php';
            ?>
            <div>
                <p class="text"><br><br>
                    Bonjour <?php
                    echo html_entity_decode($nom);
                    echo " ";
                    ?>
                    </br>
                    </br>
                    Votre inscription a bien été effectuée.
                <p>
                    <input class="btn btn-primary" type="submit" onclick="window.location.href = 'index.php'" value="Retour à l'accueil"/>
                </p>                
                <?php 
                $req = $connection->prepare('INSERT INTO sta_etudiant(nom, prenom, idclasse, idpromotion, email, photo, mdp) VALUES(:nom, :prenom, :classe, :promotion, :mail, :photo, :mdp)');
                $req->execute(array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'classe' => $classe,
                    'promotion' => $promotion,
                    'mail' => $email,
                    'photo' => $photo,
                    'mdp' => $mdph,

                    
                ));
            }
else {
    header ('location: log.php?erreur=Tous les champs doivent être complétés !');
    }
    ?>
    </body>
</html>
