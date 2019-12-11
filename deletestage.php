<?php
session_start();
include('connexion.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Supprimer une période de stage</title>
    </head>
    <body>
        <?php
        $id = $_GET['id'];
        $requete = "DELETE FROM periode WHERE idperiode = '" . $id . "'";
        $req = $connection->exec($requete);
        header('location: stage.php');
        ?>
        <!--//permet de supprimer un client de la base de donnees-->
    </body>
</html>
