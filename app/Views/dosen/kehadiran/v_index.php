<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Kehadiran Asisten Praktikum</h5>
      </div>
      <div class="card-body">
        <div class="dt-responsive table-responsive" style="margin-top: 10px;">
          <table id="kehadiran_asprak" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Asprak</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Kelas</th>
                <th>Mata Kuliah & Modul Praktikum</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($kehadiran as $k) :
                $hash_kehadiran = substr(sha1($k['id_asprak_bap_kehadiran']), 12, 7);
                if ($k['approve_dosen'] == '0') :
                  $approve = '<span class="badge badge-warning"><i class="feather icon-alert-circle"></i> Menunggu Persetujuan</span>';
                elseif ($k['approve_dosen'] == '1') :
                  $approve = '<span class="badge badge-success"><i class="feather icon-check-circle"></i> Disetujui</span>';
                elseif ($k['approve_dosen'] == '2') :
                  $approve = '<span class="badge badge-danger"><i class="feather icon-x-circle"></i> Ditolak</span>';
                endif;
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $k['nama_asprak'] ?></td>
                  <td><?= convertTanggalPendek($k['tanggal']) ?></td>
                  <td><?= $k['masuk'] ?></td>
                  <td><?= $k['keluar'] ?></td>
                  <td><?= $k['kelas'] ?></td>
                  <td><?= $k['kode_mk'] . ' - ' . $k['nama_mk'] . ' | ' . $k['modul_praktikum'] ?></td>
                  <td>
                    <span id="status_approve_<?= $hash_kehadiran ?>">
                      <?= $approve ?>
                    </span>
                  </td>
                  <td>
                    <?php
                    if ($k['approve_dosen'] == '0'):
                    ?>
                      <span id="button_aksi_<?= $hash_kehadiran ?>">
                        <button type="button" class="btn btn-sm btn-success" onclick="approve_kehadiran('<?= $hash_kehadiran ?>')">
                          <span data-toggle="tooltip" data-placement="bottom" title="Setujui Kehadiran"><i class="feather icon-check"></i></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="reject_kehadiran('<?= $hash_kehadiran ?>')">
                          <span data-toggle="tooltip" data-placement="bottom" title="Tolak Kehadiran"><i class="feather icon-x"></i></span>
                        </button>
                      </span>
                    <?php
                    elseif ($k['approve_dosen'] == '1' || $k['approve_dosen'] == '2'):
                      echo '-';
                    endif;
                    ?>
                  </td>
                </tr>
              <?php
              endforeach;
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