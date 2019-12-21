<?php
if (ISSET ($_REQUEST["erreur"])){
    echo $_REQUEST["erreur"];
}
include 'header.php';
?>

<br><br><br>
<div id="conteneurlog">
    <div id="login" class="">
        <form action="connexionetudiant.php" method="POST" class="form-signin" id="login">
            <h1 class="h3 mb-3 font-weight-normal">Identification</h1>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="text" id="inputEmail" class="form-control" placeholder="Email" name="email" required autofocus>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required>
            <br>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
            <br>
            <a style="font-size: 15px;color: white;" class="badge badge-primary" onclick="registerForm()">Créer un
                compte</a>
        </form>
    </div>

    <div class="hidden" id="register">
        <form action="newetudiant.php" method="GET" class="form-signin">

            <h1 class="h3 mb-3 font-weight-normal">Créer un compte</h1>
            <label for="inputNom" class="sr-only">Nom</label>
            <input type="text" id="inputNom" class="form-control" placeholder="Nom" name="nom" required autofocus>
            <br>
            <label for="inputPrenom" class="sr-only">Prenom</label>
            <input type="text" id="inputPrenom" class="form-control" placeholder="Prenom" name="prenom" required
                autofocus>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="mdp" required>
            <br>
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


            <button class="btn btn-lg btn-primary btn-block" type="submit">Créer</button>
            <br>
            <a style="font-size: 15px;color: white;" class="badge badge-primary" onclick="loginForm()">Connexion</a>
        </form>
    </div>
</div>

<!-- Modal // ajout  BootStrap + JS -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
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

<script type="text/javascript">
var op = <?PHP echo(!empty($_GET['err']) ? json_encode($_GET['err']) : '""'); ?> ;
if (op == 1) {
    $('#exampleModalCenter').modal('show');
}
</script>


<?php include 'footer.php'; ?>