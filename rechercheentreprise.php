<?php
include 'header.php';
// si une methode de recherche est selectionnée alors;
    // la requete est selectionnée en fonction de la methode de recherche

if (isset($_POST["searchNom"])=="nom" && ($_POST["searchNom"])!="") {        
    $sql = "SELECT * FROM sta_entreprise WHERE nom LIKE '%" . $_POST["searchNom"] . "%'";
} else if (isset($_POST["searchNaf"])=="naf" && ($_POST["searchNaf"])!="") {
    $sql = "SELECT * FROM sta_entreprise WHERE code_NAF LIKE '%" . $_POST["searchNaf"] . "%'";
} else if (isset($_POST["searchCP"])=="cp" && ($_POST["searchCP"])!="") {
    $sql = "SELECT * FROM sta_entreprise WHERE cpville LIKE '%" . $_POST["searchCP"] . "%'";
}
?>
<br><br><br>
<div class="container">
    <div class="row d-flex justify-content-center">
    <form action="" method="POST" >
        <select class="form-control" name="selectR" id="selectR" onchange="cacherInput()">
            <option value="nom" id="nom">Nom</option>
            <option value="naf" id="naf" >Libellé NAF</option>
            <option value="cp" id="CP1">Code Postal</option>
        </select>

        <br>
        <input type="text" class="form-control" id="recherche" placeholder="Saississez votre recherche..." name="searchNom">
        

        
        <select  class="hidden" name="searchNaf" id="libelNaf">
        <option selected disabled hidden>--Selectionnée un libellé naf--</option>
        <?php
            $sql2 = "SELECT * FROM sta_naf order by libelle_NAF asc";
            $q = $connection->query($sql2);
            while ($ligne = $q->fetch()) {
                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
            }
            ?>
        </select>

        

        <input type="text" class="form-control hidden" placeholder="Saississez votre recherche..." name="searchCP" id="CP"> 

        <br>

        <input class="btn btn-primary" type="submit" name="s" value="Rechercher" />
        </form>
    </div>

    <br><br><br>
    <div class="row">
        <table class="table table-striped">
            <tbody>
                <th data-column-id="SIRET"> SIRET</th>
                <th data-column-id="nom">Nom</th>
                <th data-column-id="code_NAF">Libellé NAF</th>
                <th data-column-id="telephone">Téléphone</th>
                <th data-column-id="mail">E-mail</th>
                <th data-column-id="ville">Ville</th>
                <?php
            if(isset($_SESSION['nom'])){
                if (isset($sql)){
                    $reponse = $connection->query($sql);
                    $nombre=$reponse->rowCount();
                    if ($nombre == 0){
                        if(isset($_POST["searchNom"])=="nom" && ($_POST["searchNom"])!=""){
                            echo "Il n'existe aucune entreprise de ce nom dans la base de données";                                       
                        }else if(isset($_POST["searchNaf"])=="naf" && ($_POST["searchNaf"])!=""){
                            echo "Il n'existe aucune entreprise ayant pour libellé NAF ".$_POST["searchNaf"]." dans la base de données";
                        }else if(isset($_POST["searchCP"])=="cp" && ($_POST["searchCP"])!=""){
                            echo "Il n'existe aucune entreprise dans ce secteur  dans la base de donnée";
                        }
                    }else{
                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                                <td>' . $donnees['SIRET'] . '</td>
                                <td>' . $donnees['nom'] . '</td>
                                <td>' . $donnees['code_NAF'] . '</td>
                                <td>' . $donnees['tel'] . '</td>
                                <td>' . $donnees['Mail'] . '</td>
                                <td>' . $donnees['cpville'].'</td></tr><br/>';
                            echo $don;
                        }
                    }
                    $reponse->closeCursor();
                }
            }else{
                header("Location: log.php?err=1");
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>