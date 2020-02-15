<?php
include '../inc.connexion.php';

$action = $_POST['action'];

switch ($action) {
    case 'tuteur':
        $idEnt = $_POST['idEnt'];
        $sql = "SELECT * FROM sta_contact WHERE SIRET=".$idEnt;
        $q = $connection->query($sql); 
        ?>
        <label for="selectTuteur">Tuteur</label>
        <br>
        <select name='idContact' class="form-control" id="selectTuteur">
            <?php while ($ligne = $q->fetch()) {
                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
            } ?>
        </select> 
        <?php
    break;

    case 'refus':
        ?>
        <label for="refusDem" class="col-form-label">Raison du refus:</label>
        <input type="text" class="form-control" name="refusDem" id="refusDem">
        <?php
    break;

    case 'searchEnt':
        $valueSearchEnt = $_POST['valueSearchEnt'];
        if($valueSearchEnt == 'nom'){ ?>
            <div class="form-group">
            <label for="searchByName" class="sr-only">Rechercher par nom</label>
            <input id="searchByName" type="text" name="searchByName" placeholder="Nom de l'entreprise"
                class="mr-3 form-control">
            </div>
        <?php } else if ($valueSearchEnt == 'cp') { ?>
            <div class="form-group">
            <label for="searchByCp" class="sr-only">Rechercher par code postal</label>
            <input id="searchByCp" type="text" name="searchByCp" placeholder="Code postal de l'entreprise"
                class="mr-3 form-control">
            </div>
            <?php } else if ($valueSearchEnt == 'naf') { 
                $sql = "SELECT * FROM sta_naf ORDER BY 2 asc";
                $q = $connection->query($sql); ?>
                <div class="form-group">
                <select name='idNaf' class="form-control" id="selectNaf">
                    <?php while ($ligne = $q->fetch()) {
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                    } ?>
                </select> 
                </div>
            <?php }
    break;

    default:
        break;
}
?>

<script>
    $('#searchByName').autocomplete({
        source: 'data/jsonNomEntreprise.php'
    });
</script>