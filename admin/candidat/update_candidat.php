	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>
<?php
	
	require('../connexion.php');
	
	$id=$_GET['id'];
	
	$requete=$pdo->query("SELECT * FROM candidat WHERE id_cand=$id");
	$lafiliere=$requete->fetch();
	
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$id_centre=$_POST['id_ctr'];
	$province=$_POST['province'];
	
	//creation de tableau de données d'enregistrement
	$nouvelles_valeurs=array($id_centre,$nom,$prenom,$province,$id);
					
	$requete="UPDATE candidat SET id_centre=?,nomcand=?,prencand=?,provincecand=?
					where id_cand=?";
		
	$resultat=$pdo->prepare($requete);
	
	$resultat->execute($nouvelles_valeurs);
	
	$msg= "Données modifiées avec succès";
	$url="candidat/page_les_candidats.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
	
	
?>