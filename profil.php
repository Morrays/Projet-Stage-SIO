<?php
include 'header.php';
?>
<br />
<div class="conteneur">
    <br />
    <div class="row">
        <br />
        <h2>Informations personnelles</h2>
        <p>
    </div>
    <p>
        <br />
        <div class="container">
            <tbody>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th data-column-id="nom">Nom</th>
                            <th data-column-id="prenom">Prénom</th>
                            <th data-column-id="IDclasse">Classe</th>
                            <th data-column-id="IDpromotion">Promotion</th>
                            <th data-column-id="email">Email</th>
                            <th data-column-id="email">Modifier mes données</th>
                    </thead>
                    <tbody>
                        <?php
                        $test = '0';
                        include 'connexion.php';

                        $reponse = $connection->query('SELECT * FROM sta_etudiant, sta_classe , sta_promotion WHERE sta_etudiant.idclasse = sta_classe.idclasse AND sta_etudiant.idpromotion = sta_promotion.id_promotion AND idetudiant =' . $_SESSION['code']);

                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                               <td>' . $donnees['nom'] . '</td>
                               <td>' . $donnees['prenom'] . '</td>
                               <td>' . $donnees['libelle_classe'] . '</td>
                               <td>' . $donnees['libelle_promotion'] . '</td>
                               <td>' . $donnees['email'] . '</td>';
                            echo $don;
                            echo '<td><a class="btn btn-success" href="updateProfil.php?id=' . $donnees['idetudiant'] . '"><i class="fas fa-edit"></i></a></td>';
                        }
                        $reponse->closeCursor();
                        $_SESSION['deco'] = '1';
                        ?>
                    </tbody>
                </table>
        </div>
        <div id="pfp">
            <form id="form2" action="upload.php" method="post" enctype="multipart/form-data">
                <p id="p1">Changer l'image de profile:</p> <br>
                <input type="file" name="avatar"><br />
                <br><input class="btn btn-primary" id="sub1" type="submit" value="Valider" name="submit"><br />
            </form>
        </div>
</div>
<br><br>
<?php if (isset($_SESSION['nom'])) {
if (($_SESSION['nom'] == "ADMIN")) { ?>
<div id="addformation" class="conteneur">
    <br />
    <div class="row">
        <br />
        <h2>Ajouter une période de formation</h2>
        <p>
    </div>
    <div class="container">
        <tbody>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th data-column-id="annee">Année</th>
                        <th data-column-id="debut">Date Début (AAAA-MM-JJ)</th>
                        <th data-column-id="fin">Date Fin (AAAA-MM-JJ)</th>
                </thead>
                <tbody>
                    <?php
                        $test = '0';

                        $reponse = $connection->query('SELECT * FROM sta_periode');

                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                               <td>' . $donnees['annee'] . '</td>
                               <td>' . $donnees['date_debut'] . '</td>
                               <td>' . $donnees['date_fin'] . '</td>';
                            echo $don;
                            echo '</tr>
                                <p></tr>'
                            ;
                        }
                        $reponse->closeCursor();
                        $_SESSION['deco'] = '1';
                        ?>
                    <a class="btn btn-success" href="addStage.php">Ajouter une période de formation</a>
                </tbody>
            </table>
    </div>

    <p>
</div>
<?php }
       }
include "footer.php";       
?>