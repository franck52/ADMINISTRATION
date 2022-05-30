	<?php
		require('../utilisateurs/ma_session.php');
	?>

<?php

	require('../connexion.php');
	require('test.php');
	//session_start();
	
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$date_naissance=$_POST['date_naissance'];
	$lieu_naissance=$_POST['lieu_naissance'];
	$id_ctr=$_POST['adresse'];
	$ville=$_POST['ville'];
	$cin=$_POST['cin'];
	$numvotan=$_POST['taill'];
    $_SESSION["$taill"]=$cin;
	$annee_elect=$_POST['annee_electo'];


		$requete="UPDATE votant SET numvotan =?,id_centre=?,Nomvotant=?,prenom=?, 
		provincevot=?,annee_elect=?,datenaiss =?,lieunaiss=?,civilite=?
		 			where CNI=?";
					
	
		 $valeur=array($numvotan,$id_ctr,$nom,$prenom, $ville,$annee_elect,
		 $date_naissance, $lieu_naissance,$civilite,$cin);
	    $resultat=$pdo->prepare($requete);
	    $resultat->execute($valeur);
	
	

	// $requete_insert_stag="INSERT INTO votant VALUES(?,?,?,?,?,?,?,?,?,?)";
	// $valeurs_insert_stag=array($taill,$id_centre,$nom,$prenom,$ville,
	// 				$date_inscription,$date_naissance,$lieu_naissance,$cin,$civilite
	// 				);
					
	// $resultat_insert_stag=$pdo->prepare($requete_insert_stag);
	// $resultat_insert_stag->execute($valeurs_insert_stag);
	
						
	
	
	$msg= "Electeur modifié avec succès";
	$url="votant/page_info_update_electeur.php?id= $cin";		
	header("location:../message.php?msg=$msg&color=v&url=$url");