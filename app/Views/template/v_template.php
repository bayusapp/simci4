<?php
$uri        = service('uri');
$model      = new \App\Models\M_Users_Access_Menu();
$m_sub_menu = new \App\Models\M_Users_Menu_Sub();
$tahun      = new \App\Models\M_Tahun_Ajaran();
$menu       = $model->getAccessMenu(session()->get('id_role'));
$ta         = $tahun->getTahunAjaran();

$segment_1 = $uri->getSegment(1);
$segment_2 = $uri->getSegment(2);
if ($segment_2 == null) {
  $title   = preg_replace('/(?<!^)([A-Z])/', ' $1', $segment_1);
  $title   = $title . ' | SIM Laboratorium';
} else {
  $title   = preg_replace('/(?<!^)([A-Z])/', ' $1', $segment_2);
  $title   = $title . ' | SIM Laboratorium';
}
?>
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
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/select2.min.css">
  <style>
    .select2-dropdown {
      z-index: 10060 !important;
      /*1051;*/
    }

    .select2 {
      width: 100% !important;
    }
  </style>
</head>

<body class="background-img-7">
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
            <?php
            $id_role = session()->get('id_role');
            if ($id_role == '1' || $id_role == '2') {
              $foto     = base_url($foto_laboran);
              $nama     = $nama_laboran;
              $no_induk = $nip_laboran;
            } else {
              $foto     = base_url('assets/images/person-flat.png');
              $nama     = 'Users';
              $no_induk = '1234';
            }
            ?>
            <img class="img-radius" src="<?= $foto ?>" alt="User-Profile-Image">
            <div class="user-details">
              <div id="more-details"><?= $nama . "<br>" . $no_induk ?></div>
            </div>
          </div>
        </div>
        <ul class="nav pcoded-inner-navbar ">
          <li class="nav-item pcoded-menu-caption">
            <label>Menu</label>
          </li>
          <?php foreach ($menu as $m) : ?>
            <?php
            $sub_menu = $m_sub_menu->getDataSubMenu($m['id_menu']);
            if ($sub_menu) {
            ?>
              <li class="nav-item pcoded-hasmenu">
                <a href="#" class="nav-link">
                  <span class="pcoded-micon"><i class="<?= $m['icon_menu'] ?>"></i></span>
                  <span class="pcoded-mtext"><?= $m['nama_menu'] ?></span>
                </a>
                <ul class="pcoded-submenu">
                  <?php foreach ($sub_menu as $s) : ?>
                    <li><a href="<?= base_url($s['url_menu']) ?>"><?= $s['nama_menu'] ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php
            } else {
            ?>
              <li class="nav-item">
                <a href="<?= base_url($m['url_menu']) ?>" class="nav-link">
                  <span class="pcoded-micon"><i class="<?= $m['icon_menu'] ?>"></i></span>
                  <span class="pcoded-mtext"><?= $m['nama_menu'] ?></span>
                </a>
              </li>
            <?php
            }
            ?>
          <?php endforeach; ?>
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
        <li><?= $ta['tahun_ajaran'] ?></li>
        <li>
          <div class="dropdown drp-user">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="feather icon-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right profile-notification">
              <div class="pro-head">
                <div class="row">
                  <div class="col-lg-3">
                    <img src="<?= $foto ?>" class="img-radius" alt="User-Profile-Image">
                  </div>
                  <div class="col-lg-9">
                    <span><?= $nama . "<br>" . $no_induk ?></span>
                  </div>
                </div>
              </div>
              <ul class="pro-body">
                <li><a href="<?= base_url() ?>Profil" class="dropdown-item"><i class="feather icon-user"></i> Pengaturan Profil</a></li>
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
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ripple.js"></script>
  <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>

  <!-- Apex Chart -->
  <script src="<?= base_url() ?>assets/js/plugins/apexcharts.min.js"></script>
  <!-- custom-chart js -->
  <script src="<?= base_url() ?>assets/js/pages/dashboard-main.js"></script>
  <!-- datatable Js -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>assets/js/pages/data-basic-custom.js"></script>
  <!-- select2 Js -->
  <script src="<?= base_url() ?>assets/js/plugins/select2.full.min.js"></script>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 5000);

    $(document).ready(function() {
      setTimeout(function() {
        $('#lab-praktikum').DataTable();

        $('#lab-riset').DataTable();
      }, 350);

      $(".id_lab_kategori").select2({
        placeholder: "Pilih Kategori Laboratorium"
      });

      $(".id_lab_lokasi").select2({
        placeholder: "Pilih Lokasi Laboratorium"
      });

      $(".id_prodi").select2({
        placeholder: "Pilih Program Studi"
      });

    });
  </script>
</body>

</html>