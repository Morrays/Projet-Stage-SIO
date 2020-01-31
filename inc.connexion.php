<?php
// Connection au serveur
try {
    $dns = 'mysql:host=kevingosset.fr;dbname=kriiox_sio';
    $utilisateur = 'kriiox_sio';
    $motDePasse = 'sio1212';
    $connection = new PDO($dns, $utilisateur, $motDePasse);
    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection Ã  MySQL impossible : ", $e->getMessage();
    die();
}
?>