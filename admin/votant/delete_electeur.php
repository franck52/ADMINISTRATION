	<?php
		require('../utilisateurs/ma_session.php');
		require('../utilisateurs/mon_role.php');
	?>

<?php

	require('../connexion.php');
	
	$cni=$_GET['id'];
	 $validite=0;
 $req = $pdo->prepare("select * from carte_electeur where numvotan=? and validite=?");
    $valeur = array($cni, $validite);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    
    if ($nbr_user ==1) {
    	# code...
    	// var_dump($nbr_user);
    	// suprimer la carte electeur

	    $requete1="DELETE from carte_electeur where numvotan=?";
	
	    $valeur1=array($cni);
					
	    $resultat1=$pdo->prepare($requete1);
	    $resultat1->execute($valeur1);
	    // supression du votant
	    $requete="DELETE from votant where numvotan=?";
	
	    $valeur=array($cni);
					
	    $resultat=$pdo->prepare($requete);
	    $resultat->execute($valeur);

	    
	      $msg= "Electeur supprimé avec succés";
	      $url="votant/page_le_electeur.php?id= $cin";		
	      header("location:../message.php?msg=$msg&color=v&url=$url");
    	
    }else{ echo "non";
    	 $msg= "impossible de suprimer cette personne!";
	     $url="votant/recherche_par_centre.php";		
	    header("location:../message.php?msg=$msg&color=v&url=$url");

    }
	 
?>
