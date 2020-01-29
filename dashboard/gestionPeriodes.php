<?php 
include 'header.php';

// REQUETE

$sqlperiode = "SELECT DISTINCT * FROM sta_periode p ORDER BY p.date_debut desc";
$q = $connection->query($sqlperiode);
$reponse = $q->fetchAll();

if (isset($_GET["dateDebut"]) && isset($_GET["dateFin"])) {
    $dateDebut = $_GET["dateDebut"];
    $dateFin = $_GET["dateFin"];
    $sqlajout = "INSERT INTO sta_periode(date_debut, date_fin) VALUES ('$dateDebut', '$dateFin')";
    echo $sqlajout;
    $connection->exec($sqlajout);
}

if (isset($_GET['suppPeriode'])){
    $idPeriode = $_GET['suppPeriode'];
    $sqldelete = "DELETE FROM sta_periode WHERE idperiode=".$idPeriode;
    $q = $connection->exec($sqldelete);

    echo '<div class="alert alert-danger" role="alert">La période à été supprimé.</div>';
}
?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Gestion périodes </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
            <h1 class="h3 display">Gestion périodes </h1>
        </header>

        <div class="card">
            <div class="card-header">
                <h4>Ajouter périodes <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                        style="color: white"><i class="fas fa-plus"></i></a></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Année</th>
                                <th>Date début</th>
                                <th>Date Fin</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($reponse as $affiche){
                              $idPeriode = $affiche['idperiode'];
                              $anneePeriode = $affiche['annee'];
                              $debutPeriode = $affiche["date_debut"]; 
                              $finPeriode = $affiche["date_fin"];
                            ?>
                            <tr>
                                <td><?php echo $anneePeriode;?></td>
                                <td><?php echo $debutPeriode;?></td>
                                <td><?php echo $finPeriode;?></td>
                                <td><a class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idPeriode?>" style="color: white"><i
                                            class="fa fa-trash"></i></a></td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>

<!-- Modal -->
<?php foreach($reponse as $affiche){
    $idPeriode = $affiche['idperiode'];
    $dateDebut1 = $affiche['date_debut'];
    $dateFin1 = $affiche['date_fin'];
?>
<div class="modal fade" id="supp<?php echo $idPeriode?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Etes vous sur de vouloir supprimer la période du <?php echo $dateDebut1." au ".$dateFin1?> ?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">Close</a>
                <a type="button" class="btn btn-danger" style="color: white"
                    href="?suppPeriode=<?php echo $idPeriode?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter une période de stage</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date début:</label>
            <input type="date" class="form-control" name="dateDebut" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Date fin:</label>
            <input type="date" class="form-control" name="dateFin" id="recipient-name">
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

<?php include 'footer.php' ?>