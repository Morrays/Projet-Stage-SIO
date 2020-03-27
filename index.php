<?php 
include 'inc.header.php';

if (isset($_GET['suppDemande'])){
    $idDemande = $_GET['suppDemande'];
    $sqldelete = "DELETE FROM sta_demande WHERE iddemande=".$idDemande;
    $connection->exec($sqldelete);

    echo '<div class="alert alert-danger">La demande de stage à été supprimé.</div>';
}

if ($userCheck == 'Admin') {
?>

<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row">
            <!-- Count item widget-->
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="name"><strong class="text-uppercase">SIO1</strong>
                        <div class="count-number"><?php echo getNbStagesSio1()."/".getNbElevesSio1();?></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-md-4 col-6">
                <div class="wrapper count-title d-flex">
                    <div class="icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="name"><strong class="text-uppercase">SIO2</strong>
                        <div class="count-number"><?php echo getNbStagesSio2()."/".getNbElevesSio2();?></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="">
    <div class="container-fluid">
        <header>
        </header>

        <div class="card">
            <div class="card-header">
                <h4>Etudiants sans stage</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Etudiant</th>
                                <th>Classe</th>
                                <th>Rappel</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                             
                            foreach(getEtudiantSansStage() as $affiche){
                              $idEtudiant = $affiche['idetudiant'];
                              $nomEtudiant = $affiche['nom']." ".$affiche['prenom'];
                              $photoEtudiant = $affiche["photo"]; 
                              $classeEtudiant = $affiche["libelle_classe"];
                            ?>
                            <tr>
                                <td><img width="100" src="img/avatar/<?php echo $photoEtudiant?>">
                                    <?php echo $nomEtudiant;?></td>
                                <td><?php echo $classeEtudiant;?></td>
                                <td><a class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idEtudiant?>" style="color: white"><i
                                            class="fas fa-bell"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</section>
<?php } ?>

<?php
if ($userCheck == 'Client') {
    // Ajout contact
    if (isset($_REQUEST['nomContact']) && isset($_REQUEST['prenomContact']) && isset($_REQUEST['idEnt'])) {        
        $sqlAddContact ="INSERT INTO sta_contact(nom, prenom, tel, mail, role, service, SIRET) VALUES ('".$_REQUEST['nomContact']."','".$_REQUEST['prenomContact']."','".$_REQUEST['telContact']."','".$_REQUEST['mailContact']."','".$_REQUEST['roleContact']."','".$_REQUEST['serviceContact']."','".$_REQUEST['idEnt']."'  )";
        $connection->exec($sqlAddContact);

        echo "<div class='alert alert-success'>Le tuteur ".$_REQUEST['nomContact']." ".$_REQUEST['prenomContact']." à bien été crée.</div>";
    }

    // Ajout demande de stage
    if (isset($_REQUEST['dateDem']) && isset($_REQUEST['idperiode']) && isset($_REQUEST['idEnt']) && isset($_REQUEST['idContact']) && isset($_REQUEST['idetat'])) {
        if (isset($_REQUEST['refusDem'])) {
            $refus = $_REQUEST['refusDem'];
        } else {
            $refus = "";
        }
        $sqlAddDem ="INSERT INTO sta_demande(date_demande, refus, idetudiant, idetat, SIRET, idcontact, idperiode) VALUES ('".$_REQUEST['dateDem']."','".$refus."','".$_SESSION['code']."','".$_REQUEST['idetat']."','".$_REQUEST['idEnt']."','".$_REQUEST['idContact']."','".$_REQUEST['idperiode']."')";
        $connection->exec($sqlAddDem); 
        
        echo "<div class='alert alert-success'>Nouvelle demande de stage ajouté.</div>";
    }

    // Ajout entreprise
    if (isset($_REQUEST['siretEnt']) && isset($_REQUEST['nomEnt']) && isset($_REQUEST['nafEnt']) && isset($_REQUEST['telEnt']) && isset($_REQUEST['mailEnt']) && isset($_REQUEST['cpEnt'])) {
        
        $sqlAddEnt ="INSERT INTO sta_entreprise(SIRET, nom, code_NAF, tel, Mail, cpville) VALUES ('".$_REQUEST['siretEnt']."','".$_REQUEST['nomEnt']."','".$_REQUEST['nafEnt']."','".$_REQUEST['telEnt']."','".$_REQUEST['mailEnt']."','".$_REQUEST['cpEnt']."')";
        $connection->exec($sqlAddEnt);    
        
        echo "<div class='alert alert-success'>L'entreprise ".$_REQUEST['nomEnt']." à bien été crée.</div>";
    }
?>
<br>
<section class="">
    <div class="container-fluid">
        <div class="card-header">
            <h4>Historique des recherches
                <a data-toggle="modal" data-target="#ajoutDemande" class="btn btn-primary" style="color: white"><i
                        class="fas fa-plus"></i> Nouvelle recherche</a>
                <a data-toggle="modal" data-target="#ajoutEntreprise" class="btn btn-primary" style="color: white"><i
                        class="fas fa-plus"></i> Nouvelle entreprise</a>
                <a data-toggle="modal" data-target="#ajoutContact" class="btn btn-primary" style="color: white"><i
                        class="fas fa-plus"></i> Nouveau
                    tuteur</a>
            </h4>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Entreprise</th>
                                <th>Date demande</th>
                                <th>Etat</th>
                                <th>Raison refus</th>
                                <th>Période</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach(getHistoriqueStage() as $affiche){
                                $idDemande = $affiche['iddemande'];
                                $nomEntreprise = $affiche["nom"]; 
                                $dateDemande = $affiche["date_demande"];
                                $periodeStage = $affiche["date_debut"]." au ".$affiche["date_fin"];
                                $etatStage = $affiche["libelle_etat"];
                                $raisonRefus = $affiche["refus"];
                            ?>
                            <tr>
                                <td><?php echo $nomEntreprise;?></td>
                                <td><?php echo $dateDemande;?></td>
                                <td><?php echo $etatStage;?></td>
                                <td><?php echo $raisonRefus;?></td>
                                <td><?php echo $periodeStage;?></td>
                                <td><a class="btn btn-danger" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supp<?php echo $idDemande?>" style="color: white"><i
                                            class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="ajoutDemande" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une demande de stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="dateDem" class="col-form-label">Date de la demande:</label>
                        <input type="date" class="form-control" name="dateDem" id="dateDem">
                    </div>
                    <div class="form-group">
                        <label for="selectPeriode">Période de stage</label>
                        <br>
                        <select name='idperiode' class="form-control" id="selectPeriode">
                            <?php foreach(getFuturPeriode() as $ligne) {
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] ." au ".$ligne[2]. "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="selectEnt">Entreprise</label>
                        <br>
                        <select name='idEnt' class="form-control" id="selectEnt">
                            <option disabled selected value="">--Choisir une entreprise--
                            <option>
                                <?php foreach (getEntreprise() as $ligne) {
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group" id="tuteurAjax">
                    </div>
                    <div class="form-group">
                        <label for="selectEtat">Etat</label>
                        <br>
                        <select required name='idetat' class="form-control" id="selectEtat">
                            <?php foreach (getEtat() as $ligne) {
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group" id="refusAjax">

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

<div class="modal fade" id="ajoutContact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un tuteur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <label for="nomContact" class="col-form-label">Nom:</label>
                        <input required type="text" class="form-control" name="nomContact" id="nomContact">
                    </div>
                    <div class="form-group">
                        <label for="prenomContact" class="col-form-label">Prénom:</label>
                        <input required type="text" class="form-control" name="prenomContact" id="prenomContact">
                    </div>
                    <div class="form-group">
                        <label for="mailContact" class="col-form-label">Mail:</label>
                        <input type="email" class="form-control" name="mailContact" id="mailContact">
                    </div>
                    <div class="form-group">
                        <label for="telContact" class="col-form-label">Tel:</label>
                        <input type="text" class="form-control" name="telContact" id="telContact">
                    </div>
                    <div class="form-group">
                        <label for="selectEnt">Entreprise</label>
                        <br>
                        <select name='idEnt' class="form-control" id="selectEnt">
                            <option disabled selected value="">--Choisir une entreprise--
                            <option>
                                <?php foreach (getEntreprise() as $ligne) {
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="roleContact" class="col-form-label">Role:</label>
                        <input type="text" class="form-control" name="roleContact" id="roleContact">
                    </div>
                    <div class="form-group">
                        <label for="serviceContact" class="col-form-label">Service:</label>
                        <input type="text" class="form-control" name="serviceContact" id="serviceContact">
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

<div class="modal fade" id="ajoutEntreprise" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une entreprise</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    <a href="https://www.manageo.fr/" target="_blank">Trouver le SIRET et le code NAF de
                        l'entreprise</a>
                    <a href="https://blog.easyfichiers.com/wp-content/uploads/2014/08/Liste-code-naf-ape.pdf"
                        target="_blank">Trouver la
                        division NAF de l'entreprise</a>
                    <a href="https://public.opendatasoft.com/explore/dataset/correspondance-code-insee-code-postal/table/"
                        target="_blank">Trouver le code postal unique</a>
                </div>
                <form method="post">
                    <div class="form-group">
                        <label for="siretEnt" class="col-form-label">SIRET:</label>
                        <input required type="number" class="form-control" name="siretEnt" id="siretEnt">
                    </div>
                    <div class="form-group">
                        <label for="nomEnt" class="col-form-label">Nom:</label>
                        <input required type="text" class="form-control" name="nomEnt" id="nomEnt">
                    </div>

                    <div class="form-group">
                        <label for="selectNaf">Division NAF</label>
                        <br>
                        <select required name='nafEnt' class="form-control" id="nafEnt">
                            <option disabled selected value="">--Choisir une division NAF--
                            <option>
                                <?php foreach (getNaf() as $ligne) {
                                echo  "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telEnt" class="col-form-label">Tel:</label>
                        <input type="text" class="form-control" name="telEnt" id="telEnt">
                    </div>
                    <div class="form-group">
                        <label for="mailEnt" class="col-form-label">Mail:</label>
                        <input type="text" class="form-control" name="mailEnt" id="mailEnt">
                    </div>
                    <div class="form-group">
                        <label for="cpEnt" class="col-form-label">Code Postal:</label>
                        <input type="text" class="form-control" name="cpEnt" id="cpEnt">
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
<?php } 

foreach(getDemandeStage() as $affiche){
    $idDemande = $affiche['iddemande'];
?>
<div class="modal fade" id="supp<?php echo $idDemande?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Etes vous sur de vouloir supprimer cette demande de stage ?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" style="color: white" data-dismiss="modal">Close</a>
                <a type="button" class="btn btn-danger" style="color: white"
                    href="?suppDemande=<?php echo $idDemande?>">Supprimer</a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'inc.footer.php' ?>