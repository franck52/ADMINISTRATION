<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
require_once('../connexion.php');
?>
<?php 
  $maxId =$pdo->query("SELECT MAX(numero) AS recherche FROM election");
  while ($donnees = $maxId ->fetch()){$Last =$donnees['recherche'];}
   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Election</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
<?php include('../menu.php'); ?> 
<br><br>
<br><br>
<br><br>
<!-- creation du second formulaire -->
<div class="container">
    <div class="panel panel-primary">
        <div id="validateForm" class="panel-heading"  align="center">Nouvelle élection  <?php if (isset($_POST['submt_elt'])) { echo "enregistrée!";
            # code...
            $typeElt = $_POST['type_elt'];
            $codeElt = $_POST['code_elt'];
            $debutElt = $_POST['dt_dbt'];
            $finElt = $_POST['dt_fin'];
            $num_elt = $Last+1;
            $insertion = "INSERT INTO election(idElect, type_elt, date_dbt, date_fin, numero) value(?,?,?,?,?) ";
            $donnees = array($codeElt, $typeElt,  $debutElt, $finElt, $num_elt);
            $resultat = $pdo->prepare($insertion);
            $resultat->execute($donnees);

        }  ?> </div>
        <div class="panel-body">
            <form action="creer_election.php" method="POST"  onsubmit=" validateForm(event)">
                <div class="row my-row">
                    <label class="control-label col-sm-2">Code:</label>
                    <div class="col-sm-4">
                       <input id="code_elect" class="form-control" type="text" name="code_elt">
                       <span id="code_elect_errors"></span>
                    </div>  
                    <label class="control-label col-sm-2">Type d'élection:</label>
                    <div class="col-sm-4">
                        <input id="type_elect" class="form-control" name="type_elt"></input>
                        <span id="type_elect_errors"></span>
                    </div>
                </div>
                <div class="row my-row">
                    <label for="qte" class="control-label col-sm-2" >Date début:</label>
                    <div  class="col-sm-4">
                        <input type="date" name="dt_dbt" class="form-control" required>
                    </div>
                    <label class="control-label col-sm-2" >Date fin:</label>
                    <div  class="col-sm-4">
                        <input type="date" class="form-control" name="dt_fin" required> 
                        </input>
                    </div>
                </div>
                <div class="row my-row">
                    <label class="control-label col-sm-2" ></label>
                    <div  class="col-sm-4">
                        <!-- <input type="text" name="qte_eng" class="form-control"> -->
                    </div>
                    <label class="control-label col-sm-2" ></label>
                    <div  class="col-sm-4">
                        <input id="btnclick" type="submit" name="submt_elt" class="btn btn-success btn-block" value="Enregistrer">
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" >
    function validateForm(event) {
        let type = document.getElementById("type_elect").value;
        let code_elect = document.getElementById("code_elect").value;
        let code_elect_errors = "";
        if (code_elect =="") {
            event.preventDefault();
             document.getElementById("validateForm").innerHTML = " Remplissez tous les champs svp!"
            false;
        }
        if (type ==""){
             event.preventDefault();
             document.getElementById("validateForm").innerHTML = "Remplissez tous les chams svp!"
              
            false;
        } 
           
        
        
    }
</script>
</body>
</html>
