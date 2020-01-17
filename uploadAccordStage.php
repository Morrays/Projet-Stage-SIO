
<?php

// script d'upload pour l'accord de stage.

session_start();
require "connexion.php"; 


if(isset($_FILES['accordStage']) AND !empty($_FILES['accordStage']['name'])) 
{

    $tailleMax = 2097152; 
    $extensionsValides = array('jpg','png', 'jpeg');

    if($_FILES['accordStage']['size'] <= $tailleMax)
    {
        $extensionsUpload = strtolower(substr(strchr($_FILES['accordStage']['name'], '.'), 1));
        if(in_array($extensionsUpload, $extensionsValides))
        {
            $chemin = "images/Accord/".$_SESSION['code']."Accord.".$extensionsUpload;
            $resultat = move_uploaded_file($_FILES['accordStage']['tmp_name'],$chemin);
            if($resultat)
            {
                $updateavatar = $connection->prepare('UPDATE sta_etudiant SET accordStage = :accordStage WHERE idetudiant = :id');
                $updateavatar->execute(array(
                    'accordStage' => $_SESSION['code']."Accord.".$extensionsUpload,
                    'id' => $_SESSION['code']
                ));
                header('Location: profil.php');
            }
            else
            {
                $msg = "Erreur pendant l'upload du fichier";
                echo $msg;
            }
        }else
        {
            $msg = "Votre format d'image n'est pas correcte";
            echo $msg;
        }
    }
    else
    {
        $msg = "Votre image ne doit pas dépasser 2 Mo";
        echo $msg;
    }

}

?>