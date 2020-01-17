<?php

// script de téléchargement pour l'accord de stage.

session_start();
require "connexion.php"; 

$filejpg = "images/Accord/".$_SESSION['code']."Accord.jpg";

$filepng = "images/Accord/".$_SESSION['code']."Accord.png";

$filejpeg = "images/Accord/".$_SESSION['code']."Accord.jpeg";



if (file_exists($filejpg)) {
   
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filejpg).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filejpg));
    readfile($filejpg);
    exit;

}else if (file_exists($filepng)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filepng).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filepng));
    readfile($filepng);
    exit;

}else if (file_exists($filejpeg)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($filejpeg).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($filejpeg));
    readfile($filejpeg);
    exit;

}else{
    echo "Erreur de transmission";
}




?>