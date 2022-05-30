<?php
 require('../utilisateurs/ma_session.php');
 require('../connexion.php');
 $id_votant=trim($_GET['id']);
 $validite=1;
 $req = $pdo->prepare("select * from carte_electeur where numvotan=? and validite!=?");
    $valeur = array($id_votant, $validite);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    
    if ($nbr_user ==1) {
    	# code...
    	$sql = "UPDATE carte_electeur SET validite=? WHERE numvotan=?";
        $vol=$pdo->prepare($sql)->execute([$validite,$_GET['id']]);
        $msg= "Présence validée avec succès";
	    $url="votant/recherche_par_centre.php";		
	   header("location:../message.php?msg=$msg&color=v&url=$url");
    }else{
    	$msg= "Cette personne n'est plus autorisée à voter à nouveau!";
	    $url="votant/recherche_par_centre.php";		
	   header("location:../message.php?msg=$msg&color=v&url=$url");

    }

	
	// $sql = "UPDATE carte_electeur SET validite=? WHERE numvotan=?";
 //    $vol=$pdo->prepare($sql)->execute([$validite,$_GET['id']]);
 //    $msg= "Présence validée avec succès";
	// $url="votant/recherche_par_centre.php";		
	// header("location:../message.php?msg=$msg&color=v&url=$url");


?>
