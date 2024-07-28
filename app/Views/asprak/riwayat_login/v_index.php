<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Riwayat Login</h5>
      </div>
      <div class="card-body">
        <div class="dt-responsive table-responsive">
          <table id="riwayat_login" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>IP Address</th>
                <th>Browser</th>
                <th>Platform</th>
                <th>Lokasi</th>
                <th>ISP</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($data_login as $d) {
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $d['tanggal_login'] ?></td>
                  <td><?= $d['ip_address'] ?></td>
                  <td><?= $d['browser'] ?></td>
                  <td><?= $d['platform'] ?></td>
                  <td><?= $d['kota'] . ', ' . $d['provinsi'] ?></td>
                  <td><?= $d['organisasi'] ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>