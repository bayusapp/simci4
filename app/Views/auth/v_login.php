<!DOCTYPE html>
<html lang="en">

<head>

  <title>Ablepro v8.0 bootstrap admin template by Phoenixcoded</title>
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

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
  <div class="flex-grow-1">
    <div class="h-100 d-md-flex align-items-center auth-side-img">
      <div class="col-sm-10 auth-content w-auto">
        <!-- <img src="assets/images/auth/auth-logo.png" alt="" class="img-fluid">
        <h1 class="text-white my-4">Welcome Back!</h1>
        <h4 class="text-white font-weight-normal">Signin to your account and get explore the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4> -->
      </div>
    </div>
    <div class="auth-side-form">
      <div class=" auth-content">
        <img src="assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
        <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
        <div style="text-align: center;">
          <h4 class="mb-3 f-w-400">Login</h4>
        </div>
        <form action="<?= base_url() ?>auth/login" method="post">
          <div class="form-group mb-3">
            <label class="floating-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
          </div>
          <div class="form-group mb-4">
            <label class="floating-label" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button class="btn btn-block btn-primary mb-4">Login</button>
        </form>
        <div class="text-center">
          <div class="saprator my-4"><span>ATAU</span></div>
          <p class="mb-2 mt-4 text-muted">Lupa password? <a href="auth-reset-password-img-side.html" class="f-w-400">Reset</a></p>
          <p class="mb-0 text-muted">Belum punya akun? <a href="auth-signup-img-side.html" class="f-w-400">Register</a></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- [ signin-img ] end -->

<!-- Required Js -->
<script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/ripple.js"></script>
<script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/sweetalert.min.js"></script>
<?php if (!empty(session()->getFlashdata('error'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Login", "Harap lengkapi seluruh field", "error");
    });
  </script>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('not_found'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Login", "Username tidak ditemukan", "error");
    });
  </script>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('invalid_password'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Login", "Password tidak valid", "error");
    });
  </script>
<?php endif; ?>
</body>

</html>