<?php 
include 'inc.header.php';

// REQUETE
if (isset($_POST['searchByName'])) {
    $rechercheEntreprise = $_POST['searchByName'];
    $sqlentreprise = "SELECT DISTINCT * FROM sta_entreprise e WHERE e.nom = '".$rechercheEntreprise."'";
} else if(isset($_POST['searchByCp'])){
    $rechercheCp = $_POST['searchByCp'];
    $sqlentreprise = "SELECT DISTINCT * FROM sta_entreprise e WHERE e.cpville = '".$rechercheCp."'";
} else {
    $sqlentreprise = "SELECT DISTINCT * FROM sta_entreprise e ORDER BY e.nom asc";
}
$q = $connection->query($sqlentreprise);
$reponseEntreprises = $q->fetchAll();

if (isset($_GET['suppEntreprise'])){
    $idEntreprise = $_GET['suppEntreprise'];
    $sqldelete = "DELETE FROM sta_entreprise WHERE SIRET=".$idEntreprise;
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
                <form action="#" method="POST" class="inline-form">
                    <div class="form-group">
                        <label for="searchEnt">Example select</label>
                        <select class="form-control" name="searchEnt" id="searchEnt">
                            <option selected disabled value="defaut">-- Choisir un mode de recherche--</option>
                            <option value="nom">Nom</option>
                            <option value="cp">Code postal</option>
                            <option value="naf">Libellé NAF</option>
                        </select>
                    </div>
                    <div id="filterEnt"></div>
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
                                <?php if($userCheck == 'Admin'){?>
                                <th>Supprimer</th>
                                <th>Modifier</th>
                                <?php } ?>
                                <?php if($userCheck == 'Client'){?>
                                <th>Informations</th>
                                <?php } ?>
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
                                <?php if($userCheck == 'Admin'){?>
                                <td><a class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idEntreprise?>" style="color: white"><i
                                            class="fa fa-trash"></i></a></td>
                                <td><a href="entreprise.php?identreprise=<?php echo $idEntreprise; ?>"
                                        class="btn btn-primary" style="color: white"><i class="fa fa-edit"></i></a></td>
                                <?php } ?>
                                <?php if($userCheck == 'Client'){?>
                                <td><a href="entreprise.php?identreprise=<?php echo $idEntreprise; ?>"
                                        class="btn btn-primary" style="color: white"><i class="fas fa-info"></i></a>
                                </td>
                                <?php } ?>
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
<div class="modal fade" id="supp<?php echo $idEntreprise?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
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

<?php include 'inc.footer.php'; ?>