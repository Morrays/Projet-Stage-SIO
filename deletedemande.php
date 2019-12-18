<?php
session_start();
include('connexion.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer une demande</title>
    </head>
    <body>
        <?php
        $id = $_GET['id'];
        $requete = "DELETE FROM sta_demande WHERE iddemande = '" . $id . "'";
        $req = $connection->exec($requete);
        header('location: recapitulatif.php');
        ?>
        <!--//permet de supprimer un client de la base de donnees-->
    </body>
</html>

