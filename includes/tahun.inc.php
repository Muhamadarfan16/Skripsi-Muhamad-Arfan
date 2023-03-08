<?php
class Tahun{
	
	private $conn;
	private $table_name = "tahun";
	
	public $id;
	public $nn;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_tahun ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readOne($id){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id'];
		$this->nn = $row['name'];
	}
}
?>