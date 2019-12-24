<?php
include "header.php";

if (isset($_REQUEST['submit'])) {

    $siret = $_REQUEST['SIRET'];
    $nom = $_REQUEST['nom'];
    $naf = $_REQUEST['code_NAF'];
    $tel = $_REQUEST['tel'];
    $mail = $_REQUEST['mail'];
    $cp = $_REQUEST['cpville'];
    if (!empty($_REQUEST['SIRET'])AND ! empty($_REQUEST['nom'])AND ! empty($_REQUEST['code_NAF']) AND ! empty($_REQUEST['tel'])AND ! empty($_REQUEST['mail'])AND ! empty($_REQUEST['cpville'])) {
        $insertmbr = $connection->prepare("INSERT INTO sta_entreprise(SIRET, nom, code_NAF, tel, mail, cpville, nb_demande) VALUES(?,?,?,?,?,?,?)");
        $insertmbr->execute(array($siret, $nom, $naf, $tel, $mail, $cp, 0));
        $erreur = "L'entreprise a bien été ajouté";
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
    //header('location: addDemande.php');
}
?>
<div class="container">
    <br>
    <h2>Ajouter un entreprise</h2>
    <a href="https://www.manageo.fr/" target="_blank">Trouver le SIRET et le code NAF de l'entreprise</a>
    <br>
    <a href="https://blog.easyfichiers.com/wp-content/uploads/2014/08/Liste-code-naf-ape.pdf" target="_blank">Trouver la
        division NAF de l'entreprise</a>
    <br>
    <a href="https://public.opendatasoft.com/explore/dataset/correspondance-code-insee-code-postal/table/"
        target="_blank">Trouver le code postal unique</a>
    <br><br>
    <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
    <!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
    <div class="d-inline-flex p-2">
        <form method="GET" action="">
            <div class="form-group">
                <label for="">SIRET</label>
                <input type="text" class="form-control" id="example" name="SIRET" placeholder="SIRET">
            </div>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" id="example" name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="selectNaf">Division NAF</label>
                <br>
                <?php
        $sql = "SELECT * FROM sta_naf order by libelle_NAF asc";
        $q = $connection->query($sql); ?>
                <select name='code_NAF' class="form-control" id="selectNaf">
                    <?php while ($ligne = $q->fetch()) {
            if ($row['code_NAF'] == $ligne[0])
                echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
            else
                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
        } ?>
                </select>
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
                <label for="">Ville</label>
                <br>
                <input name="cpville" id="cpville" type="hidden" placeholder="Code Postal">
                <input name="ville" class="form-control" id="ville" type="text" placeholder="Ville">
            </div>
            <button type="submit" class="btn btn-primary" name="submit"><i
                    class="fas fa-check-square"></i> Valider</button>
            <a class="btn btn-danger" href="addDemande.php?"><i class="fas fa-backspace"></i> Retour</a>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>