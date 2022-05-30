<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
require_once('../connexion.php');
require_once('../fonctions.php');
$lastElt = getLastElection();
// echo $lastElt;
if(isset($_GET["id_elto"])){
   $id_elto = $_GET["id_elto"];
}else{$id_elto = $lastElt;}

// recuperation des centre de votes
$req_centre_de_vote = $pdo->query("SELECT * FROM centre_vote");
$centre_de_vote = $req_centre_de_vote->fetchAll();
if (isset($_POST['id_ctr'])) {
        # code...
  $centre_trv = $_POST['id_ctr'];}else{ $centre_trv =0;} 


  // recuperation des villes ou communes
  $req_ville_ou_comm = $pdo->query("SELECT * FROM secteur");
  $ville_de_vote = $req_ville_ou_comm->fetchAll();
  if (isset($_POST['ville'])) {
        # code...
      $ville_trv = $_POST['ville'];}else{ $ville_trv =0;} 


// selection des elections
      $req_elect = "SELECT * FROM election";
      $result_req_elect = $pdo->query($req_elect);
      $reponses_req = $result_req_elect->fetchAll();


      ?>

      <!DOCTYPE html>
      <html>
      <head>
        <meta charset="utf-8"/>
        <title>bulletins</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <style type="text/css">
            @media (min-width: 768px) {
                #listeform {
                    margin-top:50px;
                }
            }
            .errors_form_eng{
              color: red;
              margin-top: 1px;
              left: 20%;
            }
        </style>
    </head>

    <body>
        <?php include('../menu.php'); ?>
        <br><br><br>
        <div class="container" id="listeform">
            <div class="panel panel-primary">
                <div class="panel-heading" align="center">Enregistrer bulletin</div>
                <div class="panel-body">

                    <form method="POST" action="traitement_sauvegarde.php" onsubmit="return soumettre();">
                      <!-- traitement_sauvegarde.php -->

                        <div class="row my-row">
                            <label for="nom" class="control-label col-sm-2"> Nom </label>
                            <div class="col-sm-4">
                                <select class="form-control" name="idcand" id="select_cand">
                                    <option value="0">Nom du candidant</option>
                                    <option value="1">TOTO Ali</option>
                                    <option value="2">CROOS Toni</option>
                                    <option value="3">BIEBER Becky</option>
                                    <option value="4">CARTER Austin</option>
                                   
                                </select>
                                <span class="errors_form_eng"  id="errors"></span>  
                                <!-- <input type="text" name="nom" id="nom" class="form-control"> -->
                            </div>


                            <label for="niveau_diplome" class="control-label col-sm-2">Ville ou commune</label>
                            <div class="col-sm-4">
                        <!-- <select class="form-control" name="centr" id="centr">
                            <option value="0">Ville ou commune</option>
                             <option value="ABOBO">ABOBO</option>
                             <option value="ADJAME">ADJAME</option>
                             <option value="BINGERVILLE">BINGER VILLE</option>
                            <option value="COCODY">COCODY</option>
                            <option value="KOUMASSI">KOUMASSI</option>
                            <option value="MARCORY">MARCORY</option>
                            <option value="PLATEAU">PLATEAU</option>
                            <option value="PORTBOUET">PORTBOUET</option>
                            <option value="YOPOUGON">YOPOUGON</option>
                            <option value="TREICHEVILLE">TREICHEVILLE</option>
                            <option value="WILIAMCIVILLE">WILIAMCIVILE</option>
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

                    <span class="errors_form_eng"  id="errors_ville"></span>
                 </div>

             </div>

             <!--  -->


             <div class="row my-row">
                <label for="enregistrement" class="control-label col-sm-2">Date</label>
                <div class="col-sm-4">
                    <input type="date" name="id_centre" id="id_centre" class="form-control" required>
                </div>

                <label for="frais_mansuel" class="control-label col-sm-2">Centre</label>
                <div class="col-sm-4">
                    
                 <select class="form-control" name="id_ctr" id="id_ctr">
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
                       <!--  <select class="form-control" name="id_ctr" id="id_ctr">
                              <option value="0">Références</option>
                              <option value="10ABOB">ABOBO</option>
                              <option value="20ADJ">ADJAME</option>
                              <option value="21BING">BINGERVILLE</option>
                              <option value="21C">COCODY1</option>
                              <option value="21C1">COCODY2</option>
                              <option value="21C2">COCODY3</option>
                              <option value="32KOUMA">KOUMASSI</option>
                               <option value="32MARC">MARCORY</option>
                              <option value="20P">PLATEAU</option>
                              <option value="32PORT">PORTBOUET</option>
                              <option value="10TREICH">TREICHEVILLE</option>
                              <option value="20WILLI">WILIAMSVILE</option>
                              <option value="21YOP">YOPOUGON</option> 
                          </select> -->
                          <span class="errors_form_eng" id="errors_centre"></span>
                      </div> 
                      
                  </div>
                  <div class="row my-row">
                    <label class="control-label col-sm-2" >Election</label>
                    <div  class="col-sm-4">
                        <select class="form-control" name="id_elto" id="elt">
                            <?php foreach($reponses_req as $reponse) {?> 
                                <option  
                                value="<?php echo $reponse['idElect']?>" 
                                <?php if($reponse['idElect'] === $id_elto) echo 'selected'?>>
                                <?php echo  $reponse['type_elt'] ?>  

                            </option> 
                        <?php  } ?> 
                    </select>  
                </div>
                <label class="control-label col-sm-2" ></label>
                <div  class="col-sm-4">
                    <input type="submit" name="sub_op2" class="btn btn-success btn-block" value="Enregistrer">
                </div>
            </div>

            <!-- <button type='submit' class="btn btn-success btn-block"> Enregistrer</button>  -->
        </form>
    </div>
</div>
</div>
<!-- creation du second formulaire -->
</div>
</body>
</html>
  <script type="text/javascript">
  
    var select = document.getElementById("select_cand");
    var ville = document.getElementById("ville");
    var centre = document.getElementById("id_ctr");
    var elt = document.getElementById("elt");
    var errors_cand = document.getElementById("errors");
    var errors_ville = document.getElementById("errors_ville");
    var errors_centre = document.getElementById("errors_centre");
    function soumettre(){
      var choice = select.selectedIndex;
      var city = ville.selectedIndex;
      var ctr = centre.selectedIndex;
      var type_elt = elt.selectedIndex;
     
         // alert(city);
      var valeur_cherchee = select.options[choice].value;
      var valeur_city = ville.options[city].value;
      var ctr_val = centre.options[ctr].value;
      // alert(ctr_val);
      if (valeur_cherchee==0) {
        errors_cand.innerHTML="choisiser un candidat!";
        return false;
      } else if (city==0) {
        errors_ville.innerHTML = "la ville est invalide ";
        return false;
      }else if(ctr==0) {
        errors_centre.innerHTML = "le centre est invalide ";
        return false;
      }
      else{
       console.log("enregistrement en cour...")
      }
      
     
    }
  </script>
