<?php
$uri        = service('uri');
$model      = new \App\Models\M_Users_Access_Menu();
$m_sub_menu = new \App\Models\M_Users_Menu_Sub();
$tahun      = new \App\Models\M_Tahun_Ajaran();
$menu       = $model->getAccessMenu(session()->get('id_role'));
$role       = session()->get('id_role');
$ta         = $tahun->getTahunAjaran();

if ($role == '1') {
  $segment_1 = $uri->getSegment(1);
  $segment_2 = $uri->getSegment(2);
  if ($segment_2 == null) {
    $header = $model->getAccessMenuByLink(session()->get('id_role'), $segment_1)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  } else {
    $header = $m_sub_menu->getDataSubMenuSegment($segment_1, $segment_2)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  }
} elseif ($role == '4') {
  $segment_1 = $uri->getSegment(2);
  $segment_2 = $uri->getSegment(3);
  if ($segment_2 == null) {
    $header = $model->getAccessMenuByLink(session()->get('id_role'), 'Asprak/' . $segment_1)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  } else {
    $header = $m_sub_menu->getDataSubMenuSegment($segment_1, $segment_2)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  }
} elseif ($role == '5') {
  $segment_1 = $uri->getSegment(2);
  $segment_2 = $uri->getSegment(3);
  if ($segment_2 == null) {
    $header = $model->getAccessMenuByLink(session()->get('id_role'), 'Dosen/' . $segment_1)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  } else {
    $header = $m_sub_menu->getDataSubMenuSegment($segment_1, $segment_2)['nama_menu'];
    $title  = $header . ' | SIM Laboratorium';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?= $title ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="SIM Laboratorium adalah sistem informasi manajemen untuk pengelolaan administrasi di Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom" />
  <meta name="keywords" content="simlab, asprak, aslab, laboratorium, fakultas ilmu terapan, universitas telkom">
  <meta name="author" content="Bayu Setya Ajie Perdana Putra" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/daterangepicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/clockpicker.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/toastr.min.css">
  <style>
    .pcoded-header .m-header {
      width: 0px;
    }

    .pcoded-header .m-header .b-brand img.logo {
      display: none;
    }

    @media only screen and (max-width: 991px) {
      .pcoded-header .m-header {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 50px;
      }
    }

    @media only screen and (max-width: 991px) {
      .pcoded-header .m-header .b-brand img.logo {
        display: block;
      }
    }

    @media only screen and (max-width: 991px) {
      .page-header-title .logo-header {
        display: none;
      }
    }

    img.logo {
      max-height: 25px;
    }

    img.logo-header {
      max-height: 40px;
    }

    .pcoded-header .m-header .logo-dark,
    .pcoded-header .m-header .logo-header {
      display: none;
    }

    .honor_asprak {
      max-height: 330px;
      overflow: auto;
      display: inline-block;
    }

    thead tr:nth-child(1) th {
      position: sticky;
      top: 0;
      z-index: 10;
    }

    .select2-dropdown {
      z-index: 10060 !important;
      /*1051;*/
    }

    .select2 {
      width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: #4680ff;
      border: 1px solid #373a3c;
      max-width: 100%;
      box-sizing: border-box;
      white-space: normal;
      word-wrap: break-word;
    }

    .clockpicker-popover {
      z-index: 10060 !important;
    }

    table.table-bordered.dataTable tbody td {
      vertical-align: middle;
    }
  </style>
</head>

<body class="background-img-7">
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <nav class="pcoded-navbar menupos-fixed menu-light ">
    <div class="navbar-wrapper  ">
      <div class="navbar-content scroll-div ">
        <div class="" style="margin-bottom: 30px;">
          <div class="main-menu-header">
            <?php
            if ($role == '1' || $role == '2') {
              $foto     = base_url($foto_laboran);
              $nama     = $nama_laboran;
              $no_induk = $nip_laboran;
            } elseif ($role == '4') {
              if ($foto_asprak == null) {
                $foto     = base_url('assets/images/person-flat.png');
              } else {
                $foto     = base_url($foto_asprak);
              }
              $nama     = $nama_asprak;
              $no_induk = $nim_asprak;
            } elseif ($role == '5') {
              $foto     = base_url('assets/images/person-flat.png');
              $nama     = $nama_dosen;
              $no_induk = $kode_dosen;
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
  <header class="navbar pcoded-header navbar-expand-lg navbar-light header-blue">
    <div class="m-header">
      <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a>
      <a href="#!" class="b-brand">
        <img src="<?= base_url() ?>assets/images/logo_lab_white.png" alt="" class="logo">
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
  <!-- [ Main Content ] start -->
  <section class="pcoded-main-container">
    <div class="pcoded-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <div class="page-header-title">
                <!-- <h5 class="m-b-10"><?= $header ?></h5> -->
                <img src="<?= base_url() ?>assets/images/logo_lab_white.png" alt="" class="logo-header">
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <?= $this->renderSection('content'); ?>
    </div>
  </section>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ripple.js"></script>
  <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
  <!-- sweet alert Js -->
  <script src="<?= base_url() ?>assets/js/plugins/sweetalert.min.js"></script>
  <!-- datatable Js -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/dataTables.bootstrap4.min.js"></script>
  <!-- select2 Js -->
  <script src="<?= base_url() ?>assets/js/plugins/select2.full.min.js"></script>
  <!-- Input mask Js -->
  <script src="<?= base_url() ?>assets/js/plugins/jquery.mask.min.js"></script>
  <!-- datepicker js -->
  <script src="<?= base_url() ?>assets/js/plugins/moment.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/daterangepicker.js"></script>
  <!-- <script src="<?= base_url() ?>assets/js/pages/ac-datepicker.js"></script> -->
  <script src="<?= base_url() ?>assets/js/plugins/clockpicker.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/toastr.min.js"></script>
  <script src="<?= base_url() ?>assets/js/simlab.js"></script>
  <script>
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
    });
  </script>
  <?php
  $segment_1  = $uri->getSegment(1);
  $segment_2  = $uri->getSegment(2);
  $m_kalender = new \App\Models\M_Kalender_Libur();
  $kalender   = $m_kalender->getDataKalender(date('Y'));
  $jumlah     = count($kalender);
  $no         = 1;
  $tanggal    = '';
  foreach ($kalender as $k) :
    $split_tanggal  = explode('-', $k['tanggal']);
    $urut_tanggal   = array($split_tanggal[1], $split_tanggal[2], $split_tanggal[0]);
    $fix_tanggal    = implode('/', $urut_tanggal);
    if ($no < $jumlah) :
      $tanggal .= '"' . $fix_tanggal . '",';
    elseif ($no == $jumlah) :
      $tanggal .= '"' . $fix_tanggal . '"';
    endif;
    $no++;
  endforeach;
  if ($segment_1 == 'Asprak' && $segment_2 == 'Kehadiran') :
  ?>
    <!-- <script>
      $(document).ready(function() {
        var dateToday = new Date();
        $(function() {
          var matiin = [<?= $tanggal ?>];
          $('input[name="tanggal"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: dateToday,
            locale: {
              format: "MM/DD/YYYY",
              daysOfWeek: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
              monthNames: [
                "Januari",
                "Februari",
                "Maret",
                "April",
                "Mei",
                "Juni",
                "Juli",
                "Agustus",
                "September",
                "Oktober",
                "November",
                "Desember",
              ],
            },
            isInvalidDate: function(date) {
              for (let i = 0; i < matiin.length; i++) {
                if (date.format("MM/DD/YYYY") == matiin[i]) {
                  return true;
                }
              }
              if (date.day() == 0) {
                return true;
              }
            },
          });
        });
      });
    </script> -->
  <?php endif; ?>
</body>

</html>