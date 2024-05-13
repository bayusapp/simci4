<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="shortcut icon" type="image/png" href="https://sim.bayusapp.com/assets/img/favicon.png" />
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

</head>

<body class="gray-bg">

  <div class="loginColumns animated fadeInDown">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <center><img src="<?= base_url() ?>assets/img/logo.png" height="70px" style="margin-bottom: 30px;"></center>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <h2 class="font-bold" style="text-align: center;">Form Trouble Ticket Laboratorium</h2>
            </div>
          </div>
          <form class="m-t" role="form" action="<?= base_url('Ticketing/submit') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold" for="kategori_informan">Kategori Informan</label>
                  <select name="kategori_informan" id="kategori_informan" class="form-control kategori_informan">
                    <option></option>
                    <option value="Dosen" <?php if (old('kategori_informan') == 'Dosen') echo 'selected="selected"' ?>>Dosen</option>
                    <option value="Pegawai" <?php if (old('kategori_informan') == 'Pegawai') echo 'selected="selected"' ?>>Pegawai</option>
                    <option value="Aslab" <?php if (old('kategori_informan') == 'Aslab') echo 'selected="selected"' ?>>Asisten Laboratorium</option>
                    <option value="Asprak" <?php if (old('kategori_informan') == 'Asprak') echo 'selected="selected"' ?>>Asisten Praktikum</option>
                    <option value="Mahasiswa" <?php if (old('kategori_informan') == 'Mahasiswa') echo 'selected="selected"' ?>>Mahasiswa</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold" for="nama_informan">Nama Informan</label>
                  <input type="text" name="nama_informan" id="nama_informan" class="form-control" placeholder="Contoh: Bayu Setya Ajie" value="<?= old('nama_informan') ?>">
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="form-group">
                  <label class="font-bold" for="no_informan">No. WhatsApp</label>
                  <input type="text" name="no_informan" id="no_informan" class="form-control" placeholder="Contoh: 6281234567890" value="<?= old('no_informan') ?>" onkeypress="return hanyaAngka(event)">
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold" for="laboratorium">Laboratorium</label>
                  <select name="laboratorium" id="laboratorium" class="form-control laboratorium">
                    <option></option>
                    <?php
                    foreach ($laboratorium as $l) {
                    ?>
                      <option value="<?= $l['id_lab'] ?>" <?php if (old('laboratorium') == $l['id_lab']) echo 'selected="selected"' ?>><?= $l['kode_lab'] . " - " . $l['nama_lab'] ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="form-group">
                  <label class="font-bold" for="keluhan">Keluhan</label>
                  <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Contoh: Komputer 5 mati" rows="4"><?= old('keluhan') ?></textarea>
                </div>
                <div class="form-group">
                  <input type="text" name="lokasi" id="lokasi" class="form-control" readonly hidden>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <button type="submit" name="submit" id="submit" class="btn btn-primary">Kirim</button>
                  <button type="reset" id="reset" class="btn btn-warning">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div id='map'></div>
    <hr />
    <div class="row">
      <div class="col-md-6">
        Copyright Example Company
      </div>
      <div class="col-md-6 text-right">
        <small>© 2014-2015</small>
      </div>
    </div>
  </div>
  <div class="footer">
    <div>
      <strong>Copyright</strong> Unit Laboratorium/Bengkel/Studio, FIT, Tel-U &copy; 2024
    </div>
  </div>
  <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/select2/select2.full.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script>
    $(document).ready(function() {
      $('#tanggal_kendala .input-group.date').datepicker({
        language: "id",
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
      });

      $(".kategori_informan").select2({
        placeholder: "Pilih Kategori Informan",
        allowClear: true
      });

      $("#reset").on("click", reset);

      $(".laboratorium").select2({
        placeholder: "Pilih Pilih Laboratorium",
        allowClear: true
      });
    });

    function reset() {
      $('#kategori_informan').val(null).trigger('change');
      $('#laboratorium').val(null).trigger('change');
    }

    const map = L.map('map').fitWorld();

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    function onLocationFound(e) {
      document.getElementById('lokasi').value = e.latlng;
    }

    function onLocationError(e) {
      console.log(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate({
      setView: true,
      maxZoom: 16
    });

    function hanyaAngka(event) {
      var angka = (event.which) ? event.which : event.keyCode
      if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
        return false;
      return true;
    }
  </script>
  <?php if (!empty(session()->getFlashdata('error'))) : ?>
    <script>
      $(document).ready(function() {
        swal({
          title: "Gagal Submit Trouble Ticket",
          text: "Harap lengkapi semua field",
          type: "error"
        });
      });
    </script>
  <?php endif; ?>

  <?php if (!empty(session()->getFlashdata('success'))) : ?>
    <script>
      $(document).ready(function() {
        swal({
          title: "Sukses Submit Trouble Ticket",
          text: "Trouble ticket sukses dikirim",
          type: "success"
        });
      });
    </script>
  <?php endif; ?>
</body>

</html>