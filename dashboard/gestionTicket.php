<?php 
include 'header.php';

// REQUETE

$sqlticket2 = "SELECT *,count(id_ticket) as nbticket FROM sta_ticket t, sta_etudiant e WHERE t.id_etudiant=e.idetudiant AND statut not in ('Résolu') ORDER BY t.date_ticket asc";
$q2 = $connection->query($sqlticket2);
$reponse2 = $q2->fetchAll();

if (isset($_GET["dateDebut"]) && isset($_GET["dateFin"])) {
    $dateDebut = $_GET["dateDebut"];
    $dateFin = $_GET["dateFin"];
    $sqlajout = "INSERT INTO sta_periode(date_debut, date_fin) VALUES ('$dateDebut', '$dateFin')";
    echo $sqlajout;
    $connection->exec($sqlajout);
}

if (isset($_GET['suppTicket'])){
    $idTicket = $_GET['suppTicket'];
    $sqldelete = "DELETE FROM sta_ticket WHERE id_ticket=".$idTicket;
    $q = $connection->exec($sqldelete);

    echo '<div class="alert alert-danger" role="alert">La période à été supprimé.</div>';
}

if (isset($_GET['check'])){
    $idTicket = $_GET['check'];
    $sqlupdate = "UPDATE sta_ticket SET statut='Résolu' WHERE id_ticket =".$idTicket;
    $q = $connection->exec($sqlupdate);

    echo '<div class="alert alert-danger" role="alert">Le ticket à été traiter.</div>';
}
?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item active">Gestion tickets </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
        </header>

        <div class="card">
            <div class="card-header">
                <h4>Gestion tickets</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Demandeur</th>
                                <th>Motif</th>
                                <th>Supprimer</th>
                                <th>Traiter</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($nbticket!=0){
                            foreach($reponse2 as $affiche){
                                $idTicket = $affiche['id_ticket'];
                                $nomEtudiant = $affiche['nom']." ".$affiche['prenom'];
                                $photoEtudiant = $affiche['photo'];
                                $motifTicket = $affiche['motif_ticket'];
                                $dateTicket = $affiche['date_ticket'];
                            ?>
                            <tr>
                                <td><?php echo $dateTicket;?></td>
                                <td><img src="../images/<?php echo $photoEtudiant?>"><?php echo $nomEtudiant;?></td>
                                <td><?php echo $motifTicket;?></td>
                                <td><a class="btn btn-danger" data-toggle="modal"
                                        data-target="#supp<?php echo $idTicket?>" style="color: white"><i
                                            class="fa fa-trash"></i></a></td>
                                <td><a class="btn btn-primary" href="?check=<?php echo $idTicket?>"
                                        style="color: white"><i class="fa fa-check"></i></a></td>

                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>

<!-- Modal -->
<?php 
foreach($reponse2 as $affiche){
    $idTicket = $affiche['id_ticket'];
    $nomEtudiant = $affiche['nom']." ".$affiche['prenom'];
    $photoEtudiant = $affiche['photo'];
    $motifTicket = $affiche['motif_ticket'];
    $dateTicket = $affiche['date_ticket'];
?>
<div class="modal fade" id="supp<?php echo $idTicket?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Etes vous sur de vouloir supprimer le ticket ?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">Close</a>
                <a type="button" class="btn btn-danger" style="color: white"
                    href="?suppTicket=<?php echo $idTicket?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php' ?>