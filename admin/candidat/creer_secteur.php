<?php
require('../utilisateurs/ma_session.php');
require('../utilisateurs/mon_role.php');
?>
<?php 
require('../connexion.php');
if (isset($_POST['submit'])) {
        # code...
  $id_secteur=$_POST['num'];
  $nom_secteur= $_POST['secteur'];
  $recherch=$pdo->prepare("select* from secteur where id_secteur=?");
  $rech_tab=array($id_secteur);
  $recherch->execute($rech_tab);
  $resultat=$recherch->rowCount();
  if ($resultat==1) {
    $msg= "cet indentifiant de secteur existe déjà,veilez changer d'identifiant!";
    $url="candidat/creer_secteur.php";    
    header("location:../message.php?msg=$msg&color=v&url=$url");
    
  }else{
   $insertion=$pdo->prepare("insert into secteur VALUES(?,?)");
   $tbl=array($id_secteur,$nom_secteur);
   $insertion->execute($tbl);
   $recherch=$pdo->prepare("select* from secteur where id_secteur=?");
   $rech_tab=array($id_secteur);
   $recherch->execute($rech_tab);
   $resultat=$recherch->rowCount();
   if ($resultat==1) {
             # code...
     $msg= "secteur ajouté!";
     $url="candidat/creer_secteur.php";    
     header("location:../message.php?msg=$msg&color=v&url=$url");
   }else{
     $msg= "Erreur !";
     $url="candidat/creer_secteur.php";    
     header("location:../message.php?msg=$msg&color=v&url=$url");

   }

 }
 

}  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>Secteur</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
  <script src="../js/jquery-1.10.2.js"></script>
  <script src="../js/bootstra
  p.min.js"></script>
</head>
<body>
  <?php include('../menu.php'); ?>
  <br><br><br>
  <div class="container">
    <div class="panel panel-primary">
      <div class="panel-heading" align="center">Enregistrer secteur</div>
      <div class="panel-body">

        <form method="post" action="creer_secteur.php">

          <div class="row my-row">
            <label for="nom" class="control-label col-sm-2">N° secteur</label>
            <div class="col-sm-4">
             <input required type="text" name="num" id="num" class="form-control" placeholder="N° du secteur">
           </div>


           <label for="secteur" class="control-label col-sm-2">Nom du secteur</label>
           <div class="col-sm-4">
            <input required type="text" name="secteur" class="form-control" placeholder="ville ou commune">
          </div>

        </div>

        <!--  -->
        <br>
        <button type='submit' name="submit" class="btn btn-success btn-block"> Enregistrer</button> 
      </form>
    </div>
  </div>
</div>
</body>
</html>
