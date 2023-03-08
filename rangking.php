<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
$pro1 = new Pegawai($db);
$stmt1 = $pro1->readAll();
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$stmt = $pro->readKhusus();
?>

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Perhitungan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Perhitungan</li>
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
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <a href="rangking-form.php" class="float-right btn waves-effect waves-light btn-rounded btn-primary" style="margin-bottom:15px;"><span>Tambah</span></a>
                        <h4 class="card-title">Input Data Perhitungan</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap" style="width:100%" id="tabeldata">
                                <thead>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th style="text-align: center">Alternatif</th>
                                        <th style="text-align: center">Kriteria</th>
                                        <th style="text-align: center">Nilai</th>
                                        <th style="text-align: center" width="100px">Aksi</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th width="30px">No</th>
                                        <th style="text-align: center">Alternatif</th>
                                        <th style="text-align: center">Kriteria</th>
                                        <th style="text-align: center">Nilai</th>
                                        <th style="text-align: center" width="100px">Aksi</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php
                                    $no = 1;
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $row['kode_pegawai'].' - '.$row['nama_pegawai'] ?></td>
                                            <td><?php echo $row['kode_kriteria'].' - '. $row['nama_kriteria'] ?></td>
                                            <td style="text-align: center;"><?php echo $row['nilai_rangking'] ?></td>
                                            <td class="text-center">
                                                <a href="rangking-form.php?ia=<?php echo $row['id_pegawai'] ?>&ik=<?php echo $row['id_kriteria'] ?>&tp=<?php echo $row['id_tahun'] ?>" class="btn btn-warning"><span>Ubah</span></a>
                                                <a href="rangking-hapus.php?ia=<?php echo $row['id_pegawai'] ?>&ik=<?php echo $row['id_kriteria'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span>Hapus</span></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-">
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
            </div>
                    </div>
                </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
<?php include_once 'footer.php' ?>