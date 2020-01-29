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
<?php
$sqlcontact ="SELECT DISTINCT * FROM sta_contact c WHERE SIRET =".$identreprise;
$q = $connection->query($sqlcontact);
$reponseEntrepriseContact = $q->fetchAll();


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

<section>
    <div class="container-fluid">
        <header>
            <h1 class="h3 display"><?php echo $nomEntreprise;?> </h1>
        </header>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h4>Informations</h4>
                </div>
                <div class="card-body">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $nomEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $telEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $emailEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Code postal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?php echo $cpEntreprise;?>">
                            </div>
                        </div>
                <div class="form-group">
                    <input type="submit" value="Modifier" class="btn btn-primary">
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</section>




<section class="section-padding">
    <div class="container-fluid">
        <div class="row d-flex align-items-center">
            <?php foreach ($reponseEntrepriseContact as $affiche) {
                                        $idContact = $affiche['idcontact'];
                                        $nomContact = $affiche['nom'];
                                        $prenomContact = $affiche['prenom'];
                                        $telContact = $affiche['tel'];
                                        $mailContact = $affiche['mail'];
                                        $roleContact = $affiche['role'];
                                        $serviceDuContact = $affiche['service'];
                                    ?>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <h4>Contact <?php echo $roleContact;?></h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="nom" class="form-control" value="<?php echo $nomContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="prenom" class="form-control" value="<?php echo $prenomContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="prenom" class="form-control" value="<?php echo $telContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="prenom" class="form-control" value="<?php echo $mailContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Rôle</label>
                                <input type="role" class="form-control" value="<?php echo $roleContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Service</label>
                                <input type="role" class="form-control" value="<?php echo $serviceDuContact;?>">
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Modifier" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php include 'footer.php' ?>