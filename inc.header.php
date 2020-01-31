<?php
session_start();
include "inc.connexion.php";
$userCheck="";
if ($_SESSION['idclasse'] == 3) {
    $userCheck = 'Admin';
} else if($_SESSION['idclasse'] == 2 || $_SESSION['idclasse'] == 1) {
    $userCheck = 'Client';
} else {
    header("Location: login.php");
}

$sqlphoto = "SELECT photo FROM sta_etudiant WHERE idetudiant = " . $_SESSION['code'];
$q1 = $connection->query($sqlphoto);
$ligne = $q1->fetch();

$sqlticket = "SELECT *,count(id_ticket) as nbticket FROM sta_ticket t, sta_etudiant e WHERE t.id_etudiant=e.idetudiant AND statut = 'En attente' ORDER BY t.date_ticket asc";
$q2 = $connection->query($sqlticket);
$reponse = $q2->fetchAll();

$sqlnbticket = "SELECT count(id_ticket) as nbticket FROM sta_ticket t WHERE statut = 'En attente'";
$q3 = $connection->query($sqlnbticket);
$reponse3 = $q3->fetch();
$nbticket = $reponse3['nbticket'];


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dashboard</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
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
    <!-- Side Navbar -->
    <nav class="side-navbar">
        <div class="side-navbar-wrapper">
            <!-- Sidebar Header    -->
            <div class="sidenav-header d-flex align-items-center justify-content-center">
                <!-- User Info-->
                <div class="sidenav-header-inner text-center"><img src="img/avatar/<?php echo $ligne['photo']?>"
                        alt="person" class="img-fluid rounded-circle">
                    <h2 class="h5"><?php echo $_SESSION['nom']." ".$_SESSION['prenom'] ?></h2><span><?php echo $_SESSION['nomClasse']?></span>
                </div>
                <!-- Small Brand information, appears on minimized sidebar-->
                <div class="sidenav-header-logo"><a href="index.html" class="brand-small text-center">
                        <strong>R</strong><strong class="text-primary">S</strong></a></div>
            </div>
            <!-- Sidebar Navigation Menus-->
            <?php
            if ($userCheck == 'Admin') {
            ?>
            <div class="main-menu">
                <h5 class="sidenav-heading">Main</h5>
                <ul id="side-main-menu" class="side-menu list-unstyled">
                    <li><a href="index.php"> <i class="fas fa-home"></i>DASHBOARD </a></li>
                    <li><a href="gestionEleves.php"> <i class="fas fa-user-graduate"></i>GESTION ELEVES </a></li>
                    <li><a href="gestionEntreprises.php"> <i class="fas fa-building"></i>GESTION ENTREPRISES </a></li>
                    <li><a href="gestionPeriodes.php"> <i class="fas fa-calendar-alt"></i>PERIODES </a></li>
                </ul>
            </div>
            <?php } else if ($userCheck == "Client") {?>
            <div class="etud-menu">
                <h5 class="sidenav-heading">Etudiant</h5>
                <ul id="side-admin-menu" class="side-menu list-unstyled">
                    <li> <a href="index.php"> <i class="icon-screen"> </i>DASHBOARD</a></li>
                    <li> <a href="eleve.php?ideleve=<?php echo $_SESSION['code']?>"> <i class="icon-screen"> </i>PROFIL</a></li>
                    <li> <a href="#"> <i class="icon-screen"> </i>RECHERCHE</a></li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </nav>
    <div class="page">
        <!-- navbar-->
        <header class="header">
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-holder d-flex align-items-center justify-content-between">
                        <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars">
                                </i></a><a href="index.php" class="navbar-brand">
                                <div class="brand-text d-none d-md-inline-block"><img width="100" src="img/logo.png"></div>
                            </a></div>
                        <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                            <!-- Notifications dropdown-->
                            <?php
                            if ($userCheck == 'Admin') {
                            ?>
                            <li class="nav-item dropdown"> <a id="messages" rel="nofollow" data-target="#" href="#"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    class="nav-link"><i class="fa fa-envelope"></i><span
                                        class="badge badge-info"><?php echo $nbticket; ?></span></a>
                                <ul aria-labelledby="notifications" class="dropdown-menu">
                                    <?php 
                                    if ($nbticket!=0){
                                    foreach ($reponse as $affiche) {
                                        $nomEtudiant = $affiche['nom']." ".$affiche['prenom'];
                                        $photoEtudiant = $affiche['photo'];
                                        $motifTicket = $affiche['motif_ticket'];
                                        $dateTicket = date_create($affiche['date_ticket']);
                                    ?>
                                    <li><a rel="nofollow" href="#" class="dropdown-item d-flex">
                                            <div class="msg-profile"> <img src="img/avatar<?php echo $photoEtudiant?>"
                                                    alt="..." class="img-fluid rounded-circle"></div>
                                            <div class="msg-body">
                                                <h3 class="h5"><?php echo $nomEtudiant?></h3>
                                                <span><?php echo $motifTicket?></span><small><?php echo date_format($dateTicket, 'l j F Y');?></small>
                                            </div>
                                        </a>
                                    </li>
                                    <?php }} ?>
                                    <li><a rel="nofollow" href="gestionTicket.php"
                                            class="dropdown-item all-notifications text-center">
                                            <strong> <i class="fa fa-envelope"></i>Gestion des tickets </strong></a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                            <!-- Log out-->
                            <li class="nav-item"><a href="login.php" class="nav-link logout"> <span
                                        class="d-none d-sm-inline-block">Déconnexion</span><i
                                        class="fa fa-sign-out"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>