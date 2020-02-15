<?php 
include 'inc.header.php';

// REQUETE
if (isset($_REQUEST['rechercheEleve'])&& $_REQUEST['rechercheEleve']!="") {
    $rechercheEleve = $_POST['rechercheEleve'];
    $sqleleve = "SELECT DISTINCT * FROM sta_etudiant e, sta_classe c WHERE c.idclasse=e.idclasse AND e.idclasse not in (3,4) AND e.nom LIKE '%".$rechercheEleve."%'";
} else {
    $sqleleve = "SELECT DISTINCT * FROM sta_etudiant e, sta_classe c WHERE c.idclasse=e.idclasse AND e.idclasse not in (3,4) ORDER BY e.nom asc";
}
$q = $connection->query($sqleleve);
$reponseEleves = $q->fetchAll();

if (isset($_REQUEST["check"])) {
    foreach($_REQUEST["check"] as $val){
        $sql =('UPDATE sta_etudiant SET idclasse = 4 WHERE ' .$val. ' = idetudiant');
        $q = $connection->prepare($sql);
        $q->execute(array($val));
    }
    echo '<div class="alert alert-success">'.sizeof($_REQUEST["check"]).' étudiant passé en anciens élèves.</div>';
}

if (isset($_GET['suppEleve'])){
    $idEleve = $_GET['suppEleve'];
    $sqldelete = "DELETE FROM sta_etudiant WHERE idetudiant=".$idEleve;
    $q = $connection->exec($sqldelete);

    echo '<div class="alert alert-danger" role="alert">
    L\'etudiant à été supprimé.
  </div>';
}



?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Gestion étudiants </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
            <h1 class="h3 display">Gestion élèves </h1>
        </header>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" class="form-inline">
                    <div class="form-group">
                        <label for="rechercheEtu" class="sr-only">Rechercher par nom</label>
                        <input id="rechercheEtu" type="text" name="rechercheEleve" placeholder="Rechercher par nom"
                            class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Rechercher" class="mr-3 btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Eleves</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <form action="" method="POST">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Classe</th>
                                <th>Supprimer</th>
                                <th>Informations</th>
                                <th><input type="submit" value="Passage anciens élèves" class="btn btn-primary" style="color: white"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach($reponseEleves as $affiche){
                              $idEleve = $affiche['idetudiant'];
                              $nomEleve = $affiche["nom"]; 
                              $prenomEleve = $affiche["prenom"]; 
                              $emailEleve = $affiche["email"]; 
                              $classeEleve = $affiche["libelle_classe"]; 
                            ?>
                            <tr>
                                <td><?php echo $nomEleve;?></td>
                                <td><?php echo $prenomEleve;?></td>
                                <td><?php echo $emailEleve;?></td>
                                <td><?php echo $classeEleve;?></td>
                                <td><a class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idEleve?>" style="color: white"><i
                                            class="fa fa-trash"></i></a></td>
                                <td><a href="eleve.php?ideleve=<?php echo $idEleve; ?>" class="btn btn-primary"
                                        style="color: white"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <div class="i-checks">
                                        <input id="checkboxCustom<?php echo $idEleve?>" name="check[]" type="checkbox"
                                            value="<?php echo $idEleve?>" class="form-control-custom">
                                        <label for="checkboxCustom<?php echo $idEleve?>"></label>
                                    </div>
                                </td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </div>
</section>

<!-- Modal -->
<?php foreach($reponseEleves as $affiche){
    $idEleve = $affiche['idetudiant'];
    $nomEleve = $affiche["nom"]; 
    $prenomEleve = $affiche["prenom"]; 
    $emailEleve = $affiche["email"]; 
    $classeEleve = $affiche["libelle_classe"]; 
?>
<div class="modal fade" id="supp<?php echo $idEleve?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Etes vous sur de vouloir supprimer <?php echo $nomEleve." ".$prenomEleve?> ?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">Close</a>
                <a type="button" class="btn btn-danger" style="color: white"
                    href="?suppEleve=<?php echo $idEleve?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'inc.footer.php' ?>

<script>
    $('#rechercheEtu').autocomplete({
        source: 'data/jsonNomEtudiant.php'
    });
</script>