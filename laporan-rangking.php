<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
$tp = '';
if ($_GET) {
    $tp = $_GET['tp'];
}
if ($_POST) {
    $tp = $_POST['tp'];
}
$pro1 = new Pegawai($db);
$stmt1 = $pro1->readAllRangking($tp);
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Laporan Perangkingan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Laporan Perangkingan</li>
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
            <button type="button" class="btn btn-info" id="cetak">Cetak Laporan</button>
            <a href="cetak2.php?tp=<?php echo $tp ?>" type="button" class="btn btn-info ml-2" id="cetak-2">Cetak Surat Keputusan</a>
            <a href="laporan-rangking.php?tp=<?php echo $tp ?>" type="button" class="btn btn-info ml-2" id="cetak-3">Cetak Laporan Rangking</a>
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
            <!-- Hasil Prankingan -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- <h4 class="card-title">Table Hasil Analisa</h4> -->
                            <p>Jika diurutkan dengan nilai tertinggi maka akan menghasilkan pegawai terbaik pada Indomaret Kebayoran Lama 3, berikut tabel perangkingan:</p>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">No</th>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Kode Pegawai</th>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Nama Pegawai</th>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Rangking</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $nilai = null;
                                        $nama = null;
                                        $kode = null;
                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                            $a = $row1['id_pegawai'];
                                            if ($no == 1) {
                                                $kode = $row1['kode_pegawai'];
                                                $nama = $row1['nama_pegawai'];
                                            }
                                        ?>
                                            <tr>
                                                <th style="text-align: center;"><?php echo $no ?></th>
                                                <td style="text-align: center;"><?php echo $row1['kode_pegawai'] ?></td>
                                                <td style="text-align: center;"><?php echo $row1['nama_pegawai'] ?></td>
                                                <td>
                                                    <?php
                                                    $stmthasil = $pro->readHasil($a, $tp);
                                                    $hasil = $stmthasil->fetch(PDO::FETCH_ASSOC);
                                                    echo round($hasil['bbn'], 2);
                                                    if ($no == 1) {
                                                        $nilai = round($hasil['bbn'], 2);
                                                    }
                                                    // $pro->ia = $a;
                                                    // $pro->has = $hasil['bbn'];
                                                    // $pro->hasil();
                                                    ?>
                                                </td>
                                                <th style="text-align: center;"><?php echo $no ?></th>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="new-account mt-3">
                                    <?php echo $nilai && $nama ? "<p>Pegawai dengan kode <strong>" . $kode . "</strong> yang bernama <strong>" . $nama . "</strong> dan memperoleh nilai <strong> terpilih sebagai Pegawai Terbaik Indomaret Kebayoran Lama 3 dengan Nilai " . $nilai . "</strong></p>" : null ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>
    <script>
        $('#cetak-3').click(function() {
            $("#cetak-table").printMe({
                "path": [
                    "dist/css/style.min.css"
                ],
                "title": "LAPORAN PERANGKINGAN INDOMARET KEBAYORAN LAMA 3"
            });

        });
    </script>