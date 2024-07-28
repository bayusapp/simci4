<!DOCTYPE html>
<html lang="en">

<head>
  <title>Log Book Penggunaan Ruang Lab | SIM Laboratorium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="SIM Laboratorium adalah sistem informasi manajemen untuk pengelolaan administrasi di Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom" />
  <meta name="keywords" content="simlab, asprak, aslab, laboratorium, fakultas ilmu terapan, universitas telkom">
  <meta name="author" content="Bayu Setya Ajie Perdana Putra" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
    body {
      font-family: Calibri, Candara, Segoe, Segoe UI, Optima, Arial, sans-serif;
      font-size: 10pt;
      -webkit-print-color-adjust: exact !important;
    }

    #wrapper {
      display: -webkit-flex;
      -webkit-justify-content: center;
      display: flex;
      justify-content: center;
    }

    #wrapper div {
      -webkit-flex: 1;
      flex: 1;
    }

    #c3 {
      padding-top: 40px;
      padding-left: 240px;
      padding-right: -10px;
    }

    .header {
      font-family: "Century Gothic";
      font-size: 31.6pt;
      color: #B01513;
    }

    .sub-header {
      font-family: "Century Gothic";
      font-size: 12.7pt;
      color: black;
    }

    @page {
      size: A4
    }

    .title {
      font-size: 20px;
      text-align: center;
    }

    .table {
      font-size: 10pt;
      border-collapse: collapse;
      width: 100%;
    }

    .table th,
    td {
      border: 1px solid #000000;
    }

    .table thead {
      font-weight: bold;
      background-color: #92D050;
    }
  </style>
</head>

<body class="A4">
  <?php
  $m_lab    = new \App\Models\M_Laboratorium();
  $m_jadwal = new \App\Models\M_Laboratorium_Jadwal();
  $m_ta     = new \App\Models\M_Tahun_Ajaran();

  $ta       = $m_ta->getTahunAjaran()['tahun_ajaran'];
  $split_ta = explode('-', $ta);
  $tahun_ajaran = $split_ta[0];
  if ($split_ta[1] == '1') {
    $semester = 'Ganjil';
  } elseif ($split_ta[1] == '2') {
    $semester = 'Genap';
  }
  foreach ($lab as $l) {
    $kode_lab = $m_lab->getDataLabByKode($l)['kode_lab'];
    $nama_lab = $m_lab->getDataLabByKode($l)['nama_lab'];
    $jadwal   = $m_jadwal->getDataJadwal($l);
  ?>
    <section class="sheet padding-10mm">
      <div id="wrapper">
        <div id="c1">
          <img src="<?= base_url() ?>assets/images/logo_telu.png" height="58px">
        </div>
        <div id="c2"></div>
        <div id="c3">
          <table style="font-size: 12px; font-weight: bold;" width="100%">
            <tr>
              <td style="padding: 10px 4px; text-align: center"><?= $kode_lab . ' - ' . $nama_lab ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="header">
        Log Book
        <br>
        Penggunaan Ruang Lab
        <br>
      </div>
      <div class="sub-header" style="margin-top: 5px;">Fakultas Ilmu Terapan | Universitas Telkom | Semester <?= $semester ?> Tahun Ajaran <?= $tahun_ajaran ?></div>
      <br>
      <table class="table">
        <thead style="text-align: center;">
          <tr>
            <td>No</td>
            <td colspan="2">Hari/Tanggal</td>
            <td>Nama Dosen /<br>Koor Asprak</td>
            <td>Keperluan</td>
            <td>Jam<br>Penggunaan</td>
            <td>Paraf</td>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 0;
          foreach ($jadwal as $j) {
            $i++;
          ?>
            <tr>
              <td style="text-align: center;" width="4%"><?= $i ?></td>
              <td style="text-align: center;" width="8%"><?= $j['hari'] ?></td>
              <td style="text-align: center;" width="17%"><?= strtoupper(cekHariLogbook($j['hari'])) ?></td>
              <td style="text-align: center;" width="13%"><?= $j['kode_dosen'] ?></td>
              <td><?= strtoupper($j['nama_mk']) ?></td>
              <td style="text-align: center;" width="12%"><?= $j['shift'] ?></td>
              <td width="9%"></td>
            </tr>
            <?php
          }
          if ($i < 31) {
            for ($j = $i + 1; $j <= 30; $j++) {
            ?>
              <tr>
                <td style="text-align: center;"><?= $j ?></td>
                <td style="text-align: center;" width="8%"></td>
                <td style="text-align: center;" width="17%"></td>
                <td style="text-align: center;" width="13%"></td>
                <td></td>
                <td style="text-align: center;" width="12%"></td>
                <td width="9%"></td>
              </tr>
          <?php
            }
          }
          ?>
        </tbody>
      </table>
      <br><br>
      Mengetahui,<br>
      Ka. Ur. Laboratorium/Bengkel/Studio FIT<br><br><br><br><br>
      Tedi Gunawan, S.T., M.Kom.
    </section>
  <?php
  }
  ?>
  <script src="http://webapplayers.com/inspinia_admin-v2.9.4/js/bootstrap.js"></script>
</body>

</html>