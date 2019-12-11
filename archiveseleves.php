<?php
session_start();
include 'connexion.php';

foreach($_REQUEST["scales"] as $val){
    echo $val;
    $idclasse = $val;
    $sql =('UPDATE etudiant SET idclasse = 4 WHERE ' .$val. ' = idetudiant');
    $q = $connection->prepare($sql);
    $q->execute(array($idclasse));
    
    header('location: gestioneleve.php');
}

?>
