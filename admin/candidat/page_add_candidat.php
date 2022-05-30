<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title> Nouveau candidat </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
<?php include('../menu.php'); ?>
<br><br><br>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading" align="center">Nouveau candidat</div>
        <div class="panel-body">

            <form method="post" action="insert_candidat.php">

                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2"> Nom </label>
                    <div class="col-sm-4">
                        <input type="text" name="nom" id="nom" class="form-control">
                    </div>


                    <label for="niveau_diplome" class="control-label col-sm-2">Prenoms</label>
                    <div class="col-sm-4">
                        <input type="text" name="prenoms" class="form-control" id="prenoms">

                    </div>

                </div>

                <div class="row my-row">
                    <label for="stage1" class="control-label col-sm-2"> Profession </label>
                    <div class="col-sm-4">
                        <input type="text" name="prof" id="prof" class="form-control">
                    </div>

                    <label for="stage2" class="control-label col-sm-2">N° candidat</label>
                    <div class="col-sm-4">
                        <input type="text" name="num" id="num" class="form-control">
                    </div>

                </div>


                <div class="row my-row">
                    <label for="frais_inscription" class="control-label col-sm-2">N° de centre de vote</label>
                    <div class="col-sm-4">
                        <input type="text" name="id_centre" id="id_centre" class="form-control">
                    </div>

                    <label for="frais_mansuel" class="control-label col-sm-2">Ville</label>
                    <div class="col-sm-4">
                        <input type="text" name="ville_cand" id="ville_cand" class="form-control">
                    </div>

                </div>

                <button type='submit' class="btn btn-success btn-block"> Enregistrer</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
