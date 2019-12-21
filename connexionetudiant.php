<?php
session_start();
include 'connexion.php';

$_SESSION['erreur'] = 'tocard';

$codeconnect = htmlspecialchars($_POST['email']);
$mdpconnect = ($_POST['mdp']);

$requete = $connection->query("SELECT mdp FROM sta_etudiant Where email ='$codeconnect';");
$mdph = $requete->fetch();


if (!empty($codeconnect) AND !empty($mdpconnect) and password_verify($mdpconnect, $mdph['mdp'])) {

    $requser = $connection->prepare("SELECT * FROM sta_etudiant WHERE email = :email;");
    $requser->bindParam(':email', $codeconnect);

    $requser->execute();
    $userexist = $requser->rowCount();
    if ($userexist == 1) {
        $userinfo = $requser->fetch();
        $_SESSION['code'] = $userinfo['idetudiant'];
        $_SESSION['nom'] = $userinfo['nom'];
        $_SESSION['prenom'] = $userinfo['prenom'];
        $_SESSION['mail'] = $codeconnect;
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