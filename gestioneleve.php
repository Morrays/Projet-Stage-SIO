<?php
session_start();
include 'connexion.php';
?>
<html lang="fr">
    <head>        
        <title>Gestion élèves</title>
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
        <form action="archiveseleves.php" method="GET">
            <div class="conteneur">
                <br />
                <div class="row">
                    <br />
                    <h2>Gestion des élèves</h2>
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
                                <th data-column-id="classe">Classe</th>
                                <th data-column-id="ancien">Passage en ancien élève</th>     
                        </thead>
                        <tbody>
                            <?php
                            $test = '0';
                            include 'connexion.php';

                            $reponse = $connection->query('SELECT * FROM etudiant e, classe c WHERE e.idclasse = c.idclasse AND idetudiant > 1 AND e.idclasse < 3');
                            $i = 1;
                            while ($donnees = $reponse->fetch()) {
                                $don = '<tr>
                                   <td>' . $donnees['nom'] . '</td>
                                   <td>' . $donnees['prenom'] . '</td>
                                   <td>' . $donnees['libelle_classe'] . '</td>'; 
                                echo $don;  
                                ?>
                                <td><input type="checkbox" name="scales[]" value="<?php echo $donnees['idetudiant']; ?>"></td>
                                <?php
                                $i++;
                            }
                            //$_SESSION["nbetudiant"]=$i;
                            echo '</tr>';
                            $reponse->closeCursor();
                            $_SESSION['deco'] = '1';
                            ?>
                            <input  value="Passer les élèves sélectionnés en Ancien" type="submit" class="btn btn-success"></a>
                            <br>
                            <p>
                        </tbody>	
                    </table>
                </div>
                <p>
            </div>
        </form>
    </body>
</html>

