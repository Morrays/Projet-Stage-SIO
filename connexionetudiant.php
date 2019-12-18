<?php

session_start();
include 'connexion.php';

$codeconnect = htmlspecialchars($_POST['nom']);
$mdpconnect = ($_POST['mdp']);
if (!empty($codeconnect) AND ! empty($mdpconnect)) {
<<<<<<< HEAD
    $requser = $connection->prepare("SELECT * FROM sta_etudiant WHERE nom = ? AND mdp = ?");
=======
    $mdpconnect = password_hash($mdpconnect, MHASH_SHA256);
    $requser = $connection->prepare("SELECT * FROM sta_etudiant WHERE nom = ? AND mdp = ?");
>>>>>>> 3ce744bf80101f573379550ca6a5c37c0e556933
    $requser->execute(array($codeconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
        $userinfo = $requser->fetch();
        $_SESSION['code'] = $userinfo['idetudiant'];
        $_SESSION['nomC'] = $codeconnect;
        unset($_SESSION['erreur']);
        header("Location: index.php");
    } else {
        $_SESSION['erreur'] = "Mauvais code client ou mot de passe !";
        header("Location: log.php");
    }
} else {
    $_SESSION['erreur'] = "Tous les champs doivent etre completes !";
    header("Location: log.php");
}
//permet de se connecter avec son compte au site
?>
<?php

if (isset($erreur)) {
    echo '<font color="red">' . $erreur . "</font>";
}
?>