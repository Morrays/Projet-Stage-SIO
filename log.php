<?php
session_start();
if (ISSET ($_REQUEST["erreur"])){
    echo $_REQUEST["erreur"];
}
include 'connexion.php';
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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
    <head>
        <title>Recherche de stage</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous"/>
        <link rel="stylesheet" type="text/css" href="style.css">
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet"/>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
            <meta charset="utf-8"/>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
            <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css"/>
            <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css"/>
            <script src="main.js" type="text/javascript"></script>
    </head>
    <header>
        <?php
        include 'barrenav.php';
        ?>
    </header>
    <body>
        <!-- Modal // ajout  BootStrap + JS -->   
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Vous devez être connecté pour accéder à la recherche</p>
                        <img src="images/tenor.gif" alt="Tenor qui branche un fil"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal -->
        <br><br><br>
                <div id="conteneurlog">
                        <div id="partieconnect" >
                            <a class="hiddenanchor" id="toregister"></a>
                            <a class="hiddenanchor" id="tologin"></a>
                            <div id="wrapper">
                                <div id="login" class="animate form">
                                    <form  action="connexionetudiant.php" method="POST"> 
                                        <!--						//champs pour se connecter avec son compte, appelle laconnexion.php-->
                                        <br><br><br><br>
                                        <h1>Se connecter</h1>
                                        <br>
                                            <p>
                                                Nom : <input type="text" name="nom" value="" /><br />
                                            </p>
                                            <p>
                                                Mdp : <input type="password" name="mdp" value="" /><br />
                                            </p>
                                            <p>
                                                <input class="button" type="submit" value="Connexion" /> 
                                            </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <div id="register" class="animate form">  
                        <!--//champs pour se créer un compte et l'ajouter a la bdd-->
                        <h1>Créer un compte</h1> 
                        <br>
                            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <fieldset>
                                    <p>
                                        <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Photo :</label>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                        <input name="fichier" type="file" id="fichier_a_uploader" />
                                        <input type="submit" name="submit" value="Uploader" />
                                    </p>
                                </fieldset>
                            </form>
                            <form  action="newetudiant.php" method="GET"> 
                                <p> 
                                    Nom : <input type="text" name="nom" value="" /><br />
                                </p>
                                <p> 
                                    Prénom : <input type="text" name="prenom" value="" /><br />
                                </p>
                                <p>
                                    Classe :  
                                    <?php
                                    $sql = "SELECT * FROM classe WHERE idclasse < 3";
                                    $q = $connection->query($sql);
                                    echo "<select name = 'classe' >";
                                    while ($ligne = $q->fetch()) {
                                        if ($row['libelle_classe'] == $ligne[0])
                                            echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                                        else
                                            echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                                    }
                                    echo "</select>";
                                    ?> 
                                </p>
                                <p>
                                    Promotion :  
                                    <?php
                                    $sql = "SELECT * FROM promotion WHERE id_promotion > 1";
                                    $q = $connection->query($sql);
                                    echo "<select name = 'promotion' >";
                                    while ($ligne = $q->fetch()) {
                                        if ($row['libelle_promotion'] == $ligne[0])
                                            echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                                        else
                                            echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                                    }
                                    echo "</select>";
                                    ?> 
                                </p>
                                <p>
                                    Mail : <input type="text" name="email" value="" /><br />
                                </p>
                                <p>
                                    Mdp : <input type="password" name="mdp" value="" /><br />
                                </p>
                                <input type="submit" name="submit" value="Créer" />
                            </form>
                    </div>
                </div>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"/></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"/></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"/></script>
                    <script type="text/javascript">
                        var op = <?PHP echo (!empty($_GET['err']) ? json_encode($_GET['err']) : '""'); ?>;
                        if (op == 1) {
                            $('#exampleModalCenter').modal('show');
                        }

                    </script>
    </body>
</html>