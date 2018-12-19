<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	 
	// include database and object files
	include_once 'config/database.php';
	include_once 'objects/districts.php';
	
	// instantiate database and districts object
	$database = new Database();
	$db = $database->getConnection();
	 
	$districts = new districts($db);
	
	//
	$districts->id = isset($_GET['id']) ? $_GET['id'] : die();
	
	// query districts
	$stmt = $districts->read();
	$num = $stmt->rowCount();
	
	if($num>0){
		// districts array
		$districts_arr=array();
		$districts_arr["districts"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			// extract row
			extract($row);
	 
			$districts_item=array(
				"id" => $id,
				"name" => $name,
			);
	 
			array_push($districts_arr["districts"], $districts_item);
		}
	 
		echo json_encode($districts_arr);
	}else{
		echo json_encode(
			array("message" => "No districts found.")
		);
	}