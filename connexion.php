<?php

// Connection au serveur
try {
    $dns = 'mysql:host=stpolsis45.mysql.db;dbname=stpolsis45';
    $utilisateur = 'stpolsis45';
    $motDePasse = 'LcouaiSh45';
    $connection = new PDO($dns, $utilisateur, $motDePasse);
    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection Ã  MySQL impossible : ", $e->getMessage();
    die();
}
//permet de se connecter a la base de donnees
?>