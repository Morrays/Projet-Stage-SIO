<?php
session_start();
include 'connexion.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion des stages</title>
    <meta charset="utf-8">

    <!-- POLICE ECRITURE -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">    
    <!-- PERSO -->
    <link rel="stylesheet" type="text/css" href="style.css">   

</head>

<body>
    <header>
        <!-- NAVBAR -->
        <center>
            <img src="images/stage.jpg" class="top_img">
        </center>
        <nav class="navbarstyle">
            <ul>
            <?php if (isset($_SESSION['nom'])) { ?>
                <li><a href="stage.php">Stages</a></li>
                <li><a href="rechercheEntreprise.php">Recherche</a></li>                
                <?php if (($_SESSION['nom'] == "ADMIN")) { ?>
                <li><a href="gestioneleve.php">Gestion élèves</a></li>
                <li><a href="tableaurec.php">Tableaux</a></li>
                <?php } else { ?>
                <li><a href="recapitulatif.php">Récapitulatif</a></li>
                <?php } ?>

                <li class="nomCompte">  
                    <a id="profil" href="profil.php"><?php echo $_SESSION['nom'].' '.$_SESSION['prenom']?></a>
                </li>
                <li class="imageCompte">
                <?php
                $sqlphoto = "SELECT photo FROM sta_etudiant WHERE idetudiant = " . $_SESSION['code'];
                $q = $connection->query($sqlphoto);
                $ligne = $q->fetch();
                echo '<div id="pdp">';
                echo "<img src='images/" . $ligne['photo'] . "'>";
                echo "</div>";
                ?>
                </li>
                <li>
                <?php
                if (isset($_SESSION['nom'])) {
                    echo '<a id="deco" href="logout.php">Deconnexion</a>';
                } else {
                    echo '<a id="co" href="log.php">Connexion</a>';
                } ?> 
                </li>
            <?php } else {
                echo '<a id="co" href="log.php">Connexion</a>';
            } ?>                
            </ul>
        </nav>
    </header>