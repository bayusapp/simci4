<?php
$uri = service('uri');
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>INSPINIA | 404 Error</title>

  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">


  <div class="middle-box text-center animated fadeInDown">
    <h1>404</h1>
    <h3 class="font-bold">Page Not Found</h3>

    <div class="error-desc">
      Maaf, no. trouble ticket <?= $uri->getSegment(3) ?> tidak ditemukan. Silahkan cek kembali URL yang Anda peroleh.<br>Terima kasih.
    </div>
  </div>

  <!-- Mainly scripts -->
  <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap.js"></script>

</body>

</html>