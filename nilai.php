<?php
include_once 'template.php';
include_once 'includes/nilai.inc.php';
$pro = new Nilai($db);
$stmt = $pro->readAll();
$stmst = $pro->readAll2();
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Keterangan Nilai</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Keterangan Nilai</li>
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
                        <a typer="Button" href="nilai-baru.php" class="float-right btn waves-effect waves-light btn-rounded btn-primary" style="margin-bottom:15px;"><span>Tambah</span></a>
                        <h4 class="card-title">Data Keterangan Nilai</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                        <div class="table-responsive mt-5">
                            <table id="zero_config" class="table table-striped table-bordered display no-wrap" id="tabeldata" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="30px" rowspan="2" style="vertical-align:middle">No</th>
                                        <th rowspan="2" style="vertical-align:middle">Keterangan Nilai</th>
                                        <th colspan="2" style="text-align: center">Jumlah Nilai</th>
                                        <th width="100px" rowspan="2" style="text-align: center">Aksi</th>
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

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $cost = $stmst->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $no++ ?></td>
                                            <td><?php echo $row['ket_nilai'] ?></td>
                                            <td style="text-align: center;"><?php echo $row['jum_nilai'] ?></td>
                                            <td style="text-align: center;"><?php echo $cost['jum_nilai'] ?></td>
                                            <td class="text-center">
                                                <a href="nilai-ubah.php?id=<?php echo $row['id_nilai'] ?>" class="btn btn-warning"><span>Ubah</span></a>
                                                <a href="nilai-hapus.php?id=<?php echo $row['id_nilai'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span>Hapus</span></a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>