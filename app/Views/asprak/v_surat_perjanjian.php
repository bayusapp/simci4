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

    .table th,
    td {}

    .table thead {
      font-weight: bold;
    }

    img {
      height: 100px;
    }

    .header_surat {
      font-weight: bold;
      font-size: 36px;
      text-align: center;
    }

    .body_surat {
      font-size: 17px;
      text-align: justify;
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
        <td><img src="<?= base_url('assets/images/logo_telu.png') ?>" style="max-height: 70px;"></td>
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
    <p style="font-weight: bold; text-decoration: underline; text-align: center; font-size: 30px">SURAT PERJANJIAN</p>
    <br>
    <div class="body_surat">
      <p style="font-size: 17px; text-align: justify;">Dengan ini saya yang bernama,</p>
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
      <p style="font-size: 17px; text-align: justify;">Menyatakan dan berjanji akan mematuhi aturan dan kebijakan laboratorium yang berlaku selama saya menjadi asisten praktikum di mata kuliah tersebut pada Semester ….. Tahun Akademik ……/…… di Fakultas Ilmu Terapan Universitas Telkom. Dan bersedia menerima sanksi apabila melakukan pelanggaran yang tidak sesuai dengan aturan dan kebijakan laboratorium.</p>
      <br><br><br>
      <p>Bandung, <?= date('d M Y') ?></p>
      <img src="<?= base_url('assets/images/ttd/Henokh_edit.png') ?>" style="max-height: 70px;">
      <p>Nama Lengkap</p>
    </div>
  </section>
</body>

</html>