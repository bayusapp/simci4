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
            <h5>Dosen</h5>
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
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_dosen"><i class="feather icon-plus"></i> Tambah Dosen</button>
            <div id="form_dosen" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('DataMaster/simpanDosen') ?>">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="kode_dosen">Kode Dosen</label>
                            <input type="text" class="form-control" name="kode_dosen" id="kode_dosen" value="<?= old('kode_dosen') ?>" placeholder="Contoh: JOH" required>
                          </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                          <div class="form-group">
                            <label for="nama_dosen">Nama Dosen</label>
                            <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?= old('nama_dosen') ?>" placeholder="Contoh: John Doe" required>
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
              <table id="dosen" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Dosen</th>
                    <th>Nama Dosen</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($dosen as $d) : ?>
                    <?php $hash_kode_dosen = substr(sha1($d['kode_dosen']), 7, 7); ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $d['kode_dosen'] ?></td>
                      <td><?= $d['nama_dosen'] ?></td>
                      <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_dosen_<?= $hash_kode_dosen ?>">
                          <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger" onclick="hapus_dosen('<?= $hash_kode_dosen ?>')">
                          <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                        </button>
                      </td>
                      <div id="edit_dosen_<?= $hash_kode_dosen ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="label_form">Form Edit Dosen</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <form method="post" action="<?= base_url('DataMaster/updateDosen') ?>">
                              <?= csrf_field(); ?>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label for="kode_dosen">Kode Dosen</label>
                                      <input type="text" class="form-control" name="kode_dosen" id="kode_dosen" value="<?= $d['kode_dosen'] ?>" placeholder="Contoh: JOH" required>
                                      <input type="text" name="kode_dosen_old" value="<?= $hash_kode_dosen ?>" hidden readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="form-group">
                                      <label for="nama_dosen">Nama Dosen</label>
                                      <input type="text" class="form-control" name="nama_dosen" id="nama_dosen" value="<?= $d['nama_dosen'] ?>" placeholder="Contoh: John Doe" required>
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