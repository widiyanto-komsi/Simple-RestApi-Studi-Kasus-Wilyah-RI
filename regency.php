<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	 
	// include database and object files
	include_once 'config/database.php';
	include_once 'objects/regency.php';
	
	// instantiate database and regency object
	$database = new Database();
	$db = $database->getConnection();
	 
	$regency = new regency($db);
	
	//
	$regency->id = isset($_GET['id']) ? $_GET['id'] : die();
	
	// query regency
	$stmt = $regency->read();
	$num = $stmt->rowCount();
	
	if($num>0){
		// regency array
		$regency_arr=array();
		$regency_arr["regency"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			// extract row
			extract($row);
	 
			$regency_item=array(
				"id" => $id,
				"name" => $name,
			);
	 
			array_push($regency_arr["regency"], $regency_item);
		}
	 
		echo json_encode($regency_arr);
	}else{
		echo json_encode(
			array("message" => "No regency found.")
		);
	}