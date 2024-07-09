<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
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
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
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
              <form method="post" action="<?= base_url('Laboratorium/simpanLab') ?>">
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
        <ul class="nav nav-pills mb-3" id="myTab" role="tablist" style="margin-top: 10px;">
          <?php $count = 1; ?>
          <?php foreach ($kategori as $k) : ?>
            <?php
            if ($count == 1) {
              $active = 'active';
            } else {
              $active = '';
            }
            $count++;
            ?>
            <li class="nav-item">
              <a class="nav-link <?= $active ?>" id="<?= $k['kategori_lab'] ?>-tab" data-toggle="tab" href="#<?= $k['kategori_lab'] ?>" role="tab" aria-controls="<?= $k['kategori_lab'] ?>" aria-selected="true"><?= $k['kategori_lab'] ?></a>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <?php $count = 1; ?>
          <?php foreach ($kategori as $k) : ?>
            <?php
            if ($count == 1) {
              $show_active = 'show active';
            } else {
              $show_active = '';
            }
            $count++;
            ?>
            <div class="tab-pane fade <?= $show_active ?>" id="<?= $k['kategori_lab'] ?>" role="tabpanel" aria-labelledby="<?= $k['kategori_lab'] ?>-tab">
              <div class="dt-responsive table-responsive">
                <table id="lab-<?= $k['kategori_lab'] ?>" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Laboratorium</th>
                      <th>Kode Ruangan</th>
                      <th>Lokasi</th>
                      <?php if ($k['kategori_lab'] == 'Praktikum') : ?>
                        <th>Program Studi</th>
                      <?php endif; ?>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $model_lab = new \App\Models\M_Laboratorium();
                    if ($k['kategori_lab'] == 'Praktikum') {
                      $data_lab = $model_lab->getDataLabPraktikum();
                    } elseif ($k['kategori_lab'] == 'Riset') {
                      $data_lab = $model_lab->getDataLabRiset();
                    } elseif ($k['kategori_lab'] == 'Workshop') {
                      $data_lab = $model_lab->getDataLabWorkshop();
                    }
                    foreach ($data_lab as $d) {
                      $hash_id = substr(sha1($d['id_lab']), 7, 7);
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama_lab'] ?></td>
                        <td><?= $d['kode_lab'] . ' | ' . $d['kode_ruang'] ?></td>
                        <td><?= $d['lokasi'] ?></td>
                        <?php if ($k['kategori_lab'] == 'Praktikum') : ?>
                          <td><?= $d['jenjang_prodi'] . ' ' . $d['nama_prodi'] ?></td>
                        <?php endif; ?>
                        <td style="text-align: center;">
                          <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_lab_<?= $d['id_lab'] ?>"><i class="feather icon-edit"></i></button>
                          <button type="button" class="btn btn-sm btn-danger" onclick="hapus_lab('<?= $hash_id ?>')"><i class="feather icon-trash-2"></i></button>
                        </td>
                        <div id="edit_lab_<?= $d['id_lab'] ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="label_form">Form Edit Laboratorium</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form method="post" action="<?= base_url('Laboratorium/updateLab') ?>">
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label>Nama Laboratorium</label>
                                        <input type="text" class="form-control" name="nama_lab" id="nama_lab" value="<?= $d['nama_lab'] ?>" placeholder="Contoh: Computer Laboratory">
                                        <input type="text" name="id_lab" id="id_lab" value="<?= $d['id_lab'] ?>" readonly hidden>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Kode Laboratorium</label>
                                        <input type="text" class="form-control" name="kode_lab" id="kode_lab" value="<?= $d['kode_lab'] ?>" placeholder="Contoh: Y2">
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Kode Ruangan</label>
                                        <input type="text" class="form-control" name="kode_ruang" id="kode_ruang" value="<?= $d['kode_ruang'] ?>" placeholder="Contoh: IT1.02.07">
                                      </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                      <div class="form-group">
                                        <label>Lokasi Laboratorium</label>
                                        <select class="id_lab_lokasi form-control" name="id_lab_lokasi">
                                          <option></option>
                                          <?php foreach ($lokasi as $lo) : ?>
                                            <?php
                                            if ($lo['id_lab_lokasi'] == $d['id_lab_lokasi']) {
                                              $select_lokasi = 'selected';
                                            } else {
                                              $select_lokasi = '';
                                            }
                                            ?>
                                            <option value="<?= $lo['id_lab_lokasi'] ?>" <?= $select_lokasi ?>><?= $lo['lokasi'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                      <div class="form-group">
                                        <label>Kategori Laboratorium</label>
                                        <select class="id_lab_kategori form-control" name="id_lab_kategori">
                                          <option></option>
                                          <?php foreach ($kategori as $ka) : ?>
                                            <?php
                                            if ($ka['id_lab_kategori'] == $d['id_lab_kategori']) {
                                              $select_kategori = 'selected';
                                            } else {
                                              $select_kategori = '';
                                            }
                                            ?>
                                            <option value="<?= $ka['id_lab_kategori'] ?>" <?= $select_kategori ?>><?= $ka['kategori_lab'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                      <div class="form-group">
                                        <label>Program Studi</label>
                                        <select class="prodi form-control" name="id_prodi">
                                          <option></option>
                                          <?php foreach ($prodi as $pr) : ?>
                                            <?php
                                            if ($pr['id_prodi'] == $d['id_prodi']) {
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
                    <?php } ?>
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
<?= $this->endSection('content') ?>