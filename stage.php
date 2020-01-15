<?php
include 'header.php';

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
    <div class="row">
        <br>
        <h2>Périodes de stages</h2>
        <p>
    </div>
    <p>
        <br>
        <div class="row">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="annee">Année</th>
                            <th data-column-id="datedebut">Date Début (AAAA-MM-JJ)</th>
                            <th data-column-id="datefin">Date Fin (AAAA-MM-JJ)</th>
                    </thead>
                    <tbody>
                        <?php
                        $test = '0';

                        $reponse = $connection->query('SELECT * FROM sta_periode');

                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                               <td>' . $donnees['idperiode'] . '</td>
                               <td>' . $donnees['annee'] . '</td>
                               <td>' . $donnees['date_debut'] . '</td>
                               <td>' . $donnees['date_fin'] . '</td>';
                            echo $don;
//                            echo '<td>';
//                            echo '<a class="btn btn-success" href="modifstage.php?id=' . $donnees['idperiode'] . '">Modifier</a>'; // un autre td pour le bouton d'update
//                            echo '</td>
//                                <p>';
//                            echo'<td>';
//                            echo '<a class="btn btn-danger" href="deletestage.php?id=' . $donnees['idperiode'] . ' ">Supprimer</a>'; // un autre td pour le bouton de suppression
//                            echo '</td>
//                                <p>';
                            echo '</tr>
                                <p></tr>'
                            ;
                        }
                        $reponse->closeCursor();
                        $_SESSION['deco'] = '1';
//                        echo '<a class="btn btn-success" href="addStage.php?">Ajouter une periode de stage</a>';
                        ?>
                    </tbody>
                </table>
        </div>
        <p>
</div>

<div class="row d-flex justify-content-center"">
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

        <input type="submit" value="Rechercher" class="btn btn-primary">

    </form>
</div>



<div class="container">
    <br><br><br>
    <div class="row">
        <br />
        <h2>Toutes les demandes effectuées</h2>
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
</body>

</html>