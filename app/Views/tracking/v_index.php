<?php
$uri                = service('uri');
$model_tt_tracking  = new \App\Models\M_Trouble_Ticket_Tracking();
$id_trouble_ticket  = $uri->getSegment(2);
$tanggal_open       = new DateTime($trouble_ticket['tanggal_tt']);
$tanggal_close      = new DateTime($model_tt_tracking->getDateTTClose($uri->getSegment('2'))['tanggal_track']);
$durasi_tt          = $tanggal_open->diff($tanggal_close);
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tracking Trouble Ticket | SIM Laboratorium</title>
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <link href="<?= base_url() ?>assets/inspinia/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/inspinia/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/inspinia/css/plugins/iCheck/custom.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/inspinia/css/animate.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/inspinia/css/style.css" rel="stylesheet">

</head>

<body style="background-color: #f3f3f4;">
  <div id="wrapper">
    <div class="gray-bg" style="margin-bottom: 20px;">
      <div class="ibox-content" id="ibox-content">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <h2>No. Ticket: <?= $uri->getSegment(2) ?></h2>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Nama Informan:</h5>
            <h2><?= $trouble_ticket['nama_informan'] ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Kategori Informan:</h5>
            <h2><?= $trouble_ticket['nama_kategori'] ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Status Trouble Ticket:</h5>
            <?php
            if ($trouble_ticket['status_tt'] == '1') {
              $status = 'Dibuka';
            } elseif ($trouble_ticket['status_tt'] == '2') {
              $status = 'Sedang Ditangani';
            } elseif ($trouble_ticket['status_tt'] == '3') {
              $status = 'Ditutup';
            }
            ?>
            <h2><?= $status ?></h2>
          </div>
          <div class="col-lg-3 col-md-3 col-sm-12">
            <h5>Durasi Pengerjaan:</h5>
            <?php if ($trouble_ticket['status_tt'] == '1'): ?>
              <h2>Sedang Ditangani</h2>
            <?php elseif ($trouble_ticket['status_tt'] == '2'): ?>
              <h2>Sedang Ditangani</h2>
            <?php elseif ($trouble_ticket['status_tt'] == '3'): ?>
              <h2> <?= $durasi_tt->days ?> Hari</h2>
            <?php endif; ?>
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
                Keluhan: <?= $trouble_ticket['kendala'] ?><br>
                Lokasi: <?= $trouble_ticket['kode_lab'] . ' | ' . $trouble_ticket['nama_lab'] ?>
              </p>
              <span class="vertical-date">
                <small><?= convertTanggal($trouble_ticket['tanggal_tt']) ?></small>
              </span>
            </div>
          </div>
          <?php
          $data           = $model_tt_tracking->getTroubleTicketTracking($id_trouble_ticket);
          $count_tracking = count($data);
          $count          = 1;
          foreach ($data as $d):
            if ($trouble_ticket['status_tt'] == '3' && $count == $count_tracking) :
              $header = 'Trouble Ticket Ditutup';
              $color  = 'red-bg';
              $icon   = 'fa fa-ticket';
            else :
              $header = 'Sedang Ditangani';
              $color  = 'yellow-bg';
              $icon   = 'fa fa-sign-language';
            endif;
          ?>
            <div class="vertical-timeline-block">
              <div class="vertical-timeline-icon <?= $color ?>">
                <i class="<?= $icon ?>"></i>
              </div>
              <div class="vertical-timeline-content">
                <h2><?= $header ?></h2>
                <p>
                  Petugas: <?= $d['nama_petugas'] ?><br>
                  Aktivitas: <?= $d['solusi'] ?>
                </p>
                <span class="vertical-date">
                  <small><?= convertTanggal($d['tanggal_track']) ?></small>
                </span>
              </div>
            </div>
          <?php
            $count++;
          endforeach;
          ?>
        </div>
      </div>
    </div>
  </div>
  <!-- Mainly scripts -->
  <script src="<?= base_url() ?>assets/inspinia/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url() ?>assets/inspinia/js/popper.min.js"></script>
  <script src="<?= base_url() ?>assets/inspinia/js/bootstrap.js"></script>
  <script src="<?= base_url() ?>assets/inspinia/js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="<?= base_url() ?>assets/inspinia/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

  <!-- Peity -->
  <script src="<?= base_url() ?>assets/inspinia/js/plugins/peity/jquery.peity.min.js"></script>

  <!-- Custom and plugin javascript -->
  <script src="<?= base_url() ?>assets/inspinia/js/inspinia.js"></script>
  <script src="<?= base_url() ?>assets/inspinia/js/plugins/pace/pace.min.js"></script>

  <!-- Peity -->
  <script src="<?= base_url() ?>assets/inspinia/js/demo/peity-demo.js"></script>


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