<?php
include_once 'template.php';
include_once 'includes/nilai.inc.php';
$pgn = new Nilai($db);
if ($_POST) {

    include_once 'includes/kriteria.inc.php';
    $eks = new Kriteria($db);

    $eks->kk = $_POST['kk'];
    $eks->kt = $_POST['kt'];
    $eks->tp = $_POST['tp'];
    $eks->jm = $_POST['jm'];
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
                    </button> Berhasil Tambah Data!</strong> Tambah lagi atau <a href="kriteria.php" class="btn btn-sm btn-light text-success ml-3">lihat semua data</a>
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Kriteria</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="kriteria.php" class="text-muted">Kriteria</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><span>Tambah</span></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tambah Data Kriteria</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>
                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Kriteria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Kode Kriteria" id="kk" name="kk" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Kriteria</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Kriteria" id="kt" name="kt" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Tipe Kriteria</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select class="form-control" id="tp" name="tp">
                                            <option value='benefit'>Benefit</option>
                                            <option value='cost'>Cost</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Bobot</label>
                                <div class="col-sm-10">
                                    <input type="number" min="0" max="100" class="form-control" placeholder="0" id="jm" name="jm" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="float-right btn waves-effect waves-light btn-rounded btn-primary">Ubah</button>
                                    <button type="button" onclick="location.href='kriteria.php'" class="float-right btn waves-effect waves-light btn-rounded btn-light">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>