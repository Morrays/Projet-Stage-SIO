<?php
include "header.php";

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
<br>
<h2>Ajouter un contact</h2>
<?php
if (isset($erreur)) {
    echo $erreur;
}
?>
<!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
<div class="d-inline-flex p-2">
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
    <button type="submit" class="btn btn-primary" name="submit"><i
                    class="fas fa-check-square"></i> Valider</button>
    <a class="btn btn-danger" href="addDemande.php?"><i class="fas fa-backspace"></i> Retour</a>
</form>
</div>

<?php include "footer.php"; ?>