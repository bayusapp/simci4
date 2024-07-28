<html>

<head>
  <title>Logbook | SIM Laboratorium</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="Log Book dan Berita Acara Serah Terima Kunci" />
  <meta name="keywords" content="logbook, BAST, Laboratorium Fakultas Ilmu Terapan, Universitas Telkom">
  <meta name="author" content="Bayu Setya Ajie Perdana Putra" />
  <link rel="icon" href="<?= base_url() ?>assets/images/favicon.png" type="image/x-icon">
</head>

<body>
  <form method="post" action="<?= base_url('Logbook/simpan') ?>" enctype="multipart/form-data">
    <input type="file" name="file_csv" accept=".csv">
    <button type="submit" name="submit">Submit</button>
  </form>
</body>

</html>