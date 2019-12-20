<?php
session_start();
include 'connexion.php';
?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Gestion des stages</title>

    <!-- CSS PERSO -->
    <link rel="stylesheet" type="text/css" href="style.css">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">

    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

</head>

<header>
    <!-- NAVBAR -->
    <center>
    <img src="images/stage.jpg" class="top_img">
    </center>
    <nav>
        <ul>
            <li>
                <?php
            if (isset($_SESSION['nomC'])) {
                if (($_SESSION['nomC'] != "ADMIN")) {
                } else {
                    echo ' <a href="gestioneleve.php">Gestion élèves</a>';
                }
            }
            ?>
            </li>
            <li><a href="stage.php">Stages</a></li>
            <!--
        -->
            <li><a href="rechercheentreprise.php">Recherche</a></li>
            <!--
        -->
            <li>
                <?php
            if (isset($_SESSION['nomC'])) {
                if (($_SESSION['nomC'] != "ADMIN")) {
                    echo '<a href="recapitulatif.php">Récapitulatif</a>';
                } else {
                    echo ' <a href="tableaurec.php">Tableaux</a>';
                }
            }
            ?>
            </li>
            <li class="nomCompte">
                <?php
            include('connexion.php');
            if (isset($_SESSION['nomC'])) {        
                echo '<a id="profil" href="infoutil.php">'. $_SESSION['nomC'] .'</a>';
                $sqlphoto = "SELECT photo FROM sta_etudiant WHERE idetudiant = " . $_SESSION['code'];
                $q = $connection->query($sqlphoto);
                $ligne = $q->fetch();
            }
            ?>
            </li>
            <li class="imageCompte">
                <?php
            include('connexion.php');
            if (isset($_SESSION['nomC'])) {
                echo '<div id="imageopt">';
                echo "<img src='images/" . $ligne['photo'] . "'>";
                echo "</div>";
            }
            ?>
            </li>
            <li>
                <?php
            if (isset($_SESSION['nomC'])) {
                echo '<a id="deco" href="logout.php">Deconnexion</a>';
            } else {
                echo '<a id="co" href="log.php">Connexion</a>';
            }
            ?>
            </li>
        </ul>
    </nav>
</header>