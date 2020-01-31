<?php 
include 'inc.header.php';
if(isset($_GET["identreprise"]) && $_GET["identreprise"]!="") {
    $identreprise = $_GET["identreprise"];
    $sqlentreprise ="SELECT * FROM sta_entreprise e WHERE e.SIRET =".$identreprise;

$q = $connection->query($sqlentreprise);
$affiche = $q->fetch();
$idEntreprise = $affiche['SIRET'];
$nomEntreprise = $affiche['nom'];
$nafEntreprise = $affiche['code_NAF'];
$telEntreprise = $affiche['tel'];
$emailEntreprise = $affiche['Mail'];
$cpEntreprise = $affiche['cpville'];
}

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
                    <form class="form-horizontal" method="GET">
                    <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nomEntreprise" value="<?php echo $nomEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Code NAF</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"name="nafEntreprise" value="<?php echo $nafEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Téléphone</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="telEntreprise" value="<?php echo $telEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="emailEntreprise"value="<?php echo $emailEntreprise;?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 form-control-label">Code postal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cpEntreprise" value="<?php echo $cpEntreprise;?>">
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
                        <form method="GET">
                            <div class="form-group">
                                <label>Nom</label>
                                <input type="text" name="nomContact" class="form-control" name="nomContact" value="<?php echo $nomContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Prénom</label>
                                <input type="text" name="prenomContact" class="form-control" name="prenomContact" value="<?php echo $prenomContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Téléphone</label>
                                <input type="text" name="telContact"class="form-control" value="<?php echo $telContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="mailContact"class="form-control" value="<?php echo $mailContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Rôle</label>
                                <input type="text" name="roleContact"class="form-control" value="<?php echo $roleContact;?>">
                            </div>
                            <div class="form-group">
                                <label>Service</label>
                                <input type="text" name="serviceduContact "class="form-control" value="<?php echo $serviceDuContact;?>">
                            </div>
                            <div class="form-group">
                                <input type="submit"  value="Modifier" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<?php
if (isset($_GET['modifierEntreprise'])){
    $idEntreprise = $_GET['modifierEntreprise'];
    $sqlupdateEntreprise = "UPDATE sta_entreprise SET  nom = '.$nomEntreprise.' code_NAF ='.$nafEntreprise.' tel=.'$telEntreprise.' mail='.$emailEntreprise.' cpville='.$cpEntreprise.' WHERE SIRET=".$idEntreprise;
    $q = $connection->exec($sqlupdateEntreprise);

    echo '<div class="alert alert-danger" role="alert">  
    L\'entreprise a été modifiée.
  </div>';
}
?>

<?php
if (isset($_GET['modifierContact'])){
    $idContact = $_GET['modifierContact'];
    $sqlupdateContact = "UPDATE sta_contact SET  nom = '.$nomContact.' prenom ='.$prenomContact.' tel=.'$telContact.' mail='.$mailContact.' role='.$roleContact.' service='.$serviceDuContact.'WHERE id=".$idContact;
    $q = $connection->exec($sqlupdateContact);

    echo '<div class="alert alert-danger" role="alert">  
    Le contact a été modifié.
  </div>';
}
?>

<?php include 'inc.footer.php' ?>