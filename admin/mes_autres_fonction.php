<?php
function les_differentes_annees_electo($ae){
	return $ae;

}
function type_election($type){
	return $type;
}
   //Effectif des total des votants 
function getEffectiftotal($ae, $type)
{
	global $pdo;
	$res = $pdo->query("SELECT COUNT(numvotan) as countid   from votant where annee_elect='$ae' AND idElect='$type';");
	$nbr = $res->fetch();
	return $nbr['countid'];

}

//Effectif des votes candidat 1
function getEffectifcand1($ae, $type)
{    
	global $pdo;
	$res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
		where id_cand=1 AND datebull LIKE'%$ae%' AND idElect ='$type';");
	$nbr = $res->fetch();
	return $nbr['nbr_voix'];
}

//Effectif des votes candidat 2
function getEffectifcand2($ae, $type)
{    
	global $pdo;
	$res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
		where id_cand=2 AND datebull LIKE'%$ae%' AND idElect ='$type';");
	$nbr = $res->fetch();
	return $nbr['nbr_voix'];
}
//Effectif des votes candidat 3
function getEffectifcand3($ae, $type)
{    
	global $pdo;
	$res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
		where id_cand=3 AND datebull LIKE'%$ae%' AND idElect ='$type';");
	$nbr = $res->fetch();
	return $nbr['nbr_voix'];
}



//Effectif des votes candidat 4
function getEffectifcand4($ae, $type)
{
	global $pdo;
	$res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
		where id_cand=4 AND datebull LIKE'%$ae%' AND idElect ='$type';");
	$nbr = $res->fetch();
	return $nbr['nbr_voix'];
}

?>