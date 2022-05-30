<?php
function annee_electorale_actuelle()
{
    global $pdo;
    $maxId =$pdo->query("SELECT MAX(numero) AS recherche FROM election");
    while ($donnees = $maxId ->fetch()){
        $Last =$donnees['recherche'];}
    $an_elcto =$pdo->query("SELECT date_fin AS elt_annee FROM election");
    while ($donnees = $an_elcto ->fetch()){
        $Last_ann =$donnees['elt_annee'];}
       $annee_electorale_actuelle= date("Y", strtotime($Last_ann));
    
    return $annee_electorale_actuelle;
}

function nombre_annee_electorale()
{
    $annee_debut = 2010;
    $mois = date("m");
    $annee_actuelle = date("Y");//2018
    //if ($mois >=10 && $mois <= 12)    
    if ($mois >=15 && $mois <= 20)
        return ($annee_actuelle - $annee_debut) + 1;
    else
        return $annee_actuelle - $annee_debut;
}

function les_annee_electorale($annee_debut = 2010)
{
    $les_annees = array();
    for ($i = 1; $i <= nombre_annee_electorale(); $i++) {
        // $annee_elt = ($annee_debut + ($i - 1)) . "/" . ($annee_debut + $i);
        $annee_elct = $annee_debut + $i;
        $les_annees[] = $annee_elct;
    }
    return $les_annees;

}

//Recherche par login
function recherche_user_byLogin($login)
{
    global $pdo;
    $req = $pdo->prepare("select * from administration where login=?");
    $valeur = array($login);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    return $nbr_user;
}
//localités
// function localites(){
//     global $pdo;
//     $req = $pdo->query("select ville as ctre_electoral from bulletin ");

// }

//Recherche par login et id
function recherche_user_byLoginId($login, $id)
{
     global $pdo;
    $req = $pdo->prepare("select * from administration where login=? and id_utilisateur!=?");
    $valeur = array($login, $id);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();
    return $nbr_user;
}

//Recherche par login et pwd (Soit l'utilisateur soit NULL)
function recherche_user_byLoginPwd($login, $pwd)
{
     global $pdo;
	 
    $req = $pdo->prepare("select * from administration where login=? and pwd=?");
    $valeur = array($login, $pwd);
    $req->execute($valeur);
    $nbr_user = $req->rowCount();

    if ($nbr_user == 1) // si l'utilisateur existe
        return $req->fetch(); //Retourner l'utilisateur(id_utilisateur,login,pwd et role)
    else // si l'utilisateur n'existe pas
        return 0;

}
 // recuperation de la derniere election en date
function getLastElection(){
    global $pdo;
    $maxId =$pdo->query("SELECT MAX(numero) AS recherche FROM election");
    while ($donnees = $maxId ->fetch()){$Last =$donnees['recherche'];}
    $LastInsert = $Last;
    $requete = $pdo->query("SELECT idElect AS LastIdElt FROM election WHERE numero ='$LastInsert';" );
    while ($donnees2 = $requete ->fetch()){$Last2 = $donnees2['LastIdElt'];}
    return $Last2;

}
//total par secteur
function total_secteur($ae, $ville, $id_cand, $lastElt){
    global $pdo;
    $requete=$pdo->query(" select count(id_cand) AS points from bulletin where id_cand='".$id_cand."' and ville='".$ville."' and datebull LIKE '%$ae%' AND idElect= '".$lastElt."';");
    $requete = $requete->fetch();
     return $requete['points'];
}
//Effectif des total des votants 
function getEffectif12($ae)
{
     global $pdo;
     $lastElt = getLastElection();
    $res = $pdo->query("SELECT COUNT(numvotan) as countid   from votant where annee_elect='$ae' AND idElect='$lastElt';");
    $nbr = $res->fetch();
    return $nbr['countid'];
    
}

//Effectif des votes candidat 1
function getEffectif1($ae)
{    
    global $pdo;
    $lastElt = getLastElection();
    $res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
                                where id_cand=1 AND datebull LIKE'%$ae%' AND idElect ='$lastElt';");
    $nbr = $res->fetch();
    return $nbr['nbr_voix'];
}

function getNbr_centre()
{    
    global $pdo;
    $res = $pdo->query("select count(id_centre) as nbr from centre_vote");
    $nbr = $res->fetch();
    return $nbr['nbr'];}
//nombre de pv
function getNbr_pv()
{    
    global $pdo;
    $res = $pdo->query("select count(idpv) as nbr_pv from pv");
    $nbr = $res->fetch();
    return $nbr['nbr_pv'];}

//Effectif des votes candidat 2
function getEffectif2($ae)
{    
    global $pdo;
    $lastElt = getLastElection();
    $res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
                                where id_cand=2 AND datebull LIKE'%$ae%' AND idElect ='$lastElt';");
    $nbr = $res->fetch();
    return $nbr['nbr_voix'];
}
//Effectif des votes candidat 3
function getEffectif3($ae)
{    
    global $pdo;
    $lastElt = getLastElection();
    $res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
                                where id_cand=3 AND datebull LIKE'%$ae%' AND idElect ='$lastElt';");
    $nbr = $res->fetch();
    return $nbr['nbr_voix'];
}



