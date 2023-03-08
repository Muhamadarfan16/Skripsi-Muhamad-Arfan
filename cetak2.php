<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$tp = '';
$idPrint = [];
if ($_GET) {
	$tp = $_GET['tp'];
	if(isset($_GET['id'])){
		$idPrint = $_GET['id'];
	}
}
$query = http_build_query(array('id' => $idPrint));
if ($_POST) {
	$tp = $_POST['tp'];
}

$pro1 = new Pegawai($db);
$stmt1 = $pro1->readAllRangking($tp);

// $no = 1;
// $nama = null;
// $kode = null;
// $nik = null;
// $jabatan = null;
// $tahun = null;
// $date = null;
// $id = null;
// $nilai = null;
// while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
// 	if ($no == 1) {
// 		$nama = $row1['nama_pegawai'];
// 		$kode = $row1['kode_pegawai'];
// 		$jabatan = $row1['jabatan'];
// 		$nik = $row1['nik'];
// 		$tahun = $row1['name'];

// 		$stmthasil = $pro->readHasil($row1['id_pegawai'], $tp);
// 		$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
// 		$nilai = round($hasil['bbn'], 2);

// 		include_once 'includes/surat.inc.php';
// 		$pro11 = new Surat($db);
// 		$date = $dt;
// 		$pro11->it = $row1['id_tahun'];
// 		$pro11->ip = $row1['id_pegawai'];
// 		$pro11->insert();
// 		$pro11->readOne();
// 		$id = $pro11->id;
// 		$date = date("d M Y", strtotime($pro11->ca));
// 	}
// 	$no++;
// }
include_once 'includes/tahun.inc.php';
$pro3 = new Tahun($db);
$stmt3 = $pro3->readAll();
?>
<div class="page-wrapper">
	<!-- ============================================================== -->
	<!-- Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<div class="page-breadcrumb">
		<div class="row">
			<div class="col-7 align-self-center">
				<h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Cetak Surat Rekomendasi</h4>
				<div class="d-flex align-items-center">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb m-0 p-0">
							<li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
							<li class="breadcrumb-item text-muted active" aria-current="page">Rekomendasi</li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="col-5 align-self-center">
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Bread crumb and right sidebar toggle -->
	<!-- ============================================================== -->
	<!-- ============================================================== -->
	<!-- Container fluid  -->
	<!-- ============================================================== -->
	<div class="container-fluid">

		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#rangking" aria-controls="rangking" role="tab" data-toggle="tab">Laporan Perangkingan</a></li>
                    <li role="presentation" style="cursor: pointer;"><a id="cetak" role="tab">Cetak Laporan 1 (PrintMe)</a></li>
                    <li role="presentation"><a href="laporan-cetak.php" role="tab">Cetak Laporan 2 (FPDF)</a></li>
                    <li role="presentation" style="cursor: pointer;"><a onClick ="$('#container').tableExport({type:'png',escape:'false'});" role="tab">Cetak Laporan 3 (tableExport)</a></li>
                </ul> -->

		<!-- <button><a id="cetak" role="tab">Cetak Laporan 1 (PrintMe)</a></button> -->

		<ul class="nav nav-tabs" role="tablist">
			<a href="laporan.php?tp=<?php echo $tp.'&'.$query ?>" type="button" class="btn btn-info">Cetak Laporan</a>
			<button type="button" class="btn btn-info ml-2" id="cetak-2">Cetak Surat Rekomendasi</button>
			<!-- <a href="laporan-rangking.php?tp=<?php echo $tp ?>" type="button" class="btn btn-info ml-2" id="cetak-3">Cetak Laporan Rangking</a> -->
		</ul>
		<!-- ============================================================== -->
		<!-- Table Alternative Kriteria -->
		<div class="row">
			<div class="col-lg-12">
				<div class="form-group row mt-5">
					<div class="col-sm-8">
						<form method="post">
							<div class="row">
								<div class="col-sm-8">
									<div class="form-group">
										<select class="form-control" id="tp" name="tp">
											<option value='' <?php echo $tp == '' ? 'selected' : ''; ?>>-Pilih Periode-</option>
											<?php
											while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
												extract($row3);
												$selected = $tp == $id_tahun ? 'selected' : '';
												echo "<option value='{$id_tahun}' $selected>{$name}</option>";
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-sm-4">
									<button type="submit" class="btn btn-info">Filter</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div id="cetak-table">
			<?php
			$no = 1;
			while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
				if (isset($idPrint[$no]) && $idPrint[$no] == $row1['id_pegawai']) {
					$nama = $row1['nama_pegawai'];
					$kode = $row1['kode_pegawai'];
					$jabatan = $row1['jabatan'];
					$nik = $row1['nik'];
					$tahun = $row1['name'];

					$stmthasil = $pro->readHasil($row1['id_pegawai'], $tp);
					$hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
					$nilai = round($hasil['bbn'], 2);

					include_once 'includes/surat.inc.php';
					$pro11 = new Surat($db);
					$pro11->it = $row1['id_tahun'];
					$pro11->ip = $row1['id_pegawai'];
					$pro11->insert();
					$pro11->readOne();
					$id = $pro11->id;
					$date = date("d M Y", strtotime($pro11->ca));
			?>
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body" id="rangking">
								<center>
									<table>
										<tr>
											<td><img src="./assets/images/indomaret.png" width="90" height="90"></td>
											<td>
												<center>
													<font size="4">PT INDOMARCO PRISMATAMA</font><br>
													<font size="5"><b>INDOMARET KEBAYORAN LAMA 3</b></font><br>
													<font size="2">Bidang Keahlian : Retail</font><br>
													<font size="2"><i>Jl. Raya Kby. Lama No.227, RT.10/RW.1, Grogol Sel., Kec. Kby. Lama, Kota Jakarta Selatan,<br>Daerah Khusus Ibukota Jakarta 12220</i></font>
												</center>
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<hr>
											</td>
										</tr>
										<table width="625">
											<tr>
												<td class="text2" style="float: right;">
													<font size="2">Jakarta, <span id="tanggalwaktu"><?php echo $date ?></span></font>
												</td>
											</tr>
										</table>
									</table>
									<table>
										<tr class="text2">
											<td>
												<font size="2">Nomor</font>
											</td>
											<td width="572">
												<font size="2">: SK/Indomart/KebLama3/<?php echo $id ?></font>
											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Perihal</font>
											</td>
											<td width="564">
												<font size="2">: Surat Rekomendasi</font>
											</td>
										</tr>
									</table>
									<br>
									<table width="625">
										<tr>
											<td>
												<font size="2">Kepada Yth.<br>Kepala Toko Indomaret Kebayoran Lama 3<br>Di tempat</font>
											</td>
										</tr>
									</table>
									<br>
									<table width="625">
										<tr>
											<td>
												<!-- <font size="2">Assalamu'alaikum Wr.Wb<br>Berdasarkan hasil pemilihan seleksi <b>Pegawai Terbaik</b> pada Toko Indoamret Kebayoran Lama 3 pada Tahun <strong>(<?php echo $tahun ?>)</strong> jatuh kepada :</font> -->
											</td>
										</tr>
									</table>
									<br>
									</table>
									<table>
										<tr class="text2">
											<td>
												<font size="2">NIK</font>
											</td>
											<td width="541">:
												<font size="2"><?php echo $nik ? "<strong>" . $nik . "</strong>" : null ?></font>
											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Kode Pegawai
											</td>
											<td width="525">:
												<font size="2"><?php echo $kode ? "<strong>" . $kode . "</strong>" : null ?>

											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Nama Pegawai
											</td>
											<td width="525">:
												<font size="2"><?php echo $nama ? "<strong>" . $nama . "</strong>" : null ?>

											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Jabatan</font>
											</td>
											<td width="525">:
												<font size="2"><?php echo $jabatan ? "<strong>" . $jabatan . "</strong>" : null ?></font>

											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Nilai</font>
											</td>
											<td width="525">:
												<font size="2"><?php echo $nilai ? "<strong>" . $nilai . "</strong>" : null ?></font>

											</td>
										</tr>
										<tr>
											<td>
												<font size="2">Rangking</font>
											</td>
											<td width="525">:
												<font size="2"><?php echo $no ? "<strong>" . $no . "</strong>" : null ?></font>

											</td>
										</tr>
									</table>
									<br>
									<table width="625">
										<tr>
											<td>
												<font size="2">
													Demikian surat ini di sampaikan, semoga kedepannya kinerja para pegawai Indomarert Kebayoran Lama 3 akan terus meningkat demi perkembangan perusahaan, atas perhatian dan kerjasamanya kami ucapkan Terimakasih.<br><br>Wassalamu'alaikum Wr.Wb.
												</font>
											</td>
										</tr>
									</table>
									<br>
									<table width="625">
										<tr>
											<td width="430"><br><br><br><br></td>
											<td class="text" align="center">Kepala Toko<br><br><br><br>Bahrudin</td>
										</tr>
									</table>
								</center>
							</div>
						</div>
					</div>
					<div style="page-break-after:always"></div>
			<?php
				}
				$no++;
			}
			?>
		</div>
	</div>
	<?php include_once 'footer.php' ?>
	<script>
		$('#cetak-2').click(function() {
			$("#cetak-table").printMe({
				"path": [
					"dist/css/style.min.css"
				],
			});

		});
	</script>