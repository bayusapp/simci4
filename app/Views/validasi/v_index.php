<!DOCTYPE html>
<html lang="en">

<head>
  <title>Validasi</title>
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

    .menupos-fixed {
      border-radius: 0 0.7rem 0 0 !important;
    }

    .logo_telu {
      max-height: 33px;
    }

    .logo_lab {
      max-height: 33px;
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

    @media only screen and (max-width: 991px) {
      .logo_telu {
        max-height: 15px;
      }

      .logo_lab {
        max-height: 15px;
      }
    }

    .round_custom {
      border-radius: 0.7rem;
    }
  </style>
  <style>
    .footer {
      background: none repeat scroll 0 0 #fff;
      border-top: 1px solid #e7eaec;
      bottom: 0;
      left: 0;
      padding: 10px 0;
      position: fixed;
      width: 100%;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="row" style="margin-top: 5%;">
    <div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-12">
      <div class="card round_custom">
        <div class="card-header">
          <div class="row d-flex align-items-center" style="text-align: center; vertical-align:middle">
            <div class="col-lg-2 col-md-2 col-sm-3 col-3">
              <img src="<?= base_url('assets/images/logo_telu.png') ?>" class="logo_telu">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-6" style="vertical-align: middle;">
              <h7>Validasi Berita Acara Pekerjaan dan Kehadiran Asisten Praktikum</h7>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-3">
              <img src="<?= base_url('assets/images/logo_lab.png') ?>" class="logo_lab">
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-12">
              Dokumen digital dan/atau cetak ini dapat dijadikan sebagai alat bukti yang sah, format dan isi telah sesuai dengan ketentuan yang telah ditetapkan.<br><br>
              Detail Berita Berita Acara Pekerjaan dan Kehadiran Asisten Praktikum sebagai berikut:
              <div class="row" style="margin-top: 1%;">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Nama
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : Bayu Setya Ajie Perdana Putra
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  NIM
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : 60701234567
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Bulan
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : Oktober
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Prodi
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : D3 Rekayasa Perangkat Lunak Aplikasi
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Kode MK
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : XXXXXX
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Nama MK
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : Pemrograman Berbasis Web 2
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Tahun
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : 2024
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-3">
                  Total Jam
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-9">
                  : 88 Jam
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <strong>&copy; Developed by</strong> Bayu Setya Ajie Perdana Putra
  </div>
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
</body>

</html>