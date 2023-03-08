<?php
class Kriteria{
	
	private $conn;
	private $table_name = "kriteria";
	
	public $id;
	public $kk;
	public $kt;
	public $tp;
	public $jm;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." (kode_kriteria, nama_kriteria, tipe_kriteria, bobot_kriteria) values(?,?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->kk);
		$stmt->bindParam(2, $this->kt);
		$stmt->bindParam(3, $this->tp);
		$stmt->bindParam(4, $this->jm);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_kriteria ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_kriteria'];
		$this->kk = $row['kode_kriteria'];
		$this->kt = $row['nama_kriteria'];
		$this->tp = $row['tipe_kriteria'];
		$this->jm = $row['bobot_kriteria'];
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nama_kriteria = :kt,
					kode_kriteria = :kk,
					tipe_kriteria = :tp,  
					bobot_kriteria = :jm
				WHERE
					id_kriteria = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kk', $this->kk);
		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':tp', $this->tp);
		$stmt->bindParam(':jm', $this->jm);
		$stmt->bindParam(':id', $this->id);
		
		// execute the query
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	// delete the product
	function delete(){
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_kriteria = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>