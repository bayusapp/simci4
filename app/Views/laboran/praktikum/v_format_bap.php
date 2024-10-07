<!DOCTYPE html>
<html lang="en">

<head>
  <title>BAP Asprak | SIM Laboratorium</title>
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
      font-family: Arial;
      font-size: 10pt;
      -webkit-print-color-adjust: exact !important;
    }

    @page {
      size: A4
    }


    .text-bold-12 {
      font-size: 12pt;
      font-weight: bold;
    }

    .text-bold-10 {
      font-size: 10pt;
      font-weight: bold;
    }

    .table {
      border: 1px solid black;
      text-align: center;
      vertical-align: middle;
    }

    footer {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      text-align: center;
      padding: 10px 0;
    }

    .qr-code {
      max-height: 60px;
    }
  </style>
</head>

<body class="A4">
  <section class="sheet padding-10mm">
    <table width="100%">
      <tr>
        <td class="text-bold-12" colspan="3">BERITA ACARA PEKERJAAN DAN KEHADIRAN</td>
        <td rowspan="4"><img src="<?= base_url('assets/images/template/logo_tass.png') ?>" style="max-width: 236px;"></td>
      </tr>
      <tr>
        <td class="text-bold-12" colspan="3">ASISTEN PRAKTIKUM</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="text-bold-10" width="15%">NAMA</td>
        <td width="1%">:</td>
        <td width="50%"><?= $mk_bap['nama_asprak'] ?></td>
      </tr>
      <tr>
        <td class="text-bold-10">NIM</td>
        <td>:</td>
        <td><?= $mk_bap['nim_asprak'] ?></td>
      </tr>
      <tr>
        <td class="text-bold-10">BULAN</td>
        <td>:</td>
        <td><?= $mk_bap['bulan'] ?></td>
        <td style="text-align: right; font-weight: bold;">Laboratorium</td>
      </tr>
      <tr>
        <td class="text-bold-10">PRODI</td>
        <td>:</td>
        <td><?= $mk['jenjang_prodi'] . ' ' . $mk['nama_prodi'] ?></td>
        <td style="text-align: right; font-weight: bold">Fakultas Ilmu Terapan</td>
      </tr>
      <tr>
        <td class="text-bold-10">KODE MK</td>
        <td>:</td>
        <td><?= $mk['kode_mk'] ?></td>
      </tr>
      <tr>
        <td class="text-bold-10">NAMA MK</td>
        <td>:</td>
        <td><?= $mk['nama_mk'] ?></td>
      </tr>
      <tr>
        <td class="text-bold-10">TAHUN</td>
        <td>:</td>
        <td><?= $mk_bap['tahun'] ?></td>
      </tr>
      <tr>
        <td class="text-bold-10">TOTAL JAM</td>
        <td>:</td>
        <td><?= $mk_bap['jumlah_jam'] ?></td>
      </tr>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; border: 1px solid black;">
      <thead style="text-align: center; background-color: #bdc3c7; font-weight: bold;">
        <tr>
          <td class="table" width="5%">No</td>
          <td class="table" width="15%">Tanggal</td>
          <td class="table" width="15%">Kelas</td>
          <td class="table" width="10%">Jam Masuk</td>
          <td class="table" width="10%">Jam Keluar</td>
          <td class="table" width="10%">Jumlah Jam</td>
          <td class="table">Modul Praktikum</td>
          <td class="table" width="10%">Paraf Asprak</td>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($kehadiran as $k) {
          $split_tanggal = explode(' ', $k['jam_masuk']);
          $tanggal = $split_tanggal[0];
        ?>
          <tr>
            <td class="table" style="height: 30px;"><?= $no++ ?></td>
            <td class="table"><?= convertTanggalPendek($tanggal) ?></td>
            <td class="table"><?= $k['kelas'] ?></td>
            <td class="table"><?= ambilJamAsprak($k['jam_masuk']) ?></td>
            <td class="table"><?= ambilJamAsprak($k['jam_keluar']) ?></td>
            <td class="table"><?= $k['jumlah_jam'] ?></td>
            <td class="table"><?= $k['modul_praktikum'] ?></td>
            <td class="table">&nbsp;</td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <br>
    <table width="100%">
      <tr>
        <td width="60%"></td>
        <td width="40%" style="text-align: center;">
          Bandung, <?= convertTanggal($mk_bap['tanggal_generate']) ?>
          <br>
          Koordinator Dosen Mata Kuliah
          <br><br><br><br><br>
          <span style="text-decoration: underline;"><?= $koor ?></span>
        </td>
      </tr>
    </table>
    <footer>
      Digenerate oleh <?= $laboran['nama_laboran'] ?> <img src="<?= base_url($mk_bap['qr']) ?>" class="qr-code">
    </footer>
  </section>
</body>

</html>