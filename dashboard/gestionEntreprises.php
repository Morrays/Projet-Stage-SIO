<?php 
include 'header.php';

// REQUETE

if (isset($_REQUEST["rechercheEntreprise"])) {        
    $sqlentreprise = "SELECT * FROM sta_entreprise e WHERE e.nom LIKE '%" . $_REQUEST["rechercheEntreprise"] . "%'";
}

if (isset($_POST['rechercheEntreprise'])) {
    $rechercheEntreprise = $_POST['rechercheEntreprise'];
    $sqlentreprise = "SELECT DISTINCT * FROM sta_entreprise e WHERE e.nom LIKE '%".$rechercheEntreprise."%' AND e.nom LIKE '%".$rechercheEntreprise."%' ";
} else {
    $sqlentreprise = "SELECT DISTINCT * FROM sta_entreprise e ORDER BY e.nom asc";
}
$q = $connection->query($sqlentreprise);
$reponseEntreprises = $q->fetchAll();

if (isset($_GET['suppEntreprise'])){
    $idEleve = $_GET['suppEntreprise'];
    $sqldelete = "DELETE FROM sta_entreprise WHERE identreprise=".$idEntreprise;
    $q = $connection->exec($sqldelete);

    echo '<div class="alert alert-danger" role="alert">
    L\'entreprise à été supprimée.
  </div>';
}

?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Gestion entreprises </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
            <h1 class="h3 display">Gestion entreprises </h1>
        </header>
        <div class="card">
            <div class="card-body">
                <form action="#" method="POST" class="form group">
                    <div class="form-group">
                        <label for="recherche" class="sr-only">Rechercher entreprise</label>
                        <input id="recherche" type="text" name="rechercheEntreprise" placeholder="Rechercher entreprise" class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Rechercher" class="mr-3 btn btn-primary">
                    </div>
                </form>                
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Entreprises</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Téléphone</th>
                                <th>Email</th>
                                <th>CP</th>
                                <th>Supprimer</th>
                                <th>Informations</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($reponseEntreprises as $affiche){
                              $idEntreprise = $affiche['SIRET'];
                              $nomEntreprise = $affiche["nom"]; 
                              $telEntreprise = $affiche["tel"]; 
                              $emailEntreprise = $affiche["Mail"]; 
                              $cpEntreprise = $affiche["cpville"]; 
                            ?>
                            <tr>
                                <td><?php echo $nomEntreprise;?></td>
                                <td><?php echo $telEntreprise;?></td>
                                <td><?php echo $emailEntreprise;?></td>
                                <td><?php echo $cpEntreprise;?></td>
                                <td><a class="btn btn-danger" class="btn btn-primary" data-toggle="modal" data-target="#supp<?php echo $idEntreprise?>"style="color: white"><i class="fa fa-trash"></i></a></td>
                                <td><a  href="entreprise.php?identreprise=<?php echo $idEntreprise; ?>" class="btn btn-primary" style="color: white"><i class="fa fa-edit"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>

<!-- Modal -->
<?php foreach($reponseEntreprises as $affiche){
    $idEntreprise = $affiche['SIRET'];
    $nomEntreprise = $affiche["nom"]; 
    $telEntreprise = $affiche["tel"]; 
    $emailEntreprise = $affiche["Mail"]; 
    $cpEntreprise = $affiche["cpville"]; 

?>
<div class="modal fade" id="supp<?php echo $idEntreprise?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Etes vous sur de vouloir supprimer <?php echo $nomEntreprise?> ?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">Close</a>
                <a type="button" class="btn btn-danger" style="color: white"
                    href="?suppEntreprise=<?php echo $idEntreprise?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'footer.php'; ?>