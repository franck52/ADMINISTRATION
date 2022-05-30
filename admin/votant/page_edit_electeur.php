<?php
require('../utilisateurs/ma_session.php');
include("../fonctions.php");
require('../utilisateurs/mon_role.php');
require('../connexion.php');
$id_votant=trim($_GET['id']);
$requete_votant = "SELECT * FROM votant WHERE CNI ='$id_votant';";
$result_requete_votant = $pdo->query($requete_votant);
$le_votant = $result_requete_votant->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>  Modification </title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/jquery-ui-1.10.4.custom.css">
    <link rel="stylesheet" href="../css/monStyle.css">

    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/jquery-ui-1.10.4.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <script src="../js/school.js"></script>

    <script src="js/jquery-ui-i18n.min.js"></script>
    <script>
        $(function () {
            // définit les options par défaut du calendrier
            $.datepicker.setDefaults({
                showButtonPanel: true,// affiche des boutons sous le calendrier
                showOtherMonths: true, // affiche les autres mois
                selectOtherMonths: true // possibilités de sélectionner les jours des autres mois
            });

            //$("#calendar").datepicker(); // affiche le calendrier par défaut
            //$("#calendar").datepicker($.datepicker.regional["fr"]); // affiche le calendrier en fr
            $("#calendar").datepicker({
                dateFormat: "yy",

            });
            $("#calendar1").datepicker({
                dateFormat: "yy-mm-dd",

            });
        });
    </script>


</head>

<body>
<?php include('../menu.php'); ?>
<br><br><br>
<div class="container">


    <div class="panel panel-primary">
        <div class="panel-heading" align="center">Modifier les informations de l'électeur</div>
        <div class="panel-body">
            <form method="post" action="edit_electeur.php" enctype="multipart/form-data">

                <div class="row my-row">
                    <label for="prenom" class="control-label col-sm-2"> PRENOM </label>
                    <div class="col-sm-4">
                        <input  required type="text" name="prenom" id="prenom" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['prenom'];} ?>">
                    </div>


                    <label for="nom" class="control-label col-sm-2"> Nom </label>
                    <div class="col-sm-4">
                        <input required type="text" name="nom" id="nom" class="form-control"value="<?php foreach($le_votant as $votant){
                            echo $votant['Nomvotant'];} ?>">
                    </div>

                </div>


                <div class="row my-row">
                    <label for="calendar1" class="control-label col-sm-2"> DATE_NAISSANCE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="date_naissance" id="calendar1" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['datenaiss'];} ?>">
                    </div>

                    <label for="lieu_naissance" class="control-label col-sm-2">LIEU_NAISSANCE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="lieu_naissance" id="lieu_naissance" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['lieunaiss'];} ?>">
                    </div>

                </div>

                <div class="row my-row">
                    <label for="adresse" class="control-label col-sm-2">ID CENTRE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="adresse" id="adresse" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['id_centre'];} ?>">
                    </div>

                    <label for="ville" class="control-label col-sm-2"> VILLE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="ville" id="ville" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['provincevot'];} ?>">
                    </div>

                </div>

                <div class="row my-row">
                    <label for="cin" class="control-label col-sm-2"> N°CIN </label>
                    <div class="col-sm-4">
                        <input required type="text" name="cin" id="cin" class="form-control"
                        value="<?php foreach($le_votant as $votant){
                            echo $votant['CNI'];} ?>">
                    </div>

                    <label for="tel" class="control-label col-sm-2">N°VOTANT </label>
                    <div class="col-sm-4">
                        <input required type="text" name="taill" id="taill" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['numvotan'];} ?>">
                    </div>

                </div>


                <div class="row my-row">
                    <label for="calendar" class="control-label col-sm-2">ANNEE ELECTORALE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="annee_electo" id="calendar" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['annee_elect'];} ?>">
                    </div>

                    <label for="code_national" class="control-label col-sm-2"> CIVILITE </label>
                    <div class="col-sm-4">
                        <input required type="text" name="civilite" id="" class="form-control" value="<?php foreach($le_votant as $votant){
                            echo $votant['civilite'];} ?>">
                    </div>
                    <br><br>
                </div>
               
                <button type='submit' class="btn btn-success btn-block"> Enregistrer</button>
              

            </form>
        </div>
    </div>
</div>
</body>
</html>
