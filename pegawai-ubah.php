<?php
include_once 'template.php';
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

include_once 'includes/pegawai.inc.php';
$eks = new Pegawai($db);

$eks->id = $id;

$eks->readOne();

if ($_POST) {

    $eks->kp = $_POST['kp'];
    $eks->nik = $_POST['nik'];
    $eks->kt = $_POST['kt'];
    $eks->jk = $_POST['jk'];
    $eks->tm = $_POST['tm'];
    $eks->al = $_POST['al'];
}
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">

        <?php
        if ($_POST) {
            if ($eks->update()) {
        ?>
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> Berhasil Ubah Data!</strong> <a href="pegawai.php" class="btn btn-sm btn-light text-success ml-3">lihat semua data</a>
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Alternatif</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.php" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="pegawai.php" class="text-muted">Alternatif</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Ubah</li>
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
                        <h4 class="card-title">Tambah Data Pegawai</h4>
                        <h6 class="card-subtitle">Indomaret Kebayoran Lama 3</h6>
                        <p class="card-subtitle" style="border-bottom: 1px solid"></p>

                        <form method="post">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Kode Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Kode Pegawai" id="kp" name="kp" required value="<?php echo $eks->kp; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" placeholder="0" id="nik" name="nik" required value="<?php echo $eks->nik; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Nama Pegawai" id="kt" name="kt" required value="<?php echo $eks->kt; ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select class="form-control" id="jk" name="jk">
                                            <option value='Laki-Laki' <?php echo $eks->jk == 'Laki-Laki' ? 'selected' : ''; ?>>Laki - Laki</option>
                                            <option value='Perempuan' <?php echo $eks->jk == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <select class="form-control" id="tm" name="tm">
                                            <option value='Store Sr. Leader' <?php echo $eks->tm == 'Store Sr. Leader' ? 'selected' : ''; ?>>Store Sr. Leader</option>
                                            <option value='Crew Store Boy' <?php echo $eks->tm == 'Crew Store Boy' ? 'selected' : ''; ?>>Crew Store Boy</option>
                                            <option value='Crew Store Girl' <?php echo $eks->tm == 'Crew Store Girl' ? 'selected' : ''; ?>>Crew Store Girl</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="alamat" id="al" name="al" required value="<?php echo $eks->al; ?>">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <button type="submit" class="float-right btn waves-effect waves-light btn-rounded btn-primary">Ubah</button>
                                    <button type="button" onclick="location.href='pegawai.php'" class="float-right btn waves-effect waves-light btn-rounded btn-light">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once 'footer.php' ?>