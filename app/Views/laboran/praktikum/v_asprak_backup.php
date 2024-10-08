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
            <h5>Asisten Praktikum Tahun Ajaran <?= $split_ta[0] . ' Semester ' . $semester ?></h5>
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
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_lab"><i class="feather icon-plus"></i> Tambah Asisten Praktikum</button>
            <div id="form_lab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="label_form">Form Tambah Asisten Praktikum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/simpanAsprak') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12">
                          <div class="form-group">
                            <label for="nim_asprak">NIM Asisten Praktikum</label>
                            <input type="text" class="form-control" name="nim_asprak" id="nim_asprak" value="<?= old('nim_asprak') ?>" placeholder="Contoh: 1234567890" required>
                          </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12">
                          <div class="form-group">
                            <label for="nama_asprak">Nama Asisten Praktikum</label>
                            <input type="text" class="form-control" name="nama_asprak" id="nama_asprak" value="<?= old('nama_asprak') ?>" placeholder="Contoh: John Doe" required>
                          </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                          <div class="form-group">
                            <label for="mk">Mata Kuliah</label>
                            <select class="matakuliah form-control" name="mk[]" multiple required>
                              <option></option>
                              <?php foreach ($matkul as $m) : ?>
                                <option value="<?= $m['id_mk_semester'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . '-' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
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
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#uploadCSVAsprak"><i class="feather icon-upload-cloud"></i> Tambah Via CSV</button>
            <div id="uploadCSVAsprak" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Form Upload Data Asisten Praktikum CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/simpanCSVAsprak') ?>" enctype="multipart/form-data">
                    <div class="modal-body">
                      <input type="file" class="form-control" name="file_csv" id="file_csv" accept=".csv">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn  btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn  btn-primary">Upload</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <a href="<?= base_url('assets/template/Template_CSV_Asprak.xlsx') ?>" download>
              <button type="button" class="btn btn-sm btn-secondary"><i class="feather icon-download-cloud"></i> Unduh Format CSV</button>
            </a>
            <!-- <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#generateSuratTugas"><i class="feather icon-printer"></i> Generate Surat Tugas</button> -->
            <!-- <div id="generateSuratTugas" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Generate Surat Tugas Asprak</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <form method="post" action="<?= base_url('Praktikum/simpanCSVAsprak') ?>" target="_blank">
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
            </div> -->
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
                <table id="asprak_<?= strtolower($p['kode_prodi']) ?>" class="table table-striped table-bordered nowrap" style="width: 100%;">
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
                    <?php
                    $no = 1;
                    $model_asprak_list  = new \App\Models\M_Asprak_List();
                    $asprak             = $model_asprak_list->getDataAsprakMK($p['id_prodi'], $id_ta_aktif);
                    foreach ($asprak as $a) :
                      $hash_id_asprak_list = substr(sha1($a['id_asprak_list']), 7, 7);
                    ?>
                      <tr>
                        <td style="vertical-align: middle;"><?= $no++ ?></td>
                        <td style="vertical-align: middle;"><?= $a['nim_asprak'] ?></td>
                        <td style="vertical-align: middle;"><?= $a['nama_asprak'] ?></td>
                        <td style="vertical-align: middle;"><?= $a['kode_mk'] . ' | ' . $a['nama_mk'] ?></td>
                        <td style="text-align: center;">
                          <?php if ($a['email_asprak'] == null) : ?>
                            <span class="badge badge-danger"><i class="feather icon-x-circle"></i> Email</span>
                          <?php else : ?>
                            <a href="mailto:<?= $a['email_asprak'] ?>">
                              <span class="badge badge-success"><i class="feather icon-check-circle"></i> Email</span>
                            </a>
                          <?php endif; ?>
                          <br>
                          <?php if ($a['kontak_asprak'] == null) : ?>
                            <span class="badge badge-danger"><i class="feather icon-x-circle"></i> WhatsApp</span>
                          <?php else : ?>
                            <a href="http://wa.me/<?= $a['kontak_asprak'] ?>" target="_blank">
                              <span class="badge badge-success"><i class="feather icon-check-circle"></i> WhatsApp</span>
                            </a>
                          <?php endif; ?>
                        </td>
                        <td style="text-align: center;">
                          <?php if ($a['surat_perjanjian'] != '1') : ?>
                            <span class="badge badge-danger"><i class="feather icon-x-circle"></i> Surat Perjanjian</span>
                          <?php else : ?>
                            <span class="badge badge-success"><i class="feather icon-check-circle"></i> Surat Perjanjian</span>
                          <?php endif; ?>
                          <br>
                          <?php if ($a['norek_asprak'] == null && $a['kode_bank'] == null && $a['nama_akun'] == null && $a['status_verif'] == null) : ?>
                            <span class="badge badge-danger"><i class="feather icon-x-circle"></i> Rekening Bank</span>
                          <?php elseif ($a['norek_asprak'] != null && $a['kode_bank'] != null && $a['nama_akun'] != null && $a['status_verif'] == null) : ?>
                            <span id="verif_bank_<?= $hash_id_asprak_list ?>">
                              <span class="badge badge-warning"><i class="feather icon-alert-circle"></i> Rekening Bank</span>
                            </span>
                          <?php elseif ($a['norek_asprak'] != null && $a['kode_bank'] != null && $a['nama_akun'] != null && $a['status_verif'] == '1') : ?>
                            <span class="badge badge-success"><i class="feather icon-check-circle"></i> Rekening Bank</span>
                          <?php endif; ?>
                        </td>
                        <td style="text-align: center; vertical-align: middle">
                          <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#lihat_asprak_<?= $hash_id_asprak_list ?>">
                            <span data-toggle="tooltip" data-placement="bottom" title="Lihat Data Asprak"><i class="feather feather icon-eye"></i></span>
                          </button>
                          <a href="<?= base_url('Praktikum/DataAsprak/' . $a['nim_asprak']) ?>">
                            <button type="button" class="btn btn-sm btn-primary">
                              <span data-toggle="tooltip" data-placement="bottom" title="Profil"><i class="feather icon-user"></i></span>
                            </button>
                          </a>
                          <button type="button" class="btn btn-sm btn-danger" onclick="hapus_asprak('<?= $hash_id_asprak_list ?>')">
                            <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                          </button>
                        </td>
                        <div id="lihat_asprak_<?= $hash_id_asprak_list ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="label_form">Data Asisten Praktikum</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <form>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label for="nim_<?= $hash_id_asprak_list ?>">NIM</label>
                                        <p class="mb-1"><?= $a['nim_asprak'] ?></p>
                                      </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label for="nama_<?= $hash_id_asprak_list ?>">Nama Lengkap</label>
                                        <p class="mb-1"><?= $a['nama_asprak'] ?></p>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label for="matakuliah_<?= $hash_id_asprak_list ?>">Mata Kuliah</label>
                                        <p class="mb-1"><?= $a['kode_mk'] . ' | ' . $a['nama_mk'] ?></p>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label for="foto_<?= $hash_id_asprak_list ?>">Foto</label><br>
                                        <?php if ($a['file_foto'] == null) : ?>
                                          <p class="mb-1">Tidak ada foto</p>
                                        <?php else : ?>
                                          <a href="<?= base_url($a['file_foto']) ?>" target="_blank">
                                            <button type="button" class="btn btn-sm btn-info"><i class="feather icon-eye"></i> Lihat Foto</button>
                                          </a>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label for="foto_<?= $hash_id_asprak_list ?>">Kartu Keluarga</label><br>
                                        <?php if ($a['file_kk'] == null) : ?>
                                          <p class="mb-1">Tidak ada KK</p>
                                        <?php else : ?>
                                          <a href="<?= base_url($a['file_kk']) ?>" download>
                                            <button type="button" class="btn btn-sm btn-info"><i class="feather icon-download-cloud"></i> Unduh KK</button>
                                          </a>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Nama Bank</label>
                                        <?php if ($a['nama_bank'] == null) : ?>
                                          <p class="mb-1">Belum diisi</p>
                                        <?php else : ?>
                                          <p class="mb-1"><?= $a['nama_bank'] ?></p>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Nomor Rekening</label>
                                        <?php if ($a['norek_asprak'] == null) : ?>
                                          <p class="mb-1">Belum diisi</p>
                                        <?php else : ?>
                                          <p class="mb-1"><?= $a['norek_asprak'] ?></p>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                    <div class="col-lg-6 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Nama Akun</label>
                                        <?php if ($a['nama_akun'] == null) : ?>
                                          <p class="mb-1">Belum diisi</p>
                                        <?php else : ?>
                                          <p class="mb-1"><?= $a['nama_akun'] ?></p>
                                        <?php endif; ?>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-12">
                                      <span id="data_bank_<?= $a['kode_bank'] . '/' . $a['norek_asprak'] ?>"></span>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                  <?php if ($a['norek_asprak'] != null && $a['kode_bank'] != null && $a['nama_akun'] != null && $a['verif_laboran'] == null) : ?>
                                    <button type="button" id="cek_bank_<?= $hash_id_asprak_list ?> " class="btn btn-warning" onclick="cek_bank('<?= $a['kode_bank'] . '/' . $a['norek_asprak'] ?>')">Cek Bank</button>
                                    <?php if ($a['verif_laboran'] == null) : ?>
                                      <button type="button" id="disetujui_<?= $hash_id_asprak_list ?>" class="btn btn-success" onclick="verif_bank('<?= $hash_id_asprak_list ?>')">Disetujui</button>
                                    <?php endif; ?>
                                  <?php endif; ?>
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