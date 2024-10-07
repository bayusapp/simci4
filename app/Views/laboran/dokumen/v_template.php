<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Template Dokumen</h5>
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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_dokumen"><i class="feather icon-plus"></i> Tambah Dokumen</button>
        <div id="form_dokumen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Template Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('Dokumen/simpanDokumen') ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="nama_dokumen">Nama Dokumen</label>
                        <input type="text" class="form-control" name="nama_dokumen" id="nama_dokumen" value="<?= old('nama_dokumen') ?>" placeholder="Contoh: Template LPJ Asprak D3 SI" required>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="file_dokumen">File Dokumen</label>
                        <input type="file" class="form-control" name="file_dokumen" id="file_dokumen" required>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="kategori_dokumen">Kategori Dokumen</label>
                        <select class="kategori_dokumen form-control" name="kategori_dokumen" required>
                          <option></option>
                          <?php foreach ($jenis as $j): ?>
                            <option value="<?= $j['id_dokumen_kategori'] ?>"><?= $j['nama_dokumen_kategori'] ?></option>
                          <?php endforeach; ?>
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
          <table id="template" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Dokumen</th>
                <th>Jenis Dokumen</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>

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