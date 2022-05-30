<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
?>
<?php
    require('../fonctions.php');
    require('../connexion.php');
    
       if (isset($_POST['sub'])) {
         # code...
         $commune = $_POST['id_ctr'];
         $id_secteur=getID_secteur($commune);
         $id_centre=$_POST['numo'];
         $matchef=$_POST['Chef_centre'];
         $nom_centre=$_POST['nom_centre'];
         //$communE=['id_ctr'];
         $statut= 0;

       if ($id_secteur!=0) {
         # code...
        //echo $id_secteur;
        $rech=$pdo->prepare("select id_centre FROM centre_vote where id_centre=?");
        $tab1=array($id_centre);
        $rech->execute($tab1);
        $val=$rech->rowCount();
        if ($val==1) {
          # code...
          $rech->fetch();
            $msg= "Cet identifiant est déjà utilisé!";
            $url="candidat/creer_centre.php";    
            header("location:../message.php?msg=$msg&color=v&url=$url");
        }else{
        $reqt=$pdo->prepare("insert into centre_vote(id_centre, matriculechef,nomcentre, addresse,statut, id_secteur) values(?,?,?,?,?,?)");
        $tableau=array($id_centre,$matchef,$nom_centre,$commune,$statut, $id_secteur);
        $reqt->execute($tableau);
        $msg= "centre ajouté!";
        $url="candidat/creer_centre.php";    
        header("location:../message.php?msg=$msg&color=v&url=$url"); }

       }else{
        $msg= "Secteur non existant!";
        $url="candidat/creer_centre.php";    
        header("location:../message.php?msg=$msg&color=v&url=$url");
       }
      
       }
      
     
   
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>centre</title>
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
        <div class="panel-heading" align="center">Enregistrer centre</div>
        <div class="panel-body">

            <form method="POST" action="creer_centre.php">

                <div class="row my-row">
                    <label for="nom" class="control-label col-sm-2">N° centre</label>
                    <div class="col-sm-4">
                       <input type="text" name="numo" id="num" class="form-control">
                    </div>


                    <label for="secteur" class="control-label col-sm-2">Chef de entre</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="Chef_centre">
                        <option value="0">nom</option>
                        <option value="C0120424">KANAN Maurice</option>
                        <option value="C0120425">KONE Mory</option>
                        <option value="C0120426">KABLAN Serge</option>
                      </select>
                    </div>

                </div>

            <!--  -->


               <div class="row my-row">
                    <label for="enregistrement" class="control-label col-sm-2">nom du centre</label>
                    <div class="col-sm-4">
                        <input type="text" name="nom_centre" id="nom_centre" class="form-control">

                    </div>

                   <label for="frais_mansuel" class="control-label col-sm-2">Secteur</label>
                    <div class="col-sm-4">
                        <select class="form-control" name="id_ctr" id="id_ctr">
                              <option value="0">Commune ou ville</option>
                              <option value="ABOBO">ABOBO</option>
                              <option value="ADJAME">ADJAME</option>
                              <option value="BINGERVILLE">BINGERVILLE</option>
                              <option value="COCODY">COCODY</option>
                              <option value="DIVO">DIVO</option>
                              <option value="KOUMASSI">KOUMASSI</option>
                               <option value="MARCORY">MARCORY</option>
                              <option value="PLATEAU">PLATEAU</option>
                              <option value="PORTBOUET">PORTBOUET</option>
                              <option value="TREICHEVILLE">TREICHEVILLE</option>
                              <option value="WILLIAMSVILLE">WILLIAMSVILLE</option>
                              <option value="YOPOUGON">YOPOUGON</option> 
                       </select>
                    </div> 
                    
                </div> 


                <button type='submit' name="sub" class="btn btn-success btn-block"> Enregistrer</button> 
            </form>
        </div>
    </div>
</div>
</body>
</html>
