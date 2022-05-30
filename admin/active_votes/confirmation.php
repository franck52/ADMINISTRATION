	<?php
	$info = (Object)[];
	$data = false;
	$data['bullid'] = $DB->generate_id(20);
	$data['qte'] = $DATA_OBJECT->qte;
	if ($DATA_OBJECT->qte<0) {
		# code...
		$Error .= "les valeurs negatives ne sont pas acceptées.<br>";
	}
	$data['ville_commune'] = $DATA_OBJECT->ville;
	if ($DATA_OBJECT->ville<0) {
		# code...
		$Error .= "cette ville invalide.<br>";
	}
	$data['centre'] = $DATA_OBJECT->centre;
	if ($DATA_OBJECT->centre<0) {
		# code...
		$Error .= "nom de centre invalide.<br>";
	}
	$data['type_elt'] = $DATA_OBJECT->id_elto;
	if ($DATA_OBJECT->id_elto<0) {
		# code...
		$Error .= "format invalide.<br>";
	}
	$data['type_bull'] = $DATA_OBJECT->actionner;
	if ($Error =="") {
			# code...
		
			$query = "INSERT INTO bulletin_null_blancs(qte,  ville_commune, centre, type_elt, type_bull, bullid)  values(:qte, :ville_commune, :centre, :type_elt, :type_bull, :bullid) ";
			$result = $DB->write($query, $data);
			
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