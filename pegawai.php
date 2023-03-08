<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
$pro = new Pegawai($db);
$stmt = $pro->readAll();
?>

<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pegawai</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Alternatif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="pegawai-baru.php" class="float-right btn waves-effect waves-light btn-rounded btn-primary" style="margin-bottom:15px;"><span>Tambah</span></a>
                    <h4 class="card-title">Input Data Pegawai</h4>
                    <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                    <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                    <div class="table-responsive mt-5">
                        <table id="zero_config" class="table table-striped table-bordered display no-wrap" style="width:100%" id="tabeldata">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Kode Pegawai</th>
                                    <th>NIK</th>
                                    <th>Nama Alternatif</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jabatan</th>
                                    <!-- <th>Hasil Alternatif</th> -->
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Pegawai</th>
                                    <th>NIK</th>
                                    <th>Nama Alternatif</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Jabatan</th>
                                    <!-- <th>Hasil Alternatif</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td style="text-align: center;"><?php echo $no++ ?></td>
                                        <td><?php echo $row['kode_pegawai']?></td>                                        
                                        <td><?php echo $row['nik']?></td>                                        
                                        <td><?php echo $row['nama_pegawai'] ?></td>
                                        <td><?php echo $row['jk_pegawai'] ?></td>
                                        <td><?php echo $row['jabatan']?></td>
                                        <!-- <td><?php echo $row['hasil_pegawai'] ?></td> -->
                                        <td class="text-center">
                                            <a href="pegawai-ubah.php?id=<?php echo $row['id_pegawai'] ?>" class="btn btn-warning"><span>Ubah</span></a>
                                            <a href="pegawai-hapus.php?id=<?php echo $row['id_pegawai'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span>Hapus</span></a>
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
        </div>
    </div>
<?php include_once 'footer.php' ?>