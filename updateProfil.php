<?php
include "header.php";

$id = $_REQUEST['id'];
if (isset($_REQUEST['submit'])) {

    $id = $_REQUEST['id'];
    $nom = $_REQUEST['nom'];
    $prenom = $_REQUEST['prenom'];
    $idclasse = $_REQUEST['idclasse'];
    $idpromotion = $_REQUEST['idpromotion'];
    $email = $_REQUEST['email'];
    $mdp = $_REQUEST['mdp'];
    $mdph = password_hash($mdp, PASSWORD_DEFAULT);
    $sql = "UPDATE sta_etudiant SET nom = ?,prenom = ?,idclasse = ?,idpromotion = ?,email = ?,mdp = ? WHERE idetudiant ='" . $id . "'";
    $q = $connection->prepare($sql);
    $q->execute(array($nom, $prenom, $idclasse, $idpromotion, $email, $mdph));
    header('location: profil.php');
}
?>

<body>
    <br>
    <div class="container">
        <h2>Modification de vos données</h2>
        <?php
        if (isset($erreur)) {
            echo $erreur;
        }
        ?>
        <?php
        $sql = "SELECT * FROM sta_etudiant WHERE idetudiant ='" . $id . "'";
        $q = $connection->query($sql);
        $row = $q->fetch();
        ?>

        <!--	//champs permettant de modifier les infos d'un client et d'enregistrer les modifs dans la bdd-->
        <div class="d-inline-flex p-2">
        <form method="GET" action="">
            <div class="form-group">
                <input type="hidden" class="form-control" id="example" name="id" value=<?php echo $id; ?>>
            </div>
            <div class="form-group">
                <label for="">Nom</label>
                <input type="text" class="form-control" id="example" name="nom" value=<?php echo $row['nom']; ?>>
            </div>
            <div class="form-group">
                <label for="">Prenom</label>
                <input type="text" class="form-control" id="example" name="prenom"
                    value="<?php echo $row['prenom']; ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" id="example" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="form-group">
                <label for="selectClasse">Classe</label>
                <br>
                <?php
                $sql = "SELECT * FROM sta_classe WHERE idclasse < 3  ";  
                $q = $connection->query($sql); ?>              
                <select name = 'idclasse' class="form-control" id="selectClasse" >
                <?php while ($ligne = $q->fetch()) {
                    if ($row['idclasse'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                } ?>
                </select>                
            </div>
            <div class="form-group">
                <label for="selectOption">Option</label>
                <br>
                <?php
                $sql = "SELECT * FROM sta_option WHERE idoption < 3  ";  
                $q = $connection->query($sql);?>            
                <select name = 'idoption' class="form-control" id="selectOption" >
                <?php while ($ligne = $q->fetch()) {
                    if ($row['idoption'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?>
            </div>
            <div class="form-group">
                <label for="selectPromotion">Promotion</label>
                <br>
                <?php
                $sql = "SELECT * FROM sta_promotion WHERE id_promotion > 1";
                $q = $connection->query($sql); ?>
                <select name = 'idpromotion' class="form-control" id="selectPromotion" >
                <?php while ($ligne = $q->fetch()) {
                    if ($row['idpromotion'] == $ligne[0])
                        echo "<option value=" . $ligne[0] . " selected='selected'>" . $ligne[1] . "</option>";
                    else
                        echo "<option value=" . $ligne[0] . ">" . $ligne[1] . "</option>";
                }
                echo "</select>";
                ?>
            </div>            
            <div class="form-group">
                <label for="">Mot de passe</label>
                <input type="text" class="form-control" id="example" name="mdp" value="">
            </div>
            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-check-square"></i> Valider</button>
            <a class="btn btn-danger" href="profil.php?"><i class="fas fa-backspace"></i> Retour</a>
        </form>
        </div>
    </div>

<?php include "footer.php";     ?>