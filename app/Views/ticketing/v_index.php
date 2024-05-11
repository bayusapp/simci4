<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INSPINIA | Login 2</title>
  <link rel="shortcut icon" type="image/png" href="https://sim.bayusapp.com/assets/img/favicon.png" />
  <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/animate.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/style.css" rel="stylesheet">
  <link href="<?= base_url() ?>assets/css/plugins/select2/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

</head>

<body class="gray-bg">

  <div class="loginColumns animated fadeInDown">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="ibox-content">
          <form class="m-t" role="form" action="index.html">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold">Kategori Informan</label>
                  <select name="kategori_informan" id="kategori_informan" class="form-control kategori_informan">
                    <option></option>
                    <option value="Dosen">Dosen</option>
                    <option value="Pegawai">Pegawai</option>
                    <option value="Aslab">Asisten Laboratorium</option>
                    <option value="Asprak">Asisten Praktikum</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                  </select>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold">Nama Informan</label>
                  <input type="text" name="nama_informan" id="nama_informan" class="form-control" placeholder="Contoh: Bayu Setya Ajie">
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="form-group">
                  <label class="font-bold">Laboratorium</label>
                  <select name="laboratorium" id="laboratorium" class="form-control laboratorium">
                    <option></option>
                  </select>
                </div>
                <div class="form-group">
                  <input type="text" name="location" id="location" class="form-control" readonly>
                </div>
              </div>
              <!-- <div>
                <div class="form-group">
                  <input type="text" name="location" id="location" class="form-control" readonly>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="#">
                  <small>Forgot password?</small>
                </a>

                <p class="text-muted text-center">
                  <small>Do not have an account?</small>
                </p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a>

                <p class="m-t">
                  <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small>
                </p>

              </div> -->
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
  <script src="<?= base_url() ?>assets/js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url() ?>assets/js/plugins/select2/select2.full.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script>
    $(document).ready(function() {
      $(".kategori_informan").select2({
        placeholder: "Pilih Kategori Informan",
      });
    });

    window.setTimeout(function() {
      $(".msg").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 3500);

    const map = L.map('map').fitWorld();

    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    function onLocationFound(e) {
      document.getElementById('location').value = e.latlng;
    }

    function onLocationError(e) {
      // alert(e.message);
      console.log(e.message);
    }

    map.on('locationfound', onLocationFound);
    map.on('locationerror', onLocationError);

    map.locate({
      setView: true,
      maxZoom: 16
    });
  </script>

</body>

</html>