<?php
session_start();
include('connexion.php');

if (isset($_POST['submit'])) {

    $annee = $_POST['annee'];
    $debut = $_POST['date_debut'];
    $fin = $_POST['date_fin'];
    if (!empty($_POST['annee'])AND ! empty($_POST['date_debut'])AND ! empty($_POST['date_fin'])) {
        $insertmbr = $connection->prepare("INSERT INTO periode(annee, date_debut, date_fin) VALUES(?,?,?)");
        $insertmbr->execute(array($annee, $debut, $fin));
        $erreur = "La periode de stage a bien été ajouté";
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter période de stage</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body style="margin: 200px;">
        <h2>Nouvelle période de stage</h2>
        <br>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
        <form method="POST" action="">
            <div class="form-group">
                <label for="">Année</label>
                <input type="text" class="form-control" id="example" name="annee" placeholder="Annee">
            </div>
            <div class="form-group">
                <label for="">Date de début (AAAA-MM-JJ)</label>
                <input type="date" class="form-control" id="example" name="date_debut" placeholder="Debut">
            </div>
            <div class="form-group">
                <label for="">Date de fin (AAAA-MM-JJ)</label>
                <input type="date" class="form-control" id="example" name="date_fin" placeholder="Fin">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter à la base de données</button>
            <a class="btn btn-success" href="infoutil.php?">Retour</a>
        </form>
    </body>
</html>