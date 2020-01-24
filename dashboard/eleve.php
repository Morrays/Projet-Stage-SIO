<?php 
include 'header.php';
if(isset($_GET["ideleve"]) && $_GET["ideleve"]!="") {
    $idetudiant = $_GET["ideleve"];
    $sqleleve ="SELECT * FROM sta_etudiant e, sta_classe c, sta_promotion p WHERE p.id_promotion=e.idpromotion AND c.idclasse=e.idclasse AND e.idetudiant =".$idetudiant;
}
$q = $connection->query($sqleleve);
$affiche = $q->fetch();
$idEtudiant = $affiche['idetudiant'];
$nomEtudiant = $affiche['nom'];
$prenomEtudiant = $affiche['prenom'];
$photoEtudiant = $affiche['photo'];
$emailEtudiant = $affiche['email'];
$classeEtudiant = $affiche['libelle_classe'];
$promotionEtudiant = $affiche['libelle_promotion'];
$attestStage = $affiche['attestStage'];
$accordStage = $affiche['accordStage'];
$eval = $affiche['eval'];

?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Gestion étudiant </li>
            <li class="breadcrumb-item active"><?php echo $nomEtudiant." ".$prenomEtudiant;?> </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
            <h1 class="h3 display"><?php echo $nomEtudiant." ".$prenomEtudiant;?> </h1>
        </header>
        <!-- Contenu -->
        <section class="section-padding">
            <div class="container-fluid">
                <div class="card data-usage">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center justify-content-center">
                                <img class="rounded-circle" height="200" width="200"
                                    src="../images/<?php echo $photoEtudiant;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <span>Email: <?php echo $emailEtudiant;?></span><br>
                            <span>Classe: <?php echo $classeEtudiant;?></span><br>
                            <span>Promotion: <?php echo $promotionEtudiant;?></span><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="statistics">
            <div class="container-fluid">
                <div class="row d-flex">
                    <div class="col-lg-4">
                        <!-- Income-->
                        <div class="card income text-center">
                            <div class="icon"><i class="fas fa-scroll"></i></div>
                            <?php if($attestStage!="") { ?>
                            <img height="auto" width="auto" src="../images/Attestation/<?php echo $attestStage; ?>">
                            <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            <?php } else { ?>
                            <a href="" class="btn btn-primary"><i class="fas fa-upload"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Income-->
                        <div class="card income text-center">
                            <div class="icon"><i class="fas fa-handshake"></i></div>
                            <?php if($accordStage!="") { ?>
                            <img height="auto" width="auto" src="../images/Accord/<?php echo $accordStage; ?>">
                            <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                            <?php } else { ?>
                            <a href="" class="btn btn-primary"><i class="fas fa-upload"></i></a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Income-->
                        <div class="card income text-center">
                            <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                            <?php if($eval!="") { ?>
                            <img height="auto" width="auto" src="../images/eval/<?php echo $eval; ?>">
                            <a href="" class="btn btn-danger"><i class="fa fa-upload"></i></a>
                            <?php } else { ?>
                            <a href="" class="btn btn-primary"><i class="fa fa-upload"></i></a>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
</section>

<?php include 'footer.php' ?>