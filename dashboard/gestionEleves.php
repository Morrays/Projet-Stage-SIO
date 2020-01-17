<?php 
include 'header.php';

// REQUETE
if (isset($_POST['rechercheEleve'])) {
    $rechercheEleve = $_POST['rechercheEleve'];
    $sqleleve = "SELECT DISTINCT * FROM sta_etudiant e, sta_classe c WHERE c.idclasse=e.idclasse AND e.idclasse not in (3,4) AND e.nom LIKE '%".$rechercheEleve."%' OR e.prenom LIKE '%".$rechercheEleve."%' ";
} else {
    $sqleleve = "SELECT DISTINCT * FROM sta_etudiant e, sta_classe c WHERE c.idclasse=e.idclasse AND e.idclasse not in (3,4) ORDER BY e.nom asc";
}
$q = $connection->query($sqleleve);
$reponseEleves = $q->fetchAll();
?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Gestion élèves </li>
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
                <form action="#" method="POST" class="form-inline">
                    <div class="form-group">
                        <label for="inlineFormInput" class="sr-only">Rechercher élève</label>
                        <input id="inlineFormInput" type="text" name="rechercheEleve" placeholder="Rechercher élève"
                            class="mr-3 form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Rechercher" class="mr-3 btn btn-primary">
                    </div>
                    <a class="btn btn-primary" style="color: white">Valider les anciens élèves</a>
                </form>                
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Eleves</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Email</th>
                                <th>Classe</th>
                                <th>Supprimer</th>
                                <th>Informations</th>
                                <th>Cocher</th>
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
                                <td><a class="btn btn-danger" style="color: white"><i class="fa fa-trash"></i></a></td>
                                <td><a class="btn btn-primary" style="color: white"><i class="fa fa-edit"></i></a></td>
                                <td>
                                    <div class="i-checks">
                                        <input id="checkboxCustom<?php echo $idEleve?>" type="checkbox" value="<?php echo $idEleve?>"
                                            class="form-control-custom">
                                        <label for="checkboxCustom<?php echo $idEleve?>"></label>
                                    </div>
                                </td>

                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>

<?php include 'footer.php' ?>