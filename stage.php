<?php
include 'header.php';
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
    <form>

        <div class="form-group">
            <label for="selectPromotion">Sélectionner une promotion :</label>
            <br>
            <?php
                $sql = "SELECT * FROM sta_promotion WHERE id_promotion > 1";
                $q = $connection->query($sql); ?>
            <select class="form-control" name='idpromotion' id="selectPromotion">
                <?php while ($ligne = $q->fetch()) {
                    if ($row['idpromotion'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?>
        </div>

        <div class="form-group">
            <label for="selectEtat">Sélectionner un état :</label>
            <br>
            <?php
                $sql = "SELECT * FROM sta_etat WHERE idetat > 1";
                $q = $connection->query($sql);
                ?>
            <select class="form-control" name='idetat' id="selectEtat">
                <?php while ($ligne = $q->fetch()) {
                    if ($row['idetat'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                } ?>
            </select>
        </div>

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
                <table class="table table-bordered">
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
                            if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher") {
                                $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                                $terme = $_GET["termeR"];
                                $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                                $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                            }
                            $reponse = $connection->query('SELECT ent.nom AS nomEnt, etu.nom, d.date_demande, eta.libelle_etat, d.refus, p.date_debut, p.date_fin '
                                    . 'FROM sta_demande d, sta_etudiant etu, sta_entreprise ent, sta_etat eta, sta_periode p '
                                    . 'WHERE etu.idetudiant = d.idetudiant AND ent.SIRET = d.SIRET AND d.idetat =eta.idetat AND p.idperiode = d.idperiode ORDER BY d.date_demande ');

                            while ($donnees = $reponse->fetch()) {
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
                            $reponse->closeCursor();
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