<?php 
session_start();
include "../inc.connexion.php";
$idEtudiant = $_SESSION['code'];
$nomEtudiant = $_REQUEST['updateNomEtudiant'];
$prenomEtudiant = $_REQUEST['updatePreomEtudiant'];
$mailEtudiant = $_REQUEST['updateMailEtudiant'];
$classeEtudiant = $_REQUEST['updateClasseEtudiant'];
$mdpEtudiant = $_REQUEST['updateMdpEtudiant'];

$insert = "UPDATE sta_etudiant SET nom='".$nomEtudiant."',prenom='".$prenomEtudiant."',email='".$mailEtudiant."',idclasse='".$classeEtudiant."' WHERE idetudiant=".$idEtudiant;
$connection->exec($insert);

// Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_FILES["updateImageEtudiant"])){
        // Vérifie si le fichier a été uploadé sans erreur.
        if(isset($_FILES["updateImageEtudiant"]) && $_FILES["updateImageEtudiant"]["error"] == 0){
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            $filename = $_FILES["updateImageEtudiant"]["name"];
            $filetype = $_FILES["updateImageEtudiant"]["type"];
            $filesize = $_FILES["updateImageEtudiant"]["size"];
            // Vérifie l'extension du fichier
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(!array_key_exists($ext, $allowed)) die("Erreur : Veuillez sélectionner un format de fichier valide.");

            // Vérifie la taille du fichier - 5Mo maximum
            $maxsize = 5 * 1024 * 1024;
            if($filesize > $maxsize) die("Error: La taille du fichier est supérieure à la limite autorisée.");

            // Vérifie le type MIME du fichier
            if(in_array($filetype, $allowed)){   
                $increment = 1;         
                $newname = $idEtudiant."_".$_FILES["updateImageEtudiant"]["name"];
                // Vérifie si le fichier existe avant de le télécharger.
                if(move_uploaded_file($_FILES["updateImageEtudiant"]["tmp_name"], "../img/avatar/".$newname)) {
                    $insert2 = "UPDATE sta_etudiant SET photo='".$newname."' WHERE idetudiant=".$idEtudiant;
                    $connection->exec($insert2);
                } else {
                    echo "Erreur d'upload ! Le fichier a bien été upload mais dans le mauvais repertoire !";
                } 
            } else{
                echo "Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer."; 
            }
        } else{
            echo "Error: " . $_FILES["updateImageEtudiant"]["error"];
        }
    }
}

header('Location: ../eleve.php?ideleve='.$idEtudiant);
?>