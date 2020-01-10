<?php

session_start();
require "connexion.php"; 

if(isset($_FILES['attestStage']) AND !empty($_FILES['attestStage']['name'])) 
{

    $tailleMax = 2097152;
    $extensionsValides = array('jpg','png', 'jpeg');

    if($_FILES['attestStage']['size'] <= $tailleMax)
    {
        $extensionsUpload = strtolower(substr(strchr($_FILES['attestStage']['name'], '.'), 1));
        if(in_array($extensionsUpload, $extensionsValides))
        {
            $chemin = "images/Attestation/".$_SESSION['code']."Attest.".$extensionsUpload;
            $resultat = move_uploaded_file($_FILES['attestStage']['tmp_name'],$chemin);
            if($resultat)
            {
                $updateavatar = $connection->prepare('UPDATE sta_etudiant SET attestStage = :uploadAttest WHERE idetudiant = :id');
                $updateavatar->execute(array(
                    'uploadAttest' => $_SESSION['code']."Attest.".$extensionsUpload,
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