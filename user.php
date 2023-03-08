<?php
include "template.php";

include_once 'includes/user.inc.php';
$pro = new User($db);
$stmt = $pro->readAll();
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengguna</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted" aria-current="page">Pengguna</li>
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
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <a typer="Button" href="user-baru.php" class="float-right btn waves-effect waves-light btn-rounded btn-primary" style="margin-bottom:15px;"><span>Tambah</span></a>
                        <h4 class="card-title">Data Pengguna</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered display no-wrap" id="tabeldata" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="30px">ID</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th width="100px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="text-align: center;"><?php echo $row['id_pengguna'] ?></td>
                                            <td><?php echo $row['nama_lengkap'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td class="text-center">
                                                <a href="user-ubah.php?id=<?php echo $row['id_pengguna'] ?>" class="btn btn-warning"><span>Ubah</span></a>
                                                <a href="user-hapus.php?id=<?php echo $row['id_pengguna'] ?>" onclick="return confirm('Yakin ingin menghapus data')" class="btn btn-danger"><span>Hapus</span></a>
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
    </div>
    <?php include 'footer.php' ?>