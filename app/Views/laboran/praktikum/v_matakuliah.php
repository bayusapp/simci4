<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-5 col-md-4">
            <?php
            $model_ta = new \App\Models\M_Tahun_Ajaran();
            $ta_aktif = $model_ta->getTahunAjaranByID($tahun_aktif)['tahun_ajaran'];
            $split_ta = explode('-', $ta_aktif);
            if ($split_ta[1] == "1") {
              $semester = 'Ganjil';
            } elseif ($split_ta[1] == "2") {
              $semester = 'Genap';
            }
            ?>
            <h5>Mata Kuliah Semester <?= $semester ?> Tahun Ajaran <?= $split_ta[0] ?></h5>
          </div>
          <div class="offset-lg-4 col-lg-3 offset-md-3 col-md-5">
            <form method="post" action="<?= base_url('Praktikum/Matakuliah') ?>">
              <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-8 col-8">
                  <select class="tahun_ajaran form-control" name="tahun_ajaran">
                    <option></option>
                    <?php foreach ($ta as $t) : ?>
                      <option value="<?= $t['id_ta'] ?>"><?= $t['tahun_ajaran'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-4 col-4">
                  <button type="submit" class="btn btn-sm btn-info"><i class="feather icon-filter"></i> Filter</button>
                </div>
              </div>
            </form>
          </div>
        </div>
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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Mata Kuliah Semester</button>
        <div id="form_lab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Mata Kuliah Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('Praktikum/simpanMK') ?>">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-5 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="kode_mk">Mata Kuliah</label>
                        <select class="matakuliah form-control" name="kode_mk" id="kode_mk" required>
                          <option></option>
                          <?php foreach ($matakuliah as $m) : ?>
                            <option value="<?= $m['kode_mk'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' - ' . $m['nama_mk'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-5 col-sm-12">
                      <div class="form-group">
                        <label for="id_ta">Tahun Ajaran/Semester</label>
                        <select class="tahun_ajaran form-control" name="id_ta" id="id_ta" required>
                          <option></option>
                          <?php foreach ($ta as $t) : ?>
                            <option value="<?= $t['id_ta'] ?>"><?= $t['tahun_ajaran'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12">
                      <div class="form-group">
                        <label for="kode_dosen">Dosen Koordinator</label>
                        <select class="dosen form-control" name="kode_dosen" id="kode_dosen" required>
                          <option></option>
                          <?php foreach ($dosen as $d) : ?>
                            <option value="<?= $d['kode_dosen'] ?>"><?= $d['kode_dosen'] . ' - ' . $d['nama_dosen'] ?></option>
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
              <a class="nav-link <?= $active ?>" id="<?= $p['kode_prodi'] ?>-tab" data-toggle="pill" href="#<?= $p['kode_prodi'] ?>" role="tab" aria-controls="<?= $p['kode_prodi'] ?>" aria-selected="true"><?= $p['kode_prodi'] ?></a>
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
            <div class="tab-pane fade <?= $show_active ?>" id="<?= $p['kode_prodi'] ?>" role="tabpanel" aria-labelledby="<?= $p['kode_prodi'] ?>-tab">
              <div class="dt-responsive table-responsive">
                <table id="mk_<?= strtolower($p['kode_prodi']) ?>" class="table table-striped table-bordered nowrap" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mata Kuliah</th>
                      <th>Koordinator Mata Kuliah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $model_mk_semester  = new \App\Models\M_Matakuliah_Semester();
                    $mk                 = $model_mk_semester->getDataMKSemesterProdi($p['id_prodi'], $tahun_aktif);
                    foreach ($mk as $m) :
                      $hash_mk = substr(sha1($m['id_mk_semester']), 7, 7);
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $m['kode_mk'] . ' - ' . $m['nama_mk'] ?></td>
                        <td><?= $m['nama_dosen'] ?></td>
                        <td style="text-align: center;">
                          <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_mk_<?= $hash_mk ?>">
                            <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                          </button>
                          <button type="button" class="btn btn-sm btn-danger" onclick="hapus_mk_semester('<?= $hash_mk ?>')">
                            <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                          </button>
                        </td>
                        <div id="edit_mk_<?= $hash_mk ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="label_form">Form Edit Mata Kuliah Semester</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form method="post" action="<?= base_url('Praktikum/updateMK') ?>">
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-lg-5 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label for="kode_mk">Mata Kuliah</label>
                                        <input type="text" name="id_mk_semester" value="<?= $hash_mk ?>" hidden readonly>
                                        <select class="matakuliah form-control" name="kode_mk" required>
                                          <option></option>
                                          <?php foreach ($matakuliah as $mk) : ?>
                                            <?php
                                            if ($m['kode_mk'] == $mk['kode_mk']) {
                                              $select_mk = 'selected';
                                            } else {
                                              $select_mk = '';
                                            }
                                            ?>
                                            <option value="<?= $mk['kode_mk'] ?>" <?= $select_mk ?>><?= $mk['jenjang_prodi'] . '' . $mk['kode_prodi'] . ' | ' . $mk['kode_mk'] . ' - ' . $mk['nama_mk'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-5 col-sm-12">
                                      <div class="form-group">
                                        <label for="id_ta">Tahun Ajaran/Semester</label>
                                        <select class="tahun_ajaran form-control" name="id_ta" required>
                                          <option></option>
                                          <?php foreach ($ta as $t) : ?>
                                            <?php
                                            if ($m['id_ta'] == $t['id_ta']) {
                                              $select_ta = 'selected';
                                            } else {
                                              $select_ta = '';
                                            }
                                            ?>
                                            <option value="<?= $t['id_ta'] ?>" <?= $select_ta ?>><?= $t['tahun_ajaran'] ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-lg-4 col-md-5 col-sm-12">
                                      <div class="form-group">
                                        <label for="kode_dosen">Dosen Koordinator</label>
                                        <select class="dosen form-control" name="kode_dosen" required>
                                          <option></option>
                                          <?php foreach ($dosen as $d) : ?>
                                            <?php
                                            if ($m['kode_dosen'] == $d['kode_dosen']) {
                                              $select_dosen = 'selected';
                                            } else {
                                              $select_dosen = '';
                                            }
                                            ?>
                                            <option value="<?= $d['kode_dosen'] ?>" <?= $select_dosen ?>><?= $d['kode_dosen'] . ' - ' . $d['nama_dosen'] ?></option>
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
<?= $this->endSection('content') ?>