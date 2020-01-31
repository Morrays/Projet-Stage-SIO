<?php

require "../connexion.php"; 

if ( isset ($_POST['submit'])) {

    $idEtud = $_POST['idEtu'];
    
    }else { 
        header('Location: gestionEleves.php');
    }


    $filejpg = "../images/Evaluation/".$idEtud."Eval.jpg";

    $filepng = "../images/Evaluation/".$idEtud."Eval.png";
    
    $filejpeg = "../images/Evaluation/".$idEtud."Eval.jpeg";

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