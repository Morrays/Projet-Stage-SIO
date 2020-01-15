<?php
include 'header.php';

if (isset($_REQUEST["scales"])) {
    foreach($_REQUEST["scales"] as $val){
        $sql =('UPDATE sta_etudiant SET idclasse = 4 WHERE ' .$val. ' = idetudiant');
        $q = $connection->prepare($sql);
        $q->execute(array($val));
    }
    echo sizeof($_REQUEST["scales"])." étudiant passé en anciens élèves.";
}
?>
<br />
<form action="" method="GET">
    <div class="container">
        <div class="row">
            <br />
            <h2>Gestion des élèves</h2>
        </div>
        <br />
        <div class="container">
            <tbody>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th data-column-id="nom">Nom</th>
                            <th data-column-id="prenom">Prénom</th>
                            <th data-column-id="classe">Classe</th>
                            <th data-column-id="ancien">Passage en ancien élève</th>
                    </thead>
                    <tbody>
                        <?php
                            $test = '0';
                            include 'connexion.php';

                            $reponse = $connection->query('SELECT * FROM sta_etudiant e, sta_classe  c WHERE e.idclasse = c.idclasse AND idetudiant > 1 AND e.idclasse < 3');
                            $i = 1;
                            while ($donnees = $reponse->fetch()) {
                                $don = '<tr>
                                   <td>' . $donnees['nom'] . '</td>
                                   <td>' . $donnees['prenom'] . '</td>
                                   <td>' . $donnees['libelle_classe'] . '</td>'; 
                                echo $don;  
                                ?>
                        <td><input type="checkbox" name="scales[]" class="form-check-input" value="<?php echo $donnees['idetudiant']; ?>">
                        </td>
                        <?php
                                $i++;
                            }
                            //$_SESSION["nbetudiant"]=$i;
                            echo '</tr>';
                            $reponse->closeCursor();
                            $_SESSION['deco'] = '1';
                            ?>
                        <input value="Passer les élèves sélectionnés en Ancien" type="submit"
                            class="btn btn-success"></a>
                        <br>
                        <p>
                    </tbody>
                </table>
        </div>
        <p>
    </div>
</form>

<?php include 'footer.php' ?>