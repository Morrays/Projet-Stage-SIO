<?php
session_start();
include 'connexion.php';
?>
<html lang="fr">
    <head>        
        <title>Info et ajouts</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <link rel="icon" href="images/favicon.ico" />
    </head>
    <body>
        <header>
            <?php
            include 'barrenav.php';
            ?>
        </header>
        <br />
        <div class="conteneur">
            <br />
            <div class="row">
                <br />
                <h2>Informations personnelles</h2>
                <p>
            </div>
            <p>
                <br/>
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
                    </thead>
                    <tbody>
                        <?php
                        $test = '0';
                        include 'connexion.php';

                        $reponse = $connection->query('SELECT * FROM etudiant, classe, promotion WHERE etudiant.idclasse = classe.idclasse AND etudiant.idpromotion = promotion.id_promotion AND idetudiant =' . $_SESSION['code']);

                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                               <td>' . $donnees['nom'] . '</td>
                               <td>' . $donnees['prenom'] . '</td>
                               <td>' . $donnees['libelle_classe'] . '</td>
                               <td>' . $donnees['libelle_promotion'] . '</td>
                               <td>' . $donnees['email'] . '</td>';
                            echo $don;
                            echo '<td>';
                            echo '<a class="btn btn-success" href="modifutil.php?id=' . $donnees['idetudiant'] . '">Modifier vos données</a>'; // un autre td pour le bouton d'update
                            echo '</td><p>';
                        }
                        $reponse->closeCursor();
                        $_SESSION['deco'] = '1';
                        ?>   
                    </tbody>	
                </table>
            </div>
            <p>
        </div>
        <br><br>
       <?php if (isset($_SESSION['nomC'])) {
                if (($_SESSION['nomC'] == "ADMIN")) { ?>
        <div id="addformation" class="conteneur">
            <br/>
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
                        include 'connexion.php';

                        $reponse = $connection->query('SELECT * FROM periode');

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
       }?>
    </body>
</html>

