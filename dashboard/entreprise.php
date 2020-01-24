<?php 
include 'header.php';
if(isset($_GET["identreprise"]) && $_GET["identreprise"]!="") {
    $identreprise = $_GET["identreprise"];
    $sqlentreprise ="SELECT * FROM sta_entreprise e WHERE e.SIRET =".$identreprise;
}
$q = $connection->query($sqlentreprise);
$affiche = $q->fetch();
$idEntreprise = $affiche['SIRET'];
$nomEntreprise = $affiche['nom'];
$telEntreprise = $affiche['tel'];
$emailEntreprise = $affiche['Mail'];
$cpEntreprise = $affiche['cpville'];

?>

<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
            <li class="breadcrumb-item">Gestion entreprise </li>
            <li class="breadcrumb-item active"><?php echo $nomEntreprise;?> </li>
        </ul>
    </div>
</div>

<section class="">
    <div class="container-fluid">
        <header>
            <h1 class="h3 display"><?php echo $nomEntreprise;?> </h1>
        </header>
        <!-- Contenu -->
        <section class="section-padding">
            <div class="container-fluid">
                <div class="card data-usage">
                    <div class="row d-flex align-items-center">
                        <div class="col-sm-6">
                            <span>Téléphone : <?php echo $telEntreprise;?></span><br>
                            <span>Email : <?php echo $emailEntreprise;?></span><br>
                            <span>CP: <?php echo $cpEntreprise;?></span><br>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</section>

<?php include 'footer.php' ?>