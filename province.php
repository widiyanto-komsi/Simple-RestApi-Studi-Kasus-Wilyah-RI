<?php
	// required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	 
	// include database and object files
	include_once 'config/database.php';
	include_once 'objects/province.php';
	
	// instantiate database and province object
	$database = new Database();
	$db = $database->getConnection();
	 
	$province = new province($db);
	
	// query province
	$stmt = $province->read();
	$num = $stmt->rowCount();
	
	if($num>0){
		// province array
		$province_arr=array();
		$province_arr["province"]=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			// extract row
			extract($row);
	 
			$province_item=array(
				"id" => $id,
				"name" => $name,
			);
	 
			array_push($province_arr["province"], $province_item);
		}
	 
		echo json_encode($province_arr);
	}else{
		echo json_encode(
			array("message" => "No province found.")
		);
	}