//Effectif des votes candidat 4
function getEffectif4($ae)
{
   global $pdo;
   $lastElt = getLastElection();
    $res = $pdo->query("select count(id_bull) as nbr_voix from bulletin 
                                where id_cand=4 AND datebull LIKE'%$ae%' AND idElect ='$lastElt';");
    $nbr = $res->fetch();
    return $nbr['nbr_voix'];
}

 // resultats cand1
function getResultat_cand1($ae)
{
   global $pdo;
    $res = $pdo->query("select nbrvoix from resultat 
                                where id_cand=1 AND annee_elect LIKE'%$ae%';");
    $nbr = $res->fetch();
    $valeur= abs($nbr['nbrvoix']- getEffectif1($ae));
    $new_val=$nbr['nbrvoix']+$valeur;
    $requete="UPDATE resultat SET nbrvoix =? WHERE id_cand=1  AND annee_elect LIKE'%$ae%'";
    $valeur1=array($new_val);
    $resultat=$pdo->prepare($requete);
    $repp= $resultat->execute($valeur1);
    // var_dump($repp);
    return $new_val;
    
   
}
 // resultats cand2
function getResultat_cand2($ae)
{
   global $pdo;
    $res = $pdo->query("select nbrvoix from resultat 
                                where id_cand=2 AND annee_elect LIKE'%$ae%';");
    $nbr = $res->fetch();
    $valeur= abs($nbr['nbrvoix']- getEffectif2($ae));
   
    $new_val=$nbr['nbrvoix']+$valeur;
    $requete="UPDATE resultat SET nbrvoix =? WHERE id_cand=2  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($new_val);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
       //var_dump($repp);
    return $new_val;
}
 // resultats cand3
function getResultat_cand3($ae)
{
   global $pdo;
    $res = $pdo->query("select nbrvoix from resultat 
                                where id_cand=3 AND annee_elect LIKE'%$ae%';");
    $nbr = $res->fetch();
    $valeur= abs($nbr['nbrvoix']- getEffectif3($ae));
    $new_val=$nbr['nbrvoix']+$valeur;
    $requete="UPDATE resultat SET nbrvoix =? WHERE id_cand=3  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($new_val);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
       //var_dump($repp);
    return $new_val;
}
 // resultats cand4
function getResultat_cand4($ae)
{
   global $pdo;
    $res = $pdo->query("select nbrvoix from resultat 
                                where id_cand=4 AND annee_elect LIKE'%$ae%';");
    $nbr = $res->fetch();
    $valeur= abs($nbr['nbrvoix']- getEffectif4($ae));
    $new_val=$nbr['nbrvoix']+$valeur;
    $requete="UPDATE resultat SET nbrvoix =? WHERE id_cand=4  AND annee_elect LIKE'%$ae%'";
                    
    
        $valeur1=array($new_val);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
       //var_dump($repp);
    return $new_val;
}
function modifier($total,$ae,$re1,$re2,$re3,$re4){
    global $pdo;
    if ($total!=0) {
         # code...
         $t1 =number_format((($re1)*100)/$total,2);
         $t2 =number_format((($re2)*100)/$total,2);
         $t3 =number_format((($re3)*100)/$total,2);
         $t4 =number_format((($re4)*100)/$total,2);
        
     }else{$t1=$t2=$t3=$t4=0;}
     //modification du taux de participation Candidat1
    $requete="UPDATE resultat SET pourcentage =? WHERE id_cand=1  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($t1);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
    //modification du taux de participation Candidat2
    $requete="UPDATE resultat SET pourcentage =? WHERE id_cand=2  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($t2);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
    //modification du taux de participation Candidat3
    $requete="UPDATE resultat SET pourcentage =? WHERE id_cand=3  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($t3);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
    //modification du taux de participation Candidat4
    $requete="UPDATE resultat SET pourcentage =? WHERE id_cand=4  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($t4);
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
    //apprecation
    $admis='Candidat élu';
    $refus='candidat malheureux';
    $requete="UPDATE resultat SET decision =? WHERE pourcentage=?  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($admis,max($t1, $t2, $t3, $t4));
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
    //pour tous les candidats malheureux
    $requete="UPDATE resultat SET decision =? WHERE pourcentage!=?  AND annee_elect LIKE'%$ae%'";
        $valeur1=array($refus,max($t1, $t2, $t3, $t4));
        $resultat=$pdo->prepare($requete);
       $repp= $resultat->execute($valeur1);
  return  max($t1, $t2, $t3, $t4);
}
function getID_secteur($commune){
    global $pdo;
    $Recherche=$pdo->prepare('select id_secteur from secteur where nom_secteur=?');
    $tab= array($commune);
    $Recherche->execute($tab);
    $id=$Recherche->rowCount();
    if ($id==1) {
        # code...
        $id_sec= $Recherche->fetch();
        return $id_sec['id_secteur'];
    }else{return 0;}

    // global $pdo;
    // $req = $pdo->prepare("select * from administration where login=?");
    // $valeur = array($login);
    // $req->execute($valeur);
    // $nbr_user = $req->rowCount();
    // return $nbr_user
}


 

?>

   

