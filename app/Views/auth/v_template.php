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
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <style>
    .swal-button--danger {
      color: #fff;
      background-color: #00acc1;
      border-color: #00acc1;
    }

    .swal-button--danger:not([disabled]):hover {
      color: #fff;
      background-color: #008a9b;
      border-color: #007f8e;
    }

    .swal-button--danger:active {
      color: #fff;
      background-color: #007f8e;
      border-color: #007381;
    }

    .swal-button--danger:focus {
      color: #fff;
      background-color: #008a9b;
      border-color: #007f8e;
      box-shadow: 0 0 0 0rem rgba(38, 184, 202, 0.5);
    }

    .swal-button--cancel {
      color: #fff;
      background-color: #9ccc65;
      border-color: #9ccc65;
    }

    .swal-button--cancel:not([disabled]):hover {
      color: #fff;
      background-color: #8ac248;
      border-color: #83bf3f;
    }

    .swal-button--cancel:active {
      color: #fff;
      background-color: #83bf3f;
      border-color: #7db53c;
    }

    .swal-button--cancel:focus {
      color: #fff;
      background-color: #9ccc65;
      border-color: #9ccc65;
      box-shadow: 0 0 0 0rem rgba(171, 212, 124, 0.5);
    }
  </style>
</head>

<body>
  <div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
      <div class="h-100 d-md-flex align-items-center auth-side-img">
        <div class="col-sm-10 auth-content w-auto">
          <!-- <img src="assets/images/logo_auth.png" alt="" class="img-fluid" style="max-width: 200px;"> -->
          <h3 class="text-white font-weight-normal mb-4">Selamat Datang di</h3>
          <!-- <h2 class="text-white font-weight-normal mb-4">SIMLAB FIT</h2> -->
          <img src="<?= base_url() ?>assets/images/logo_lab_white.png" alt="" class="img-fluid" style="max-width: 400px;">
          <!-- <h5 class="text-white font-weight-normal mt-3">Unit Laboratorium/Bengkel/Studio<br>
            Fakultas Ilmu Terapan, Telkom University</h5> -->
          <!-- <h4 class="text-white font-weight-normal">Signin to your account and get explore the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4> -->
        </div>
      </div>
      <?= $this->renderSection('content'); ?>
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ripple.js"></script>
  <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
  <!-- sweet alert Js -->
  <script src="<?= base_url() ?>assets/js/plugins/sweetalert.min.js"></script>
  <?php
  $uri        = service('uri');
  $segment_1  = $uri->getSegment(1);
  if (!$segment_1) {
  ?>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
    <script>
      const map = L.map('map').fitWorld();

      const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);

      function onLocationFound(e) {
        document.getElementById('location').value = e.latlng;
      }

      function onLocationError(e) {
        console.log(e.message);
      }

      map.on('locationfound', onLocationFound);
      map.on('locationerror', onLocationError);

      map.locate({
        setView: true,
        maxZoom: 16
      });

      function register() {
        swal({
            title: "Register Akun SIM Laboratorium",
            text: "Register sebagai?",
            icon: "warning",
            buttons: {
              dosen: {
                text: "Dosen",
                value: "dosen",
              },
              asprak: {
                text: "Asisten Praktikum"
              },
            },
            confirmButtonColor: '#8CD4F5',
          })
          .then((value) => {
            switch (value) {
              case "asprak":
                location.replace(window.location.origin + "/Auth/asprak");
              case "dosen":
                location.replace(window.location.origin + "/Auth/dosen");
            }
          });
      }
    </script>
  <?php
  }
  ?>
</body>

</html>