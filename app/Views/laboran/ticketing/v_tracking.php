<?php
$uri = service('uri');
?>
<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>INSPINIA | intimeline</title>

  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/plugins/iCheck/custom.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">

</head>

<body style="background-color: #f3f3f4;">
  <div id="wrapper">
    <div class="gray-bg" style="margin-bottom: 20px;">
      <div class="ibox-content" id="ibox-content">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>No. Ticket: <?= $uri->getSegment(3) ?></h2>
            <hr>
          </div>
        </div>
        <?php
        $status_trouble_ticket = 0;
        $tanggal_terakhir;
        $split_tanggal_ticket = explode(' ', $trouble_ticket['tanggal_kendala']);
        $tanggal_ticket =  strtotime($split_tanggal_ticket[0]);
        foreach ($tracking as $t) {
          $status_trouble_ticket = $t['status'];
          // $tanggal_terakhir = strtotime($t['tanggal']);
          $split_tanggal_tracking = explode(' ', $t['tanggal']);
          $tanggal_terakhir = strtotime($split_tanggal_tracking[0]);
        }
        if ($status_trouble_ticket == '0') {
          $status_ticket = 'Sedang dikerjakan';
        } elseif ($status_trouble_ticket == '1') {
          $status_ticket = 'Selesai';
        }
        // $durasi = $tanggal_terakhir - $trouble_ticket['tanggal_kendala'];
        $durasi = ($tanggal_terakhir - $tanggal_ticket) + 1;
        ?>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Nama Informan:</h5>
            <h2><?= $trouble_ticket['nama_informan'] ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Kategori Informan:</h5>
            <h2><?= $trouble_ticket['kategori_informan'] ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Status Trouble Ticket:</h5>
            <h2><?= $status_ticket ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Durasi Pengerjaan:</h5>
            <h2><?= $durasi ?> Hari</h2>
          </div>
        </div>
      </div>
    </div>
    <div class="gray-bg">
      <div class="ibox-content" id="ibox-content">
        <div id="vertical-timeline" class="vertical-container dark-timeline">
          <div class="vertical-timeline-block">
            <div class="vertical-timeline-icon navy-bg">
              <i class="fa fa-ticket"></i>
            </div>
            <div class="vertical-timeline-content">
              <h2>Trouble Ticket Dibuat</h2>
              <p>
                Keluhan: <?= $trouble_ticket['keluhan'] ?><br>
                Lokasi: <?= $trouble_ticket['nama_lab'] . ' (' . $trouble_ticket['kode_lab'] . ')' ?>
              </p>
              <span class="vertical-date">
                <?= tanggalIndoLengkap($trouble_ticket['tanggal_kendala']) ?>
              </span>
            </div>
          </div>
          <?php
          foreach ($tracking as $t) {
          ?>
            <div class="vertical-timeline-block">
              <?php
              if ($t['status'] == 0) {
                $background = 'vertical-timeline-icon yellow-bg';
                $icon = 'fa fa-cog';
                $title = 'Sedang Dikerjakan';
              } elseif ($t['status'] == 1) {
                $background = 'vertical-timeline-icon blue-bg';
                $icon = 'fa fa-ticket';
                $title = 'Trouble Ticket Ditutup';
              }
              ?>
              <div class="<?= $background ?>">
                <i class="<?= $icon ?>"></i>
              </div>
              <div class="vertical-timeline-content">
                <h2><?= $title ?></h2>
                <p>
                  Solusi: <?= $t['solusi'] ?><br>
                  Petugas: <?= $t['nama_petugas'] . ' | ' . $t['kategori_petugas'] ?>
                </p>
                <span class="vertical-date">
                  <?= tanggalIndoLengkap($t['tanggal']) ?>
                </span>
              </div>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Mainly scripts -->
  <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/js/bootstrap.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

  <!-- Peity -->
  <script src="<?= base_url() ?>assets/js/plugins/peity/jquery.peity.min.js"></script>

  <!-- Custom and plugin javascript -->
  <script src="<?= base_url() ?>assets/js/inspinia.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/pace/pace.min.js"></script>

  <!-- Peity -->
  <script src="<?= base_url() ?>assets/js/demo/peity-demo.js"></script>


  <script>
    $(document).ready(function() {

      // Local script for demo purpose only
      $('#lightVersion').click(function(event) {
        event.preventDefault()
        $('#ibox-content').removeClass('ibox-content');
        $('#vertical-timeline').removeClass('dark-timeline');
        $('#vertical-timeline').addClass('light-timeline');
      });

      $('#darkVersion').click(function(event) {
        event.preventDefault()
        $('#ibox-content').addClass('ibox-content');
        $('#vertical-timeline').removeClass('light-timeline');
        $('#vertical-timeline').addClass('dark-timeline');
      });

      $('#leftVersion').click(function(event) {
        event.preventDefault()
        $('#vertical-timeline').toggleClass('center-orientation');
      });


    });
  </script>

</body>

</html>