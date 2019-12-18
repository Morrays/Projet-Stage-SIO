<?php
session_start();
include('connexion.php');

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $role = $_POST['role'];
    $service = $_POST['service'];
    $siret = $_REQUEST['SIRET'];
    
    if (!empty($_POST['nom'])AND ! empty($_POST['prenom'])AND ! empty($_POST['tel']) AND ! empty($_POST['mail'])AND ! empty($_POST['role'])AND ! empty($_POST['service'])AND ! empty($_REQUEST['SIRET'])) {
        $insertmbr = $connection->prepare("INSERT INTO sta_contact(nom, prenom, tel, mail, role, service, SIRET) VALUES(?,?,?,?,?,?,?)");
        $insertmbr->execute(array($nom, $prenom, $tel, $mail, $role, $service, $siret));
        $erreur = "Le contact a bien été ajouté";
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter contact</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css">
        <script src="main.js" type="text/javascript"></script>
    </head>
    <body style="margin: 200px;">
        <h2>Nouveau contact</h2>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
        <form method="POST" action="">
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" id="example" name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="">Prenom</label>
                <input type="text" class="form-control" id="example" name="prenom" placeholder="Prenom">
            </div>
            <div class="form-group">
                <label for="">Téléphone</label>
                <input type="text" class="form-control" id="example" name="tel" placeholder="Telephone">
            </div>
            <div class="form-group">
                <label for="">Mail</label>
                <input type="text" class="form-control" id="example" name="mail" placeholder="Mail">
            </div>
            <div class="form-group">
                <label for="">Rôle</label>
                <input type="text" class="form-control" id="example" name="role" placeholder="Role">
            </div>
            <div class="form-group">
                <label for="">Service</label>
                <input type="text" class="form-control" id="example" name="service" placeholder="Service">
            </div>
            <div class="form-group">
                <label for="">Entreprise</label>
                <br>
                <?php
                $sql = "SELECT * FROM sta_entreprise WHERE SIRET = '".$_REQUEST['SIRET']."'";
                $q = $connection->query($sql);
                $ligne = $q->fetch();
                echo $ligne ['nom'];
                ?>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Ajouter à la base de données</button>
            <a class="btn btn-success" href="addDemande.php?">Retour</a>
        </form>
    </body>
</html>
