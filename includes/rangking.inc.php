<?php
class Rangking
{

	private $conn;
	private $table_name = "rangking";

	public $ia;
	public $ik;
	public $ir;
	public $nn;
	public $tp;
	public $nn2;
	public $nn3;
	public $mnr1;
	public $mnr2;
	public $has;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	function insert()
	{
		$nilai = $this->nn;
		$id_pegawai = $this->ia;
		$id_kriteria = $this->ik;
		$id_tahun = $this->tp;

		$result = null;
		foreach ($nilai as $key => $value) {
			$idAlternatif = $id_pegawai[$key];
			foreach ($value as $k => $v) {
				# code...
				$split = explode('-', $v);
				$nilai_rangking = $split[1];
				$id_nilai = $split[0];
				$idKriteria = $id_kriteria[$k];
				
				$query = "insert into perhitungan_saw (`id_pegawai`, `id_kriteria`, `id_tahun`, `id_nilai`) values(?,?,?,?);";
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(1, $idAlternatif);
				$stmt->bindParam(2, $idKriteria);
				$stmt->bindParam(3, $id_tahun);
				$stmt->bindParam(4, $id_nilai);

				$qq = "DELETE ps, r FROM perhitungan_saw ps join rangking r on r.id_perhitungan = ps.id_perhitungan WHERE ps.id_pegawai = ? and ps.id_kriteria = ? and ps.id_tahun = ?";

				$st = $this->conn->prepare($qq);
				$st->bindParam(1, $idAlternatif);
				$st->bindParam(2, $idKriteria);
				$st->bindParam(3, $id_tahun);

				$st->execute();

				$result = $stmt->execute();
				$row = $this->conn->lastInsertId();
				$q = "insert into " . $this->table_name . " (`id_perhitungan`, `nilai_rangking`, `nilai_normalisasi`, `bobot_normalisasi`) values(?,?,0,0)";
				$ss = $this->conn->prepare($q);
				$ss->bindParam(1, $row);
				$ss->bindParam(2, $nilai_rangking);
				$ss->execute();
			}
		}
		return $result;
	}

	function readAll()
	{

		$query = "SELECT * FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function read($id)
	{

		$query = "SELECT * FROM perhitungan_saw ps join rangking r on r.id_perhitungan=ps.id_perhitungan right join kriteria k on ps.id_kriteria=k.id_kriteria AND ps.id_pegawai='$id' ";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readKhusus()
	{

		$query = "SELECT * FROM pegawai a, kriteria b, perhitungan_saw ps, rangking c, tahun t where a.id_pegawai=ps.id_pegawai and b.id_kriteria=ps.id_kriteria and ps.id_tahun=t.id_tahun and ps.id_perhitungan=c.id_perhitungan order by a.id_pegawai asc";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readR($a, $tp)
	{
		$query = "SELECT * FROM pegawai a, kriteria b,perhitungan_saw ps,  rangking c, nilai n where n.id_nilai=ps.id_nilai and a.id_pegawai=ps.id_pegawai and ps.id_perhitungan=c.id_perhitungan and b.id_kriteria=ps.id_kriteria and ps.id_pegawai='$a' and ps.id_tahun = '$tp' order by ps.id_kriteria";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readMax($b, $tp)
	{

		$query = "SELECT max(r.nilai_rangking) as mnr1 FROM perhitungan_saw ps join rangking r on r.id_perhitungan=ps.id_perhitungan WHERE ps.id_kriteria='$b' and ps.id_tahun = '$tp' LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	function readMin($b, $tp)
	{

		$query = "SELECT min(r.nilai_rangking) as mnr2 FROM perhitungan_saw ps join rangking r on r.id_perhitungan=ps.id_perhitungan WHERE ps.id_kriteria='$b' and ps.id_tahun = '$tp' LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}


	function readHasil($a, $tp)
	{

		$query = "SELECT sum(r.bobot_normalisasi) as bbn FROM perhitungan_saw ps join rangking r on r.id_perhitungan=ps.id_perhitungan WHERE ps.id_pegawai='$a' and ps.id_tahun = '$tp' LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}

	// used when filling up the update product form
	function readOne()
	{

		$query = "SELECT * FROM " . $this->table_name . " WHERE id_pegawai=? and id_kriteria=? LIMIT 0,1";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->ia = $row['id_pegawai'];
		$this->ik = $row['id_kriteria'];
		$this->nn = $row['nilai_rangking'];
		$this->tp = $row['id_tahun'];
	}

	// update the product
	function update()
	{

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_rangking = :nn
				WHERE
					id_pegawai = :ia 
				AND
					id_kriteria = :ik";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn', $this->nn);
		$stmt->bindParam(':ia', $this->ia);
		$stmt->bindParam(':ik', $this->ik);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function 	normalisasi()
	{

		$query = "UPDATE 
					" . $this->table_name . " 
				SET 
					nilai_normalisasi = :nn2,
					bobot_normalisasi = :nn3
				WHERE
					id_rangking = :ir";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':nn2', $this->nn2);
		$stmt->bindParam(':nn3', $this->nn3);
		$stmt->bindParam(':ir', $this->ir);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	function hasil()
	{

		$query = "UPDATE 
					pegawai
				SET 
					hasil_pegawai = :has
				WHERE
					id_pegawai = :ia";

		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':has', $this->has);
		$stmt->bindParam(':ia', $this->ia);

		// execute the query
		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}

	// delete the product
	function delete()
	{

		$query = "DELETE FROM " . $this->table_name . " WHERE id_pegawai = ? and id_kriteria = ?";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->ia);
		$stmt->bindParam(2, $this->ik);

		if ($result = $stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
