<?php
require('../utilisateurs/ma_session.php');
include("../fonctions.php");
require('../utilisateurs/mon_role.php');
require('../connexion.php');

$requete_votant = "SELECT * FROM votant";
$result_requete_votant = $pdo->query($requete_votant);
$tous_les_votants = $result_requete_votant->fetchAll();

// recuperation des centre de votes
$req_centre_de_vote = $pdo->query("SELECT * FROM centre_vote");
$centre_de_vote = $req_centre_de_vote->fetchAll();
if (isset($_POST['centr'])) {
        # code...
  $centre_trv = $_POST['centr'];}else{ $centre_trv =0;} 


  // recuperation des villes ou communes
$req_ville_ou_comm = $pdo->query("SELECT * FROM secteur");
$ville_de_vote = $req_ville_ou_comm->fetchAll();
if (isset($_POST['ville'])) {
        # code...
  $ville_trv = $_POST['ville'];}else{ $ville_trv =0;} 

 // selection des elections
  $lastElt = getLastElection();
  $req_elect = "SELECT * FROM election";
  $result_req_elect = $pdo->query($req_elect);
  $reponses_req = $result_req_elect->fetchAll();
  if(isset($_GET["id_elto"])){
   $id_elto = $_GET["id_elto"];
 }else{$id_elto = $lastElt;}

 if(isset($_GET["annee_elect"])){
   $annee_elect = $_GET["annee_elect"];
 }else{$annee_elect = annee_electorale_actuelle();}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="utf-8"/>
  <title> Nouveau électeur </title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" href="../css/jquery-ui-1.10.4.custom.css">
  <link rel="stylesheet" href="../css/monStyle.css">
  <style type="text/css">
    .erreur_eng{ color: red; 
      font-size: 15px;
      flex: 2;}
  </style>

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
            <div class="panel-heading" align="center"> Nouveau électeur</div>
            <div class="panel-body">
              <form method="post" onsubmit="return confirmation_data();" action="insert_electeur.php" enctype="multipart/form-data">
              <!-- insert_electeur.php -->
                <div class="row my-row">
                  <label for="prenom" class="control-label col-sm-2"> PRENOM :</label>
                  <div class="col-sm-4">
                    <input required type="text" name="prenom" id="prenom" class="form-control">
                  </div>


                  <label for="nom" class="control-label col-sm-2"> Nom :</label>
                  <div class="col-sm-4">
                    <input required type="text" name="nom" id="nom" class="form-control">
                  </div>

                </div>


                <div class="row my-row">
                  <label for="calendar1" class="control-label col-sm-2"> DATE DE NAISSANCE :</label>
                  <div class="col-sm-4">
                    <input required type="text" name="date_naissance" id="calendar1" class="form-control">
                  </div>

                  <label for="lieu_naissance" class="control-label col-sm-2">LIEU DE NAISSANCE :</label>
                  <div class="col-sm-4">
                    <input required type="text" name="lieu_naissance" id="lieu_naissance" class="form-control">
                  </div>

                </div>

                <div class="row my-row">
                  <label for="adresse" class="control-label col-sm-2">ID CENTRE: </label>
                  <div class="col-sm-4">
                   <select class="form-control" name="centr" id="centr">
                    <option value="0"> Centre</option>
                    <?php foreach ($centre_de_vote as $cente_trouve) {
                    # code...
                     ?>
                     <option value="<?php echo $cente_trouve['id_centre'] ?>"
                       <?php if($cente_trouve['id_centre'] === $centre_trv) { echo 'selected';} ?>>
                       <?php echo $cente_trouve['nomcentre'];  ?>
                     </option>
                   <?php  }?>

                 </select>
                 <!-- <input required type="text" name="adresse" id="adresse" class="form-control"> -->
                <span id="erreur_centre" class="erreur_eng"></span>
               </div>

               <label for="ville" class="control-label col-sm-2"> VILLE :</label>
               <div class="col-sm-4">
               <!--  <select name="ville" id="ville" class="form-control">
                  <option value="0">ville ou commune</option>
                  <option value="ABOBO">ABOBO</option>
                  <option value="ADJAME">ADJAME</option>
                  <option value="BINGERVILLE">BINGERVILLE</option>
                  <option value="COCODY">COCODY</option>
                  <option value="KOUMASSI">KOUMASSI</option>
                  <option value="MARCORY">MARCORY</option>
                  <option value="PLATEAU">PLATEAU</option>
                  <option value="PORTBOUET">PORTBOUET</option>
                  <option value="TREICHEVILLE">TREICHEVILLE</option>
                  <option value="WILIAMCIVILLE">WILIAMSVILE</option>
                  <option value="YOPOUGON">YOPOUGON</option>
                </select> -->
                 <select class="form-control" name="ville" id="ville">
                    <option value="0"> Ville ou commune</option>
                    <?php foreach ($ville_de_vote as $ville_trouve) {
                    # code...
                     ?>
                     <option value="<?php echo $ville_trouve['nom_secteur'] ?>"
                       <?php if($ville_trouve['nom_secteur'] === $ville_trv) { echo 'selected';} ?>>
                       <?php echo $ville_trouve['nom_secteur'];  ?>
                     </option>
                   <?php  }?>

                 </select>
                <!-- <input required type="text" name="ville" id="ville" class="form-control"> -->
                  <span id="erreur_ville" class="erreur_eng"></span>
              </div>

            </div>

            <div class="row my-row">
              <label for="cin" class="control-label col-sm-2"> N°CNI: </label>
              <div class="col-sm-4">
                <input required type="text" name="cin" id="cin" class="form-control">
              </div>

              <label for="tel" class="control-label col-sm-2">TAILLE N°VOTANT :</label>
              <div class="col-sm-4">
                <input required type="text" name="taill" id="taill" class="form-control">
              </div>

            </div>


            <div class="row my-row">
              <label for="calendar" class="control-label col-sm-2">ANNEE ELECTORALE: </label>
              <div class="col-sm-4">
                <select class="form-control" 
                name="annee_elect">

                <?php 
                $les_annees=les_annee_electorale();
                foreach($les_annees as $annee){ 
                  ?>
                  <option <?php if($annee == $annee_elect) echo 'selected' ?>> 
                    <?php echo $annee; ?>
                  </option>

                <?php } ?>

              </select>
              <!-- <input required type="text" name="annee_elect" id="calendar" class="form-control"> -->
            </div>

            <label for="code_national" class="control-label col-sm-2"> CIVILITE: </label>
            <div class="col-sm-4">

              <select  class="form-control" name="civilite">
                <option>f</option>
                <option>m</option>
              </select>
            </div>
            <br><br>
          </div>
          <div class="row my-row">
            <label class="control-label col-sm-2">Election :</label>
            <div class="col-sm-4">
             <select class="form-control" name="id_elto">

              <?php foreach($reponses_req as $reponse) {?>        
                <option 
                value="<?php echo $reponse['idElect']?>" 
                <?php if($reponse['idElect'] === $id_elto) echo 'selected'?>>
                <?php echo  $reponse['type_elt'] ?>  

              </option>                           
            <?php  } ?> 

          </select>
        </div>
        <label class="control-label col-sm-2"></label>
        <div class="col-sm-4">
          <button type='submit' class="btn btn-success btn-block">Enregistrer</button>
        </div>
      </div>




    </form>
  </div>
</div>
</div>
</body>
</html>
<script type="text/javascript">
  function confirmation_data(){
    var centre = document.getElementById("centr");
    var erreur_centre = document.getElementById("erreur_centre");
    var erreur_ville =document.getElementById("erreur_ville");
    var cntr = centre.selectedIndex;
    var valeur_centre = centre.options[cntr].value;
    var ville_commune = document.getElementById("ville");
    var com_ville =  ville_commune.selectedIndex;
    var value_ville_comme =  ville_commune.options[com_ville].value;  
    if (valeur_centre==0) {
      erreur_centre.innerHTML ="Selectionner un centre!";
      return false;
    }else if (value_ville_comme==0) {
      erreur_ville.innerHTML ="Selectionner une ville!";
      return false;

    }
  }
</script>
