<!DOCTYPE html>
<html lang="en">

<head>
  <title>Berita Acara Serah Terima Kunci | SIM Laboratorium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Log Book dan Berita Acara Serah Terima Kunci" />
  <meta name="keywords" content="logbook, BAST, Laboratorium Fakultas Ilmu Terapan, Universitas Telkom">
  <meta name="author" content="Bayu Setya Ajie Perdana Putra" />
  <link rel="icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
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
      font-size: 35.3pt;
      color: #B01513;
    }

    .sub-header {
      font-family: "Century Gothic";
      font-size: 13.7pt;
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
    }

    footer {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      text-align: center;
      padding: 10px 0;
    }
  </style>
</head>

<body class="A4">
  <?php
  $halaman = 1;
  for ($i = 1; $i <= 6; $i++) {
    switch ($i) {
      case 1:
        $hari = 'Senin';
        break;
      case 2:
        $hari = 'Selasa';
        break;
      case 3:
        $hari = 'Rabu';
        break;
      case 4:
        $hari = 'Kamis';
        break;
      case 5:
        $hari = 'Jumat';
        break;
      case 6:
        $hari = 'Sabtu';
        break;
    }
    $m_lab_jadwal = new \App\Models\M_Laboratorium_Jadwal();
    if ($lantai != '1') {
      $data = $m_lab_jadwal->getDataBAST($lantai, $i);
    } elseif ($lantai == '1') {
      $data = $m_lab_jadwal->getDataBASTSatuEmpat($i);
    }
    $jumlah = count($data);
    if ($jumlah > 35) {
  ?>
      <?php
      $no = 1;
      foreach ($data as $d) {
        if ($no == 1) {
      ?>
          <section class="sheet padding-10mm">
            <div id="wrapper">
              <div id="c1">
                <img src="<?= base_url() ?>assets/images/logo_telu.png" height="55px">
              </div>
              <div id="c2"></div>
              <div id="c3"></div>
            </div>
            <div class="header">
              Berita Acara
              <br>
              Serah Terima Kunci Lab
              <br>
            </div>
            <div class="sub-header">
              Fakultas Ilmu Terapan | Universitas Telkom | <?= date('Y') ?>
              <br><br>
              Hari / Tanggal : <?= $hari ?> / <?= cekHariLogbook($hari) ?>
            </div>
            <br>
            <table class="table">
              <thead style="text-align: center;">
                <tr style="font-size: 17pt;">
                  <td colspan="7">PENGAMBILAN KUNCI</td>
                  <td colspan="3" style="background-color: #bfbfbf;">PENGEMBALIAN KUNCI</td>
                </tr>
                <tr>
                  <td>No</td>
                  <td colspan="2">Ruang</td>
                  <td>Kode<br>Dosen</td>
                  <td>Jam Kuliah</td>
                  <td>Jam<br>Ambil</td>
                  <td>Paraf<br>Dosen</td>
                  <td style="background-color: #bfbfbf;">Jam<br>Kembali</td>
                  <td style="background-color: #bfbfbf;">Paraf<br>Admin<br>Lab</td>
                  <td style="background-color: #bfbfbf;">Keterangan</td>
                </tr>
              </thead>
              <tbody style="text-align: center;">
                <tr>
                  <td width="4%"><?= $no++ ?></td>
                  <td width="4%"><?= $d['ruangan'] ?></td>
                  <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                  <td width="8%"><?= $d['kode_dosen'] ?></td>
                  <td width="13%"><?= $d['shift'] ?></td>
                  <td width="8%"></td>
                  <td width="8%"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="20%" style="background-color: #bfbfbf;"></td>
                </tr>
              <?php
            } elseif ($no > 1 && $no < 36) {
              ?>
                <tr>
                  <td width="4%"><?= $no++ ?></td>
                  <td width="4%"><?= $d['ruangan'] ?></td>
                  <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                  <td width="8%"><?= $d['kode_dosen'] ?></td>
                  <td width="13%"><?= $d['shift'] ?></td>
                  <td width="8%"></td>
                  <td width="8%"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="20%" style="background-color: #bfbfbf;"></td>
                </tr>
              <?php
            } elseif ($no == 36) {
              ?>
              </tbody>
            </table>
            <footer>
              <?= $hari ?>, <?= cekHariLogbook($hari) . ' | ' . $halaman++ ?>
            </footer>
          </section>
          <section class="sheet padding-10mm">
            <table class="table">
              <tbody style="text-align: center;">
                <tr>
                  <td width="4%"><?= $no++ ?></td>
                  <td width="4%"><?= $d['ruangan'] ?></td>
                  <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                  <td width="8%"><?= $d['kode_dosen'] ?></td>
                  <td width="13%"><?= $d['shift'] ?></td>
                  <td width="8%"></td>
                  <td width="8%"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="20%" style="background-color: #bfbfbf;"></td>
                </tr>
              <?php
            } elseif ($no > 36 && $no < $jumlah) {
              ?>
                <tr>
                  <td width="4%"><?= $no++ ?></td>
                  <td width="4%"><?= $d['ruangan'] ?></td>
                  <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                  <td width="8%"><?= $d['kode_dosen'] ?></td>
                  <td width="13%"><?= $d['shift'] ?></td>
                  <td width="8%"></td>
                  <td width="8%"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="20%" style="background-color: #bfbfbf;"></td>
                </tr>
              <?php
            } elseif ($no == $jumlah) {
              ?>
                <tr>
                  <td width="4%"><?= $no++ ?></td>
                  <td width="4%"><?= $d['ruangan'] ?></td>
                  <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                  <td width="8%"><?= $d['kode_dosen'] ?></td>
                  <td width="13%"><?= $d['shift'] ?></td>
                  <td width="8%"></td>
                  <td width="8%"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="8%" style="background-color: #bfbfbf;"></td>
                  <td width="20%" style="background-color: #bfbfbf;"></td>
                </tr>
                <?php
                for ($x = $no; $x <= 70; $x++) {
                ?>
                  <tr>
                    <td width="4%"><?= $no++ ?></td>
                    <td width="4%"></td>
                    <td width="19%"></td>
                    <td width="8%"></td>
                    <td width="13%"></td>
                    <td width="8%"></td>
                    <td width="8%"></td>
                    <td width="8%" style="background-color: #bfbfbf;"></td>
                    <td width="8%" style="background-color: #bfbfbf;"></td>
                    <td width="20%" style="background-color: #bfbfbf;"></td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
            <footer>
              <?= $hari ?>, <?= cekHariLogbook($hari) . ' | ' . $halaman++ ?>
            </footer>
          </section>
        <?php
            }
        ?>
      <?php
      }
    } else {
      ?>
      <section class="sheet padding-10mm">
        <div id="wrapper">
          <div id="c1">
            <img src="<?= base_url() ?>assets/images/logo_telu.png" height="55px">
          </div>
          <div id="c2"></div>
          <div id="c3"></div>
        </div>
        <div class="header">
          Berita Acara
          <br>
          Serah Terima Kunci Lab
          <br>
        </div>
        <div class="sub-header">
          Fakultas Ilmu Terapan | Universitas Telkom | <?= date('Y') ?>
          <br><br>
          Hari / Tanggal : <?= $hari ?> / <?= cekHariLogbook($hari) ?>
        </div>
        <br>
        <table class="table">
          <thead style="text-align: center;">
            <tr style="font-size: 17pt;">
              <td colspan="7">PENGAMBILAN KUNCI</td>
              <td colspan="3" style="background-color: #bfbfbf;">PENGEMBALIAN KUNCI</td>
            </tr>
            <tr>
              <td>No</td>
              <td colspan="2">Ruang</td>
              <td>Kode<br>Dosen</td>
              <td>Jam Kuliah</td>
              <td>Jam<br>Ambil</td>
              <td>Paraf<br>Dosen</td>
              <td style="background-color: #bfbfbf;">Jam<br>Kembali</td>
              <td style="background-color: #bfbfbf;">Paraf<br>Admin<br>Lab</td>
              <td style="background-color: #bfbfbf;">Keterangan</td>
            </tr>
          </thead>
          <tbody style="text-align: center;">
            <?php
            $no = 1;
            foreach ($data as $d) {
            ?>
              <tr>
                <td width="4%"><?= $no++ ?></td>
                <td width="4%"><?= $d['ruangan'] ?></td>
                <td width="19%"><?= $d['nama_lab_pendek'] ?></td>
                <td width="8%"><?= $d['kode_dosen'] ?></td>
                <td width="13%"><?= $d['shift'] ?></td>
                <td width="8%"></td>
                <td width="8%"></td>
                <td width="8%" style="background-color: #bfbfbf;"></td>
                <td width="8%" style="background-color: #bfbfbf;"></td>
                <td width="20%" style="background-color: #bfbfbf;"></td>
              </tr>
            <?php
            }
            for ($sisa = $no; $sisa <= 35; $sisa++) {
            ?>
              <tr>
                <td width="4%"><?= $sisa ?></td>
                <td width="4%"></td>
                <td width="18%"></td>
                <td width="9%"></td>
                <td width="13%"></td>
                <td width="8%"></td>
                <td width="8%"></td>
                <td width="8%" style="background-color: #bfbfbf;"></td>
                <td width="8%" style="background-color: #bfbfbf;"></td>
                <td width="20%" style="background-color: #bfbfbf;"></td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <footer>
          <?= $hari ?>, <?= cekHariLogbook($hari) . ' | ' . $halaman++ ?>
        </footer>
      </section>
    <?php
    }
    ?>
  <?php
  }
  ?>
  <script src="http://webapplayers.com/inspinia_admin-v2.9.4/js/bootstrap.js"></script>
</body>

</html>