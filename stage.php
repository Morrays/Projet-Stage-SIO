<?php
include 'header.php';

if (isset($_REQUEST["searchNom"])) {        
    $sql = "SELECT * FROM sta_entreprise WHERE nomEnt LIKE '%" . $_REQUEST["searchNom"] . "%'";
}

if (isset($_REQUEST["searchNomEtudiant"])) {        
    $sql = "SELECT * FROM sta_etudiant WHERE nom LIKE '%" . $_REQUEST["searchNomEtudiant"] . "%'";
}

if (isset($_GET['idpromotion']) && (isset($_GET['idetat']))){
    $idpromo = $_GET['idpromotion'];
    $idetat = $_GET['idetat'];
    $sql = 'SELECT ent.nom AS nomEnt, etu.nom, d.date_demande, eta.libelle_etat, d.refus, p.date_debut, p.date_fin, prom.libelle_promotion FROM sta_demande d, sta_etudiant etu, sta_entreprise ent, sta_etat eta, sta_periode p, sta_promotion prom WHERE prom.id_promotion=etu.idpromotion and etu.idetudiant = d.idetudiant AND ent.SIRET = d.SIRET AND d.idetat =eta.idetat AND p.idperiode = d.idperiode and prom.id_promotion='.$idpromo.' AND eta.idetat='.$idetat.' ORDER BY d.date_demande';
} else {
    $sql = 'SELECT ent.nom AS nomEnt, etu.nom, d.date_demande, eta.libelle_etat, d.refus, p.date_debut, p.date_fin FROM sta_demande d, sta_etudiant etu, sta_entreprise ent, sta_etat eta, sta_periode p WHERE etu.idetudiant = d.idetudiant AND ent.SIRET = d.SIRET AND d.idetat =eta.idetat AND p.idperiode = d.idperiode ORDER BY d.date_demande ';
}
$reponse1 = $connection->query($sql);
?>
<div class="container">
    <br><br><br>
<div class="row d-flex justify-content-center">
    <form action="" method="get">

        <div class="form-group">
            <label for="selectPromotion">Sélectionner une promotion :</label>
            <br>
            <?php
                $sql = "SELECT * FROM sta_promotion WHERE id_promotion > 1";
                $q = $connection->query($sql); ?>
            <select class="form-control" name='idpromotion' id="selectPromotion">
                <?php while ($ligne = $q->fetch()) { ?>
                        <option value="<?php echo $ligne[0] ?>" <?php if(isset($_GET['idpromotion']) && $ligne[0] == $_GET['idpromotion']){echo 'selected'; }?>><?php echo $ligne[1] ?></option>
                    <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="selectEtat">Sélectionner un état :</label>
            <br>
            <?php
                $sql = "SELECT * FROM sta_etat WHERE idetat > 1";
                $q = $connection->query($sql);
                ?>
            <select class="form-control" name='idetat' id="selectEtat">
                <?php while ($ligne = $q->fetch()) { ?>
                    <option value="<?php echo $ligne[0] ?>" <?php if(isset($_GET['idetat']) && $ligne[0] == $_GET['idetat']){echo 'selected'; }?>><?php echo $ligne[1] ?></option>
                <?php } ?>
                </select>     
        </div>
        <input type="text" class="form-control" id="recherche" placeholder="Recherche entreprise..." name="searchNom">
        <br>
        <input type="text" class="form-control" id="rechercheEtu" placeholder="Recherche nom étudiant..." name="searchNomEtudiant">
        <br>
        <input type="submit" value="Rechercher" class="btn btn-primary">
    </form>
</div>



<div class="container">
    <br><br><br>
    <div class="row">
        <br />
        <h2>Demandes effectuées</h2>
        <p>
    </div>
    <p>
        <br />
        <div class="row">
            <tbody>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">Entreprise</th>
                            <th data-column-id="datedemande">Date de la demande</th>
                            <th data-column-id="raisonrefus">Etat</th>
                            <th data-column-id="datedemande">Raison du refus</th>
                            <th data-column-id="raisonrefus">Etudiant</th>
                            <th data-column-id="raisonrefus">Periode</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['nom'])) {                            

                            while ($donnees = $reponse1->fetch()) {
                                $don = '<tr>
                               <td>' . $donnees['nomEnt'] . '</td>
                               <td>' . $donnees['date_demande'] . '</td>
                               <td>' . $donnees['libelle_etat'] . '</td>
                               <td>' . $donnees['refus'] . '</td>  
                               <td>' . $donnees['nom'] . '</td>
                               <td>' . $donnees['date_debut'].' / '.$donnees['date_fin'] . '</td>';

                                echo $don;
//                                    echo '<td>';
//                                    echo '<a class="btn btn-success" href="modifdemande.php?id=' . $donnees['iddemande'] . '">Modifier</a>'; // un autre td pour le bouton d'update
//                                    echo '</td>
//                                <p>';
//                                    echo'<td>';
//                                    echo '<a class="btn btn-danger" href="deletedemande.php?id=' . $donnees['iddemande'] . ' ">Supprimer</a>'; // un autre td pour le bouton de suppression
//                                    echo '</td>
//                                <p>';
                                echo '</tr>
                                <p></tr>'
                                ;
                            }
                            $reponse1->closeCursor();
                            $_SESSION['deco'] = '1';
//                                echo '<a class="btn btn-success" href="addDemande.php?">Ajouter une demande de stage</a>';
                            ?>
                    </tbody>
                </table>
                <?php
                } else {
                    header("Location: log.php?err=1");
                }
                ?>
        </div>
        <p>
</div>
<?php include "footer.php";     ?>