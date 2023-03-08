<?php
include_once 'template.php';
if ($_POST) {

    include_once 'includes/user.inc.php';
    $eks = new User($db);

    $eks->nl = $_POST['nl'];
    $eks->un = $_POST['un'];
    $eks->pw = md5($_POST['pw']);
}
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
                    </button> Berhasil Tambah Data!</strong> Tambah lagi atau <a href="user.php" class="btn btn-sm btn-light text-success ml-3">lihat semua data</a>
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pengguna</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="user.php" class="text-muted">Pengguna</a></li>
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
                        <h4 class="card-title">Tambah Data Pengguna</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Lengkap" id="nl" name="nl" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Username" id="un" name="un" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="********" id="pw" name="pw" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ulangi Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="********" id="up" name="up" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="float-right btn waves-effect waves-light btn-rounded btn-primary">Simpan</button>
                                    <button type="button" onclick="location.href='user.php'" class="float-right btn waves-effect waves-light btn-rounded btn-light">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>