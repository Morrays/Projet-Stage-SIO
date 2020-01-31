<?php 
include 'header.php';

$sqleleve = "SELECT * FROM sta_etudiant etu,sta_demande d, sta_etat eta, sta_periode p,sta_classe c WHERE etu.idclasse=c.idclasse AND etu.idetudiant = d.idetudiant AND d.idetat =eta.idetat AND p.idperiode = d.idperiode and eta.idetat not in (4) GROUP BY etu.idetudiant ORDER BY etu.nom asc, p.idperiode asc";
$q = $connection->query($sqleleve);
$reponse2 = $q->fetchAll();

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
                                <th>Etat</th>
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
                              $etatStage = $affiche["libelle_etat"];
                            ?>
                            <tr>
                                <td><img src="../images/<?php echo $photoEtudiant?>"> <?php echo $nomEtudiant;?></td>
                                <td><?php echo $classeEtudiant;?></td>
                                <td><?php echo $etatStage;?></td>
                                <td><a class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idPeriode?>" style="color: white"><i
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

<?php include 'footer.php' ?>