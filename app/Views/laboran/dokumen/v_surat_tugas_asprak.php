<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Surat Tugas Asprak</h5>
      </div>
      <div class="card-body">
        <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
          </div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_surat_tugas"><i class="feather icon-plus"></i> Tambah Surat Tugas</button>
        <div id="form_surat_tugas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Surat Tugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('Dokumen/simpanSuratTugasAsprak') ?>">
                <?= csrf_field(); ?>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="nama_dokumen">Kode & Nama Mata Kuliah</label>
                        <select class="matakuliah form-control" name="mk" required>
                          <option></option>
                          <?php
                          foreach ($matakuliah_semester as $mks) :
                          ?>
                            <option value="<?= $mks['id_mk_semester'] ?>"><?= $mks['jenjang_prodi'] . '' . $mks['kode_prodi'] . ' | ' . $mks['kode_mk'] . ' | ' . $mks['nama_mk'] ?></option>
                          <?php
                          endforeach;
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="dt-responsive table-responsive" style="margin-top: 10px;">
          <table id="surat_tugas" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal Generate</th>
                <th>Kode & Nama Mata Kuliah</th>
                <th>Tahun Ajaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($surat_tugas as $st) :
                $hash_id = substr(sha1($st['id_dsta']), 12, 7);
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= convertTanggal($st['tanggal_dibuat']) ?></td>
                  <td><?= $st['kode_mk'] . ' | ' . $st['nama_mk'] ?></td>
                  <td><?= $st['tahun_ajaran'] ?></td>
                  <td>
                    <a href="<?= base_url('Dokumen/LihatSuratTugas/' . $hash_id) ?>" target="_blank">
                      <button class="btn btn-sm btn-info"><i class="feather icon-eye"></i></button>
                    </a>
                    <button class="btn btn-sm btn-danger"><i class="feather icon-trash-2"></i></button>
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