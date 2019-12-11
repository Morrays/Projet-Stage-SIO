<?php
session_start();
include 'connexion.php';
?>
<html lang="fr">
    <head>        
        <title>Tableaux recapitulatifs</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <?php
            include 'barrenav.php';
            ?>
        </header>
        <br><br>
        <div class="conteneur">
            <table class="table table-bordered">
                <h3>Récapitulatif entreprise</h3>
                <br>
                <tr>
                    <th data-column-id="entreprise" data-type="numeric" data-identifier="true">Entreprise</th>
                    <th data-column-id="demandefaite">Nombre de demandes faites</th>
                    <th data-column-id="stagiarepris">Nombre de stagiaires pris</th>
                </tr>
                <?php
                if (isset($_SESSION['nomC'])) {
                    if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher") {
                        $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                        $terme = $_GET["termeR"];
                        $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                        $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                    }
                    $reponse = $connection->query('SELECT *  FROM entreprise ORDER BY nom');
                    while ($donnees = $reponse->fetch()) {
                        echo '<tr>';
                        echo "<td>" . $donnees['nom'] . "</td>";
                        echo "<td>" . $donnees['nb_demande'] . "</td>";
                        $rep = $connection->query("SELECT count(*) as Nb_stagiaire_pris FROM `demande` WHERE idetat = 4 AND SIRET = '" . $donnees['SIRET'] . "'");
                        $ligne = $rep->fetch();
                        echo "<td>" . $ligne['Nb_stagiaire_pris'] . "</td>";
                        $rep->closeCursor();
                        echo '</tr>';
                    }
                    $reponse->closeCursor();
                    $_SESSION['deco'] = '1';
                    ?>   	
                </table>
            </div>

            <?php
            echo "";
        } else {
            header("Location: log.php?err=1");
        }
        ?>
        <br><br>
        <div class="conteneur">
            <table class="table table-bordered">
                <h3>Récapitulatif promotion</h3>
                <br>
                <tr>
                    <th data-column-id="classe" data-type="numeric" data-identifier="true">Classe</th>
                    <th data-column-id="nbeleves">Nombre d'élèves</th>
                    <th data-column-id="nbelevesstages">Nombre d'élèves avec un stage</th>
                </tr>
                <tr>

                </tr>
                <?php
                if (isset($_SESSION['nomC'])) {
                    if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher") {
                        $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                        $terme = $_GET["termeR"];
                        $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                        $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                    }
                    $sql = 'SELECT c.libelle_classe, p.libelle_promotion, count(*) as nb_eleves FROM etudiant e, promotion p, classe c WHERE e.idpromotion=p.id_promotion AND e.idclasse = c.idclasse
                    AND libelle_promotion IN (YEAR(CURDATE()), YEAR(CURDATE()-1)) AND c.idclasse <> 3  GROUP BY c.libelle_classe, p.libelle_promotion';
                    $reponse = $connection->query($sql);
                    while ($donnees = $reponse->fetch()) {
                        echo '<tr>';
                        echo "<td>" . $donnees['libelle_classe'] . "</td>";
                        echo "<td>" . $donnees['nb_eleves'] . "</td>";
                        $sql2 = "SELECT c.libelle_classe, p.annee,count(*) as nb_eleves_pris FROM etudiant e, periode p, classe c, demande d WHERE e.idclasse=c.idclasse AND e.idetudiant = d.idetudiant AND d.idperiode = p.idperiode
                            AND d.idetat = 4 AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1) AND c.idclasse NOT IN (3,4) AND c.libelle_classe = '" . $donnees['libelle_classe'] . "' GROUP BY c.libelle_classe, p.annee";
                        $reponse2 = $connection->query($sql2);
                        $donnees2 = $reponse2->fetch();
                        echo "<td>" . $donnees2['nb_eleves_pris'] . "</td>";
                        echo '</tr>';
                    }
                    $reponse->closeCursor();
                    $_SESSION['deco'] = '1';
                    ?>   	
                </table>
            </div>

            <?php
            echo "";
        } else {
            header("Location: log.php?err=1");
        }
        ?>
        <br><br>
        <div class="conteneur">
            <table class="table table-bordered">
                <h3>Récapitulatif élèves</h3>
                <br>
                <tr>
                    <th data-column-id="id" data-type="numeric" data-identifier="true">Nom de l'élève</th>
                    <th data-column-id="raisonrefus">Nombre de demandes faites</th>
                    <th data-column-id="datedemande">Demandes acceptées</th>
                    <th data-column-id="datedemande">Demandes en attente</th>
                    <th data-column-id="datedemande">Demandes refusées</th>
                </tr>
                <tr>

                </tr>
                <?php
                if (isset($_SESSION['nomC'])) {
                    if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher") {
                        $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                        $terme = $_GET["termeR"];
                        $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                        $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                    }
                    $reponse = $connection->query('SELECT e.idetudiant, e.nom, e.prenom,count(*) as nb_demandes FROM etudiant e, periode p, demande d, classe c WHERE e.idetudiant = d.idetudiant AND d.idperiode = p.idperiode AND c.idclasse = e.idclasse
                    AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1) AND c.idclasse NOT IN (3,4) GROUP BY e.idetudiant, e.nom, e.prenom');
                    while ($donnees = $reponse->fetch()) {
                        echo '<tr>';
                        echo "<td>" . $donnees['nom'] . " " . $donnees['prenom'] . "</td>";
                        echo "<td>" . $donnees['nb_demandes'] . "</td>";
                        $sql2 = "SELECT e.idetudiant, e.nom, e.prenom,count(*) as nb_demandes_accepte FROM etudiant e, periode p, demande d, classe c WHERE e.idetudiant = d.idetudiant AND d.idperiode = p.idperiode AND c.idclasse = e.idclasse"
                                . " AND e.idetudiant=" . $donnees['idetudiant'] . " AND d.idetat = 4  AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1)";
                        $reponse2 = $connection->query($sql2);
                        $donnees2 = $reponse2->fetch();
                        echo "<td>" . $donnees2['nb_demandes_accepte'] . "</td>";
                        $sql3 = "SELECT e.idetudiant, e.nom, e.prenom,count(*) as nb_demandes_attente FROM etudiant e, periode p, demande d, classe c WHERE e.idetudiant = d.idetudiant AND d.idperiode = p.idperiode AND c.idclasse = e.idclasse"
                                . " AND e.idetudiant=" . $donnees['idetudiant'] . " AND d.idetat = 5  AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1)";
                        $reponse3 = $connection->query($sql3);
                        $donnees3 = $reponse3->fetch();
                        echo "<td>" . $donnees3['nb_demandes_attente'] . "</td>";
                        $sql4 = "SELECT e.idetudiant, e.nom, e.prenom,count(*) as nb_demandes_refuse FROM etudiant e, periode p, demande d, classe c WHERE e.idetudiant = d.idetudiant AND d.idperiode = p.idperiode AND c.idclasse = e.idclasse"
                                . " AND e.idetudiant=" . $donnees['idetudiant'] . " AND d.idetat = 6  AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1)";
                        $reponse4 = $connection->query($sql4);
                        $donnees4 = $reponse4->fetch();
                        echo "<td>" . $donnees4['nb_demandes_refuse'] . "</td>";
                        echo '</tr>';
                    }
                    $reponse->closeCursor();
                    $reponse = $connection->query('SELECT nom, prenom FROM etudiant e, classe c WHERE idetudiant not in (SELECT idetudiant
                                                                                                                        FROM demande d,periode p
                                                                                                                        WHERE p.idperiode = d.idperiode
                                                                                                                        AND p.annee IN (YEAR(CURDATE()),YEAR(CURDATE())-1))
                                                AND c.idclasse NOT IN (3,4)
                                                AND c.idclasse = e.idclasse');
                    while ($donnees = $reponse->fetch()) {
                        echo '<tr>';
                        echo "<td>" . $donnees['nom'] . " " . $donnees['prenom'] . "</td>";
                        echo "<td>0</td>";
                        echo "<td>0</td>";
                        echo "<td>0</td>";
                        echo "<td>0</td>";
                        echo "</tr>";
                    }
                    $reponse->closeCursor();
                    $_SESSION['deco'] = '1';
                    ?>   	
                </table>
            </div>

            <?php
            echo "";
        } else {
            header("Location: log.php?err=1");
        }
        ?>
    </body>
</html>
