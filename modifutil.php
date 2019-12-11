
<?php
session_start();
include('connexion.php');

$id = $_REQUEST['id'];
if (isset($_REQUEST['submit'])) {

    $id = $_REQUEST['id'];
    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom'];
    $idclasse = $_REQUEST['idclasse'];
    $idpromotion = $_REQUEST['idpromotion'];
    $email = $_REQUEST['email'];
    $mdp = $_REQUEST['mdp'];
    $sql = "UPDATE etudiant SET nom = ?,prenom = ?,idclasse = ?,idpromotion = ?,email = ?,mdp = ? WHERE idetudiant ='" . $id . "'";
    $q = $connection->prepare($sql);
    $q->execute(array($nom, $prenom, $idclasse, $idpromotion, $email, $mdp));
    header('location: infoutil.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Modifier vos informations</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
    </head>
    <body style="margin: 200px;">
        <h2>Modification de vos informations</h2>
        <br>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <?php
        $sql = "SELECT * FROM etudiant WHERE idetudiant ='" . $id . "'";
        $q = $connection->query($sql);
        $row = $q->fetch();
        ?>

        <!--	//champs permettant de modifier les infos d'un client et d'enregistrer les modifs dans la bdd-->
        <form method="GET" action="">
            <div class="form-group">
                <input type="hidden" class="form-control" id="example" name="id" value=<?php echo $id; ?>>
            </div>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" id="example" name="nom" value=<?php echo $row['nom']; ?>>
            </div>
            <div class="form-group">
                <label for="">Prenom</label>
                <input type="text" class="form-control" id="example" name="prenom" value="<?php echo $row['prenom']; ?>">
            </div>
            <div class="form-group">
                <label for="">Classe</label>
                <br>
                <?php
                $sql = "SELECT * FROM classe WHERE idclasse < 3  ";  
                $q = $connection->query($sql);               
                echo "<select name = 'idclasse' >";
                while ($ligne = $q->fetch()) {
                    if ($row['idclasse'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?> 
            </div>
            <div class="form-group">
                <label for="">Promotion</label>
                <br>
                <?php
                $sql = "SELECT * FROM promotion WHERE id_promotion > 1";
                $q = $connection->query($sql);
                echo "<select name = 'idpromotion' >";
                while ($ligne = $q->fetch()) {
                    if ($row['idpromotion'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?> 
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="example" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="text" class="form-control" id="example" name="mdp" value="<?php echo $row['mdp']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Modifier dans la base de donnees</button>
            <a class="btn btn-success" href="infoutil.php?">Retour</a>
        </form>
    </body>
</html>