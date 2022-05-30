
<?php
require('../utilisateurs/ma_session.php');
require_once('../connexion.php');
require_once('../mes_autres_fonction.php');
require_once('../fonctions.php');

$lastElt = getLastElection();
$le_nbr_annees_elts =nombre_annee_electorale();
if(isset($_GET["annee_elect"])){
 $annee_elect = $_GET["annee_elect"];
}else{$annee_elect = annee_electorale_actuelle();}

 if(isset($_GET["id_elto"])){
 $id_elto = $_GET["id_elto"];
}else{$id_elto = $lastElt;}

// recuperation des centre de votes
$req_centre_de_vote = $pdo->query("SELECT * FROM centre_vote");
$centre_de_vote = $req_centre_de_vote->fetchAll(); 

     //trouver  les differents centres
if (isset($_POST['centr'])) {
        # code...
    $centre_trv = $_POST['centr'];}else{ $centre_trv =0;}  

// selection des elections
$req_elect = "SELECT * FROM election";
$result_req_elect = $pdo->query($req_elect);
$reponses_req = $result_req_elect->fetchAll();
$annedata = date_parse("10/12/1995");
$jour = $annedata['day'];


$ae = les_differentes_annees_electo($annee_elect);
$type = type_election($id_elto);
$n = getEffectiftotal($ae, $type);
$n1 = getEffectifcand1($ae, $type);
$n2 = getEffectifcand2($ae, $type);
$n3 = getEffectifcand3($ae, $type);
$n4 = getEffectifcand4($ae, $type);
if ($n!=0) {
                # code...
    $taux =number_format((($n1+$n2+$n3+$n4)*100)/$n,2);

}else{$taux=0;}

