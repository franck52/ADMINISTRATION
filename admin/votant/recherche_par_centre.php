	<?php
		require('../utilisateurs/ma_session.php');
	?>


	<?php
		include("../fonctions.php");
		
		require('../connexion.php');

		$lastElt = getLastElection();//ID DE LA DERNIERE ELECTION
		$requete="SELECT * FROM votant";
		$stmt = $pdo->query($requete);
		if (isset($_POST['sub1'])) {
		   	$idcentr=$_POST['centr'];
		   if ($_POST['centr'] ) {
		   	# code...
		   
		   	$requete="SELECT * FROM votant WHERE idElect ='$lastElt' AND id_centre LIKE'%$idcentr%'  ORDER BY Nomvotant;";
		   $stmt = $pdo->query($requete);
		   }elseif ($_POST['nomf']) {
		   	# code...
		   	$requete="SELECT * FROM votant WHERE idElect ='$lastElt' AND  Nomvotant='".$_POST['nomf']."' ORDER BY prenom;";
		   $stmt = $pdo->query($requete);
		   }
		   elseif ($_POST['c_ni']) {
		    	# code...
		   	$requete="SELECT * FROM votant WHERE idElect ='$lastElt' AND  CNI='".$_POST['c_ni']."';";
		    $stmt = $pdo->query($requete);
		    }
			}	
									
?>
<!DOCTPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title> Liste electorale </title> 
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		
	</head>
		
	<body>
	
		
	<?php include('../menu.php'); ?>
	<br><br>
	<div class="container">
        <h1 class="text-center">  </h1>
        <div class="panel panel-success margetop">
            <div class="panel-heading">RECHERCHE PAR CATEGORIE</div>
            <div class="panel-body">
            	<form method="POST" action="recherche_par_centre.php" class="form-inline navbar-form pull-right">
                     <div class="form-group">
         
                        <input class="form-control" type="text" placeholder="Nom de famille" name="nomf"></input>
                        <input class="form-control" type="text" placeholder="N° CNI" name="c_ni"></input> 

                        <select class="form-control" name="centr" id="centr">
                              <option value="0">Commune ou ville</option>
                              <option value="20P">PLATEAU</option>
                              <option value="21C">COCODY</option>
                              <option value="21BING">BINGERVILLE</option>
                              <option value="32PORT">PORTBOUET</option>
                              <option value="32KOUMA">KOUMASSI</option>
                              <option value="20ADJ">ADJAME</option>
                              <option value="21YOP">YOPOUGON</option>
                              <option value="32MARC">MARCORY</option>
                              <option value="10TREICH">TREICHEVILLE</option>
                              <option value="10ABOB">ABOBO</option>
                              <option value="20WILLI">WILIAMSVILE</option>
                       </select> 
        
                      </div>
      
                      <button class="btn btn-success" type="submit" name="sub1" > <span class="glyphicon glyphicon-search"></span> RECHERCHE.. </button>
                </form>
           </div>
        </div> 
        <div class="panel panel-primary">
				<div class="panel-heading">Liste électorale</div>
				<div class="panel-body">
		<table class="table table-striped table-bordered">
			<thead>
					<tr>
						<th>N° CNI </th> <th>ID Centre </th> <th>Nom </th> <th>Prénoms </th> 
						<th> Province </th> 	 <th> Année </th><?php if($role=="Directeur"){?><th> Actions</th><?php } ?>
						
					</tr>
			</thead>
				
			<tbody>
			
			<?php foreach($stmt as $votant){?>
			
			<tr>
				<td><?php echo $votant['CNI'] ?> </td>
				<td><?php echo $votant['id_centre'] ?> </td>
				<td><?php echo $votant['Nomvotant'] ?> </td>
				<td><?php echo $votant['prenom'] ?> </td>
				<td><?php echo $votant['provincevot'] ?> </td>
				<td><?php echo $votant['annee_elect'] ?> </td>

					<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
								<td> 
									<a href="page_valider.php?id=<?php echo $votant['numvotan']?>"><span class="fa fa-check-square-o"></span>
									</a>
									<a href="page_edit_electeur.php?id=<?php echo $votant['CNI']?>"><span class="fa fa-edit"></span>
									</a>	
									<a 
										onclick="return confirm('Etes-vous sûr de vouloir supprimer cette personne?')"
										href="delete_electeur.php?id=<?php echo $votant['CNI']?>"><span class="fa fa-trash"></span>
									</a>
										
								</td>
							<?php } ?>
			  </tr>
		    <?php } ?>
		   </tbody>
		</table>
	</div>
</div>

		<?php if($role=="Directeur"){?>		
		<a href="page_add_electeur.php" class="btn btn-primary">
			<span class="fa fa-plus"></span> NOUVEAU ELECTEUR 
		</a><?php } ?>
</div>
</body>
</html>




