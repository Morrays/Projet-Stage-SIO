<?php
session_start();
include 'connexion.php';
// si une methode de recherche est selectionnée alors;
    if (isset($_REQUEST['selectR'])) {
    //init variable
    $rech = $_REQUEST['selectR'];
    $car = $_REQUEST['termeR'];

    // la requete est selectionnée en fonction de la methode de recherche
    if ($rech == "nom") {

        $sql = "SELECT * FROM entreprise WHERE nom LIKE '%" . $car . "%'";
    } elseif ($rech == "naf") {

        $sql = "SELECT * FROM entreprise WHERE code_NAF LIKE '%" . $car . "%'";
    } elseif ($rech == "secteur") {

        $sql = "SELECT * FROM entreprise WHERE cpville LIKE '%" . $car . "%'";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>        
        <title>Recherche d'entreprise</title>
        
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
        <header>
            <?php
            include 'barrenav.php';
            ?>
        </header>
        <br><br><br>
        <div class="conteneur">
        <form action="" method="GET">
            <select class="form-control" id="exampleFormControlSelect1" name="selectR">
                <option value="nom">Nom</option>
                <option value="naf">Libellé NAF</option>
                <option value="secteur">Secteur géographique</option>
            </select>
            <br>
            <input type = "text" class="form-control" id="exampleFormControlInput1" placeholder="Saississez votre recherche..." name = "termeR">
            <br>
            <input type="submit" name="s" value="Rechercher"/>
            
        </form>
        <br><br><br>
        <table class="table">
            <tbody>
                <th data-column-id="SIRET"> SIRET</th>
                <th data-column-id="nom">Nom</th> 
                <th data-column-id="code_NAF">Libellé NAF</th>
                <th data-column-id="telephone">Téléphone</th>
                <th data-column-id="mail">E-mail</th>
                <th data-column-id="ville">Ville</th>
            <?php
            if(isset($_SESSION['nomC'])){
                if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
                {
                    $_GET["termeR"] = htmlspecialchars($_GET["termeR"]); //pour sécuriser le formulaire contre les failles html
                    $terme = $_GET["termeR"];
                    $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
                    $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
                };
                if (isset($sql)){
                    $reponse = $connection->query($sql);
                    $nombre=$reponse->rowCount();
                    if ($car == ''){
                        if($rech=="nom"){
                            echo "Il n'existe aucune entreprise de ce nom dans la base de données";                                       
                        }elseif($rech == "naf"){
                            echo "Il n'existe aucune entreprise ayant pour libellé NAF ".$car." dans la base de données";
                        }elseif($rech == "secteur"){
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
    </body>
</html>

