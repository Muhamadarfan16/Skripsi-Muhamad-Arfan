<?php
class Surat{
	
	private $conn;
	private $table_name = "surat_keputusan";
	
	public $ca;
	public $id;
	public $it;
	public $ip;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){

		$query = "INSERT into ".$this->table_name." ( tgl_sk, id_tahun, id_pegawai) values(?,?,?)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ca);
		$stmt->bindParam(2, $this->it);
		$stmt->bindParam(3, $this->ip);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}

	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " order by kode_sk DESC LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->ca = $row['tgl_sk'];
		$this->id = $row['kode_sk'];
	}
}
?>