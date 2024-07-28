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
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/plugins/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
</head>

<body>
  <div class="auth-wrapper">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="auth-content">
          <div class="card">
            <div class="row align-items-center text-center">
              <div class="col-md-12">
                <div class="card-body">
                  <h4 class="mb-3 f-w-400">Log Book Ruangan Lab</h4>
                  <form method="post" action="<?= base_url('Logbook/LogbookLab') ?>">
                    <select name="lab[]" class="lab col-sm-12" multiple="multiple" required>
                      <option></option>
                      <?php foreach ($lab as $l) : ?>
                        <option value="<?= $l['kode_lab'] ?>"><?= $l['kode_lab'] ?></option>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-block btn-primary mb-4"><i class="feather icon-printer"></i> Cetak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="auth-content">
          <div class="card">
            <div class="row align-items-center text-center">
              <div class="col-md-12">
                <div class="card-body">
                  <h4 class="mb-3 f-w-400">BAST Kunci Lab</h4>
                  <form method="post" action="<?= base_url('Logbook/BAST') ?>">
                    <select name="lantai" class="lantai col-sm-12" required>
                      <option></option>
                      <?php foreach ($lokasi as $l) : ?>
                        <?php if ($l['lokasi'] == 'Lantai 1') : ?>
                          <option value="<?= $l['id_lab_lokasi'] ?>"><?= $l['lokasi'] . ' & Lantai 4' ?></option>
                        <?php elseif ($l['lokasi'] != 'Lantai 4') : ?>
                          <option value="<?= $l['id_lab_lokasi'] ?>"><?= $l['lokasi'] ?></option>
                        <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-block btn-primary mb-4"><i class="feather icon-printer"></i> Cetak</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/vendor-all.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/bootstrap.min.js"></script>
  <script src="<?= base_url() ?>assets/js/ripple.js"></script>
  <script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>

  <!-- select2 Js -->
  <script src="<?= base_url() ?>assets/js/plugins/select2.full.min.js"></script>
  <!-- form-select-custom Js -->
  <script src="<?= base_url() ?>assets/js/pages/form-select-custom.js"></script>
  <script>
    $(document).ready(function() {
      $(".lab").select2({
        placeholder: "Pilih Laboratorium",
        allowClear: true,
      });

      $(".lantai").select2({
        placeholder: "Pilih Lantai",
        allowClear: true,
      });
    });
  </script>
</body>

</html>