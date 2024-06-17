<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <!-- <h5 class="m-b-10">Basic Table Sizes</h5> -->
              <img src="<?= base_url() ?>assets/images/toppng.com-all-new-r15-all-new-r15-logo-1551x302.png" style="max-height: 30px;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
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
  </div>
</section>
<?= $this->endSection('content') ?>