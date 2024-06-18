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
            <div class="row">
              <div class="col-lg-5">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Asisten Praktikum</button>
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
                <button type="button" class="btn btn-sm btn-info"><i class="feather icon-upload-cloud"></i> Tambah Via CSV</button>
                <button type="button" class="btn btn-sm btn-secondary"><i class="feather icon-download-cloud"></i> Unduh Format CSV</button>
              </div>
              <div class="col-lg-1 offset-lg-6">
                <button type="button" class="btn btn-sm btn-warning"><i class="feather icon-filter"></i> Filter</button>
              </div>
            </div>
            <ul class="nav nav-pills mb-3" id="myTab" role="tablist" style="margin-top: 10px;">
              <?php foreach ($prodi as $p) : ?>
                <li class="nav-item">
                  <a class="nav-link" id="<?= $p['kode_prodi'] ?>-tab" data-toggle="pill" href="#pills-<?= $p['kode_prodi'] ?>" role="tab" aria-controls="pills-<?= $p['kode_prodi'] ?>" aria-selected="true"><?= $p['kode_prodi'] ?></a>
                </li>
              <?php endforeach; ?>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <?php foreach ($prodi as $p) : ?>
                <div class="tab-pane fade" id="pills-<?= $p['kode_prodi'] ?>" role="tabpanel" aria-labelledby="<?= $p['kode_prodi'] ?>-tab">
                  <div class="dt-responsive table-responsive">
                    <table id="mk_<?= strtolower($p['kode_prodi']) ?>" class="table table-striped table-bordered nowrap" style="width: 100%;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>NIM</th>
                          <th>Nama Lengkap</th>
                          <th>Mata Kuliah</th>
                          <th>Kontak</th>
                          <th>Kelengkapan</th>
                          <th>Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>6701144265</td>
                          <td>Bayu Setya Ajie Perdana Putra</td>
                          <td>VSI1I3 | Arsitektur dan Jaringan Komputer</td>
                          <td>
                            <span class="badge badge-success">Email</span>
                            <span class="badge badge-success">WhatsApp</span>
                          </td>
                          <td>
                            <span class="badge badge-warning">Surat Perjanjian</span>
                            <span class="badge badge-warning">Rekening Bank</span>
                          </td>
                          <td></td>
                        </tr>
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