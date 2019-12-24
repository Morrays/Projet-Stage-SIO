<?php
include "header.php";

if (isset($_REQUEST['submit'])) {

    $date = $_REQUEST['date_demande'];
    $idetat = $_REQUEST['idetat'];
    if (isset($_REQUEST['refus'])) {
        $refus = $_REQUEST['refus'];
    } else {
        $refus = NULL;
    }
    $idetu = $_REQUEST['idetudiant'];
    $idperio = $_REQUEST['idperiode'];
    $ident = $_REQUEST['nomentreprise'];
    $idcontact = $_REQUEST['nomcontact'];
    if (!empty($_REQUEST['date_demande'])AND ! empty($_REQUEST['idetat'])AND ! empty($_REQUEST['idetudiant'])AND ! empty($_REQUEST['idperiode'])AND ! empty($_REQUEST['nomentreprise'])AND ! empty($_REQUEST['nomcontact'])) {
        $insertmbr = $connection->prepare("INSERT INTO sta_demande(date_demande, idetat, refus, idetudiant, idperiode, SIRET, idcontact) VALUES(?,?,?,?,?,?,?)");
        $insertmbr->execute(array($date, $idetat, $refus, $idetu, $idperio, $ident, $idcontact));
        $erreur = "La demande de stage a bien été ajouté.";
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<body>
    <div class="container">
        <br>
        <h2>Nouvelle demande de stage</h2>
        <!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
        <div class="d-inline-flex p-2">
            <form method="GET" action="">
                <div class="form-group">
                    <label for="">Date de la demande</label>
                    <input type="date" class="form-control" id="example" name="date_demande"
                        placeholder="Date de la demande">
                </div>
                <div class="form-group">
                    <label for="selectEtat">Etat</label>
                    <br>
                    <?php
                $sql = "SELECT * FROM sta_etat";
                $q = $connection->query($sql); ?>
                    <select name='idetat' class="form-control" id="selectEtat">
                        <?php while ($ligne = $q->fetch()) {
                    if ($row['idetat'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?>
                </div>
                <div class="form-group">
                    <label for="">Refus</label>
                    <input type="text" class="form-control" id="example" name="refus" placeholder="Raison du refus">
                </div>
                <div class="form-group">
                    <?php
                $sql = "SELECT * FROM sta_etudiant WHERE type <> 0 AND sta_etudiant.idetudiant = " . $_SESSION['code'];
                $q = $connection->query($sql);
                $ligne = $q->fetch();
                ?>
                    <input type="hidden" name="idetudiant" value="<?php echo $ligne[0]; ?>" />
                </div>
                <div class="form-group">
                    <label for="selectPeriode">Periode</label>
                    <br>
                    <?php
                $sql = "SELECT * FROM sta_periode where date_fin > now()";
                $q = $connection->query($sql); ?>
                    <select name='idperiode' class="form-control" id="selectPeriode">
                        <?php while ($ligne = $q->fetch()) {
                    if ($row['idperiode'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[2] . " " . $ligne[3] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[2] . " au " . $ligne[3] . "</option>";
                }
                echo "</select>";
                ?>
                </div>
                <div class="form-group">
                    <label for="selectEntreprise">Entreprise <a href="addEntreprise.php" class="btn btn-success"
                            style="color: white"><i class="fas fa-plus"></i></a></label>
                    <br>
                    <?php
                $sql = "SELECT * FROM sta_entreprise";
                $q = $connection->query($sql);?>
                    <select id='entreprise' name='nomentreprise' onchange='contactlie()' class="form-control"
                        id="selectEntreprise">
                        <?php while ($ligne = $q->fetch()) {
                    if ($row['nom'] == $ligne[0]) {
                        ?>
                        <option value="<?php echo $ligne[0]; ?>" selected="selected"><?php echo $ligne[1]; ?></option>
                        <?php
                    } else
                        
                        ?>
                        <option value="<?php echo $ligne[0]; ?>"><?php echo $ligne[1]; ?></option>
                        <?php
                }
                echo "</select>";
                ?>
                        <!-- <a class="btn btn-danger" href="addentreprise.php?">Ajouter une entreprise</a> -->
                </div>
                <div class="form-group">
                    <label for="selectContact">Contact <a onClick="addcontact()" class="btn btn-success"
                            style="color: white"><i class="fas fa-plus"></i></a></label>
                    <br>
                    <?php
                $sql = "SELECT * FROM sta_contact";
                $q = $connection->query($sql); ?>
                    <select name='nomcontact' class="form-control" id="selectContact">
                        <?php while ($ligne = $q->fetch()) {
                    if ($row['nom'] == $ligne[0])
                        echo "<option value=" . htmlentities($ligne[0]) . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . htmlentities($ligne[0]) . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?>
                        <!-- <a class="btn btn-danger" onClick="addcontact()">Ajouter un contact</a> -->
                </div>
                <button type="submit" class="btn btn-primary" value="submit" name="submit"> <i
                    class="fas fa-check-square"></i> Valider</button>
                <a class="btn btn-danger" href="recapitulatif.php?"><i class="fas fa-backspace"></i> Retour</a>
                <?php
            if (isset($erreur)) {
                echo "<div>".$erreur."</div>";
            }
            ?>
            </form>            
        </div>
    </div>
    <?php include "footer.php"; ?>