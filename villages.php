<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	 
	// include database and object files
	include_once 'config/database.php';
	include_once 'objects/villages.php';
	
	// instantiate database and villages object
	$database = new Database();
	$db = $database->getConnection();
	 
	$villages = new villages($db);
	
	//
	$villages->id = isset($_GET['id']) ? $_GET['id'] : die();
	
	// query villages
	$stmt = $villages->read();
	$num = $stmt->rowCount();
	
	if($num>0){
		// villages array
		$villages_arr=array();
		$villages_arr["villages"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			// extract row
			extract($row);
	 
			$villages_item=array(
				"id" => $id,
				"name" => $name,
			);
	 
			array_push($villages_arr["villages"], $villages_item);
		}
	 
		echo json_encode($villages_arr);
	}else{
		echo json_encode(
			array("message" => "No villages found.")
		);
	}