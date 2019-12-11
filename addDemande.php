<?php
session_start();
include('connexion.php');

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
        $insertmbr = $connection->prepare("INSERT INTO demande(date_demande, idetat, refus, idetudiant, idperiode, SIRET, idcontact) VALUES(?,?,?,?,?,?,?)");
        $insertmbr->execute(array($date, $idetat, $refus, $idetu, $idperio, $ident, $idcontact));
        $erreur = "La demande de stage a bien été ajouté";
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Ajouter une demande</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="main.js" type="text/javascript"></script>
    </head>

    <body style="margin: 200px;">
        <h2>Nouvelle demande de stage</h2>
        <br>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <!--	//permet de rentrer de nouvelles infos clients et de les enregistrer dans la bdd-->
        <form method="GET" action="">
            <div class="form-group">
                <label for="">Date de la demande</label>
                <input type="date" class="form-control" id="example" name="date_demande" placeholder="Date de la demande">
            </div>
            <div class="form-group">
                <label for="">Etat</label>
                <br>
                <?php
                $sql = "SELECT * FROM etat";
                $q = $connection->query($sql);
                echo "<select name = 'idetat' >";
                while ($ligne = $q->fetch()) {
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
                <input type="text" class="form-control" id="example" name="refus" placeholder="Refus">
            </div>
            <div class="form-group">
                <label for="">Etudiant</label>
                <br>
                <?php
                $sql = "SELECT * FROM etudiant WHERE type <> 0 AND etudiant.idetudiant = " . $_SESSION['code'];
                $q = $connection->query($sql);
                $ligne = $q->fetch();
                echo "<label>" . $ligne[1]."</label>";
                ?> 
                <input type ="hidden" name ="idetudiant" value="<?php echo $ligne[0]; ?>"/>
            </div>
            <div class="form-group">
                <label for="">Periode</label>
                <br>
                <?php
                $sql = "SELECT * FROM periode";
                $q = $connection->query($sql);
                echo "<select name = 'idperiode' >";
                while ($ligne = $q->fetch()) {
                    if ($row['idperiode'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[2] . " " . $ligne[3] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[2] . " au " . $ligne[3] . "</option>";
                }
                echo "</select>";
                ?> 
            </div>
            <div class="form-group">
                <label for="">Entreprise</label>
                <br>
                <?php
                $sql = "SELECT * FROM entreprise";
                $q = $connection->query($sql);
                echo "<select id = 'entreprise' name = 'nomentreprise' onchange='contactlie()' >";
                while ($ligne = $q->fetch()) {
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
                <a class="btn btn-danger" href="addentreprise.php?">Ajouter une entreprise</a>
            </div>
            <div class="form-group">
                <label for="">Contact</label>
                <br>
                <?php
                $sql = "SELECT * FROM contact";
                $q = $connection->query($sql);
                echo "<select name = 'nomcontact' >";
                while ($ligne = $q->fetch()) {
                    if ($row['nom'] == $ligne[0])
                        echo "<option value=" . htmlentities($ligne[0]) . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . htmlentities($ligne[0]) . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?> 
                <a class="btn btn-danger" onClick="addcontact()">Ajouter un contact</a>
            </div>
            <button type="submit" class="btn btn-primary" value="submit" name="submit">Ajouter a la base de donnees</button>
            <a class="btn btn-success" href="recapitulatif.php?">Retour</a>
        </form>
    </body>
</html>