<?php
session_start();
include('connexion.php');

$id = $_REQUEST['id'];
if (isset($_REQUEST['submit'])) {

    $id = $_POST['idperiode'];
    $annee = $_POST['annee'];
    $debut = $_POST['date_debut'];
    $fin = $_POST['date_fin'];
    $sql = "UPDATE periode SET idperiode = ?,annee = ?,date_debut = ?,date_fin = ? WHERE idperiode ='" . $id . "'";
    $q = $connection->prepare($sql);
    $q->execute(array($id, $annee, $debut, $fin));

    header('location: stage.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modifier une periode de stage</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body style="margin: 200px;">
        <h2>Modification d'une periode de stage</h2>
        <br>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <?php
        $sql = "SELECT * FROM periode WHERE idperiode ='" . $id . "'";
        $q = $connection->query($sql);
        $row = $q->fetch();
        ?>

        <!--	//champs permettant de modifier les infos d'un client et d'enregistrer les modifs dans la bdd-->
        <form method="POST" action="">
            <div class="form-group">
                <label for="">ID Stage</label>
                <input type="text" class="form-control" id="example" name="idperiode" value=<?php echo $row['idperiode']; ?>>
            </div>
            <div class="form-group">
                <label for="">Année</label>
                <input type="text" class="form-control" id="example" name="annee" value="<?php echo $row['annee']; ?>">
            </div>
            <div class="form-group">
                <label for="">Date de debut (AAAA-MM-JJ)</label>
                <input type="text" class="form-control" id="example" name="date_debut" value="<?php echo $row['date_debut']; ?>">
            </div>
            <div class="form-group">
                <label for="">Date de fin (AAAA-MM-JJ)</label>
                <input type="text" class="form-control" id="example" name="date_fin" value="<?php echo $row['date_fin']; ?>">
            </div>

            <button type="submit" class="btn btn-primary" name="submit">Modifier dans la base de données</button>
            <a class="btn btn-success" href="stage.php?">Retour</a>
        </form>
    </body>
</html>

