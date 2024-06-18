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
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Mata Kuliah</button>
            <div id="form_lab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/simpanMK') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="kode_mk">Kode Mata Kuliah</label>
                            <input type="text" class="form-control" name="kode_mk" id="kode_mk" value="<?= old('kode_mk') ?>" placeholder="Contoh: VSI1I3" required>
                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                          <div class="form-group">
                            <label for="nama_mk">Nama Mata Kuliah</label>
                            <input type="text" class="form-control" name="nama_mk" id="nama_mk" value="<?= old('nama_mk') ?>" placeholder="Contoh: Arsitektur dan Jaringan Komputer" required>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="id_prodi">Program Studi</label>
                            <select class="id_prodi form-control" name="id_prodi" required>
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
            <ul class="nav nav-pills mb-3" id="myTab" role="tablist" style="margin-top: 10px;">
              <?php $count = 1; ?>
              <?php foreach ($prodi as $p) : ?>
                <?php
                if ($count == 1) {
                  $active = 'active';
                } else {
                  $active = '';
                }
                $count++;
                ?>
                <li class="nav-item">
                  <a class="nav-link <?= $active ?>" id="<?= $p['kode_prodi'] ?>-tab" data-toggle="pill" href="#pills-<?= $p['kode_prodi'] ?>" role="tab" aria-controls="pills-<?= $p['kode_prodi'] ?>" aria-selected="true"><?= $p['kode_prodi'] ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <?php $count = 1; ?>
              <?php foreach ($prodi as $p) : ?>
                <?php
                if ($count == 1) {
                  $show_active = 'show active';
                } else {
                  $show_active = '';
                }
                $count++;
                ?>
                <div class="tab-pane fade <?= $show_active ?>" id="pills-<?= $p['kode_prodi'] ?>" role="tabpanel" aria-labelledby="<?= $p['kode_prodi'] ?>-tab">
                  <div class="dt-responsive table-responsive">
                    <table id="mk_<?= strtolower($p['kode_prodi']) ?>" class="table table-striped table-bordered nowrap" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Mata Kuliah</th>
                          <th>Nama Mata Kuliah</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        $model_mk = new \App\Models\M_Matakuliah();
                        $mk       = $model_mk->getDataMKProdi($p['id_prodi']);
                        foreach ($mk as $mk) :
                        ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $mk['kode_mk'] ?></td>
                            <td><?= $mk['nama_mk'] ?></td>
                            <td style="text-align: center;">
                              <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#form_edit_mk_<?= $mk['kode_mk'] ?>"><i class="feather icon-edit"></i></button>
                              <button type="button" class="btn btn-danger btn-sm" onclick="hapus_mk('<?= substr(sha1($mk['kode_mk']), 7, 7) ?>')"><i class="feather icon-trash-2"></i></button>
                            </td>
                            <div id="form_edit_mk_<?= $mk['kode_mk'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="label_form">Form Edit Mata Kuliah</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  </div>
                                  <form method="post" action="<?= base_url('Praktikum/updateMK') ?>">
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                          <div class="form-group">
                                            <label for="kode_mk">Kode Mata Kuliah</label>
                                            <input type="text" class="form-control" name="kode_mk" id="kode_mk" value="<?= $mk['kode_mk'] ?>" placeholder="Contoh: VSI1I3" required>
                                            <input type="text" class="form-control" name="kode_mk_lama" id="kode_mk_lama" value="<?= $mk['kode_mk'] ?>" placeholder="Contoh: VSI1I3" required readonly hidden>
                                          </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                          <div class="form-group">
                                            <label for="nama_mk">Nama Mata Kuliah</label>
                                            <input type="text" class="form-control" name="nama_mk" id="nama_mk" value="<?= $mk['nama_mk'] ?>" placeholder="Contoh: Arsitektur dan Jaringan Komputer" required>
                                          </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                          <div class="form-group">
                                            <label for="id_prodi">Program Studi</label>
                                            <select class="id_prodi form-control" name="id_prodi" required>
                                              <option></option>
                                              <?php foreach ($prodi as $p) : ?>
                                                <?php
                                                if ($p['id_prodi'] == $mk['id_prodi']) {
                                                  $selected = 'selected';
                                                } else {
                                                  $selected = '';
                                                }
                                                ?>
                                                <option value="<?= $p['id_prodi'] ?>" <?= $selected ?>><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></option>
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
              <?php endforeach; ?>
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