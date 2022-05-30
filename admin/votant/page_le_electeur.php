	<?php
		require('../utilisateurs/ma_session.php');
		
	?>


	<?php
	    
		include("../fonctions.php");
		
		require('../connexion.php');
		//require('../class_crypter.php');
		//require('insert_electeur.php');
		//$decrypter = new Crypter($chaine);
		$id_udser=trim($_GET['id']) ;
		//echo $id_udser;
		$requete="SELECT * FROM votant WHERE CNI='$id_udser';";
		$stmt = $pdo->query($requete);
				
?>
<!DOCTPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Information </title> 
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

			<h1 class="text-center"> Les informations enregistrées</h1>
			
			
			<table class="table table-striped">
				<thead>
					<tr>
						<th> Id votant </th><th>N° Carte électeur</th> <th>ID Centre </th> <th>Nom </th> <th>Prénoms </th> 
						<th> Province </th><th>Date de naissance</th><th>N°CNI</th><th>Civilité</th><th> Actions</th>
						
					</tr>
				</thead>
				
				<tbody>
			
			<?php foreach($stmt as $votant){?>
			
			<tr>
				<td><?php echo $votant['numvotan']?> </td>
				<td><?php echo $_SESSION['mdp']?> </td>
				<td><?php echo $votant['id_centre'] ?> </td>
				<td><?php echo $votant['Nomvotant'] ?> </td>
				<td><?php echo $votant['prenom'] ?> </td>
				<td><?php echo $votant['provincevot'] ?> </td>
				<td><?php echo $votant['datenaiss'] ?> </td>
				<td><?php echo $votant['CNI'] ?> </td>
				<td><?php echo $votant['civilite'] ?> </td>

					<?php if($_SESSION['user']['roles']=='Directeur'){  ?>
								<td> 
									
									<a href="page_edit_electeur.php?id=<?php echo $votant['CNI']?>" 
									><span class="fa fa-edit"></span>
									</a>	
									<a 
										onclick="return confirm('Etes-vous sûr de vouloir supprimer cette personne?')"
										href="delete_electeur.php?id=<?php echo $votant['numvotan']?>"><span class="fa fa-trash"></span>
									</a>
										
								</td>
							<?php } ?>
			</tr>
		<?php } ?>
		
			</table>
				</tbody>
				<a href="page_add_electeur.php" class="btn btn-primary">
					<span class="fa fa-plus"></span> NOUVEAU ELECTEUR 
				</a>
		</div>
	</body>
</html>




