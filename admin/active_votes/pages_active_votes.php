<?php 
require('../connexion.php');
$validite=1;
$desactiv=0;
$som=$pdo->query("SELECT SUM(statut) as somme FROM centre_vote ");
$som_val=$som->fetch();
$val_somme=$som_val['somme'];
echo $val_somme;
var_dump($val_somme);
 if ($val_somme==0) {
 	# code...
 $sql1 = $pdo->prepare("UPDATE centre_vote SET statut=?");
 $donnees1 = array($validite);
 $sql1->execute($donnees1); 
 $msg= "votes activés!";
 	$url="../admin/dashboard/dashboard.php";		
 	header("location:../message.php?msg=$msg&color=v&url=$url");
 }else{
 	$sql1 = $pdo->prepare("UPDATE centre_vote SET statut=?");
     $donnees1 = array($desactiv);
     $sql1->execute($donnees1); 
     $msg= "votes desactivés!";
 	$url="../admin/dashboard/dashboard.php";		
 	header("location:../message.php?msg=$msg&color=v&url=$url");
}
// $sql1 = $pdo->prepare("UPDATE centre_vote SET statut=?");
// $donnees1 = array($validite);
// $sql1->execute($donnees1); 
// $msg= "votes activés!";
// 	$url="../admin/dashboard/dashboard.php";		
// 	header("location:../message.php?msg=$msg&color=v&url=$url");
?>