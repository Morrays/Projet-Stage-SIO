<?php 
include 'connexion.php'; 

if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST["option"]) AND !empty($_POST["promotion"]) AND !empty($_POST["classe"])){
    $nom = htmlentities($_POST["nom"]);
    $prenom = htmlentities($_POST["prenom"]);
    $classe = htmlentities($_POST["classe"]);
    $promotion  = htmlentities($_POST["promotion"]);
    $option  = htmlentities($_POST["option"]);
    $email = htmlentities($_POST["email"]);
    $mdp = htmlentities($_POST["mdp"]);
    $mdph = password_hash($mdp, PASSWORD_DEFAULT);

    $sql = "INSERT INTO sta_etudiant(nom, prenom, idclasse, idpromotion,option, email, photo, mdp) VALUES('".$nom."', '".$prenom."', '".$classe."', '".$promotion."', '".$option."', '".$email."', 'membres.png', '".$mdph."')";
    echo $sql;
    $connection->exec($sql); 

    header ('Location: login.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bootstrap Dashboard by Bootstrapious.com</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="css/fontastic.css">
    <!-- Google fonts - Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <!-- jQuery Circle-->
    <link rel="stylesheet" href="css/grasp_mobile_progress_circle-1.0.0.min.css">
    <!-- Custom Scrollbar-->
    <link rel="stylesheet" href="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <div class="page login-page">
        <div class="container">
            <div class="row">
                <div class="form-outer text-center d-flex align-items-center">
                    <div class="form-inner">
                        <div class="logo text-uppercase"><img src="../images/stage.jpg">
                        </div>
                        <form method="post" action="register.php" class="text-left form-validate">
                            <div class="form-group-material">
                                <input id="register-nom" type="text" name="nom" required
                                    data-msg="Please enter your nom" class="input-material">
                                <label for="register-nom" class="label-material">Nom</label>
                            </div>
                            <div class="form-group-material">
                                <input id="register-prenom" type="text" name="prenom" required
                                    data-msg="Please enter your prenom" class="input-material">
                                <label for="register-prenom" class="label-material">Prenom</label>
                            </div>
                            <div class="form-group-material">
                                <input id="register-email" type="email" name="email" required
                                    data-msg="Please enter a valid email address" class="input-material">
                                <label for="register-email" class="label-material">Email </label>
                            </div>
                            <div class="form-group-material">
                                <input id="register-password" type="password" name="mdp" required
                                    data-msg="Please enter your password" class="input-material">
                                <label for="register-password" class="label-material">Password </label>
                            </div>
                            <?php
                        $sql = "SELECT * FROM sta_classe WHERE idclasse < 3";
                        $q = $connection->query($sql);
                        echo "<div class='form-group'>";
                        echo "<label for='selectClasse'>Classe</label>";
                        echo "<select name='classe' class='form-control' id='selectClasse'>";                                            
                        while ($ligne = $q->fetch()) {
                            if ($row['libelle_classe'] == $ligne[0])
                                echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                            else
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                        }
                        echo "</select>";
                        echo "</div>";

                        $sql = "SELECT * FROM sta_promotion WHERE id_promotion > 1";
                        $q = $connection->query($sql);
                        echo "<div class='form-group'>";
                        echo "<label for='selectPromotion'>Promotion</label>";
                        echo "<select name='promotion' class='form-control' id='selectPromotion'>"; 
                        while ($ligne = $q->fetch()) {
                            if ($row['libelle_promotion'] == $ligne[0])
                                echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                            else
                                echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                        }
                        echo "</select>";                                            
                        echo "</div>";
                        ?>
                            <div class="form-group"><label for="selectOption">Option</label><select name="option"
                                    class="form-control is-valid" id="selectOption" aria-invalid="false">
                                    <option value="SLAM">SLAM</option>
                                    <option value="SISR">SISR</option>
                                </select></div>
                            <div class="form-group text-center">
                                <input id="register" type="submit" value="S'enregistrer" class="btn btn-primary">
                            </div>
                        </form><small>Se connecter au site. </small><a href="login.php" class="signup">Connexion</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/grasp_mobile_progress_circle-1.0.0.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
</body>

</html>