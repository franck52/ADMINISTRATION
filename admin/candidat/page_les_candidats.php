	
	<?php
		require('../utilisateurs/ma_session.php');
	?>
	
	
	<?php
				
		require('../connexion.php');
		
		
			$requete="SELECT * FROM candidat";
			$stmt = $pdo->query($requete);	
			//$toute_les_candidats=$stmt->fetchAll();
	?>		
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>  les Candidats </title> 
		
		<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../css/monStyle.css">
		<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
		
		<script src="../js/jquery-1.10.2.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		
	</head>
		
	<body>
	<!-- debut *************************************** -->
	<?php include('../menu.php'); ?>
	<!--  fin **************************************** -->
	<br><br>
		<div class="container">
			<h1 class="text-center"> Liste des candidats </h1>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Id candidat</th> <th>ID Centre</th> <th>Nom </th> <th>Prénoms </th><th>Province </th>
						<!-- <th> Frais mensuel </th> <th>Frais d'examen</th> <th> Frais de dipôme</th> -->
						<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
							<th> Actions </th>
						<?php } ?>
					</tr>
				</thead>
					
				<tbody>
					<?php foreach($stmt as $candidat){  ?>
						<!-- Pour chaque filiere de l'ensemble  toute_les_filieres -->
						
						<tr>
							<td> <?php echo $candidat['id_cand'] ?>  				</td> 
							<td> <?php echo $candidat['id_centre'] 	?>  			</td> 
							<td> <?php echo $candidat['nomcand'] ?> 			</td>
							<td> <?php echo $candidat['prencand'] ?> </td> 
							<td> <?php echo $candidat['provincecand'] ?> </td> 
							
							<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
								<td> 
									
									<a href="page_edit_candidats.php?id=<?php echo $candidat['id_cand']?>"><span class="fa fa-edit"></span>
									</a>	
									<a 
										onclick="return confirm('Etes-vous sûr de vouloir supprimer cette personne?')"
										href="delete_candidat.php?id=<?php echo $candidat['id_cand']?>"><span class="fa fa-trash"></span>
									</a>
										
								</td>
							<?php } ?>
						</tr>
					
					<?php } ?>
				</tbody>
			</table>
			<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
				<a href="page_add_candidat.php" class="btn btn-primary">Nouveau candidat </a>
			<?php } ?>
			<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
				<a href="creer_election.php" class="btn btn-primary">Céer élection</a>
			<?php } ?>
			<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
				<a href="creer_centre.php" class="btn btn-primary">Céer centre</a>
			<?php } ?>
			<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
				<a href="creer_secteur.php" class="btn btn-primary">Céer secteur</a>
			<?php } ?>
		</div>
	</body>
	
</html>




