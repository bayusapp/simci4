<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-5 col-md-4">
            <h5>Kalender Libur <?= $tahun ?></h5>
            <!-- <input type="text" name="birthday" value="10/24/1984" class="form-control" /> -->
          </div>
          <div class="offset-lg-4 col-lg-3 offset-md-3 col-md-5">
            <form method="post" action="<?= base_url('Kalender') ?>">
              <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-8 col-8">
                  <select class="tahun form-control" name="tahun">
                    <option></option>
                    <?php foreach ($ta as $t) : ?>
                      <option value="<?= $t['tahun'] ?>"><?= $t['tahun'] ?></option>
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
          <div class="col-lg-5">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form_tanggal_libur"><i class="feather icon-plus"></i> Tambah Tanggal Libur</button>
            <div id="form_tanggal_libur" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Tanggal Libur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Kalender/simpanTanggal') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= date('m/d/Y') ?>" placeholder="Contoh: 01/01/2024" required>
                          </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                          <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= old('keterangan') ?>" placeholder="Contoh: Tahun Baru Masehi" required>
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
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#uploadCSVKalender"><i class="feather icon-upload-cloud"></i> Tambah Via CSV</button>
            <div id="uploadCSVKalender" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Form Upload Data Kalender Libur CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Kalender/simpanCSVKalender') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="file" class="form-control" name="file_csv" id="file_csv">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn  btn-primary">Upload</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="<?= base_url('assets/template/Template_CSV_Kalender_Libur.xlsx') ?>" download>
              <button type="button" class="btn btn-sm btn-secondary"><i class="feather icon-download-cloud"></i> Unduh Format CSV</button>
            </a>
          </div>
        </div>
        <div class="dt-responsive table-responsive" style="margin-top: 10px;">
          <table id="kalender_libur" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($kalender as $k) :
                $hash_kalender  = substr(sha1($k['id_kalender_libur']), 7, 7);
                $tanggal        = $k['tanggal_libur'];
                $split_tanggal  = explode('-', $tanggal);
                $array_tanggal  = array($split_tanggal[1], $split_tanggal[2], $split_tanggal[0]);
                $tanggal        = implode('/', $array_tanggal);
              ?>
                <tr>
                  <td style="text-align: center;"><?= $no++ ?></td>
                  <td><?= tanggalIndo($k['tanggal_libur']); ?></td>
                  <td><?= $k['keterangan'] ?></td>
                  <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_kalender_<?= $hash_kalender ?>">
                      <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapus_kalender('<?= $hash_kalender ?>')">
                      <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                    </button>
                  </td>
                  <div id="edit_kalender_<?= $hash_kalender ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_form">Form Edit Tanggal Libur</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="<?= base_url('Kalender/updateTanggal') ?>">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="tanggal">Tanggal</label>
                                  <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= $tanggal ?>" placeholder="Contoh: 01/01/2024" required>
                                  <input type="text" name="id_tanggal" id="id_tanggal" value="<?= $hash_kalender ?>" readonly hidden>
                                </div>
                              </div>
                              <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-group">
                                  <label for="keterangan">Keterangan</label>
                                  <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?= $k['keterangan'] ?>" placeholder="Contoh: Tahun Baru Masehi" required>
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
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>