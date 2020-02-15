<?php
include 'data/define.php';
// Connection au serveur
try {
    $dns = 'mysql:host='.PDO_HOST.';dbname='.PDO_DB_NAME.'';
    $utilisateur = PDO_USER_NAME;
    $motDePasse = PDO_USER_PSW;
    $connection = new PDO($dns, $utilisateur, $motDePasse);
    $connection->query("SET NAMES utf8");
} catch (Exception $e) {
    echo "Connection Ã  MySQL impossible : ", $e->getMessage();
    die();
}
?>