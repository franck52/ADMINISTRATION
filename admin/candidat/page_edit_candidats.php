<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
?>

<?php
require('../connexion.php');
$id =$_GET['id'];
$requete = $pdo->query("SELECT * FROM candidat WHERE id_cand='$id';");
$edt_cdt = $requete->fetch();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Modifier  </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/jquery-ui-1.10.4.custom.css">
    <link rel="stylesheet" href="../css/monStyle.css">

    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/jquery-ui-1.10.4.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/school.js"></script>
</head>

<body>
<?php include('../menu.php'); ?>
<br><br><br>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading" align="center"> Modifier le candidat</div>
        <div class="panel-body">

            <form method="post" action="update_candidat.php?id=<?php echo $_GET['id']?>" enctype="multipart/form-data">

                <!-- <input type="hidden" name="id" value="<?php echo $edt_cdt['id_cand']; ?>"> -->

                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2"> Nom </label>
                    <div class="col-sm-4">
                        <input required type="text" name="nom" id="nom" class="form-control"
                               value="<?php echo $edt_cdt['nomcand']; ?>">
                    </div>
                    <label for="prenom" class="control-label col-sm-2"> Prenoms</label>
                    <div class="col-sm-4">
                        <input required type="text" name="prenom" id="prenom" class="form-control"
                               value="<?php echo $edt_cdt['prencand']; ?>">
                    </div>
                </div>
                <!-- <br> -->
                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2"> ID centre </label>
                    <div class="col-sm-4">
                        <input required type="text" name="id_ctr" id="id_ctr" class="form-control"
                               value="<?php echo $edt_cdt['id_centre']; ?>">
                    </div>
                    <label for="nom" class="control-label col-sm-2">Ville</label>
                    <div class="col-sm-4">
                        <input required type="text" name="province" id="province" class="form-control"
                               value="<?php echo $edt_cdt['provincecand']; ?>">
                    </div>
                </div>
                <!-- <br> -->
                <button onclick="return confirm('Voulez-vous enregistrer les modificatios')"
                        type='submit'
                        class="btn btn-success btn-block"> Enregistrer
                </button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
