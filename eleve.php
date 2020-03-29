<?php 
include 'inc.header.php';
if(isset($_GET["ideleve"]) && $_GET["ideleve"]!="") {
    $idetudiant = $_GET["ideleve"];
    $sqleleve ="SELECT * FROM sta_etudiant e, sta_classe c, sta_promotion p WHERE p.id_promotion=e.idpromotion AND c.idclasse=e.idclasse AND e.idetudiant =".$idetudiant;
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

    $sqlhistorique = "SELECT * FROM sta_etudiant e, sta_demande d, sta_periode p, sta_contact c, sta_entreprise en WHERE c.SIRET=en.SIRET AND c.idcontact=d.idcontact AND d.idperiode=p.idperiode AND e.idetudiant=d.idetudiant AND d.idetat=4 AND e.idetudiant=".$idEtudiant." ORDER BY p.date_debut asc";
    $q20 = $connection->query($sqlhistorique);
    $reponse20 = $q20->fetchAll();
} else {
    //header('Location: gestionEleves.php');
}

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
                                    src="img/avatar/<?php echo $photoEtudiant;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <span>Email: <?php echo $emailEtudiant;?></span><br>
                            <span>Classe: <?php echo $classeEtudiant;?></span><br>
                            <span>Promotion: <?php echo $promotionEtudiant;?></span><br>
                            <a class="btn btn-primary" data-toggle="modal"
                                        data-target="#modifProfil" style="color: white">Modifier</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="">
            <div class="container-fluid">
                <div class="card-header">
                    <h4>Historique des stages</h4>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Période</th>
                                        <th>Entreprise</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach($reponse20 as $affiche){
                                    $periode = $affiche["date_debut"]." au ".$affiche['date_fin']; 
                                    $nomEntreprise = $affiche["nom"];
                                    ?>
                                    <tr>
                                        <td><?php echo $periode;?></td>
                                        <td><?php echo $nomEntreprise;?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
        </section>

        <section class="statistics">
            <div class="container-fluid">
                <div class="row d-flex">
                    <div class="col-lg-4">
                        <!-- Attestation-->
                        <div class="card income text-center">
                            <div class="icon"><i class="fas fa-scroll"></i>
                                <p>Attestation</p>
                            </div>
                            <?php //if($attestStage!="") { ?>
                            
                            
                            <?php //} else { ?>
                            <form id="form2" action="uploadAttestStage.php" method="POST" enctype="multipart/form-data">
                                <p id="attest">Upload l'attestation de stage signée: </p>
                                <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                <input type="file" name="attestStage[]" multiple="multiple"><br />
                                <br><input class="btn btn-primary" id="sub2" type="submit" value="Valider" name="submit"><br />
                            </form>
                            <br>
                            <form id="form2" action="supAttest.php" method="POST">
                                
                                <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                <input type="submit" class="btn btn-danger" value="Supprimer" name="submit">
                                
                            </form>
                                
                            <?php

                                $dir = 'img/attestation/'.$idEtudiant.'/';
                                
                                $a = scandir($dir);
                                
            
                                for ($i=2; $i < count($a); $i++) { 
                                    
                                    echo "<a  class='btn btn-primary'  href='".$dir.$a[$i]."' download>".$a[$i]."</a>" ;
                                }
                               




                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Accord -->
                        <div class="card income text-center">
                            <div class="icon"><i class="fas fa-handshake"></i>
                                <p>Accord</p>
                            </div>                           
                                <form id="form2" action="uploadAccordStage.php" method="post" enctype="multipart/form-data">
                                    <p id="attest">Upload l'accord de stage signée: </p>
                                    <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                    <input type="file" name="accordStage[]" multiple="multiple"><br />
                                    <br><input class="btn btn-primary" id="sub2" type="submit" value="Valider" name="submit"><br />
                                </form>
                                <form id="form2" action="supAccord.php" method="POST">                                
                                    <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                    <input type="submit" class="btn btn-danger" value="Supprimer" name="submit">                                
                                </form>                            
                           <?php
                                $dir = 'img/accord/'.$idEtudiant.'/';
                                $a = scandir($dir);
                                for ($i=2; $i < count($a); $i++) { 
                                    echo "<a  class='btn btn-primary'  href='".$dir.$a[$i]."' download>".$a[$i]."</a>" ;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Evaluation -->
                        <div class="card income text-center">
                            <div class="icon"><i class="fa fa-graduation-cap"></i>
                                <p>Evaluation</p>
                            </div>                            
                                <form id="form2" action="uploadEvalStage.php" method="post" enctype="multipart/form-data">
                                <p id="attest">Upload l'évaluation de stage : </p>
                                <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                <input type="file" name="eval[]" multiple="multiple"><br />
                                <br><input class="btn btn-primary" id="sub2" type="submit" value="Valider" name="submit"><br />
                            </form>
                            <br>
                            <form id="form2" action="supEval.php" method="POST">                                
                                <input type="hidden" value="<?php echo $idEtudiant; ?>" name="idEtu">
                                <input type="submit" class="btn btn-danger" value="Supprimer" name="submit">                                
                            </form>
                            <br>
                            <?php
                                $dir = 'img/eval/'.$idEtudiant.'/';                                
                                $a = scandir($dir);  
                                for ($i=2; $i < count($a); $i++) {                                     
                                    echo "<a  class='btn btn-primary'  href='".$dir.$a[$i]."' download>".$a[$i]."</a><br>" ;
                                }                          
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </section>
</section>

<!-- Modal -->
<?php 
$rqtEtudiant = "SELECT * FROM sta_etudiant WHERE idetudiant=".$idEtudiant;
$resultEtudiant = $connection->query($rqtEtudiant);
$tableEtudiant = $resultEtudiant->fetchAll();
foreach ($tableEtudiant as $infoEtudiant){
    $nomEtud = $infoEtudiant['nom'];
    $prenomEtud = $infoEtudiant['prenom'];
    $mailEtud = $infoEtudiant['email'];
    $idClasseEtud = $infoEtudiant['idclasse'];
?>
<div class="modal fade" id="modifProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier informations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="data/updateEtudiant.php" class="form-validate" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="dateDem" class="col-form-label">Nom:</label>
                        <input type="text" class="form-control" value="<?php echo $nomEtud?>" name="updateNomEtudiant" id="updateNomEtudiant">
                    </div>
                    <div class="form-group">
                        <label for="dateDem" class="col-form-label">Prenom:</label>
                        <input type="text" class="form-control" value="<?php echo $prenomEtud?>" name="updatePreomEtudiant" id="updateNomEtudiant">
                    </div>
                    <div class="form-group">
                        <label for="dateDem" class="col-form-label">Mail:</label>
                        <input type="text" class="form-control" value="<?php echo $mailEtud?>" name="updateMailEtudiant" id="updateNomEtudiant">
                    </div>
                    <div class="form-group">
                        <label>Classe: </label>
                        <?php 
                        $rqtClasse = "SELECT * FROM sta_classe WHERE idclasse NOT IN (3,4)";
                        $resultClasse = $connection->query($rqtClasse);
                        foreach ($resultClasse as $table) {
                            $idClasse = $table['idclasse'];
                            $libelleClasse = $table['libelle_classe'];
                        ?>
                        <input type="radio" name="updateClasseEtudiant" id="optionsRadios<?php echo $idClasse ?>"
                            value="<?php echo $idClasse ?>"
                            <?php if($idClasse==$idClasseEtud) { echo "checked=''"; }?>>
                        <label for="optionsRadios<?php echo $idClasse ?>"><?php echo $libelleClasse ?></label>
                        <?php } ?>
                    </div>                    
                    <div class="form-group">
                        <label for="dateDem" class="col-form-label">Mot de passe:</label>
                        <input type="text" class="form-control" name="updateMdpEtudiant" id="updateNomEtudiant">
                    </div>
                    <label>Image de profil</label>
                    <div class="custom-file form-group">
                        <input type="file" name="updateImageEtudiant" class="custom-file-input" id="fileUpload">
                        <label class="custom-file-label" for="fileUpload">Choose file</label>
                    </div>
                    <input type="submit" value="Valider" class="btn btn-primary">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php include 'inc.footer.php' ?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>