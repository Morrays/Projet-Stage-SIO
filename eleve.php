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

                            <br>
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
                            <?php
                                $dir = 'img/eval/'.$idEtudiant.'/';
                                
                                $a = scandir($dir);
                                
            
                                for ($i=2; $i < count($a); $i++) { 
                                    
                                    echo "<a  class='btn btn-primary'  href='".$dir.$a[$i]."' download>".$a[$i]."</a>" ;
                                }
                          
                            ?>

                        </div>
                    </div>

                </div>
            </div>
        </section>
</section>

<?php include 'inc.footer.php' ?>