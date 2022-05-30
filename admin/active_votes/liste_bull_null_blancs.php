<?php
 require('../utilisateurs/ma_session.php');
 require_once('../connexion.php');
 require_once('../fonctions.php');
 // total bulletin nulls
 $info_pv =$pdo->query("SELECT * FROM bulletin_null_blancs WHERE  type_bull=0");
 $resultat = $info_pv->fetchAll();
// total bulletin blancs
 $info_blancs =$pdo->query("SELECT * FROM bulletin_null_blancs WHERE  type_bull=1");
 $result = $info_blancs->fetchAll();

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <script src="../js/jquery-1.10.2.js"></script>
   <script src="../js/bootstrap.min.js"></script>
   <script type="text/javascript" src="../js/menu.js"></script>
   <link rel="stylesheet" type="text/css" href="../js/menu.css">
   <!-- new  -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>bulletins nulls</title>
</head>
<body>
	<?php include('../menu.php'); ?>
	<br><br><br>
	<div class="container" id="listeform">
        <div class="panel panel-primary">
            <div class="panel-heading">Bulletins nulls</div>
            <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Ville ou commune</th> <th>ID Centre</th> <th>Total bulletin </th>
                    </tr> 
                </thead>
                    
                <tbody>
                    <?php foreach($resultat as $res){  ?>
                        
                        
                        <tr >
                            <td> <?php echo $res['ville_commune'] ?></td> 
                            <td> <?php echo $res['centre']  ?></td> 
                            <td> <?php echo $res['qte'] ?></td>
                        </tr>
                    
                    <?php } ?>
                </tbody>

            </table> 
        </div> 
    </div>
        <div class="panel panel-primary">
            <div class="panel-heading">Bulletins non utilisés</div>
            <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Ville ou commune</th> <th>ID Centre</th> <th>Total bulletin </th>
                    </tr> 
                </thead>
                    
                <tbody>
                    <?php foreach($result  as $rep){  ?>
                        
                        
                        <tr >
                            <td> <?php echo $rep['ville_commune'] ?></td> 
                            <td> <?php echo $rep['centre']  ?></td> 
                            <td> <?php echo $rep['qte'] ?></td>
                        </tr>
                    
                    <?php } ?>
                </tbody>

            </table> 
        </div> 
    </div>
   </div>
   <br>
 
</body>
</html>