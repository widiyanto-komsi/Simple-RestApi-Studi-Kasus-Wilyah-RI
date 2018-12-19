<?php
class villages{
    // database connection and table name
    private $conn;
    private $table_name = "villages";
 
    // object properties
    public $id;
    public $name;
	
	// constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read villages
	function read(){
		// select all query
		$query = "SELECT * FROM " . $this->table_name . " WHERE district_id = ?";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
		
		// bind id of villages to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// create villages
	function create(){
		// query to insert record
		$query = "INSERT INTO ".$this->table_name." SET name=?";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
        // sanitize
        $this->name = $this->name;
	 
		// bind values
        $stmt->bindParam(1, $this->name);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
		return false;
	}
	
	function readOne(){
		// query to read single record
		$query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
		
		// prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of villages to be updated
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->name = $row['name'];
	}
}