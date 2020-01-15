<?php

session_start();
require "connexion.php"; 

if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) 
{

    $tailleMax = 2097152;
    $extensionsValides = array('jpg','png', 'jpeg');

    if($_FILES['avatar']['size'] <= $tailleMax)
    {
        $extensionsUpload = strtolower(substr(strchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionsUpload, $extensionsValides))
        {
            $chemin = "images/".$_SESSION['code'].".".$extensionsUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
            if($resultat)
            {
                $updateavatar = $connection->prepare('UPDATE sta_etudiant SET photo = :avatar WHERE idetudiant = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['code'].".".$extensionsUpload,
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