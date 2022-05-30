<?php 
require('connexion.php');
if (isset($_POST['submit'])) {
	# code...
	$requete=$pdo->prepare("SELECT * FROM votant WHERE id_centre=? and CNI=?;");
	$valeur = array(trim($_POST['ctr']), trim($_POST['cni']));
    $sql->execute($valeur);
    $resultat = $sql->fetch();
    $ville=$resultat['provincevot'];
    $numv=$resultat['numvotan'];
    $da=date("Y-m-d");
    $requete=$pdo->prepare("INSERT INTO votant VALUES(?,?,?,?);");
    $valeur = array(trim($_POST['cdt']),$numv,$da,$ville);
    $resultat_insert->execute($valeurs);
}
?>