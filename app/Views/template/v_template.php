<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title ?></title>
  <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="" />
  <meta name="keywords" content="">
  <meta name="author" content="Phoenixcoded" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>

<body class="">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <!-- [ navigation menu ] start -->
  <nav class="pcoded-navbar menu-light ">
    <div class="navbar-wrapper  ">
      <div class="navbar-content scroll-div ">
        <div class="" style="margin-bottom: 15px;">
          <div class="main-menu-header">
            <img class="img-radius" src="<?= base_url() . "/" . $foto_laboran ?>" alt="User-Profile-Image">
            <div class="user-details">
              <div id="more-details"><?= $nama_laboran . "<br>" . $nip_laboran ?></div>
            </div>
          </div>
        </div>
        <ul class="nav pcoded-inner-navbar ">
          <li class="nav-item pcoded-menu-caption">
            <label>Menu</label>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>Dashboard" class="nav-link ">
              <span class="pcoded-micon"><i class="feather icon-home"></i></span>
              <span class="pcoded-mtext">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>TroubleTicket" class="nav-link ">
              <span class="pcoded-micon"><i class="feather icon-thumbs-down"></i></span>
              <span class="pcoded-mtext">Trouble Ticket</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url() ?>TroubleTicket" class="nav-link ">
              <span class="pcoded-micon"><i class="feather icon-clock"></i></span>
              <span class="pcoded-mtext">Riwayat Login</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- [ navigation menu ] end -->
  <!-- [ Header ] start -->
  <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      <a href="#!" class="b-brand">
        <!-- ========   change your logo hear   ============ -->
        <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="logo" height="28px">
      </a>
      <a href="#!" class="mob-toggler">
        <i class="feather icon-more-vertical"></i>
      </a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li>
          <div class="dropdown drp-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-notification">
              <div class="pro-head">
                <div class="row">
                  <div class="col-lg-3">
                    <img src="<?= base_url() . "/" . $foto_laboran ?>" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <div class="col-lg-9">
                    <span><?= $nama_laboran . "<br>" . $nip_laboran ?></span>
                  </div>
                </div>
              </div>
              <ul class="pro-body">
                <li><a href="user-profile.html" class="dropdown-item"><i class="feather icon-user"></i> Pengaturan Profil</a></li>
                <li><a href="<?= base_url() ?>Auth/logout" class="dropdown-item"><i class="feather icon-log-out text-danger"></i> Keluar</a></li>
              </ul>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </header>
  <!-- [ Header ] end -->
  <?= $this->renderSection('content'); ?>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="assets/js/vendor-all.min.js"></script>
  <script src="assets/js/plugins/bootstrap.min.js"></script>
  <script src="assets/js/ripple.js"></script>
  <script src="assets/js/pcoded.min.js"></script>

  <!-- Apex Chart -->
  <script src="assets/js/plugins/apexcharts.min.js"></script>
  <!-- custom-chart js -->
  <script src="assets/js/pages/dashboard-main.js"></script>
</body>

</html>