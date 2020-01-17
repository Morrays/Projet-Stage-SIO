<?php
session_start();
if (!empty($_REQUEST['nom']) AND !empty($_REQUEST['prenom']) AND !empty($_REQUEST['email']) AND !empty($_REQUEST['mdp'])){
    $nom = htmlentities($_REQUEST["nom"]);
    $prenom = htmlentities($_REQUEST["prenom"]);
    $classe = htmlentities($_REQUEST["classe"]);
    $promotion  = htmlentities($_REQUEST["promotion"]);
    $email = htmlentities($_REQUEST["email"]);
    $mdp = htmlentities($_REQUEST["mdp"]);

    $mdph = password_hash($mdp, PASSWORD_DEFAULT);
    
    
?>
    <!DOCTYPE html>
    <html>
        <!--//permet d'enregistrer les infos rentrer lors de l'inscription d'un nouveau client-->
        <head>
            <title>Enregistrer</title>

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="style.css">
        </head>
        <body>
            <?php
            include 'connexion.php';
            ?>
            <div>
                <p class="text"><br><br>
                    Bonjour <?php
                    echo html_entity_decode($nom);
                    echo " ";
                    ?>
                    </br>
                    </br>
                    Votre inscription a bien été effectuée.
                <p>
                    <input class="btn btn-primary" type="submit" onclick="window.location.href = 'index.php'" value="Retour à l'accueil"/>
                </p>                
                <?php 
                $req = $connection->prepare('INSERT INTO sta_etudiant(nom, prenom, idclasse, idpromotion, email, photo, mdp) VALUES(:nom, :prenom, :classe, :promotion, :mail, :photo, :mdp)');
                $req->execute(array(
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'classe' => $classe,
                    'promotion' => $promotion,
                    'mail' => $email,
                    'photo' => "membres.png",
                    'mdp' => $mdph,

                    
                ));
            }
else {
    header ('location: log.php?erreur=Tous les champs doivent être complétés !');
    }
    ?>
    </body>
</html>
