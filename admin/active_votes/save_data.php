	<?php
	$info = (Object)[];
	$data = false;
	$data['idpv'] = $DB->generate_id(20);
	// $data['ID_PV'] = $DATA_OBJECT->qte;
	// if ($DATA_OBJECT->qte<0) {
	// 	# code...
	// 	$Error .= "les valeurs negatives ne sont pas acceptées.<br>";
	// }
	$data['nom_rep1'] = $DATA_OBJECT->nom1;
	if ($DATA_OBJECT->nom1 =="") {
		# code...
		$Error .= "Nom du rep 1 invalide.<br>";
	}
	$data['nom_rep2'] = $DATA_OBJECT->nom2;
	if ($DATA_OBJECT->nom2=="") {
		# code...
		$Error .= "Nom du rep 2 invalide.<br>";
	}
	$data['centre'] = $DATA_OBJECT->centre_de_votes;
	if ($DATA_OBJECT->centre_de_votes=="") {
		# code...
		$Error .= "format invalide.<br>";
	}
	$data['message_pv'] = $DATA_OBJECT->ta;
	if ($DATA_OBJECT->ta =="") {
		# code...
		$Error .= " message trop court.<br>";
	}
	 //echo $data['message_pv'];


	//$data['type_bull'] = $DATA_OBJECT->actionner;
	if ($Error =="") {
			# code...
		
			$query = "INSERT INTO pv(idpv, nom_rep1, nom_rep2, centre, message_pv)  values(:idpv, :nom_rep1, :nom_rep2, :centre, :message_pv) ";
			$result = $DB->save_datas($query, $data);
			
			if ($result) {
				# code...
				$info->message = "données enregistrées!";
	    	    $info->data_type ="info";
	    	    echo json_encode($info);
			}
			else{
				$info->message = "erreur lors de l'enregistrement des données";
	    	    $info->data_type ="error";
	    	    echo json_encode($info);
			}
	    }else{
	    	$info->message = $Error;
	    	$info->data_type ="error";
	    	echo json_encode($info);
	 }