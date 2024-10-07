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
            $id_ta_aktif = $model_ta->getTahunAjaranByID($tahun_aktif)['id_ta'];
            $split_ta = explode('-', $ta_aktif);
            if ($split_ta[1] == "1") {
              $semester = 'Ganjil';
            } elseif ($split_ta[1] == "2") {
              $semester = 'Genap';
            }
            ?>
            <h5>BAP Asisten Praktikum Tahun Ajaran <?= $split_ta[0] . ' Semester ' . $semester ?></h5>
          </div>
          <div class="offset-lg-4 col-lg-3 offset-md-3 col-md-5">
            <form method="post" action="<?= base_url('Praktikum/Asprak') ?>">
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
        <div class="row">
          <div class="col-lg-12">
            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#generate_bap"><i class="feather icon-refresh-cw"></i> Generate BAP</button>
            <div id="generate_bap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Generate BAP Asisten Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/generateBAP') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-6 col-md-3 col-sm-12">
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
                            <label for="id_ta">Dari Tanggal</label>
                            <input type="text" name="dari_tanggal" value="<?= date('m/d/Y') ?>" class="form-control" />
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-12">
                          <div class="form-group">
                            <label for="kode_dosen">Sampai Tanggal</label>
                            <input type="text" name="sampai_tanggal" value="<?= date('m/d/Y') ?>" class="form-control" />
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
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#print_bap"><i class="feather icon-printer"></i> Print BAP</button>
            <div id="print_bap" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Print BAP Asisten Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/generateBAP') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-6 col-md-3 col-sm-12">
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
                            <label for="id_ta">Dari Tanggal</label>
                            <input type="text" name="dari_tanggal" value="<?= date('m/d/Y') ?>" class="form-control" />
                          </div>
                        </div>
                        <div class="col-lg-3 col-md-5 col-sm-12">
                          <div class="form-group">
                            <label for="kode_dosen">Sampai Tanggal</label>
                            <input type="text" name="sampai_tanggal" value="<?= date('m/d/Y') ?>" class="form-control" />
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
            $id_prodi = $p['id_prodi'];
            $count++;
            ?>
            <div class="tab-pane fade <?= $show_active ?>" id="pills-<?= $p['kode_prodi'] ?>" role="tabpanel" aria-labelledby="<?= $p['kode_prodi'] ?>-tab">
              <div class="dt-responsive table-responsive">
                <table id="bap_<?= strtolower($p['kode_prodi']) ?>" class="table table-striped table-bordered nowrap" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIM</th>
                      <th>Nama Lengkap</th>
                      <th>Mata Kuliah</th>
                      <th>Periode</th>
                      <th>Jumlah Jam</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $model_asprak_bap = new \App\Models\M_Asprak_BAP();
                    $bap              = $model_asprak_bap->getDataBAP($id_prodi);
                    foreach ($bap as $b) {
                      $hash_bap = substr(sha1($b['id_asprak_bap']), 7, 7);
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b['nim_asprak'] ?></td>
                        <td><?= $b['nama_asprak'] ?></td>
                        <td><?= $b['kode_mk'] . ' | ' . $b['nama_mk'] ?></td>
                        <td><?= $b['bulan'] . ' ' . $b['tahun'] ?></td>
                        <td><?= $b['jumlah_jam'] ?></td>
                        <td>
                          <a href="<?= base_url('Praktikum/LihatBAP/' . $hash_bap) ?>" target="_blank">
                            <button type="button" class="btn btn-sm btn-success">
                              <i class="feather icon-eye"></i>
                            </button>
                          </a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
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