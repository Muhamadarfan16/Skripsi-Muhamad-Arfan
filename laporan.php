<?php
include_once 'template.php';
include_once 'includes/pegawai.inc.php';
$tp = '';
$cek = [];
if ($_GET) {
    $tp = $_GET['tp'];
    if(isset($_GET['id'])){
        $cek = $_GET['id'];
    }
}
if ($_POST) {
    $tp = $_POST['tp'];
    if(isset($_POST['cek'])){
        $cek = $_POST['cek'];
    }
}
$query = http_build_query(array('id' => $cek));
$pro1 = new Pegawai($db);
$stmt1 = $pro1->readAllOrder($tp);
$stmt123 = $pro1->readAllRangking($tp);
$stmt1x = $pro1->readAllOrder($tp);
$stmt1y = $pro1->readAllOrder($tp);
include_once 'includes/kriteria.inc.php';
$pro2 = new Kriteria($db);
$stmt2 = $pro2->readAll();
$stmt2x = $pro2->readAll();
$stmt2xss = $pro2->readAll();
$stmt2y = $pro2->readAll();
$stmt2yx = $pro2->readAll();
include_once 'includes/rangking.inc.php';
$pro = new Rangking($db);
$stmt = $pro->readKhusus();
$stmtx = $pro->readKhusus();
$stmty = $pro->readKhusus();
include_once 'includes/tahun.inc.php';
$pro3 = new Tahun($db);
$stmt3 = $pro3->readAll();
$stmt32 = $pro3->readAll();
?>
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Rekomendasi</h4>
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
            <button type="button" class="btn btn-info" id="cetak">Cetak Laporan</button>
            <a href="cetak2.php?tp=<?php echo $tp . '&' . $query ?>" type="button" class="btn btn-info ml-2" id="cetak-2">Cetak Surat Rekomendasi</a>
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
            <div class="row">
                <div class="col-lg-12">
                    <?php
                    while ($row3 = $stmt32->fetch(PDO::FETCH_ASSOC)) {
                        extract($row3);
                        if ($tp == $id_tahun) {
                            echo "<h2 class='tahun-hide text-center'>LAPORAN PENILAIAN INDOMARET KEBAYORAN LAMA 3<br/>{$name}</h2>";
                        }
                    }
                    ?>
                    <div class="card">
                        <div class="card-body" id="rangking">
                            <h4 class="card-title">Nilai Kriteria</h4>
                            <h6 class="card-subtitle">Berisikian data yang diinput kedalam Kriteria.</h6>

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
                                                <th style="text-align: center;"><?php echo $row2x['kode_kriteria'] ?><br />(<?php echo $row2x['tipe_kriteria'] ?>)</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        while ($row1x = $stmt1x->fetch(PDO::FETCH_ASSOC)) {
                                            include_once 'includes/nilai.inc.php';
                                            $pro22 = new Nilai($db);
                                            $stmtss = $pro22->readAll();
                                            $stmstsst = $pro22->readAll2();
                                        ?>
                                            <tr>
                                                <th style="text-align: center;"><?php echo $row1x['kode_pegawai'] ?></th>
                                                <?php
                                                $ax = $row1x['id_pegawai'];
                                                $stmtrx = $pro->readR($ax, $tp);
                                                while ($rowrx = $stmtrx->fetch(PDO::FETCH_ASSOC)) {
                                                    $b = $rowrx['id_kriteria'];
                                                    $tipe = $rowrx['tipe_kriteria'];
                                                    $bobot = $rowrx['bobot_kriteria'];

                                                ?>
                                                    <td style="text-align: center;">
                                                        <?php

                                                        if ($tipe == 'benefit') {
                                                            // $predikat = $rowrx['predikat_nilai'];
                                                            $stmtmax = $pro->readMax($b, $tp);
                                                            $maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $rowrx['nilai_rangking'] / $maxnr['mnr1'];
                                                        } else {
                                                            // while ($aa = $stmtss->fetch(PDO::FETCH_ASSOC)) {
                                                            //     // $cs = $stmstsst->fetch(PDO::FETCH_ASSOC);
                                                            //     // if ($aa['jum_nilai'] == $rowrx['nilai_rangking']) {
                                                            //     //     $predikat = $cs['predikat_nilai'];
                                                            //     // }
                                                            // }
                                                            // if($stmtss['jum_nilai']== $rowrx['nilai_rangking']){
                                                            // $predikat = $stmstsst['predikat_nilai'];
                                                            // }
                                                            $stmtmin = $pro->readMin($b, $tp);
                                                            $minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $minnr['mnr2'] / $rowrx['nilai_rangking'];
                                                        }
                                                        $pro->tp = $tp;
                                                        $pro->ia = $ax;
                                                        $pro->ik = $b;
                                                        $pro->ir = $rowrx['id_rangking'];
                                                        $pro->nn2 = $nor;
                                                        $pro->nn3 = $bobot * $nor;
                                                        $pro->normalisasi();
                                                        ?>
                                                        <?php
                                                        echo $rowrx['nilai_rangking'];
                                                        ?>
                                                    </td>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                        <tr>
                                            <td style="text-align: center;"><b>Nilai Tertinggi</b></td>
                                            <?php
                                            while ($row2xs = $stmt2xss->fetch(PDO::FETCH_ASSOC)) {
                                                $b = $row2xs['id_kriteria'];
                                                $tipe = $row2xs['tipe_kriteria'];
                                                if ($tipe == 'benefit') {
                                                    $stmtmax = $pro->readMax($b, $tp);
                                                    $maxnr = $stmtmax->fetch(PDO::FETCH_ASSOC);
                                                    $minmax = $maxnr['mnr1'];
                                                } else {
                                                    $stmtmin = $pro->readMin($b, $tp);
                                                    $minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
                                                    $minmax = $minnr['mnr2'];
                                                }
                                            ?>
                                                <td style="text-align: center;"><b><?php echo $minmax ?></b></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table Normalisasi Matrix -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body" id="rangking">
                            <h4 class="card-title">Table Nilai Normalisasi</h4>
                            <h6 class="card-subtitle">Berisikan data dengan perkalian Max(Benefit) dan Min (Cost).</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
                                            <th colspan="<?php echo $stmt2y->rowCount(); ?>" class="text-center">Kriteria</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            while ($row2y = $stmt2y->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <th style="text-align: center;"><?php echo $row2y['kode_kriteria'] ?></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        while ($row1y = $stmt1y->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <th style="text-align: center;"><?php echo $row1y['kode_pegawai'] ?></th>
                                                <?php
                                                $ay = $row1y['id_pegawai'];
                                                $stmtry = $pro->readR($ay, $tp);
                                                while ($rowry = $stmtry->fetch(PDO::FETCH_ASSOC)) {
                                                    $aa = $rowry['id_kriteria'];
                                                    $tipe = $rowry['tipe_kriteria'];
                                                ?>
                                                    <td style="text-align: center;">
                                                        <?php

                                                        if ($tipe == 'benefit') {
                                                            // $predikat = $rowrx['predikat_nilai'];
                                                            $stmtmaxs = $pro->readMax($aa, $tp);
                                                            $maxnrs = $stmtmaxs->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $rowry['nilai_rangking'] . '/' . $maxnrs['mnr1'];
                                                        } else {
                                                            $stmtmin = $pro->readMin($aa, $tp);
                                                            $minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $minnr['mnr2'] . '/' . $rowry['nilai_rangking'];
                                                        }
                                                        echo $nor . ' = <b>' . round($rowry['nilai_normalisasi'], 2) . '</b>';
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?><tr>
                                            <td style="text-align: center;"><b>Bobot</b></td>
                                            <?php
                                            while ($row2yx = $stmt2yx->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <td style="text-align: center;"><b><?php echo $row2yx['bobot_kriteria'] ?></b></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Hasil Prankingan -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Table Hasil Analisa</h4>
                            <h6 class="card-subtitle">Berisikian data Hasil Akhir.</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Alternatif</th>
                                            <th colspan="<?php echo $stmt2->rowCount(); ?>" class="text-center">Kriteria</th>
                                            <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
                                        </tr>
                                        <tr>
                                            <?php
                                            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                            ?>
                                                <th style="text-align: center;"><?php echo $row2['kode_kriteria'] ?></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $nilai = null;
                                        $nama = null;
                                        $kode = null;
                                        while ($row1 = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                            <tr>
                                                <th style="text-align: center;"><?php echo $row1['kode_pegawai'] ?></th>
                                                <?php
                                                $a = $row1['id_pegawai'];
                                                if ($no == 1) {
                                                    $kode = $row1['kode_pegawai'];
                                                    $nama = $row1['nama_pegawai'];
                                                }
                                                $stmtr = $pro->readR($a, $tp);
                                                while ($rowr = $stmtr->fetch(PDO::FETCH_ASSOC)) {
                                                    $aa = $rowr['id_kriteria'];
                                                    $tipe = $rowr['tipe_kriteria'];
                                                    $bobot = $rowr['bobot_kriteria'];
                                                ?>
                                                    <td style="text-align: center;">
                                                        <?php

                                                        if ($tipe == 'benefit') {
                                                            // $predikat = $rowrx['predikat_nilai'];
                                                            $stmtmaxs = $pro->readMax($aa, $tp);
                                                            $maxnrs = $stmtmaxs->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $rowr['nilai_rangking'] / $maxnrs['mnr1'];
                                                        } else {
                                                            $stmtmin = $pro->readMin($aa, $tp);
                                                            $minnr = $stmtmin->fetch(PDO::FETCH_ASSOC);
                                                            $nor = $minnr['mnr2'] / $rowr['nilai_rangking'];
                                                        }
                                                        $sss =  $bobot . '*' . round($nor, 2);
                                                        echo $sss . ' = <b>' . round($rowr['bobot_normalisasi'], 2) . '</b>';
                                                        ?>
                                                    </td>
                                                <?php
                                                }
                                                ?>
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
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <!-- <div class="new-account mt-3">
                                    <?php echo $nilai && $nama ? "<p>Keputusan mengenai Pegawai Terbaik jatuh kepada <strong>" . $kode . "</strong> dengan nama <strong>" . $nama . "</strong> dan memperoleh nilai <strong>" . $nilai . "</strong></p>" : null ?>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="cetak-table-3">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Table Perangkingan</h4>
                            <h6 class="card-subtitle">Berisikian data perangkingan.</h6>
                            <div class="table-responsive">
                                <form method="post" style="display: inline;" name="thisform">
                                    <table class="table table-bordered table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">No</th>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Kode Pegawai</th>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Nama Pegawai</th>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Hasil</th>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Rangking</th>
                                                <th rowspan="2" style="vertical-align: middle" class="text-center">Pilih</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $no = 1;
                                            $nilai = null;
                                            $nama = null;
                                            $kode = null;
                                            while ($row1 = $stmt123->fetch(PDO::FETCH_ASSOC)) {
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
                                                    <td style="text-align: center;">
                                                        <input type="hidden" value="<?php echo $tp ?>" name="tp" />
                                                        <input type="checkbox" name="cek[<?php echo $no ?>]" value="<?php echo $a ?>" onclick="document.forms.thisform.submit();" <?php if (isset($cek[$no]) && $cek[$no] == $a) {
                                                                                                                                                                                        echo 'checked';
                                                                                                                                                                                    } else {
                                                                                                                                                                                        echo '';
                                                                                                                                                                                    }  ?> />
                                                    </td>
                                                </tr>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                                <div class="new-account mt-3">
                                    <?php echo $nilai && $nama ? "<p>Pegawai dengan kode <strong>" . $kode . "</strong> yang bernama <strong>" . $nama . "</strong> terpilih sebagai Pegawai Terbaik Indomaret Kebayoran Lama 3 dengan Nilai <strong> " . $nilai . "</strong></p>" : null ?>
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
        $('#cetak').click(function() {
            $("#cetak-table").printMe({
                "path": [
                    "dist/css/style.min.css"
                ],
                // "title": "LAPORAN PENILAIAN INDOMARET KEBAYORAN LAMA 3"
            });

        });
    </script>

    <style>
        .tahun-hide {
            display: none;
        }

        @media print {

            .tahun-hide {
                display: unset;
            }
        }
    </style>