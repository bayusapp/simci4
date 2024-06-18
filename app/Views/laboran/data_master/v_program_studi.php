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
            <h5>Program Studi</h5>
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
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Program Studi</button>
            <div id="form_lab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Program Studi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('DataMaster/simpanProdi') ?>">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="nama_prodi">Nama Program Studi</label>
                            <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" value="<?= old('nama_prodi') ?>" placeholder="Contoh: D4 Sistem Informasi" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="jenjang_prodi">Jenjang</label>
                            <input type="text" class="form-control" name="jenjang_prodi" id="jenjang_prodi" value="<?= old('jenjang_prodi') ?>" placeholder="Contoh: D4" required>
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="kode_prodi">Kode Program Studi</label>
                            <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" value="<?= old('kode_prodi') ?>" placeholder="Contoh: SI" required>
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
              <table id="prodi" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Program Studi</th>
                    <th>Jenjang</th>
                    <th>Kode Prodi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($prodi as $p) : ?>
                    <?php $hash_prodi = substr(sha1($p['id_prodi']), 7, 7); ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $p['nama_prodi'] ?></td>
                      <td><?= $p['jenjang_prodi'] ?></td>
                      <td><?= $p['kode_prodi'] ?></td>
                      <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_prodi_<?= $hash_prodi ?>">
                          <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapus_prodi('<?= $hash_prodi ?>')">
                          <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                        </button>
                      </td>
                      <div id="edit_prodi_<?= $hash_prodi ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="label_form">Form Edit Program Studi</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="post" action="<?= base_url('DataMaster/updateProdi') ?>">
                              <?= csrf_field(); ?>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label for="nama_prodi">Nama Program Studi</label>
                                      <input type="text" class="form-control" name="nama_prodi" id="nama_prodi" value="<?= $p['nama_prodi'] ?>" placeholder="Contoh: D4 Sistem Informasi" required>
                                      <input type="text" name="id_prodi" value="<?= $hash_prodi ?>" hidden readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label for="jenjang_prodi">Jenjang</label>
                                      <input type="text" class="form-control" name="jenjang_prodi" id="jenjang_prodi" value="<?= $p['jenjang_prodi'] ?>" placeholder="Contoh: D4" required>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label for="kode_prodi">Kode Program Studi</label>
                                      <input type="text" class="form-control" name="kode_prodi" id="kode_prodi" value="<?= $p['kode_prodi'] ?>" placeholder="Contoh: SI" required>
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
    <!-- [ Main Content ] end -->
  </div>
</section>
<?= $this->endSection('content') ?>