	<?php
		require('../utilisateurs/ma_session.php');
	?>

<?php

	require('../connexion.php');
	$centre=$_POST['ville'];
	$id_cdt=$_POST['idcand'];
	$id_centre=$_POST['id_ctr'];
    $date_enrg=date('Y-m-d H:i:s');
    $elt = $_POST['id_elto'];
    var_dump($elt);
	
	$req="INSERT INTO bulletin(id_cand,datebull,ville,id_centre,idElect) VALUES(?,?,?,?,?)";
	$val=array($id_cdt,$date_enrg,$centre,$id_centre,$elt);

	$resultat_insert_cart=$pdo->prepare($req);
	if ($resultat_insert_cart->execute($val)) {
		# code...
		$msg= "Bulletin ajouté avec succès";
	    $url="votant/sauvegarde_bulletin.php";		
	    header("location:../message.php?msg=$msg&color=v&url=$url");
	}
	else{
		echo "erreur!";
	}
	

	
	
?>
