<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
$tp = '';
if (isset($_GET['tp'])) {
    $tp = $_GET['tp'];
}

if ($_POST) {

    include_once 'includes/rangking.inc.php';
    $eks = new Rangking($db);
    $eks->ia = $_POST['ia'];
    $eks->ik = $_POST['ik'];
    $eks->nn = $_POST['nn'];
    $eks->tp = $_POST['tp'];
}
$pro1 = new Pegawai($db);
if (isset($_GET['ia'])) {
    $pro1->id = $_GET['ia'];

    $stmt1x = $pro1->readOne1();
} else {
    $stmt1x = $pro1->readAll();
}
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2x = $pro2->readAll();
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

        <?php
        if ($_POST) {
            if ($eks->insert()) {
        ?>
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </button> Berhasil Tambah Data!</strong> Tambah lagi atau <a href="rangking.php" class="btn btn-sm btn-light text-success ml-3">lihat semua data</a>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Gagal Tambah Data!</strong> Terjadi kesalahan, coba sekali lagi.
                </div>
        <?php
            }
        }
        ?>
        <div class="row">

            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Perhitungan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="rangking.php" class="text-muted">Perhitungan</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><span>Tambah</span></li>
                        </ol>
                    </nav>
                </div>
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
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ubah Data Perhitungan</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>

                        <div class="form-group row">
                            <form method="post" class="col-12">
                                <div class="form-group">
                                    <select class="form-control" id="tp" name="tp" required>
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
                                <div class="table-responsive">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
                                                <th colspan="<?php echo $stmt2x->rowCount(); ?>" class="text-center">Kriteria</th>
                                            </tr>
                                            <tr>
                                                <?php
                                                while ($row2x = $stmt2x->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <th><?php echo $row2x['kode_kriteria'] ?><br />(<?php echo $row2x['tipe_kriteria'] ?>)</th>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no = 1;
                                            while ($row1x = $stmt1x->fetch(PDO::FETCH_ASSOC)) {
                                                $no++;
                                            ?>
                                                <tr>
                                                    <th><?php echo $row1x['kode_pegawai'] ?></th>
                                                    <?php
                                                    $id = $row1x['id_pegawai'];
                                                    $index = 0;
                                                    $stmt11 = $pro->read($id);
                                                    while ($rowrx = $stmt11->fetch(PDO::FETCH_ASSOC)) {
                                                        $index++;
                                                        if (isset($rowrx['nilai_rangking'])) {
                                                            $nilai = $rowrx['nilai_rangking'];
                                                        } else {
                                                            $nilai = '0';
                                                        }
                                                    ?>
                                                        <td>
                                                            <select class="form-control" name="nn[<?php echo $no ?>][<?php echo $index ?>]" required>
                                                                <option value='' <?php echo $rowrx['id_nilai'] == '' ? 'selected' : ''; ?>>-Pilih-</option>
                                                                <?php
                                                                include_once 'includes/nilai.inc.php';
                                                                $pro22 = new Nilai($db);
                                                                $stmn = $pro22->readAll();
                                                                $stmn2 = $pro22->readAll2();
                                                                while ($row44 = $stmn->fetch(PDO::FETCH_ASSOC)) {
                                                                    $rrr = "" . $row44['id_nilai'] . "-" . $row44['jum_nilai'] . "";
                                                                    $jum = $row44['jum_nilai'];
                                                                    $selected = $row44['id_nilai'] == $rowrx['id_nilai'] ? 'selected' : '';
                                                                    if ($rowrx['tipe_kriteria'] == 'cost') {
                                                                        $row112 = $stmn2->fetch(PDO::FETCH_ASSOC);
                                                                        $jum = $row112['jum_nilai'];
                                                                        $rrr = "" . $row112['id_nilai'] . "-" . $row112['jum_nilai'] . "";
                                                                        $selected = $row112['id_nilai'] == $rowrx['id_nilai'] ? 'selected' : '';
                                                                    }

                                                                    echo "<option value='{$rrr}' $selected>{$jum}</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                            <input type="hidden" class="form-control" name="ia[<?php echo $no ?>]" id="<?php echo 'ia' . $no . $index; ?>" placeholder="0" value="<?php echo $id; ?>" />
                                                            <input type="hidden" class="form-control" name="ik[<?php echo $index ?>]" id="<?php echo 'ik' . $no . $index; ?>" placeholder="0" value="<?php echo $rowrx['id_kriteria']; ?>" />
                                                        </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive mt-5 mb-4">
                                    <table class="table table-striped table-bordered display no-wrap" id="tabeldata" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="30px" rowspan="2" style="vertical-align:middle">No</th>
                                                <th rowspan="2" style="vertical-align:middle">Keterangan Nilai</th>
                                                <th colspan="2" style="text-align: center">Jumlah Nilai</th>
                                            </tr>
                                            <tr>
                                                <th style="text-align: center">Benefit</th>
                                                <th style="text-align: center">Cost</th>
                                                <!-- <th>Benefit</th>
                                        <th>Cost</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;

                                            include_once 'includes/nilai.inc.php';
                                            $pro = new Nilai($db);
                                            $stmt = $pro->readAll();
                                            $stmst = $pro->readAll2();
                                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                $cost = $stmst->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $no++ ?></td>
                                                    <td><?php echo $row['ket_nilai'] ?></td>
                                                    <td style="text-align: center;"><?php echo $row['jum_nilai'] ?></td>
                                                    <td style="text-align: center;"><?php echo $cost['jum_nilai'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="submit" class="float-right btn waves-effect waves-light btn-rounded btn-primary">Simpan</button>
                                        <button type="button" onclick="location.href='rangking.php'" class="float-right btn waves-effect waves-light btn-rounded btn-light">Kembali</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once 'footer.php' ?>