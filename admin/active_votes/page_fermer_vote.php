<?php 
require('../connexion.php');
$validite=0;
$sql1 = $pdo->prepare("UPDATE centre_vote SET statut=?");
$donnees1 = array($validite);
$sql1->execute($donnees1); 
$msg= "votes desactivés!";
	$url="../admin/dashboard/dashboard.php";		
	header("location:../message.php?msg=$msg&color=v&url=$url");
?>