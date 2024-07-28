<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Create a report base on paper size using CSS</title>
  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">
  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
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
      font-size: 12pt;
      text-align: justify;
    }

    .def .table tr,
    td {
      vertical-align: top;
    }
  </style>
</head>
<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->

<body class="A4">
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
    <!-- Write HTML just like a web page -->
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
          <td></td>
        </tr>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td></td>
        </tr>
        <tr>
          <td>Asprak Mata Kuliah</td>
          <td>:</td>
          <td></td>
        </tr>
        <tr>
          <td>Program Studi</td>
          <td>:</td>
          <td></td>
        </tr>
      </table>
      <p style="text-align: justify;">Menyatakan dan berjanji akan mematuhi aturan dan kebijakan laboratorium yang berlaku selama saya menjadi asisten praktikum di mata kuliah tersebut pada Semester ….. Tahun Akademik ……/…… di Fakultas Ilmu Terapan Universitas Telkom. Dan bersedia menerima sanksi apabila melakukan pelanggaran yang tidak sesuai dengan aturan dan kebijakan laboratorium.</p>
      <br><br><br>
      <p>Bandung, <?= date('d M Y') ?></p>
      <img src="<?= base_url('assets/images/ttd/Henokh_edit.png') ?>" style="max-height: 70px;">
      <p>Nama Lengkap</p>
    </div>
  </section>
  <section class="sheet padding-10mm">
    <!-- Write HTML just like a web page -->
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
      <table width="100%" class="def" style="margin-bottom: 22pt;">
        <tr>
          <td width="5%">(1)</td>
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
          <td width="5%">(1)</td>
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