<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Mata Kuliah</h5>
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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_mk"><i class="feather icon-plus"></i> Tambah Mata Kuliah</button>
        <div id="form_mk" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Mata Kuliah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('DataMaster/simpanMK') ?>">
                <?= csrf_field(); ?>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="kode_mk">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" name="kode_mk" id="kode_mk" value="<?= old('kode_mk') ?>" placeholder="Contoh: VAI1A4" required>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group">
                        <label for="nama_mk">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" name="nama_mk" id="nama_mk" value="<?= old('nama_mk') ?>" placeholder="Contoh: Algoritma dan Pemrograman " required>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="id_prodi">Program Studi</label>
                        <select class="prodi form-control" name="id_prodi">
                          <option></option>
                          <?php foreach ($prodi as $p) : ?>
                            <option value="<?= $p['id_prodi'] ?>"><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></option>
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
          <table id="matkul" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>Program Studi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1 ?>
              <?php foreach ($matkul as $m) : ?>
                <?php $hash_kode_mk = substr(sha1($m['kode_mk']), 7, 7); ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $m['kode_mk'] ?></td>
                  <td><?= $m['nama_mk'] ?></td>
                  <td><?= $m['jenjang_prodi'] . ' ' . $m['nama_prodi'] ?></td>
                  <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_mk_<?= $hash_kode_mk ?>">
                      <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapus_mk('<?= $hash_kode_mk ?>')">
                      <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                    </button>
                  </td>
                  <div id="edit_mk_<?= $hash_kode_mk ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_form">Form Edit Mata Kuliah</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="<?= base_url('DataMaster/updateMK') ?>">
                          <?= csrf_field(); ?>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="kode_mk">Kode Mata Kuliah</label>
                                  <input type="text" class="form-control" name="kode_mk" id="kode_mk" value="<?= $m['kode_mk'] ?>" placeholder="Contoh: VAI1A4" required>
                                  <input type="text" name="kode_mk_old" value="<?= $hash_kode_mk ?>" hidden readonly>
                                </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-group">
                                  <label for="nama_mk">Nama Mata Kuliah</label>
                                  <input type="text" class="form-control" name="nama_mk" id="nama_mk" value="<?= $m['nama_mk'] ?>" placeholder="Contoh: Algoritma dan Pemrograman " required>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="id_prodi">Program Studi</label>
                                  <select class="prodi form-control" name="id_prodi">
                                    <option></option>
                                    <?php foreach ($prodi as $p) : ?>
                                      <?php
                                      if ($p['id_prodi'] == $m['id_prodi']) {
                                        $select_prodi = 'selected';
                                      } else {
                                        $select_prodi = '';
                                      }
                                      ?>
                                      <option value="<?= $p['id_prodi'] ?>" <?= $select_prodi ?>><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
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
<?= $this->endSection('content') ?>