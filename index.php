<?php 
include 'inc.header.php';

$sqlstagesio1 = "SELECT count(etu.idetudiant) as stagesio1 FROM sta_etudiant etu,sta_classe c,sta_demande d where d.idetudiant=etu.idetudiant AND etu.idclasse=c.idclasse AND etu.idclasse=1 AND etu.idclasse not in (3,4) AND d.idetat=4 ";
$q10 = $connection->query($sqlstagesio1);
$reponse10 = $q10->fetch();
$nbNoStageSio1 = $reponse10['stagesio1'];

$sqlstagesio2 = "SELECT count(etu.idetudiant) as stagesio2 FROM sta_etudiant etu,sta_classe c,sta_demande d where d.idetudiant=etu.idetudiant AND etu.idclasse=c.idclasse AND etu.idclasse=2 AND etu.idclasse not in (3,4) AND d.idetat=4 ";
$q20 = $connection->query($sqlstagesio2);
$reponse20 = $q20->fetch();
$nbNoStageSio2 = $reponse20['stagesio2'];

$sqlsio1 = "SELECT count(idetudiant) as nbsio1 FROM sta_etudiant e,sta_classe c where e.idclasse=c.idclasse AND e.idclasse=1";
$q11 = $connection->query($sqlsio1);
$reponse11 = $q11->fetch();
$nbsio1 = $reponse11['nbsio1'];

$sqlsio2 = "SELECT count(idetudiant) as nbsio2 FROM sta_etudiant e,sta_classe c where e.idclasse=c.idclasse AND e.idclasse=2";
$q22 = $connection->query($sqlsio2);
$reponse22 = $q22->fetch();
$nbsio2 = $reponse22['nbsio2'];
?>

<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="name"><strong class="text-uppercase">SIO1</strong>
                        <div class="count-number"><?php echo $nbNoStageSio1."/".$nbsio1;?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="name"><strong class="text-uppercase">SIO2</strong>
                        <div class="count-number"><?php echo $nbNoStageSio2."/".$nbsio2;?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
if ($userCheck == 'Admin') {
    $sqleleve = "SELECT * FROM sta_etudiant etu, sta_classe c WHERE etu.idclasse=c.idclasse AND ((idetudiant not in (SELECT idetudiant FROM sta_demande)) OR ( idetudiant in (SELECT idetudiant FROM sta_demande WHERE idetat <> 4))) AND etu.idclasse not in (3,4) ORDER BY etu.idclasse desc,etu.nom asc";
    $q = $connection->query($sqleleve);
    $reponse2 = $q->fetchAll();
?>
<section class="">
    <div class="container-fluid">
        <header>
        </header>

        <div class="card">
            <div class="card-header">
                <h4>Etudiants sans stage</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Etudiant</th>
                                <th>Classe</th>
                                <th>Rappel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($reponse2 as $affiche){
                              $idEtudiant = $affiche['idetudiant'];
                              $nomEtudiant = $affiche['nom']." ".$affiche['prenom'];
                              $photoEtudiant = $affiche["photo"]; 
                              $classeEtudiant = $affiche["libelle_classe"];
                            ?>
                            <tr>
                                <td><img width="100" src="img/avatar/<?php echo $photoEtudiant?>"> <?php echo $nomEtudiant;?></td>
                                <td><?php echo $classeEtudiant;?></td>
                                <td><a class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idEtudiant?>" style="color: white"><i
                                            class="fas fa-bell"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
<?php } ?>

<?php
if ($userCheck == 'Client') {
    $sqlrecherche = "SELECT * FROM sta_demande d, sta_etudiant etu, sta_etat eta, sta_entreprise ent, sta_periode p WHERE p.idperiode=d.idperiode AND ent.SIRET=d.SIRET AND etu.idetudiant = d.idetudiant AND d.idetat =eta.idetat AND etu.idetudiant =".$_SESSION['code'];
    $qq = $connection->query($sqlrecherche);
    $reponse3 = $qq->fetchAll();
?>
<section class="">
    <div class="container-fluid">
        <div class="card-header">
            <h4>Historique des recherches <a data-toggle="modal" data-target="#ajoutDemande" class="btn btn-primary"
                    style="color: white"><i class="fas fa-plus"></i></a></h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Entreprise</th>
                                <th>Date demande</th>
                                <th>Etat</th>
                                <th>Raison refus</th>
                                <th>Période</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($reponse3 as $affiche){
                                $nomEntreprise = $affiche["nom"]; 
                                $dateDemande = $affiche["date_demande"];
                                $periodeStage = $affiche["date_debut"]." au ".$affiche["date_fin"];
                                $etatStage = $affiche["libelle_etat"];
                                $raisonRefus = $affiche["refus"];
                            ?>
                            <tr>
                                <td><?php echo $nomEntreprise;?></td>
                                <td><?php echo $dateDemande;?></td>
                                <td><?php echo $etatStage;?></td>
                                <td><?php echo $raisonRefus;?></td>
                                <td><?php echo $periodeStage;?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ajoutDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une demande de stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Date de la demande:</label>
                        <input type="date" class="form-control" name="dateDemande" id="recipient-name">
                    </div>  
                    <div class="form-group">
                        <label for="recipient-refus" class="col-form-label">Entreprise:</label>
                        <input type="text" class="form-control" name="siretEntreprise" id="recipient-refus">
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
                        } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-refus" class="col-form-label">Refus:</label>
                        <input type="text" class="form-control" name="dateFin" id="recipient-refus">
                    </div>
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'inc.footer.php' ?>