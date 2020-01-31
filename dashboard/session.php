<?php
session_start();
include 'connexion.php';

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
        $_SESSION['idpromo'] = $userinfo['idpromotion'];
        $_SESSION['mail'] = $codeconnect;
        $_SESSION['photo'] = $userinfo['photo'];
        $_SESSION['idclasse'] = $userinfo['idclasse'];
        unset($_SESSION['erreur']);
        header("Location: index.php");
    } else {
        header("Location: login.php");
    }
} else {
    header("Location: login.php");
}
//permet de se connecter avec son compte au site
?>