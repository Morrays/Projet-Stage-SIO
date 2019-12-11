<?php
session_start();
include 'connexion.php';
?>
<html lang="fr">
    <head>        
        <title>Stages</title>
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
                <h2>Périodes de stages</h2>
                <p>
            </div>
            <p>
                <br/>
            <div class="container">
                <tbody>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">ID</th>
                            <th data-column-id="annee">Année</th>
                            <th data-column-id="datedebut">Date Debut (AAAA-MM-JJ)</th>
                            <th data-column-id="datefin">Date Fin (AAAA-MM-JJ)</th>
                    </thead>
                    <tbody>
                        <?php
                        $test = '0';
                        include 'connexion.php';

                        $reponse = $connection->query('SELECT * FROM periode');

                        while ($donnees = $reponse->fetch()) {
                            $don = '<tr>
                               <td>' . $donnees['idperiode'] . '</td>
                               <td>' . $donnees['annee'] . '</td>
                               <td>' . $donnees['date_debut'] . '</td>
                               <td>' . $donnees['date_fin'] . '</td>';
                            echo $don;
                            echo '<td>';
                            echo '</tr>
                                <p></tr>'
                            ;
                        }
                        $reponse->closeCursor();
                        $_SESSION['deco'] = '1';
                        ?>   
                    </tbody>	
                </table>
            </div>
            <p>
        </div>
        <div class="conteneur">
            <br />
            <div class="row">
                <br />
                <h2>Mes demandes effectuées</h2>
                <p>
            </div>
            <p>
                <br>
            <div class="container">
                <tbody>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th data-column-id="id" data-type="numeric" data-identifier="true">Demande</th>
                            <th data-column-id="datedemande">Date de la demande</th>
                            <th data-column-id="raisonrefus">Etat</th>
                            <th data-column-id="datedemande">Refus</th>
                            <th data-column-id="raisonrefus">Etudiant</th>
                            <th data-column-id="raisonrefus">Periode</th>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['nomC'])) {
                            if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher") {
                                $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                                $terme = $_GET["termeR"];
                                $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                                $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                            }
                            $reponse = $connection->query('SELECT * FROM demande, etudiant, etat WHERE etudiant.idetudiant = demande.idetudiant AND demande.idetat =etat.idetat AND etudiant.idetudiant = ' .$_SESSION['code']);

                            while ($donnees = $reponse->fetch()) {
                                $don = '<tr>
                               <td>' . $donnees['iddemande'] . '</td>
                               <td>' . $donnees['date_demande'] . '</td>
                               <td>' . $donnees['libelle_etat'] . '</td>
                               <td>' . $donnees['refus'] . '</td>  
                               <td>' . $donnees['nom'] . '</td>
                               <td>' . $donnees['idperiode'] . '</td>';

                                echo $don;
                                echo '<td>';
                                echo '<a class="btn btn-success" href="modifdemande.php?id=' . $donnees['iddemande'] . '">Modifier</a>'; // un autre td pour le bouton d'update
                                echo '</td><p>';
                                echo'<td>';
                                echo '<a class="btn btn-danger" href="deletedemande.php?id=' . $donnees['iddemande'] . ' ">Supprimer</a>'; // un autre td pour le bouton de suppression
                                echo '</td><p>';  
                            }
                            $reponse->closeCursor();
                            $_SESSION['deco'] = '1';
                          
                            echo '<a class="btn btn-success" href="addDemande.php?">Ajouter une demande de stage</a>';
                            ?>   
                        </tbody>	
                    </table>
                    <?php
                    echo '<a class="btn btn-danger" href="index.php?">Retour au site</a>';
                    echo "";
                } else {
                    header("Location: log.php?err=1");
                }
                ?>
            </div>
            <p>
        </div>
        <p>
    </body>
</html>

