	<?php
		require('../utilisateurs/ma_session.php');
	?>

<?php

	require('../connexion.php');
	//require('../class_crypter.php');
	require_once('../fonctions.php');
	require('test.php');
	require('mdp.php');
	
    
	
	$civilite=$_POST['civilite'];
	$nom=$_POST['nom'];
	$prenom=$_POST['prenom'];
	$date_naissance=$_POST['date_naissance'];
	$lieu_naissance=$_POST['lieu_naissance'];
	$id_centre=$_POST['centr'];
	$ville=$_POST['ville'];
	$cin=$_POST['cin'];
	$taill1=$_POST['taill'];
	$idElect = $_POST['id_elto'];
	$mdp=generer_mdp_carte_elect($taill1);
        $taill=generer_mot_de_passe($taill1);
    //$crypter = new Crypter($taill);
    //$chaine_crypter = $crypter->encrypt($taill);
    $_SESSION['mdp']=$mdp;
    $date_enrg=date('Y-m-d H:i:s');
    $valide=0;
	$date_inscription=$_POST['annee_elect'];
	
	$req = $pdo->prepare("SELECT * FROM votant WHERE CNI =?; ");
	$valeur = array($cin);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
       if ($nbr_user == 1){// si l'utilisateur existe
        $msg= "CNI EXISTE DANS LA BASE DE DONNEE";
        $url="votant/page_add_electeur.php";		
        header("location:../message.php?msg=$msg&color=v&url=$url"); 
        } 
    else{ // si l'utilisateur n'existe pas



    $requete_insert_stag="INSERT INTO votant VALUES(?,?,?,?,?,?,?,?,?,?,?)";
    $valeurs_insert_stag=array($taill,$id_centre,$nom,$prenom,$ville,
    	$date_inscription,$date_naissance,$lieu_naissance,$cin,$civilite,$idElect);

    $resultat_insert_stag=$pdo->prepare($requete_insert_stag);
    $resultat_insert_stag->execute($valeurs_insert_stag);
//CREER CARTE ELECTEUR
    $idElect =  getLastElection();

    $req="INSERT INTO carte_electeur VALUES(?,?,?,?,?)";
    $val=array($mdp,$taill,$date_enrg,$valide,$idElect);

    $resultat_insert_cart=$pdo->prepare($req);
    $resultat_insert_cart->execute($val);



    $msg= "Electeur ajouté avec succès";
    $url="votant/page_le_electeur.php?id=$cin";		
    header("location:../message.php?msg=$msg&color=v&url=$url");
}
	
	
?>
