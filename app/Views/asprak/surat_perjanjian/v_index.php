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
          <table id="surat_perjanjian" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Mata Kuliah</th>
                <th>Program Studi Mata Kuliah</th>
                <th>Tahun Ajaran</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($sp as $sp) : ?>
                <?php
                $hash_id_asprak_list = substr(sha1($sp['id_asprak_list']), 7, 7);
                $tahun_ajaran = $sp['tahun_ajaran'];
                $split_ta     = explode('-', $tahun_ajaran);
                if ($split_ta[1] == '1') {
                  $ta = 'Semester Ganjil Tahun Ajaran ';
                } elseif ($split_ta[1] == '2') {
                  $ta = 'Semester Genap Tahun Ajaran ';
                }
                $ta .= $split_ta[0];
                if ($sp['surat_perjanjian'] == null) {
                  $status = '<span class="badge badge-warning"><i class="feather icon-alert-circle"></i> Belum Tanda Tangan</span>';
                } else {
                  $status = '<span class="badge badge-success"><i class="feather feather icon-check-circle"></i> Sudah Tanda Tangan</span>';
                }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $sp['kode_mk'] . ' | ' . $sp['nama_mk'] ?></td>
                  <td><?= $sp['jenjang_prodi'] . ' ' . $sp['nama_prodi'] ?></td>
                  <td><?= $ta ?></td>
                  <td>
                    <span id="status_sp_<?= $hash_id_asprak_list ?>">
                      <?= $status ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($sp['surat_perjanjian'] == null) : ?>
                      <button type="button" id="ttd_<?= $hash_id_asprak_list ?>" class="btn btn-sm btn-success" onclick="ttd_sp('<?= $hash_id_asprak_list ?>')">
                        <span data-toggle="tooltip" data-placement="bottom" title="Tanda Tangan"><i class="fas fa-file-signature"></i></span>
                      </button>
                    <?php endif; ?>
                    <a href="<?= base_url('Asprak/SuratPerjanjian/view/' . $hash_id_asprak_list) ?>" target="_blank">
                      <button type="button" class="btn btn-sm btn-info">
                        <span data-toggle="tooltip" data-placement="bottom" title="Lihat Surat Perjanjian"><i class="feather icon-eye"></i></span>
                      </button>
                    </a>
                  </td>
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