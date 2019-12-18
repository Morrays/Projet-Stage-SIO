<?php
session_start();
if (ISSET ($_REQUEST["erreur"])){
    echo $_REQUEST["erreur"];
}
include 'connexion.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">

<head>
    <title>Recherche de stage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin-ext" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.7.3/themes/base/jquery-ui.css" />
    <script src="main.js" type="text/javascript"></script>
</head>
<header>
    <?php
        include 'barrenav.php';
<<<<<<< HEAD
    ?>
</header>

<body>
    <!-- Modal // ajout  BootStrap + JS -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Vous devez être connecté pour accéder à la recherche</p>
                    <img src="images/tenor.gif" alt="Tenor qui branche un fil" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin modal -->
    <br><br><br>
    <div id="conteneurlog">
        <div id="login" class="">
            <form action="connexionetudiant.php" method="POST" class="form-signin" id="login">
                <h1 class="h3 mb-3 font-weight-normal">Identification</h1>
                <label for="inputNom" class="sr-only">Nom</label>
                <input type="text" id="inputNom" class="form-control" placeholder="Nom" name="nom" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp"
                    required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
                <a onclick="registerForm()">Créer un compte</a>
            </form>
        </div>
=======
        ?>
    </header>
    <body>
        <!-- Modal // ajout  BootStrap + JS -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Vous devez être connecté pour accéder à la recherche</p>
                        <img src="images/tenor.gif" alt="Tenor qui branche un fil"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin modal -->
        <br><br><br>
                <div id="conteneurlog">
                        <div id="partieconnect" >
                            <a class="hiddenanchor" id="toregister"></a>
                            <a class="hiddenanchor" id="tologin"></a>
                            <div id="wrapper">
                                <div id="login" class="animate form">
                                    <!-- <form  action="connexionetudiant.php" method="POST">
                                        champs pour se connecter avec son compte, appelle laconnexion.php
                                        <br><br><br><br>
                                        <h1>Se connecter</h1>
                                        <br>
                                            <p>
                                                Nom : <input type="text" name="nom" value="" /><br />
                                            </p>
                                            <p>
                                                Mdp : <input type="password" name="mdp" value="" /><br />
                                            </p>
                                            <p>
                                                <input class="button" type="submit" value="Connexion" />
                                            </p>
                                    </form> -->
>>>>>>> d249f2501a39da8448053a267dd116ced77c01a9

        <div class="hidden" id="register">
            <form action="newetudiant.php" method="GET" class="form-signin">

<<<<<<< HEAD
                <h1 class="h3 mb-3 font-weight-normal">Créer un compte</h1>
                <label for="inputNom" class="sr-only">Nom</label>
                <input type="text" id="inputNom" class="form-control" placeholder="Nom" name="nom" required autofocus>
                <label for="inputPrenom" class="sr-only">Prenom</label>
                <input type="text" id="inputPrenom" class="form-control" placeholder="Prenom" name="prenom" required
                    autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp"
                    required>
                <label for="inputMail" class="sr-only">Mail</label>
                <input type="email" id="inputMail" class="form-control" placeholder="name@example.com" name="email"
                    required>

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
                ?>

                <?php
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
                <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Photo :</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                <input name="fichier" type="file" id="fichier_a_uploader" />
                <input type="submit" name="submit" value="Uploader" />


                <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
                <a onclick="loginForm()">Connexion</a>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous" />
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous" />
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous" />
    </script>
    <script type="text/javascript">
    var op = <?PHP echo(!empty($_GET['err']) ? json_encode($_GET['err']) : '""'); ?> ;
    if (op == 1) {
        $('#exampleModalCenter').modal('show');
    }
    </script>
</body>

</html>
=======
                                </div>
                            </div>
                        </div>
                    <div id="register" class="animate form">
                        <!--//champs pour se créer un compte et l'ajouter a la bdd-->
                        <h1>Créer un compte</h1>
                        <br>
                            <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <fieldset>
                                    <p>
                                        <label for="fichier_a_uploader" title="Recherchez le fichier à uploader !">Photo :</label>
                                        <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_SIZE; ?>" />
                                        <input name="fichier" type="file" id="fichier_a_uploader" />
                                        <input type="submit" name="submit" value="Uploader" />
                                    </p>
                                </fieldset>
                            </form>
                            <form  action="newetudiant.php" method="GET">
                                <p>
                                    Nom : <input type="text" name="nom" value="" /><br />
                                </p>
                                <p>
                                    Prénom : <input type="text" name="prenom" value="" /><br />
                                </p>
                                <p>
                                    Classe :
                                    <?php
                                    $sql = "SELECT * FROM sta_classe WHERE idclasse < 3";
                                    $q = $connection->query($sql);
                                    echo "<select name = 'classe' >";
                                    while ($ligne = $q->fetch()) {
                                        if ($row['libelle_classe'] == $ligne[0])
                                            echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                                        else
                                            echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </p>
                                <p>
                                    Option :
                                    <?php
                                    $sql = "SELECT * FROM sta_option WHERE idoption <3";
                                    $q = $connection->query($sql);
                                    echo "<select name = 'option' >";
                                    while ($ligne = $q->fetch()) {
                                        if ($row['libelle_option'] == $ligne[0])
                                            echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                                        else
                                            echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </p>
                                <p>
                                    Promotion :
                                    <?php
                                    $sql = "SELECT * FROM sta_promotion WHERE id_promotion > 1";
                                    $q = $connection->query($sql);
                                    echo "<select name = 'promotion' >";
                                    while ($ligne = $q->fetch()) {
                                        if ($row['libelle_promotion'] == $ligne[0])
                                            echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                                        else
                                            echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                                    }
                                    echo "</select>";
                                    ?>
                                </p>
                                <p>
                                    Mail : <input type="text" name="email" value="" /><br />
                                </p>
                                <p>
                                    Mdp : <input type="password" name="mdp" value="" /><br />
                                </p>
                                <input type="submit" name="submit" value="Créer" />
                            </form>
                    </div>
                </div>
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"/></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"/></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"/></script>
                    <script type="text/javascript">
                        var op = <?PHP echo (!empty($_GET['err']) ? json_encode($_GET['err']) : '""'); ?>;
                        if (op == 1) {
                            $('#exampleModalCenter').modal('show');
                        }

                    </script>
    </body>
</html>
>>>>>>> d249f2501a39da8448053a267dd116ced77c01a9
