<?php 
  require('../utilisateurs/ma_session.php');
  require_once('../connexion.php');
  require_once('../fonctions.php');
  $info_pv =$pdo->query("SELECT * FROM pv");
  $resultat = $info_pv->fetchAll();
  // determiner le nombre de centre de vote
  $s = getNbr_centre();
  $nbr_pv = getNbr_pv();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./style/liste_pv.css">
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
     <br><br><br>
	<div class="container" id="rep_pv_container">
		<div class="nbr_pv_dispo"> Vous avez <?php echo $nbr_pv; ?> PV disponible sur <?php echo $s; ?> PV.</div>
		<?php  foreach ($resultat as $rep) {
			# code...
		 ?>
		 <div class="le_pv_du_centre">
			<div class="entete">
				<div class="h_pv h_pv_id"><span class="mon_entete_span">Id du centre:</span>  <span class="mon_entete_span_id"><?php echo $rep['centre'];  ?></span></div>
				<div class="h_pv"> <span class="mon_entete_span">Nom du 1er Responsable:</span><span class="mon_entete_span_id"><?php echo $rep['nom_rep1'];  ?></span> </div>
				<div class="h_pv"><span class="mon_entete_span">Nom du 2e Responsable:</span><span class="mon_entete_span_id"><?php echo $rep['nom_rep2'];  ?></span> </div>
			</div>
			<div class="contenu_pv">
				<h3> Message:</h3>
				<p><?php echo $rep['message_pv'];  ?></p>
			</div>
		</div>

		<?php  }?>
	</div>

</body>
</html>