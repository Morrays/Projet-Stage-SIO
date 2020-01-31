<?php

require "../connexion.php"; 

if ( isset ($_POST['submit'])) {

    $idEtud = $_POST['idEtu'];
    
    }else { 
        header('Location: gestionEleves.php');
    }


    $filejpg = "../images/Attestation/".$idEtud."Attest.jpg";

    $filepng = "../images/Attestation/".$idEtud."Attest.png";
    
    $filejpeg = "../images/Attestation/".$idEtud."Attest.jpeg";

if (file_exists($filejpg)){
    unlink($filejpg);
    

}elseif (file_exists($filejpeg)){
    unlink($filejpeg);
    

}elseif (file_exists($filepng)){
    unlink($filepng);
    

}else{
    echo "Le fichier n'existe pas !";
}

?>