<?php
    ini_set( 'display_errors', 1 );
 
    error_reporting( E_ALL );
 
    $from = "test@votredomaine.com";
 
    $to = $_REQUEST['mailEtudiant'];
 
    $subject = "Vérification PHP mail";
 
    $message = $_REQUEST['message'];
 
    $headers = "From:" . $from;
 
    mail($to,$subject,$message, $headers);
 
    header('Location: ../eleve.php?index.php');
?>