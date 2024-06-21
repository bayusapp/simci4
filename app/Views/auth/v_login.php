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
</head>

<body>
  <div class="auth-wrapper align-items-stretch aut-bg-img">
    <div class="flex-grow-1">
      <div class="h-100 d-md-flex align-items-center auth-side-img">
        <div class="col-sm-10 auth-content w-auto">
          <!-- <img src="assets/images/auth/auth-logo.png" alt="" class="img-fluid"> -->
          <h3 class="text-white font-weight-normal mb-4">Selamat Datang di</h3>
          <h2 class="text-white font-weight-normal mb-4">SIMLAB FIT</h2>
          <h5 class="text-white font-weight-normal mt-3">Fakultas Ilmu Terapan, Telkom University</h5>
          <!-- <h4 class="text-white font-weight-normal">Signin to your account and get explore the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4> -->
        </div>
      </div>
      <div class="auth-side-form">
        <div class=" auth-content">
          <img src="assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
          <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
          <div style="text-align: center;">
            <h4 class="mb-3 f-w-400">Login</h4>
          </div>
          <?php if (!empty(session()->getFlashdata('error'))) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFlashdata('error') ?>
            </div>
          <?php endif; ?>
          <?php if (!empty(session()->getFlashdata('not_found'))) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFlashdata('not_found') ?>
            </div>
          <?php endif; ?>
          <?php if (!empty(session()->getFlashdata('invalid_password'))) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFlashdata('invalid_password') ?>
            </div>
          <?php endif; ?>
          <?php if (!empty(session()->getFlashdata('deactiv'))) : ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getFlashdata('deactiv') ?>
            </div>
          <?php endif; ?>
          <form action="<?= base_url() ?>auth/login" method="post">
            <div class="form-group mb-3">
              <label class="floating-label" for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
            </div>
            <div class="form-group mb-4">
              <label class="floating-label" for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
            </div>
            <input type="text" name="location" id="location" class="form-control" readonly hidden>
            <div id='map' hidden></div>
            <button class="btn btn-block btn-primary mb-4">Login</button>
          </form>
          <div class="text-center">
            <div class="saprator my-4"><span>ATAU</span></div>
            <p class="mb-2 mt-4 text-muted">Lupa password? <a href="auth-reset-password-img-side.html" class="f-w-400">Reset Password</a></p>
            <p class="mb-0 text-muted">Belum punya akun? <a href="auth-signup-img-side.html" class="f-w-400">Register Akun</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ripple.js"></script>
  <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
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
      // alert(e.message);
      console.log(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate({
      setView: true,
      maxZoom: 16
    });
  </script>
</body>

</html>