
<?php
	require('../utilisateurs/ma_session.php');
	require('../utilisateurs/mon_role.php');
?>


<?php
	
	
	require('../connexion.php');
	
	$nom=$_POST['nom'];
	$prenom_cand=$_POST['prenoms'];
	$id_cand=$_POST['num'];
	$prof_cand=$_POST['prof'];
	$id_centre=$_POST['id_centre'];
	$ville_cand=$_POST['ville_cand'];
	
	
	$requete="INSERT INTO candidat VALUES(?,?,?,?,?,?)";
	$valeur=array($id_cand,$id_centre,$nom,$prenom_cand,$prof_cand,$ville_cand);
	$resultat=$pdo->prepare($requete);
	$resultat->execute($valeur);
	//var_dump($resultat);
	
	$msg= "Candidat(e) ajouté(e) avec succès";
	$url="candidat/page_les_candidats.php";		
    header("location:../message.php?msg=$msg&color=v&url=$url");
		
	
?>