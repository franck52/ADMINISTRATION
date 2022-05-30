
<?php
    require('../utilisateurs/ma_session.php');
	 require_once('../connexion.php');
    require_once('../fonctions.php');
    require_once('../mes_autres_fonction.php');
   /* if (isset($_POST['sub1'])) {
        # code...
        $idcand=$_POST['id_cand'];
        $ctr=$_POST['centr'];
        $requete=$pdo->query("SELECT count(id_bull) as total from bulletin WHERE id_cand='$idcand' and Ville='$ctr';");
        $stmt =$requete->fetch();
        $requete1="SELECT* from candidat WHERE id_cand='$idcand';";
        $stmt1 = $pdo->query($requete1);
         $requete2=$pdo->query("SELECT count(numvotan) as total2 from votant WHERE provincevot like'%$ctr%';");
        $stmt2 =$requete2->fetch();
        if ($stmt2['total2']!=0) {
            # code...
            $taux_centre=number_format((100*$stmt['total'])/$stmt2['total2'],2);
        }else{$taux_centre=0;}
        

        

    }*/
    // recuperation des centre de votes
    $req_centre_de_vote = $pdo->query("SELECT * FROM centre_vote");
    $centre_de_vote = $req_centre_de_vote->fetchAll(); 
     
     

    // $ae = annee_electorale_actuelle();

     $lastElt = getLastElection();
    $le_nbr_annees_elts =nombre_annee_electorale();
    if(isset($_POST["annee_elect"])){
       $annee_elect = $_POST["annee_elect"];
    }else{$annee_elect = annee_electorale_actuelle();}

    if(isset($_POST["id_elto"])){
       $id_elto = $_POST["id_elto"];
    }else{$id_elto = $lastElt;}
    //trouver  les differents centres
    if (isset($_POST['centr'])) {
        # code...
        $centre_trv = $_POST['centr'];}else{ $centre_trv =0;}  

    // selection des elections
    $req_elect = "SELECT * FROM election";
    $result_req_elect = $pdo->query($req_elect);
    $reponses_req = $result_req_elect->fetchAll();

    $ae = les_differentes_annees_electo($annee_elect);
    $type = type_election($id_elto);
    $n = getEffectiftotal($ae, $type);
    $n1 = getEffectifcand1($ae, $type);
    $n2 = getEffectifcand2($ae, $type);
    $n3 = getEffectifcand3($ae, $type);
    $n4 = getEffectifcand4($ae, $type);

    // $n = getEffectif12($ae);
    // $n1 = getEffectif1($ae);
    // $n2 = getEffectif2($ae);
    // $n3 = getEffectif3($ae);
    // $n4 = getEffectif4($ae);
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
</head>

<body>

<?php include('../menu.php'); ?> 
<br><br>
<div class="container  tableau-stat text-center">
    <h1 class="text-center text-primary">Resultat electoral <?php echo $ae ?></h1>
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
            <!-- <option value="0"> centre</option>
            <option value="10ABOB">ABOBO1</option>
            <option value="10ABO1">ABOBO2</option>
            <option value="10ABOB2">ABOBO3</option>
            <option value="20ADJ">ADJAME1</option>
            <option value="20ADJ1">ADJAME2</option>
            <option value="21BING">BINGERVILLE1</option>
            <option value="21BING1">BINGERVILLE2</option>
            <option value="21C">COCODY1</option>
            <option value="21C1">COCODY2</option>
            <option value="21C2">COCODY3</option>
            <option value="32KOUMA">KOUMASSI1</option>
            <option value="32KOUMA1">KOUMASSI2</option>
            <option value="32MARC">MARCORY1</option>
            <option value="32MARC2">MARCORY2</option>
            <option value="20P">PLATEAU1</option>
            <option value="20P2">PLATEAU2</option>
            <option value="32PORT">PORTBOUET1</option>
            <option value="32PORT2">PORTBOUET2</option>
            <option value="21YOP">YOPOUGON1</option>
            <option value="21YOP2">YOPOUGON2</option>
            <option value="10TREICH">TREICHEVILLE1</option>
            <option value="10TREICH2">TREICHEVILLE2</option>
            <option value="20WILLI">WILIAMSVILE1</option>
            <option value="20WILLI2">WILIAMSVILE2</option> -->
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
             <th>N°candidat</th><th>Nom</th><th>prenoms</th> <th>Nombre de voix</th><th>Pourcentage</th>  
                      
                        
        </tr>
        </thead>
                
        <tbody>

            <?php
                if (isset($_POST['sub1'])) {
                     # code...
                    $stmt=$pdo->query("SELECT id_cand, id_centre,count(id_cand) as points from bulletin where  id_centre='".$_POST['centr']."' AND idElect='".$_POST['id_elto']."' and datebull LIKE '%$ae%' group by id_cand;");
                 
                foreach($stmt as $res){ ?>
            
            <tr>
                
                <td><?php echo $res['id_cand'];?> </td>
                <td><?php $id=$res['id_cand'];
                $stmt=$pdo->query("SELECT nomcand as nom from candidat where  id_cand='".$id."';");
                $nom = $stmt->fetch();
                echo $nom['nom'];
                ?> </td>
                <td><?php $id=$res['id_cand']; 
                    $stmt=$pdo->query("SELECT prencand as prnom from candidat where  id_cand='".$id."';");
                    $nom = $stmt->fetch();
                    echo $nom['prnom'];
                ?> </td>
                <td><?php echo $res['points'];?> </td>
                <td><?php
                       $stmt=$pdo->query("SELECT numvotan,count(numvotan) as point_total from votant where  id_centre='".$_POST['centr']."' and annee_elect LIKE '%$ae%' ");
                        $nbr_user = $stmt->rowCount();
                                     
                        if ($nbr_user==1) {
                             # code...
                             $no=$stmt->fetch();
                             $point_total=$no['point_total'];
                             if ($point_total!=0) {
                                 # code...
                                 $prctag=number_format(($res['points']*100)/$point_total,2);
                                 echo $prctag.'%';
                            }
                        } 
                ?> </td>
                
               

                    
            </tr>
        <?php }}  ?>
            
          
        </tbody>
    </table>
    </div>
    </div>    
                
 </div>
</body>
</html>
