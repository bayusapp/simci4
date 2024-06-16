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
            <h5>Laboratorium</h5>
          </div>
          <div class="card-body">
            <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
              <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('sukses') ?>
              </div>
            <?php endif; ?>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Laboratorium</button>
            <div id="form_lab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Laboratorium</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Laboratorium/simpanLaboratorium') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                          <div class="form-group">
                            <label for="nama_lab">Nama Laboratorium</label>
                            <input type="text" class="form-control" name="nama_lab" id="nama_lab" value="<?= old('nama_lab') ?>" placeholder="Contoh: Computer Laboratory">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="kode_lab">Kode Laboratorium</label>
                            <input type="text" class="form-control" name="kode_lab" id="kode_lab" value="<?= old('kode_lab') ?>" placeholder="Contoh: Y2">
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="kode_ruang">Kode Ruangan</label>
                            <input type="text" class="form-control" name="kode_ruang" id="kode_ruang" value="<?= old('kode_ruang') ?>" placeholder="Contoh: IT1.02.07">
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="lokasi_lab">Lokasi Laboratorium</label>
                            <select class="id_lab_lokasi form-control" name="id_lab_lokasi">
                              <option></option>
                              <?php foreach ($lokasi as $l) : ?>
                                <option value="<?= $l['id_lab_lokasi'] ?>"><?= $l['lokasi'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="kategori_lab">Kategori Laboratorium</label>
                            <select class="id_lab_kategori form-control" name="id_lab_kategori">
                              <option></option>
                              <?php foreach ($kategori as $k) : ?>
                                <option value="<?= $k['id_lab_kategori'] ?>"><?= $k['kategori_lab'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="id_prodi">Program Studi</label>
                            <select class="id_prodi form-control" name="id_prodi">
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
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist" style="margin-top: 10px;">
              <li class="nav-item">
                <a class="nav-link active text-uppercase" id="praktikum-tab" data-toggle="tab" href="#praktikum" role="tab" aria-controls="praktikum" aria-selected="true">Praktikum</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-uppercase" id="riset-tab" data-toggle="tab" href="#riset" role="tab" aria-controls="riset" aria-selected="false">Riset</a>
              </li>
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="praktikum" role="tabpanel" aria-labelledby="praktikum-tab">
                <div class="dt-responsive table-responsive">
                  <table id="lab-praktikum" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Laboratorium</th>
                        <th>Kode Ruangan</th>
                        <th>Lokasi</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($lab_praktikum as $p) : ?>
                        <?php
                        $hash_id_lab = substr(sha1($p['id_lab']), 7, 7);
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $p['nama_lab'] ?></td>
                          <td><?= $p['kode_lab'] . ' | ' . $p['kode_ruang'] ?></td>
                          <td><?= $p['lokasi'] ?></td>
                          <td><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></td>
                          <td style="text-align: center;">
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#form_edit_lab_<?= $hash_id_lab ?>">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" onclick="hapus_lab('<?= $hash_id_lab ?>')">Hapus</button>
                          </td>
                          <div id="form_edit_lab_<?= $hash_id_lab ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="label_form">Form Edit Laboratorium</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" action="<?= base_url('Laboratorium/updateLaboratorium/' . $hash_id_lab) ?>">
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label for="edit_nama_lab">Nama Laboratorium</label>
                                          <input type="text" class="form-control" name="edit_nama_lab" id="edit_nama_lab" value="<?= $p['nama_lab'] ?>" placeholder="Contoh: Computer Laboratory">
                                          <input type="text" name="id_lab" id="id_lab" value="<?= $p['id_lab'] ?>" readonly hidden>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="edit_kode_lab">Kode Laboratorium</label>
                                          <input type="text" class="form-control" name="edit_kode_lab" id="edit_kode_lab" value="<?= $p['kode_lab'] ?>" placeholder="Contoh: Y2">
                                        </div>
                                      </div>
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label for="edit_kode_ruang">Kode Ruangan</label>
                                          <input type="text" class="form-control" name="edit_kode_ruang" id="edit_kode_ruang" value="<?= $p['kode_ruang'] ?>" placeholder="Contoh: IT1.02.07">
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="lokasi_lab">Lokasi Laboratorium</label>
                                          <select class="id_lab_lokasi form-control" name="edit_id_lab_lokasi">
                                            <option></option>
                                            <?php foreach ($lokasi as $l) : ?>
                                              <?php
                                              if ($l['id_lab_lokasi'] == $p['id_lab_lokasi']) {
                                                $select_lokasi = 'selected';
                                              } else {
                                                $select_lokasi = '';
                                              }
                                              ?>
                                              <option value="<?= $l['id_lab_lokasi'] ?>" <?= $select_lokasi ?>><?= $l['lokasi'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="kategori_lab">Kategori Laboratorium</label>
                                          <select class="id_lab_kategori form-control" name="edit_id_lab_kategori">
                                            <option></option>
                                            <?php foreach ($kategori as $k) : ?>
                                              <?php
                                              if ($k['id_lab_kategori'] == $p['id_lab_kategori']) {
                                                $select_kategori = 'selected';
                                              } else {
                                                $select_kategori = '';
                                              }
                                              ?>
                                              <option value="<?= $k['id_lab_kategori'] ?>" <?= $select_kategori ?>><?= $k['kategori_lab'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group">
                                          <label for="id_prodi">Program Studi</label>
                                          <select class="id_prodi form-control" name="edit_id_prodi">
                                            <option></option>
                                            <?php foreach ($prodi as $pr) : ?>
                                              <?php
                                              if ($pr['id_prodi'] == $p['id_prodi']) {
                                                $select_prodi = 'selected';
                                              } else {
                                                $select_prodi = '';
                                              }
                                              ?>
                                              <option value="<?= $pr['id_prodi'] ?>" <?= $select_prodi ?>><?= $pr['jenjang_prodi'] . ' ' . $pr['nama_prodi'] ?></option>
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
              <div class="tab-pane fade" id="riset" role="tabpanel" aria-labelledby="riset-tab">
                <div class="dt-responsive table-responsive">
                  <table id="lab-riset" class="table table-striped table-bordered nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Laboratorium</th>
                        <th>Kode Ruangan</th>
                        <th>Lokasi</th>
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
        </div>
      </div>
      <!-- Zero config table end -->
    </div>
    <!-- [ Main Content ] end -->
  </div>
</section>
<?= $this->endSection('content') ?>