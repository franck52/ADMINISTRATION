<? php
require_once("./class/autoload.php");
$DB = new Database();
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJECT =json_decode($DATA_RAW);


// echo "<pre>";
// print_r($data);
// echo "</pre>";
//proccess data
if (isset($DATA_OBJECT->data_type) && $DATA_OBJECT->data_type =="valider") 
{
	# code...
	$data = false;
	$data['bullid'] = $DB->generate_id(20);
	$data['qte'] = $DATA_OBJECT->qte;
	$data['ville_commune'] = $DATA_OBJECT->ville;
	$data['centre'] = $DATA_OBJECT->centre;
	$data['type_elt'] = $DATA_OBJECT->id_elto;
	$data['type_bull'] = $DATA_OBJECT->actionner;
	$query = "INSERT INTO bulletin_null_blancs(qte,  ville_commune, centre, type_elt, type_bull, bullid)  values(:qte, :ville_commune, :centre, :type_elt, :type_bull, :bullid) ";
	$result = $DB->write($query, $data);
	
	if ($result) {
		# code...
		echo "données enregistrées!";
	}
	else{
		echo "erreur lors de l'enregistrement des données!";
	}
}

