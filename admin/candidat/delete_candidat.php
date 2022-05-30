
<?php
	require('../utilisateurs/ma_session.php');
	require('../utilisateurs/mon_role.php');
	
?>

<?php
	
	
	require('../connexion.php');
	
	$id_cand=$_GET['id'];		
	
	$requete="DELETE FROM candidat where id_cand=?";
	
	$valeur=array($id_cand);
	
	$resultat=$pdo->prepare($requete);
	
	$resultat->execute($valeur);
	
	
    $msg= "Candidat(e) supprimé(e) avec succès";
	$url="candidat/page_les_candidats.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
	
	
?>
