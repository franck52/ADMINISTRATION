<?php
 /**
  * 
  */
 class Database
 {
 	private $con;
 	//constructeur
 	function __construct()
 	{
 		# code...
 		$this->con = $this->connection();
 	}
 	//connexion à la db
 	private function connection()
 	  {
 	  	$string = "mysql:host=localhost; dbname=votes";
 	  	try{
 	  		$connection = new PDO($string,DBUSER, DBPASS);
 	  		return $connection;

 	  	}catch(PDOException $e){
 	  		echo $e->getMessage();
 	  		die;

 	  	}
 	  	return false;

 	  }
 	//ENREGISTRER LES DONNEES
 	public function write($query, $data_array =[ ])
 	{
 		$con = $this->connection();
 		$statement = $con->prepare($query);
 			/*foreach ($data_array as $key => $value) {
 			# code...
 			$statement->bindparam(":".$key,"$id");

 		}*/
 		// "SELECT * FROM bulletin_null_blancs WHERE idB = $id";
 		// "SELECT * FROM bulletin_null_blancs WHERE idB = :id";
 		
 		$check = $statement->execute($data_array);
 		if ($check) {
 			# code...
 			return true;
 		}
 		return false;

 	}
 	public function save_datas($query, $data_array =[ ])
 	{
 		$con = $this->connection();
 		$statement = $con->prepare($query);
 			/*foreach ($data_array as $key => $value) {
 			# code...
 			$statement->bindparam(":".$key,"$id");

 		}*/
 		// "SELECT * FROM bulletin_null_blancs WHERE idB = $id";
 		// "SELECT * FROM bulletin_null_blancs WHERE idB = :id";
 		
 		$check = $statement->execute($data_array);
 		if ($check) {
 			# code...
 			return true;
 		}
 		return false;

 	}
 	public function generate_id($max)
 	{
 		$rand ="";
 		$rand_count = rand(4, $max);
 		for ($i=0; $i <$rand_count ; $i++) { 
 			# code...
 			$r = rand(0, 9);
 			$rand .=  $r;
 		}
 		return $rand;
 	}
 }