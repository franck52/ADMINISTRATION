<?php
    require('../utilisateurs/ma_session.php');
	 require_once('../connexion.php');
    require_once('../fonctions.php');
    $lastElt = getLastElection();
    $ae = annee_electorale_actuelle();
    $n = getEffectif12($ae);
    $n1 = getEffectif1($ae);
    $n2 = getEffectif2($ae);
    $n3 = getEffectif3($ae);
    $n4 = getEffectif4($ae);
    $re4=getResultat_cand4($ae);
    $re3=getResultat_cand3($ae);
    $re2=getResultat_cand2($ae);
    $re1=getResultat_cand1($ae);
    $total= $re1+$re2+$re3+$re4;

    modifier($n,$ae,$re1,$re2,$re3,$re4);
   
    $recherche=$pdo->query("SELECT * FROM candidat as cdt, resultat as rslt where rslt.idElect='$lastElt' and cdt.idElect='$lastElt' and  cdt.id_cand=rslt.id_cand and annee_elect LIKE'%$ae%' order by decision;");
   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Resultats </title> 
        
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../css/monStyle.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/bootstrap.min.js"></script> 
        <style type="text/css">
            @media (min-width: 768px) {
                #listeform {
                    margin-top:50px;
                }
            }
        </style>
        
    </head>
        
    <body>
    <!-- debut menu*************************************** -->
     <?php include('../menu.php'); ?> 
    <!--  fin **************************************** -->
    <br><br>
    <br><br>
    
    <div class="container" id="listeform">
        <div class="panel panel-primary">
            <div class="panel-heading">Les résultats</div>
            <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Numéro candidat</th> <th>Nom</th> <th>Prénoms </th> <th>Total </th><th>Pourcentage </th><th>Décision</th>
                    </tr> 
                </thead>
                    
                <tbody>
                    <?php foreach($recherche as $candidat){  ?>
                        
                        
                        <tr >
                            <td> <?php echo $candidat['id_cand'] ?></td> 
                            <td> <?php echo $candidat['nomcand']  ?></td> 
                            <td> <?php echo $candidat['prencand'] ?></td>
                            <td> <?php echo $candidat['nbrvoix'] ?> </td> 
                            <td> <?php echo $candidat['pourcentage']."%" ?> </td> 
                            <td> <?php echo $candidat['decision'] ?> </td>
                            
                          
                        </tr>
                    
                    <?php } ?>
                </tbody>

            </table> 
        </div> 
    </div>
    </div>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading"> resultats par secteur</div>
            <div class="panel-body">
                <div class="panel panel-success margetop">
                <form class="form-inline navbar-form pull-right" method="POST" action="publier_les_resultats.php">
                    <div class="form-group">
                       <select class="form-control" name="vil">
                        <option value="0">Localités</option>
                        <option value="ABOBO">ABOBO</option>
                        <option value="ADJAME">ADJAME</option>
                        <option value="BINGERVILLE">Bingerville</option>
                        <option value="COCODY">COCODY</option>
                        <option value="KOUMASSI">KOUMASSI</option>
                        <option value="MARCORY">MARCORY</option>
                        <option value="PLATEAU">PLATEAU</option>
                        <option value="PORTBOUET">PORTBOUET</option>
                        <option value="TREICHEVILLE">TREICHEVILLE</option>
                        <option value="YOPOUGON">YOPOUGON</option>
                        <option value="WILLIAMSVILLE">WILLIAMSVILLE</option>

                    </select> 
                      <!--   <select class="form-control" name="vil" id="vil" onChange="this.form.submit();" >
                            <option value="0">Localité</option>
                            <?php foreach ($Localite as $centre_elect) {
                               # code...
                               ?>
                               <option value="<?php echo $centre_elect['id_centre'] ?>"
                                   <?php if($centre_elect['id_centre'] === $centre_trv) { echo 'selected';} ?>>
                                   <?php echo $centre_elect['nomcentre'];  ?>
                               </option>
                           <?php  }?>

                       </select>  -->
                    </div>
                    <div class="form-group">
                        <input class="btn btn-success" type="submit" name="rech" value="Recherche">
                    </div>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr><th>numéro</th><th>nom</th><th>Prénoms</th><th>Points</th><th>Pourcentage</th><th>Localité</th></tr>
                    </thead>
                    <tbody>
                        <?php if (isset($_POST['rech'])) {
                            # code...
                            $stmt=$pdo->query("SELECT id_cand, ville,count(id_cand) as points from bulletin where  ville='".$_POST['vil']."' and datebull LIKE '%$ae%'AND idElect='$lastElt' group by id_cand;");

                        //}
                        foreach($stmt as $votant){?>
                        <tr><td><?php echo $votant['id_cand']; ?></td>
                            <td><?php $id=$votant['id_cand']; 
                            $stmt=$pdo->query("SELECT nomcand as nom from candidat where  id_cand='".$id."';");
                            $nom = $stmt->fetch();
                            echo $nom['nom']; 
                            ?></td>
                             <td><?php $id=$votant['id_cand']; 
                            $stmt=$pdo->query("SELECT prencand as prnom from candidat where  id_cand='".$id."';");
                            $nom = $stmt->fetch();
                            echo $nom['prnom']; 
                            ?></td>
                            <td><?php echo $votant['points']; ?></td>
                            <td><?php
                                    $stmt=$pdo->query("SELECT numvotan,count(numvotan) as point_total from votant where  provincevot='".$_POST['vil']."' and annee_elect LIKE '%$ae%' ");
                                    $nbr_user = $stmt->rowCount();
                                     
                                    if ($nbr_user==1) {
                                        # code...
                                        $no=$stmt->fetch();
                                        $point_total=$no['point_total'];
                                        if ($point_total!=0) {
                                            # code...
                                            $prctag=number_format(($votant['points']*100)/$point_total,2);
                                            echo $prctag.'%';
                                        }
                                    }
                             ?></td>
                             <td><?php echo $votant['ville'];  ?></td>
                            
                            
                        </tr>
                           <?php }} ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    </body>
    
</html>




