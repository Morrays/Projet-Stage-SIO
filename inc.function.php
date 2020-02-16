<?php 
function getNbStagesSio1(){
    include "inc.connexion.php";
    $sqlstagesio1 = "SELECT count(etu.idetudiant) as stagesio1 FROM sta_etudiant etu,sta_classe c,sta_demande d where d.idetudiant=etu.idetudiant AND etu.idclasse=c.idclasse AND etu.idclasse=1 AND etu.idclasse not in (3,4) AND d.idetat=4 ";
    $q10 = $connection->query($sqlstagesio1);
    $reponse10 = $q10->fetch();
    $nbNoStageSio1 = $reponse10['stagesio1'];
    return $nbNoStageSio1;
}

function getNbStagesSio2() {
    include "inc.connexion.php";
    $sqlstagesio2 = "SELECT count(etu.idetudiant) as stagesio2 FROM sta_etudiant etu,sta_classe c,sta_demande d where d.idetudiant=etu.idetudiant AND etu.idclasse=c.idclasse AND etu.idclasse=2 AND etu.idclasse not in (3,4) AND d.idetat=4 ";
    $q20 = $connection->query($sqlstagesio2);
    $reponse20 = $q20->fetch();
    $nbNoStageSio2 = $reponse20['stagesio2'];
    return $nbNoStageSio2;
}

function getNbElevesSio1(){
    include "inc.connexion.php";
    $sqlsio1 = "SELECT count(idetudiant) as nbsio1 FROM sta_etudiant e,sta_classe c where e.idclasse=c.idclasse AND e.idclasse=1";
    $q11 = $connection->query($sqlsio1);
    $reponse11 = $q11->fetch();
    $nbsio1 = $reponse11['nbsio1'];
    return $nbsio1;
}

function getNbElevesSio2(){
    include "inc.connexion.php";
    $sqlsio2 = "SELECT count(idetudiant) as nbsio2 FROM sta_etudiant e,sta_classe c where e.idclasse=c.idclasse AND e.idclasse=2";
    $q22 = $connection->query($sqlsio2);
    $reponse22 = $q22->fetch();
    $nbsio2 = $reponse22['nbsio2'];
    return $nbsio2;
}

function getEtudiantSansStage(){
    include "inc.connexion.php";
    $sqleleve = "SELECT * FROM sta_etudiant etu, sta_classe c WHERE etu.idclasse=c.idclasse AND ((idetudiant not in (SELECT idetudiant FROM sta_demande)) OR ( idetudiant in (SELECT idetudiant FROM sta_demande WHERE idetat <> 4))) AND etu.idclasse not in (3,4) ORDER BY etu.idclasse desc,etu.nom asc";
    $q = $connection->query($sqleleve);
    $reponse2 = $q->fetchAll();
    return $reponse2;
}

function getHistoriqueStage(){
    include "inc.connexion.php";
    $sqlrecherche = "SELECT * FROM sta_demande d, sta_etudiant etu, sta_etat eta, sta_entreprise ent, sta_periode p WHERE p.idperiode=d.idperiode AND ent.SIRET=d.SIRET AND etu.idetudiant = d.idetudiant AND d.idetat =eta.idetat AND etu.idetudiant =".$_SESSION['code']." ORDER BY d.date_demande desc";
    $qq = $connection->query($sqlrecherche);
    $reponse3 = $qq->fetchAll();
    return $reponse3;
}

function getFuturPeriode(){
    include "inc.connexion.php";
    $sql = "SELECT * FROM sta_periode where date_fin > now()";
    $q = $connection->query($sql);
    $ligne = $q->fetchAll();
    return $ligne;
}

function getEntreprise(){
    include 'inc.connexion.php';
    $sql = "SELECT * FROM sta_entreprise ORDER BY nom asc";
    $q = $connection->query($sql);
    $ligne = $q->fetchAll();
    return $ligne;
}

function getEtat(){
    include 'inc.connexion.php';
    $sql = "SELECT * FROM sta_etat";
    $q = $connection->query($sql);
    $ligne = $q->fetchAll();
    return $ligne;
}

function getNaf(){
    include 'inc.connexion.php';
    $sql = "SELECT * FROM sta_naf order by libelle_NAF asc";
    $q = $connection->query($sql);
    $ligne = $q->fetchAll();
    return $ligne;
}

function getDemandeStage(){
    include 'inc.connexion.php';
    $sql = "SELECT * FROM sta_demande";
    $q = $connection->query($sql);
    $ligne = $q->fetchAll();
    return $ligne;
}
?>