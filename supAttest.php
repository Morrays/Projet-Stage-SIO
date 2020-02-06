<?php


if ( isset ($_POST['submit'])) {

    $idEtud = $_POST['idEtu'];
    
    }else { 
        header('Location: gestionEleves.php');
    }


    $path='img/attestation/'.$idEtud.'/';
    $rep=opendir($path);
    
    while($file = readdir($rep)){
        if($file != '..' && $file !='.' && $file !='' && $file!='.htaccess'){
            unlink($path.$file);
        
        }
    }
    header('Location: gestionEleves.php');

    ?>