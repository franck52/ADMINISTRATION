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

    if (isset($_POST['valider'])) {
            # code...
      $centre_trv = $_POST['centre'];}else{ $centre_trv =0;} 
       
     
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
             <meta charset="utf-8">
             <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
             <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
             <link rel="stylesheet" type="text/css" href="pv_bull_null.css">
             <script src="../js/jquery-1.10.2.js"></script>
             <script src="../js/bootstrap.min.js"></script>
             <script type="text/javascript" src="../js/menu.js"></script>
             <link rel="stylesheet" type="text/css" href="../js/menu.css">
             <!-- new  -->
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
             <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
               <title>pv et bulletin null</title>
           </head>
           <body>
               <?php include('../menu.php'); ?>  
               <br><br>
               <br><br>
               <br><br>
        <div class="container" id="pv_bull">
           <div class="div_pv" id="pv">
            <h3>Rediger Votre PV</h3>
            <p class="pv_p">Le PV relate l’ensemble des opérations électorales, les différents incidents, et comprend aussi les éventuelles protestations émises par des membres du bureau.</p>
            <div class="dipv">
             <!-- <header>votre description</header> onsubmit="return soumettre()" method="POST" action="pv.php" -->
             <div class="div_form_pv">
                <form class="formul_pv" id="save">
                    <p id="errors"></p>
                    <input class="iput_nom" type="text" name="nom1" placeholder="Nom du 1er representant" id="rep1">
                    <span style="height:2.5px;"></span>
                    <input type="text" name="nom2" placeholder="Nom du 2e representant" id="rep2">
                    <span style="height:2.5px;"></span>
                       <select class="form-control input_text" name="id_ctr" id="id_ctr">
                            <option value="0" id="n3"> Centre</option>
                            <?php foreach ($centre_de_vote as $cente_trouve) {
                                # code...
                               ?>
                               <option value="<?php echo $cente_trouve['id_centre'] ?>"
                                 <?php if($cente_trouve['id_centre'] === $centre_trv) { echo 'selected';} ?>>
                                 <?php echo $cente_trouve['nomcentre'];  ?>
                             </option>
                         <?php  }?>

                     </select>
                     
                    <textarea placeholder="Votre Message" id="textarea1"></textarea>
                    <input type="button" name="" value="Sauvegarder" id="btnv_valider">
                </form>
            </div>
        </div>
        </div>
        <div class="div_bull_null" id="bull_null">
          <h3>Enregistrer les bulletins null et blancs</h3>
          <p class="pv_bulnul">Ici, vous pouvez enregistrer les bulletin nulls et les bulletins non utilisés</p>
          <div class="div_form">
             <form id="myForm" class="form-group myform">
                <!-- onsubmit="return validation()"action="bulletin.php" -->
                <p id="errors2" class="errors2"></p>
                    <input type="number" name="qte" class="form-control input_text" id="n1" placeholder="nombre de bulletin null">
                        <select class="form-control input_text" name="ville" id="ville"  >
                                <option value="0" id="n2"> Ville ou commune</option>
                                    <?php foreach ($ville_de_vote as $ville_trouve) {
                                    # code...
                                    ?>
                                    <option value="<?php echo $ville_trouve['nom_secteur'] ?>"
                                        <?php if($ville_trouve['nom_secteur'] === $ville_trv) { echo 'selected';} ?>>
                                               <?php echo $ville_trouve['nom_secteur'];  ?>
                                           </option>
                                       <?php  }?>

                        </select>
                    <!-- <input type="text" name=""class="form-control input_text" id="n2"> -->
                       <select class="form-control input_text" name="centre" id="centre">
                          <option value="0" id="n3"> Centre</option>
                            <?php foreach ($centre_de_vote as $centre_trouve) {
                                # code...
                               ?>
                               <option value="<?php echo $centre_trouve['id_centre'] ?>"
                                 <?php if($centre_trouve['id_centre'] === $centre_trv) { echo 'selected';} ?>>
                                 <?php echo $centre_trouve['nomcentre'];  ?>
                             </option>
                         <?php  }?>
                        <!--  <option value="1234">CENTRE1</option>
                         <option value="5677">CENTRE2</option> -->

                     </select>
                       <select class="form-control input_text" name="id_elto">

                                        <?php foreach($reponses_req as $reponse) {?> 
                                            <option  
                                            value="<?php echo $reponse['idElect']?>" 
                                            <?php if($reponse['idElect'] === $id_elto) echo 'selected'?>>
                                            <?php echo  $reponse['type_elt'] ?>  

                                        </option> 
                                    <?php  } ?> 
                                </select>
                    <select class="form-control input_text" name="actionner">
                        <option  value="0"> bulletin null</option>
                        <option value="1"> bulletin blanc</option>
                    </select> 
                <!-- <input type="text" name="" class="form-control input_text" id="n3">
                <input type="text" name="" class="form-control input_text" id="n4">
                <input type="text" name="" class="form-control input_text" id="n5"> -->
                <input type="button" name="valider" class="form-control" id="btn_valider"  value="Valider">
            </form>
        </div>
        </div> 
        <div id="resultat_pv">
            <div class="liste_pv" ><a href="liste_pv.php">Liste pv</a></div>
            <div class="liste_bull_null_blancs"><a href="liste_bull_null_blancs.php">Bulletins nulls</a></div>
        </div>
        </div>
        <script type="text/javascript" src="./validation.js"></script>
        </body>
        </html>
        <script type="text/javascript">
            function _(element){
                return document.getElementById(element);
            }
            // var personne = {}
            // personne.name= "john";
            // personne.age=32;
            // var myString = JSON.stringify(personne);
            // var myObject = JSON.parse(myString);
            // console.log(myString);
            var btn_valider = _("btn_valider");
            var btnv_valider = _("btnv_valider");
            
            btn_valider.addEventListener('click', collect_data );
            btnv_valider.addEventListener('click', collection_data_pv );
           //fonction en rapport avec btn_valider
            function collect_data(){
                btn_valider.disabled = true;
                btn_valider.value = "Patienter svp...";
                var myForm = _("myForm");
                var nbr_voix = _("n1").value;
                // alert(nbr_voix);
                var selects = myForm.getElementsByTagName("SELECT");
                var data = {};
                data.qte=nbr_voix;
                for (var i = selects.length - 1; i >= 0; i--) {
                    var key = selects[i].name;
                    switch(key){
                        case "ville":
                              data.ville =selects[i].value;
                              break;
                        case "centre":
                               data.centre =selects[i].value;
                               break;

                        case "id_elto":
                              data.id_elto =selects[i].value;
                              break;
                        case "actionner":
                              data.actionner =selects[i].value;
                              break;
                              
                    }
                }
                send_data(data,"valider");
                
                //alert(JSON.stringify(data));
            }

            function send_data(data, type){
                var xml = new XMLHttpRequest();
                xml.onload = function(){
                    if (xml.readyState ==4 || xml.status ==200) {
                       handle_result( xml.responseText);
                       btn_valider.disabled = false;
                       btn_valider.value = "Valider";
                    }
                } 
               data.data_type = type;
               var data_string = JSON.stringify(data); 
               xml.open("POST","pv.php", true);
               xml.send(data_string); 
                

            }
          function handle_result(result){
            var data = JSON.parse(result);
            if (data.data_type == "info") {
               //redirection vers la page suivante
               //window.location=nom_de_page.extension
               var errors = _("errors2");
                errors.innerHTML = data.message;
            }else{
                var errors = _("errors2");
                errors.innerHTML = data.message;
            }

          }
          //fonction en rapport avec btnv_valider
            function collection_data_pv(){
                btnv_valider.disabled = true;
                btnv_valider.value = "Patienter svp...";
                var formul_pv = _("save");
                var ta = _("textarea1").value;
                var centre_de_votes = _("id_ctr").value;
                // alert(nbr_voix);
                var inputs = formul_pv.getElementsByTagName("INPUT");
                var data = {};
                data.ta = ta;
                data.centre_de_votes = centre_de_votes;
                for (var i = inputs.length - 1; i >= 0; i--) {
                    var key = inputs[i].name;
                    switch(key){
                        case "nom1":
                              data.nom1 =inputs[i].value;
                              break;
                        case "nom2":
                               data.nom2 =inputs[i].value;
                               break;     
                    }
                }
                sending_data(data,"save");
                
                //alert(JSON.stringify(data));
            }

             function sending_data(data, type){
                var xml = new XMLHttpRequest();
                xml.onload = function(){
                    if (xml.readyState ==4 || xml.status ==200) {
                       handle2_result( xml.responseText);
                       //alert(( xml.responseText));
                       btnv_valider.disabled = false;
                       btnv_valider.value = "Sauvegarder";
                    }
                } 
               data.data_type = type;
               var data_string = JSON.stringify(data); 
               xml.open("POST","api.php", true);
               xml.send(data_string); 
                

            }
            function handle2_result(result){
            var data = JSON.parse(result);
            if (data.data_type == "info") {
               //redirection vers la page suivante
               //window.location=nom_de_page.extension
               var errors = _("errors");
                errors.innerHTML = data.message;
            }else{
                var errors = _("errors");
                errors.innerHTML = data.message;
            }

          }
            
        </script>