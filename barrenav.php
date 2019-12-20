
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="style.css">
<div id="top_img">
</div>
<!--//barre de navigation du site-->
<img src="images/stage.jpg" alt=""/>
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
            <li><a href="stage.php">Stages</a></li><!--
        --><li><a href="rechercheentreprise.php">Recherche</a></li><!--
        --><li>
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
                $sqlphoto = "SELECT photo FROM sta_etudiant WHERE idetudiant = " . $_SESSION['code'];
                $q = $connection->query($sqlphoto);
                $ligne = $q->fetch();
                echo "<img src='images/membres" . $ligne['photo'] . "'>";
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
