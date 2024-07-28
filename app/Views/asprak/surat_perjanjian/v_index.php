<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Surat Perjanjian</h5>
      </div>
      <div class="card-body">
        <div class="dt-responsive table-responsive">
          <table id="riwayat_login" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Program Studi</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($sp as $sp) : ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?=$sp['kode_mk'].' | '.$sp['nama_mk']?></td>
                  <td><?=$sp['jenjang_prodi'].' '.$sp['nama_prodi']?></td>
                </tr>
              <?php endforeach; ?>
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