<!DOCTYPE html>
<html lang="en">

<head>
  <title>Surat Perjanjian Asisten Praktikum Mata Kuliah <?= $sp['kode_mk'] . ' - ' . $sp['nama_mk'] ?> | SIM Laboratorium</title>
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
      font-family: "Calibri", sans-serif;
    }

    @page {
      size: A4
    }

    .title {
      font-size: 20px;
      text-align: center;
    }

    .table {
      border-collapse: collapse;
      width: 100%;
    }

    .table thead {
      font-weight: bold;
    }

    img {
      height: 100px;
    }

    .header_surat {
      font-weight: bold;
      font-size: 24pt;
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
  </style>
</head>

<body class="A4">
  <section class="sheet padding-10mm">
    <table width="100%">
      <tr>
        <td><img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 66px;"></td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>LABORATORIUM</span>
        </td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>FAKULTAS ILMU TERAPAN</span>
        </td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>UNIVERSITAS TELKOM</span>
        </td>
      </tr>
    </table>
    <hr>
    <p style="font-weight: bold; text-decoration: underline; text-align: center; font-size: 20pt">SURAT PERJANJIAN</p>
    <br>
    <div class="body_surat">
      <p style="text-align: justify;">Dengan ini saya yang bernama,</p>
      <table width="100%">
        <tr>
          <td width="20%">Nama Lengkap</td>
          <td width="2%">:</td>
          <td><?= $sp['nama_asprak'] ?></td>
        </tr>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td><?= $sp['nim_asprak'] ?></td>
        </tr>
        <tr>
          <td>Asprak Mata Kuliah</td>
          <td>:</td>
          <td><?= $sp['kode_mk'] . ' - ' . $sp['nama_mk'] ?></td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td><?= $sp['jenjang_prodi'] . ' ' . $sp['nama_prodi'] ?></td>
        </tr>
      </table>
      <?php
      $tahun_ajaran = $sp['tahun_ajaran'];
      $split_ta     = explode('-', $tahun_ajaran);
      if ($split_ta[1] == '1') {
        $semester = 'Ganjil';
      } elseif ($split_ta[1] == '2') {
        $semester = 'Genap';
      }
      if ($sp['tanggal_surat_perjanjian'] == null) {
        $tanggal_ttd = 'xx xxxx xxxx';
      } else {
        $tanggal_ttd = convertTanggal($sp['tanggal_surat_perjanjian']);
      }
      if ($sp['surat_perjanjian'] == null) {
        $ttd = '<img src="' . base_url('assets/images/white.jpg') . '" style="max-height: 70px">';
      } else {
        $ttd = '<img src="' . base_url($sp['ttd_digital']) . '" style="max-height: 70px">';
      }
      ?>
      <p style="text-align: justify;">Menyatakan dan berjanji akan mematuhi aturan dan kebijakan laboratorium yang berlaku selama saya menjadi asisten praktikum di mata kuliah tersebut pada Semester <?= $semester ?> Tahun Akademik <?= $split_ta[0] ?> di Fakultas Ilmu Terapan Universitas Telkom. Dan bersedia menerima sanksi apabila melakukan pelanggaran yang tidak sesuai dengan aturan dan kebijakan laboratorium.</p>
      <br><br><br>
      <p>Bandung, <?= $tanggal_ttd ?></p>
      <?= $ttd ?>
      <p><?= $sp['nama_asprak'] ?></p>
    </div>
  </section>
  <section class="sheet padding-10mm">
    <table width="100%">
      <tr>
        <td><img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 66px;"></td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>LABORATORIUM</span>
        </td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>FAKULTAS ILMU TERAPAN</span>
        </td>
      </tr>
      <tr>
        <td class="header_surat">
          <span>UNIVERSITAS TELKOM</span>
        </td>
      </tr>
    </table>
    <hr>
    <div class="body_surat">
      <p style="font-weight: bold; text-align: center; margin-top: 22pt; margin-bottom: 11pt">DEFINISI DAN KETENTUAN ASISTEN PRAKTIKUM</p>
      <center><span style="font-weight: bold">DEFINISI</span></center>
      <table width="100%" class="def" style="margin-bottom: 11pt;">
        <tr>
          <td width="6%">(1)</td>
          <td>Asisten Praktikum adalah posisi yang diduduki mahasiswa aktif Fakultas Ilmu Terapan dengan tugas untuk membantu kegiatan praktikum.</td>
        </tr>
        <tr>
          <td>(2)</td>
          <td>Asisten Praktikum disahkan oleh Dekan Fakultas Ilmu Terapan.</td>
        </tr>
        <tr>
          <td>(3)</td>
          <td>Asisten Praktikum berkoordinasi langsung dengan Koordinator Dosen Mata Kuliah.</td>
        </tr>
      </table>
      <center><span style="font-weight: bold;">KETENTUAN</span></center>
      <table width="100%">
        <tr>
          <td width="6%">(1)</td>
          <td>Asisten Praktikum membantu Dosen dalam melakukan asistensi praktikum sesuai dengan Modul Praktikum yang ada.</td>
        </tr>
        <tr>
          <td>(2)</td>
          <td>Sebelum melaksanakan asistensi praktikum, Asisten Praktikum memastikan bahwa namanya terdaftar pada daftar Asisten Praktikum di Mata Kuliah yang berkaitan.</td>
        </tr>
        <tr>
          <td>(3)</td>
          <td>Asisten Praktikum melakukan pengisian Berita Acara Pelaksanaan Praktikum (BAPP) setiap praktikum dan langsung diserahkan ke Laboran saat praktikum selesai dilaksanakan.</td>
        </tr>
        <tr>
          <td>(4)</td>
          <td>Asisten Praktikum wajib menjaga kebersihan dan ketertiban laboratorium tempat pelaksanaan praktikum selama praktikum berlangsung.</td>
        </tr>
        <tr>
          <td>(5)</td>
          <td>Setelah praktikum selesai, Asisten Praktikum wajib membersihkan dan merapihkan kembali peralatan dan perlengkapan laboratorium yang telah digunakan.</td>
        </tr>
        <tr>
          <td>(6)</td>
          <td>Asisten Praktikum membuat rekap kehadiran secara individu di Berita Acara Pekerjaan dan Kehadiran (BAP) Asisten Praktikum.</td>
        </tr>
        <tr>
          <td>(7)</td>
          <td>Jumlah jam yang diperkenankan dicatat ke BAP <b>maksimal 6 jam per hari nya</b>.</td>
        </tr>
        <tr>
          <td>(8)</td>
          <td>Pengumpulan BAP Asisten Praktikum dilakukan <b>setiap tanggal 10</b> ke Laboran untuk direkap terlebih dahulu sebelum di serahkan ke bagian Keungan.</td>
        </tr>
        <tr>
          <td>(9)</td>
          <td>Pembayaran honor Asisten Praktikum sesuai dengan Modul Praktikum pada Mata Kuliah yang berkaitan. Kegiatan di luar modul tidak bisa dibayarkan honornya.</td>
        </tr>
        <tr>
          <td>(10)</td>
          <td>Pembayaran honor hanya untuk Asisten Praktikum yang terdaftar dan telah disahkan oleh Dekan Fakultas Ilmu Terapan.</td>
        </tr>
        <tr>
          <td>(11)</td>
          <td>Pembayaran honor Asisten Praktikum akan diberikan melalui transfer Bank Mandiri dan bukti slip honornya akan dikirimkan ke email masing-masing.</td>
        </tr>
        <tr>
          <td>(12)</td>
          <td>Di akhir semester, Asisten Praktikum membuat Laporan Praktikum untuk setiap Mata Kuliah Praktikum yang diketahui oleh Dosen Koordinator Mata Kuliah, Laboran, dan disetujui oleh Ka. Ur. Laboratorium/Bengkel/Studio FIT.</td>
        </tr>
        <tr>
          <td>(13)</td>
          <td>Penilaian kinerja Asisten Praktikum dari Laporan Praktikum dan rekap kehadiran asistensi per Mata Kuliah Praktikum berdasarkan BAP yang telah dikumpulkan.</td>
        </tr>
        <tr>
          <td>(14)</td>
          <td><i>Reward</i> berupa sertifikat dan TAK diserahkan ke Asisten Praktikum jika penilaian diatas 75%.</td>
        </tr>
      </table>
    </div>
  </section>
</body>

</html>