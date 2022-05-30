<?php 

require_once("class/autoload.php");
$DB = new Database();
$DATA_RAW = file_get_contents("php://input");
$DATA_OBJECT =json_decode($DATA_RAW);
$Error = ""; 
/*echo "<pre>";
print_r($DATA_OBJECT);
echo "</pre>";?>*/
if (isset($DATA_OBJECT->data_type) && $DATA_OBJECT->data_type =="valider") 
{
	# code...
	//sleep(2);
	include("confirmation.php");
}

