<?php
$uri                = service('uri');
$model_surat_tugas  = new \App\Models\M_Dokumen_Surat_Tugas_Asprak_List();
$asprak             = $model_surat_tugas->getDataAsprak($uri->getSegment('3'));
$jumlah_asprak      = count($asprak);
$halaman            = 0;
if ($jumlah_asprak <= 40) {
  $halaman = 1;
} elseif ($jumlah_asprak > 40) {
  $halaman = 2;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Surat Perjanjian Asisten Praktikum Mata Kuliah | SIM Laboratorium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="SIM Laboratorium adalah sistem informasi manajemen untuk pengelolaan administrasi di Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom" />
  <meta name="keywords" content="simlab, asprak, aslab, laboratorium, fakultas ilmu terapan, universitas telkom">
  <meta name="author" content="Bayu Setya Ajie Perdana Putra" />
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
  <!-- <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <style>
    body {
      font-family: "Calibri", sans-serif;
      -webkit-print-color-adjust: exact !important;
    }

    @page {
      size: A4
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    .table thead {
      font-weight: bold;
    }

    img {
      height: 100px;
    }

    hr {
      height: 0px;
      border: none;
      border-top: 2px solid black;
    }

    .header_surat {
      font-weight: bold;
      font-size: 22pt;
      text-align: center;
    }

    .body_surat {
      font-size: 13pt;
      text-align: justify;
    }

    .def .table tr,
    td {
      vertical-align: top;
    }

    .row {
      display: flex;
    }

    /* Create two equal columns that sits next to each other */
    .column {
      flex: 50%;
      padding: 10px;
      /* Should be removed. Only for demonstration */
    }

    footer {
      position: absolute;
      bottom: 0;
      left: 0;
      text-align: center;
    }
  </style>
</head>

<body class="A4">
  <?php
  if ($halaman == 1) :
  ?>
    <section class="sheet padding-10mm">
      <div style="margin-left: 70%;">
        <img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 60px;">
      </div>
      <div style="margin-left: 5%; margin-right: 5%">
        <div class="col-lg-12">
          <p class="header_surat" style="margin-bottom: -15px;">FAKULTAS ILMU TERAPAN</p>
          <hr>
          <p style="font-weight: bold; text-decoration: underline; text-align: center; font-size: 19pt; margin-top: -3px">SURAT TUGAS</p>
          <p style="text-align: center; font-size: 12pt; margin-top: -20px">No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AKD9/IT-DEK/<?= date('Y') ?></p>
          <p style="font-size: 12pt;">Guna menunjang kelancaran jalannya kegiatan praktikum di Laboratorium Fakultas Ilmu Terapan Universitas Telkom, maka kami memberikan tugas kepada nama-nama yang tercantum di bawah ini sebagai,</p>
        </div>
      </div>
      <div style="margin-left: 11%; margin-right: 5%; margin-top: -10px;">
        <table width="100%" style="font-size: 12pt;">
          <tr>
            <td width="27%">Tugas</td>
            <td width="2%">:</td>
            <td>Asisten Praktikum</td>
          </tr>
          <tr>
            <td>Kode / Nama MK</td>
            <td>:</td>
            <td><?= $surat['kode_mk'] ?>/ <?= ucwords(strtolower($surat['nama_mk'])) ?></td>
          </tr>
          <tr>
            <td>Prodi</td>
            <td>:</td>
            <td><?= $surat['jenjang_prodi'] . ' ' . $surat['nama_prodi'] ?></td>
          </tr>
          <tr>
            <td>Periode</td>
            <td>:</td>
            <td>
              <?php
              $split = explode('-', $surat['tahun_ajaran']);
              if ($split[1] == '1') {
                $semester = 'Semester Ganjil';
              } elseif ($split[1] == '2') {
                $semester = 'Semester Genap';
              }
              echo $semester . ' T.A. ' . $split[0];
              ?>
            </td>
          </tr>
        </table>
      </div>
      <div style="margin-left: 4%; margin-right: 4%">
        <div class="row">
          <div class="column" style="margin-right: 0.1px;">
            <table border="1" style="font-size: 12pt;">
              <tr style="text-align: center;">
                <td width="12%">NO.</td>
                <td>NAMA</td>
                <td>NIM</td>
              </tr>
              <?php
              $div_jumlah         = round($jumlah_asprak / 2);
              $start              = 0;
              $no                 = 1;
              foreach ($asprak as $a) :
                $split_nama = explode(' ', $a['nama_asprak']);
                if (count($split_nama) > 2) {
                  $nama_asprak = $split_nama[0] . ' ' . $split_nama[1];
                  for ($i = 2; $i < count($split_nama); $i++) {
                    $nama_asprak .= ' ' . substr($split_nama[$i], 0, 1) . '.';
                  }
                } else {
                  $nama_asprak = $a['nama_asprak'];
                }
              ?>
                <tr>
                  <td style="padding-left: 2%; text-align: center; vertical-align: middle"><?= $no++ ?>.</td>
                  <td style="padding-left: 2%"><?= ucwords(strtolower($nama_asprak)) ?></td>
                  <td style="vertical-align: middle"><?= $a['nim_asprak'] ?></td>
                </tr>
              <?php
                if ($start == ($div_jumlah - 1)) :
                  break;
                endif;
                $start++;
              endforeach;
              ?>
            </table>
          </div>
          <div class="column">
            <table border="1">
              <tr style="text-align: center;">
                <td width="12%">NO.</td>
                <td>NAMA</td>
                <td>NIM</td>
              </tr>
              <?php
              $no_row = 0;
              foreach ($asprak as $a) :
                $split_nama = explode(' ', $a['nama_asprak']);
                if (count($split_nama) > 2) {
                  $nama_asprak = $split_nama[0] . ' ' . $split_nama[1];
                  for ($i = 2; $i < count($split_nama); $i++) {
                    $nama_asprak .= ' ' . substr($split_nama[$i], 0, 1) . '.';
                  }
                } else {
                  $nama_asprak = $a['nama_asprak'];
                }
                $no_row++;
                if ($no_row >= ($div_jumlah + 1)) :
              ?>
                  <tr>
                    <td style="text-align: center; vertical-align: middle"><?= $no_row ?>.</td>
                    <td style="padding-left: 2%"><?= ucwords(strtolower($nama_asprak)) ?></td>
                    <td style="vertical-align: middle"><?= $a['nim_asprak'] ?></td>
                  </tr>
              <?php
                endif;
              endforeach;
              ?>
            </table>
          </div>
        </div>
      </div>
      <div style="margin-left: 5%; margin-right: 5%">
        <p style="font-size: 12pt;">Demikian Surat Tugas ini dibuat agar dapat dilaksanakan dengan penuh tanggung jawab.</p>
        <p style="font-size: 12pt; margin-top: 30px">Bandung, <?= convertDateTime($surat['tanggal_penugasan']) ?></p>
        <p style="font-size: 12pt; margin-bottom: 60px; margin-top: -15px">Dekan Fakultas Ilmu Terapan</p>
        <p style="font-size: 12pt; text-decoration: underline">Angga Rusdinar, S.T., M.T., Ph.D.</p>
        <p style="font-size: 12pt; margin-top: -20px">NIP: 07740023</p>
      </div>
      <footer>
        <img src="<?= base_url('assets/images/p.png') ?>" style="max-width: 100%; margin-bottom: -6px">
      </footer>
    </section>
  <?php
  elseif ($halaman == 2) :
  ?>
    <section class="sheet padding-10mm">
      <div style="margin-left: 70%;">
        <img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 60px;">
      </div>
      <div style="margin-left: 5%; margin-right: 5%">
        <div class="col-lg-12">
          <p class="header_surat" style="margin-bottom: -15px;">FAKULTAS ILMU TERAPAN</p>
          <hr>
          <p style="font-weight: bold; text-decoration: underline; text-align: center; font-size: 19pt; margin-top: -3px">SURAT TUGAS</p>
          <p style="text-align: center; font-size: 12pt; margin-top: -20px">No:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/AKD9/IT-DEK/<?= date('Y') ?></p>
          <p style="font-size: 12pt;">Guna menunjang kelancaran jalannya kegiatan praktikum di Laboratorium Fakultas Ilmu Terapan Universitas Telkom, maka kami memberikan tugas kepada nama-nama yang tercantum di bawah ini sebagai,</p>
        </div>
      </div>
      <div style="margin-left: 11%; margin-right: 5%; margin-top: -10px;">
        <table width="100%" style="font-size: 12pt;">
          <tr>
            <td width="27%">Tugas</td>
            <td width="2%">:</td>
            <td>Asisten Praktikum</td>
          </tr>
          <tr>
            <td>Kode / Nama MK</td>
            <td>:</td>
            <td><?= $surat['kode_mk'] ?>/ <?= ucwords(strtolower($surat['nama_mk'])) ?></td>
          </tr>
          <tr>
            <td>Prodi</td>
            <td>:</td>
            <td><?= $surat['jenjang_prodi'] . ' ' . $surat['nama_prodi'] ?></td>
          </tr>
          <tr>
            <td>Periode</td>
            <td>:</td>
            <td>
              <?php
              $split = explode('-', $surat['tahun_ajaran']);
              if ($split[1] == '1') {
                $semester = 'Semester Ganjil';
              } elseif ($split[1] == '2') {
                $semester = 'Semester Genap';
              }
              echo $semester . ' T.A. ' . $split[0];
              ?>
            </td>
          </tr>
        </table>
      </div>
      <div style="margin-left: 4%; margin-right: 4%">
        <div class="row">
          <div class="column" style="margin-right: 0.1px;">
            <table border="1" style="font-size: 12pt;">
              <tr style="text-align: center;">
                <td width="12%">NO.</td>
                <td>NAMA</td>
                <td>NIM</td>
              </tr>
              <?php
              $start              = 0;
              $no                 = 1;
              foreach ($asprak as $a) :
                $split_nama = explode(' ', $a['nama_asprak']);
                if (count($split_nama) > 2) {
                  $nama_asprak = $split_nama[0] . ' ' . $split_nama[1];
                  for ($i = 2; $i < count($split_nama); $i++) {
                    $nama_asprak .= ' ' . substr($split_nama[$i], 0, 1) . '.';
                  }
                } else {
                  $nama_asprak = $a['nama_asprak'];
                }
              ?>
                <tr>
                  <td style="padding-left: 2%; text-align: center; vertical-align: middle"><?= $no++ ?>.</td>
                  <td style="padding-left: 2%"><?= ucwords(strtolower($nama_asprak)) ?></td>
                  <td style="vertical-align: middle"><?= $a['nim_asprak'] ?></td>
                </tr>
              <?php
                if ($start == 19) :
                  break;
                endif;
                $start++;
              endforeach;
              ?>
            </table>
          </div>
          <div class="column">
            <table border="1">
              <tr style="text-align: center;">
                <td width="12%">NO.</td>
                <td>NAMA</td>
                <td>NIM</td>
              </tr>
              <?php
              $start = 0;
              foreach ($asprak as $a) :
                $split_nama = explode(' ', $a['nama_asprak']);
                if (count($split_nama) > 2) :
                  $nama_asprak = $split_nama[0] . ' ' . $split_nama[1];
                  for ($i = 2; $i < count($split_nama); $i++) {
                    $nama_asprak .= ' ' . substr($split_nama[$i], 0, 1) . '.';
                  }
                else :
                  $nama_asprak = $a['nama_asprak'];
                endif;
                if ($start >= 20 && $start < 40) :
              ?>
                  <tr>
                    <td style="padding-left: 2%; text-align: center; vertical-align: middle"><?= $no++ ?>.</td>
                    <td style="padding-left: 2%"><?= ucwords(strtolower($nama_asprak)) ?></td>
                    <td style="vertical-align: middle"><?= $a['nim_asprak'] ?></td>
                  </tr>
              <?php
                endif;
                $start++;
              endforeach;
              ?>
            </table>
          </div>
        </div>
      </div>
      <footer>
        <img src="<?= base_url('assets/images/p.png') ?>" style="max-width: 100%; margin-bottom: -6px">
      </footer>
    </section>
    <section class="sheet padding-10mm">
      <div style="margin-left: 70%;">
        <img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 60px;">
      </div>
      <div style="margin-left: 5%; margin-right: 5%; margin-top: 5%;">
        <div class="row">
          <div class="column" style="margin-right: 23%; margin-left: 23%;">
            <table border="1" style="font-size: 12pt;">
              <tr style="text-align: center;">
                <td width="12%">NO.</td>
                <td>NAMA</td>
                <td>NIM</td>
              </tr>
              <?php
              $sisa               = round(($jumlah_asprak - 40) / 2);
              $limit              = 0;
              $start              = 41;
              $count              = 1;
              foreach ($asprak as $a) :
                $split_nama = explode(' ', $a['nama_asprak']);
                if (count($split_nama) > 2) {
                  $nama_asprak = $split_nama[0] . ' ' . $split_nama[1];
                  for ($i = 2; $i < count($split_nama); $i++) {
                    $nama_asprak .= ' ' . substr($split_nama[$i], 0, 1) . '.';
                  }
                } else {
                  $nama_asprak = $a['nama_asprak'];
                }
                if ($count >= $start) {
              ?>
                  <tr>
                    <td style="padding-left: 2%; text-align: center; vertical-align: middle"><?= $no++ ?>.</td>
                    <td style="padding-left: 2%"><?= ucwords(strtolower($nama_asprak)) ?></td>
                    <td style="vertical-align: middle"><?= $a['nim_asprak'] ?></td>
                  </tr>
                <?php
                  $start++;
                }
                ?>
              <?php
                $count++;
              endforeach;
              ?>
            </table>
          </div>
        </div>
        <p style="font-size: 12pt;">Demikian Surat Tugas ini dibuat agar dapat dilaksanakan dengan penuh tanggung jawab.</p>
        <p style="font-size: 12pt; margin-top: 30px">Bandung, <?= convertDateTime($surat['tanggal_penugasan']) ?></p>
        <p style="font-size: 12pt; margin-bottom: 60px; margin-top: -15px">Dekan Fakultas Ilmu Terapan</p>
        <p style="font-size: 12pt; text-decoration: underline">Angga Rusdinar, S.T., M.T., Ph.D.</p>
        <p style="font-size: 12pt; margin-top: -20px">NIP: 07740023</p>
      </div>
      <footer>
        <img src="<?= base_url('assets/images/p.png') ?>" style="max-width: 100%; margin-bottom: -6px">
      </footer>
    </section>
  <?php
  endif;
  ?>
</body>

</html>