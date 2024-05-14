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

<!-- [ signin-img ] start -->
<div class="auth-wrapper align-items-stretch aut-bg-img">
  <div class="flex-grow-1">
    <div class="h-100 d-md-flex align-items-center auth-side-img">
      <div class="col-sm-10 auth-content w-auto">
        <!-- <img src="<?= base_url() ?>assets/images/auth/auth-logo.png" alt="" class="img-fluid"> -->
        <!-- <h1 class="text-white my-4">Welcome you!</h1>
        <h4 class="text-white font-weight-normal">Signup to your account and made member of the Able pro Dashboard Template.<br />Do not forget to play with live customizer</h4> -->
      </div>
    </div>
    <div class="auth-side-form">
      <div class=" auth-content">
        <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
        <div style="text-align: center;">
          <h4 class="mb-3 f-w-400">Register</h4>
        </div>
        <form action="<?= base_url() ?>Auth/submitLaboran" method="post">
          <div class="form-group mb-3">
            <label class="floating-label" for="nip">NIP</label>
            <input type="text" class="form-control" id="nip" name="nip" value="<?= old('nip') ?>" onkeypress="return hanyaAngka(event)">
          </div>
          <div class="form-group mb-3">
            <label class="floating-label" for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
          </div>
          <div class="form-group mb-4">
            <label class="floating-label" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/ripple.js"></script>
<script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/sweetalert.min.js"></script>
<script>
  function hanyaAngka(event) {
    var angka = (event.which) ? event.which : event.keyCode
    if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
      return false;
    return true;
  }
</script>
<?php if (!empty(session()->getFlashdata('error'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Registrasi", "Harap lengkapi seluruh field", "error");
    });
  </script>
<?php endif; ?>

<?php if (!empty(session()->getFlashdata('not_laboran'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Registrasi", "NIP yang dimasukkan tidak terdaftar sebagai laboran", "error");
    });
  </script>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('already'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Gagal Registrasi", "NIP yang dimasukkan sudah digunakan", "error");
    });
  </script>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('success'))) : ?>
  <script>
    $(document).ready(function() {
      swal("Sukses Registrasi", "Silahkan cek nomor WhatsApp Anda untuk detail akun yang terdaftar", "success");
    });
  </script>
<?php endif; ?>
</body>

</html>