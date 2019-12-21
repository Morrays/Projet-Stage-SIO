<?php
session_start();
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion des stages</title>
    <meta charset="utf-8">
    
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- PERSO -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="main.js" type="text/javascript"></script>

</head>

<body>
    <header>
        <!-- NAVBAR -->
        <center>
            <img src="images/stage.jpg" class="top_img">
        </center>
        <nav>
            <ul>
                <li><a href="stage.php">Stages</a></li>
                <li><a href="rechercheentreprise.php">Recherche</a></li>
                <?php if (isset($_SESSION['nomC'])) {
                if (($_SESSION['nomC'] == "ADMIN")) { ?>
                <li><a href="gestioneleve.php">Gestion élèves</a></li>
                <li><a href="tableaurec.php">Tableaux</a></li>
                <?php } else { ?>
                <li><a href="recapitulatif.php">Récapitulatif</a></li>
                <?php } } ?>

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