?>
<!DOCTPE html>
<html>
<head>
 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
         <!--    <script type="text/javascript">
              google.charts.load('current', {'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {

                var data = google.visualization.arrayToDataTable([
                  ['Task', 'Hours per Day'],
                  ['Work',     11],
                  ['Eat',      2],
                  ['Commute',  2],
                  ['Watch TV', 2],
                  ['Sleep',    7]
                ]);
              
                var options = {
                  title: 'My Daily Activities'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
              }
          </script> -->
      </head>
      <meta charset="utf-8"/>
      <title>Tableau de bord</title>
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
      <script src="../js/jquery-1.10.2.js"></script>
      <script src="../js/bootstrap.min.js"></script>
      <script type="text/javascript" src="../js/menu.js"></script>
      <link rel="stylesheet" type="text/css" href="../js/menu.css">
      <!-- new  -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  </head>

  <body>

    <?php include('../menu.php'); ?> 
    <br><br>
    <br><br>
    <br><br>
    <div class="container  tableau-stat text-center">
        <div class="panel panel-primary">
            <div class="panel-heading">les resultats</div>
            <br>
            <div class="panel-body">
                <form class="form-inline" >
                    <select class="form-control" 
                    name="annee_elect"
                    onChange="this.form.submit();">

                    <?php 
                    $les_annees=les_annee_electorale();
                    foreach($les_annees as $annee){ 
                        ?>
                        <option <?php if($annee == $annee_elect) echo 'selected' ?>> 
                            <?php echo $annee; ?>
                        </option>

                    <?php } ?>
                
                <select class="form-control" name="id_elect" onChange="this.form.submit();">
                    <select class="form-control" name="id_elto"
                    onChange="this.form.submit();"  >

                    <?php foreach($reponses_req as $reponse) {?>        
                        <option 
                        value="<?php echo $reponse['idElect']?>" 
                        <?php if($reponse['idElect'] === $id_elto) echo 'selected'?>>
                        <?php echo  $reponse['type_elt'] ?>  
                         
                    </option>                           
                <?php  } ?> 

            </select>
            <button class="btn btn-primary" name="sub_mit">
                <span class="fa fa-search btn-block"></span>
            </button>
        
    </form>
</div>
</div>
<h1 class="text-center text-primary">Resultats electorale <?php echo $ae ?></h1>
<div class="row">

    <!-- ************ Total des inscrits  ******************  -->

    <div class="col-md-4">
        <div class="stat stat12">
            <span class="fa fa-users"></span>
            <div class="effectif">
                Efectif total des votants
                <div class="nbr"><?php echo $n ?></div>
            </div>

        </div>
    </div>

    <!-- ************* Total votes candidat 1*****************  -->

    <div class="col-md-4">
        <div class="stat stat1">
            <span class="fa fa-user"></span>
            <div class="effectif">
                TOTO Ali
                <div class="nbr"><?php echo $n1 ?> </div>
            </div>
        </div>
    </div>

    <!-- ************* Total votes candidat 2 *****************  -->


    <div class="col-md-4">
        <div class="stat stat2">
            <span class="fa fa-user"></span>
            <div class="effectif">
                CROOS Toni
                <div class="nbr"><?php echo $n2 ?> </div>
            </div>
        </div>
    </div>



</div>
<br>
<div class="row">

    <!-- ************ Taux de participassion ******************  -->

    <div class="col-md-4">
        <div class="stat stat12">
            <span class="fa fa-users"></span>
            <div class="effectif">
                Taux de participassion
                <div class="nbr"><?php echo $taux."%" ?></div>
            </div>

        </div>
    </div>

    <!-- ************* Total votes candidat 3  *****************  -->

    <div class="col-md-4">
        <div class="stat stat1">
            <span class="fa fa-user"></span>
            <div class="effectif">
                BIEBER Becky
                <div class="nbr"><?php echo $n3 ?> </div>
            </div>
        </div>
    </div>

    <!-- ************* Total votes candidat 4 *****************  -->


    <div class="col-md-4">
        <div class="stat stat2">
            <span class="fa fa-user"></span>
            <div class="effectif">
                CARTER Austin
                <div class="nbr"><?php echo $n4 ?> </div>
            </div>
        </div>
    </div>



</div>
</div>
<!-- <div id="piechart" style="width: 900px; height: 500px;"></div> -->
<br><br>

<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading">Taux de participassion par secteur</div>
        <div class="panel-body">
            <!-- <div class="container"> -->
                <div class="panel panel-success margetop">
                 <!-- <div class="panel-heading">Taux de participassion par secteur</div> -->
                 <div class="panel-body">
                  <form method="POST" action="info_resultat.php" class="form-inline navbar-form pull-right">
                    <div class="form-group">
                        <select class="form-control" 
                     name="annee_elect"
                     onChange="this.form.submit();">

                     <?php 
                     $les_annees=les_annee_electorale();
                     foreach($les_annees as $annee){ 
                        ?>
                        <option <?php if($annee == $annee_elect) echo 'selected' ?>> 
                            <?php echo $annee; ?>
                        </option>

                    <?php } ?>
                    
                </select>
                <select class="form-control" name="id_elto"
                onChange="this.form.submit();"  >

                <?php foreach($reponses_req as $reponse) {?>        
                    <option 
                    value="<?php echo $reponse['idElect']?>" 
                    <?php if($reponse['idElect'] === $id_elto) echo 'selected'?>>
                    <?php echo  $reponse['type_elt'] ?>  
                    
                </option>                           
            <?php  } ?> 

        </select>
                 &nbsp;&nbsp;
                 <select class="form-control" name="centr" id="centr" onChange="this.form.submit();">
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
                <!-- <input type="text" name="" class="form-control" placeholder="nom"> -->
                <!-- <input class="form-control" type="text" placeholder="l'année accademique" name="ak"></input>   -->
            </div>
            
            <button class="btn btn-success" type="submit" name="sub1" > <span class="glyphicon glyphicon-search"></span> RECHERCHE.. </button>
        </form>
    </div>
</div> 




<table class="table table-striped">
    <thead>
        <tr>
            <th>N°candidat</th><th>Nom</th><th>Prénoms</th> <th>Nombre de voix</th><th>Pourcentage</th><th>Centre</th> 


        </tr>
    </thead>


</table>
</div>
</div>


</div>
</body>
</html>
