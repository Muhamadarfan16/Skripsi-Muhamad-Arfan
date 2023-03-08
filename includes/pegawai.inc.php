<?php
class Pegawai{
	
	private $conn;
	private $table_name = "pegawai";
	
	public $id;
	public $kt;
	public $jm;
	public $jk;
	public $al;
	public $tm;
	public $kp;
	public $nik;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	function insert(){
		
		$query = "insert into ".$this->table_name." (kode_pegawai,nik,nama_pegawai,jk_pegawai, jabatan, alamat, hasil_pegawai) values(?,?,?,?,?,'',0)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->kp);
		$stmt->bindParam(2, $this->nik);
		$stmt->bindParam(3, $this->kt);
		$stmt->bindParam(4, $this->jk);
		$stmt->bindParam(5, $this->tm);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function readAll(){

		$query = "SELECT * FROM ".$this->table_name." ORDER BY id_pegawai ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	function readAllOrder($tp){

		$query = "SELECT a.id_pegawai,a.kode_pegawai, a.nik, a.nama_pegawai, a.jk_pegawai, a.jabatan, a.hasil_pegawai FROM ".$this->table_name." a,perhitungan_saw ps,rangking r where r.id_perhitungan=ps.id_perhitungan and ps.id_pegawai = a.id_pegawai and ps.id_tahun='$tp' group by a.id_pegawai,a.kode_pegawai, a.nik, a.nama_pegawai, a.jk_pegawai, a.jabatan, a.hasil_pegawai ORDER BY a.id_pegawai ASC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}

	function readAllRangking($tp){

		$query = "SELECT a.id_pegawai,a.kode_pegawai, a.nik, a.nama_pegawai, a.jk_pegawai, a.jabatan,sum(r.bobot_normalisasi) as hasil_pegawai, t.name, t.id_tahun FROM ".$this->table_name." a,perhitungan_saw ps, rangking r, tahun t where ps.id_perhitungan=r.id_perhitungan and ps.id_pegawai = a.id_pegawai and ps.id_tahun='$tp' and ps.id_tahun=t.id_tahun group by a.id_pegawai,a.kode_pegawai, a.nik, t.name, t.id_tahun, a.nama_pegawai, a.jk_pegawai, a.jabatan ORDER BY sum(r.bobot_normalisasi) DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		
		return $stmt;
	}
	
	// used when filling up the update product form
	function readOne(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pegawai=?";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['id_pegawai'];
		$this->kp = $row['kode_pegawai'];
		$this->nik = $row['nik'];
		$this->kt = $row['nama_pegawai'];
		$this->jk = $row['jk_pegawai'];
		$this->tm = $row['jabatan'];
		$this->al = $row['alamat'];
	}

	function readOne1(){
		
		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pegawai=? LIMIT 0,1";

		$stmt = $this->conn->prepare( $query );
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		
		return $stmt;
	}
	
	// update the product
	function update(){

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					kode_pegawai = :kp,
					nik = :nik,
					nama_pegawai = :kt,
					jk_pegawai = :jk,
					jabatan = :tm
				WHERE
					id_pegawai = :id";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':kp', $this->kp);
		$stmt->bindParam(':nik', $this->nik);
		$stmt->bindParam(':kt', $this->kt);
		$stmt->bindParam(':jk', $this->jk);
		$stmt->bindParam(':tm', $this->tm);
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
	
		$query = "DELETE FROM " . $this->table_name . " WHERE id_pegawai = ?";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);

		if($result = $stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
