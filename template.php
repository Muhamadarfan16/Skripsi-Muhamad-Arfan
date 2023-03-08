<?php
include "includes/config.php";
session_start();
if (!isset($_SESSION['nama_lengkap'])) {
  echo "<script>location.href='login.php'</script>";
}
$config = new Config();
$db = $config->getConnection();

?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Favicon icon -->
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/sidomarlogo.png">
  <title>Indomaret Kebayoran Lama 3</title>
  <!-- Custom CSS -->
  <link href="assets/extra-libs/c3/c3.min.css" rel="stylesheet">
  <link href="assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
  <link href="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
  <!-- Custom CSS -->
  <link href="dist/css/style.min.css" rel="stylesheet">
  <link href="assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
  <!-- ============================================================== -->
  <!-- Preloader - style you can find in spinners.css -->
  <!-- ============================================================== -->
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <!-- ============================================================== -->
  <!-- Main wrapper - style you can find in pages.scss -->
  <!-- ============================================================== -->
  <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <header class="topbar" data-navbarbg="skin6">
      <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
          <!-- This is for the sidebar toggle which is visible on mobile only -->
          <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
          <!-- ============================================================== -->
          <!-- Logo -->
          <!-- ============================================================== -->
          <div class="navbar-brand">
            <!-- Logo icon -->
            <a href="index.php">
              <!-- <b class="logo-icon"> -->
              <!-- Dark Logo icon -->
              <!-- <img src="assets/images/sidomarlogo.png" alt="homepage" class="dark-logo" /> -->
              <!-- Light Logo icon -->
              <!-- <img src="assets/images/sidomarlogo.png" alt="homepage" class="light-logo" />
                            </b> -->
              <!--End Logo icon -->
              <!-- Logo text -->
              <span class="logo-text">
                <!-- dark Logo text -->
                <img src="assets/images/indomaretlogo.png" alt="homepage" class="dark-logo" />
                <!-- Light Logo text -->
                <!-- <img src="assets/images/indomaretlogo.png" class="light-logo" alt="homepage" /> -->
              </span>
            </a>
          </div>
          <!-- ============================================================== -->
          <!-- End Logo -->
          <!-- ============================================================== -->
          <!-- ============================================================== -->
          <!-- Toggle which is visible on mobile only -->
          <!-- ============================================================== -->
          <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
          <!-- ============================================================== -->
          <!-- toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
            <!-- Notification -->
            <!-- End Notification -->
            <!-- ============================================================== -->
            <!-- create new -->
            <!-- ============================================================== -->
          </ul>
          <!-- ============================================================== -->
          <!-- Right side toggle and nav items -->
          <!-- ============================================================== -->
          <ul class="navbar-nav float-right">
            <!-- ============================================================== -->
            <!-- Search -->
            <!-- ============================================================== -->
            <!-- <li class="nav-item d-none d-md-block">
              <a class="nav-link" href="javascript:void(0)">
                <form>
                  <div class="customize-input">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white" type="search" placeholder="Search" aria-label="Search">
                    <i class="form-control-icon" data-feather="search"></i>
                  </div>
                </form>
              </a>
            </li> -->
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline-block"><span>Selamat Datang,</span> <span class="text-dark"><?php echo $_SESSION['nama_lengkap'] ?></span> <i data-feather="chevron-down" class="svg-icon"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="user.php"><i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                  Kelola Akun</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="login.php" onclick="return confirm('Apakah anda yakin ingin keluar Aplikasi ?')"><i data-feather="power" class="svg-icon mr-2 ml-1"></i>Keluar</a>
              </div>
            </li>
            <!-- ============================================================== -->
            <!-- User profile and search -->
            <!-- ============================================================== -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
      <!-- Sidebar scroll-->
      <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
          <ul id="sidebarnav">
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="index.php" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Applications</span></li>
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="pegawai.php" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu ">Pegawai
                </span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="kriteria.php" aria-expanded="false"><i data-feather="message-square" class="feather-icon"></i><span class="hide-menu">Kriteria Penilaian
                </span></a>
            </li>
            <li class="sidebar-item"> <a class="sidebar-link" href="nilai.php" aria-expanded="false"><i data-feather="tag" class="feather-icon"></i><span class="hide-menu">Keterangan Nilai
                </span></a>
            </li>
            <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="rangking.php" aria-expanded="false"><i data-feather="bar-chart-2" class="feather-icon"></i><span class="hide-menu">Perhitungan
                </span></a>
            </li>
            <li class="sidebar-item"><a class="sidebar-link sidebar-link" href="laporan.php" aria-expanded="false"><i data-feather="file-text" class="feather-icon"></i><span class="hide-menu">Rekomendasi
                </span></a>
            </li>
            <li class="list-divider"></li>
            <li class="nav-small-cap"><span class="hide-menu">Authentication</span></li>

            <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="user.php" aria-expanded="false"><i data-feather="lock" class="feather-icon"></i><span class="hide-menu">Pengguna
                </span></a>
            </li>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>