<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Kehadiran Asisten Praktikum</h5>
      </div>
      <div class="card-body">
        <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
          </div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger" role="alert">
            <?php
            echo 'Kehadiran Anda gagal disimpan karena:<br><ul>';
            for ($i = 0; $i < count(session()->getFlashdata('error')); $i++) {
              echo '<li>' . session()->getFlashdata('error')[$i] . '</li>';
            }
            echo '</ul>';
            ?>
          </div>
        <?php endif; ?>
        <?php
        $error = array();
        if ($identitas['kontak_asprak'] == null) {
          $error[] = 'Kontak/No. WhatsApp belum diisi.';
        }
        if ($identitas['email_asprak'] == null) {
          $error[] = 'Alamat email belum diisi.';
        }
        if ($identitas['norek_asprak'] == null || $identitas['bank'] == null || $identitas['nama_akun'] == null) {
          $error[] = 'No. Rekening belum diisi.';
        }
        if ($identitas['file_foto'] == null) {
          $error[] = 'Belum mengunggah pas foto';
        }
        if ($identitas['ttd_digital'] == null) {
          $error[] = 'Belum mengunggah tanda tangan digital';
        }
        foreach ($mk as $m) {
          $tahun_ajaran = explode('-', $m['tahun_ajaran']);
          if ($tahun_ajaran[1] == '1') {
            $semester = 'Ganjil';
          } elseif ($tahun_ajaran[1] == '2') {
            $semester = 'Genap';
          }
          if ($m['surat_perjanjian'] == null) {
            $error[] = 'Belum menyetujui surat perjanjian pada ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] . ' di Semester ' . $semester . ' Tahun Ajaran ' . $tahun_ajaran[0];
          }
        }

        if (count($error) > 0) {
        ?>
          <div class="alert alert-danger" role="alert">
            Anda belum bisa mengisi kehadiran karena:
            <ul>
              <?php for ($i = 0; $i < count($error); $i++) : ?>
                <li><?= $error[$i] ?></li>
              <?php endfor; ?>
            </ul>
          </div>
        <?php
        } else {
        ?>
          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_kehadiran"><i class="feather icon-plus"></i> Tambah Kehadiran</button>
          <div id="form_kehadiran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="label_form">Form Tambah Kehadiran</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="post" action="<?= base_url('Asprak/Kehadiran/simpanKehadiran') ?>">
                  <?= csrf_field(); ?>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label for="tanggal">Tanggal</label>
                          <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= convertTanggal(date('Y-m-d')) ?>" readonly>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label for="jam_masuk">Jam Masuk</label>
                          <div class="input-group jam_masuk" data-autoclose="true">
                            <input type="text" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="09:30" maxlength="5" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label for="jam_keluar">Jam Keluar</label>
                          <div class="input-group jam_keluar" data-autoclose="true">
                            <input type="text" class="form-control" name="jam_keluar" id="jam_keluar" placeholder="11:30" maxlength="5" required>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-md-3 col-sm-12">
                        <div class="form-group">
                          <label for="kelas">Kelas</label>
                          <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Contoh: D3SI-38-06" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="mk_asprak">Mata Kuliah</label>
                          <select class="mk_asprak form-control" name="mk_asprak" id="mk_asprak" required>
                            <option></option>
                            <?php foreach ($mk as $m) : ?>
                              <option value="<?= $m['id_asprak_list'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="kode_dosen">Kode Dosen</label>
                          <select class="dosen form-control" name="kode_dosen" id="kode_dosen" required>
                            <option></option>
                            <?php foreach ($dosen as $d) : ?>
                              <option value="<?= $d['kode_dosen'] ?>"><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="form-group">
                          <label for="modul">Modul Praktikum</label>
                          <input type="text" class="form-control" name="modul" id="modul" placeholder="Contoh: Installasi Framework Laravel" required>
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
        <?php
        }
        ?>
        <div class="dt-responsive table-responsive" style="margin-top: 10px;">
          <table id="kehadiran" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Masuk</th>
                <th>Keluar</th>
                <th>Jumlah</th>
                <th>Kelas</th>
                <th>Mata Kuliah & Modul Praktikum</th>
                <th>Kode Dosen</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($kehadiran as $k) :
                $hash_id_kehadiran = substr(sha1($k['id_kehadiran']), 7, 7);
                if ($k['approve_dosen'] == '0') :
                  $approve = '<span class="badge badge-warning"><i class="feather icon-alert-circle"></i> Menunggu Persetujuan</span>';
                elseif ($k['approve_dosen'] == '1') :
                  $approve = '<span class="badge badge-success"><i class="feather icon-check-circle"></i> Disetujui</span>';
                elseif ($k['approve_dosen'] == '2') :
                  $approve = '<span class="badge badge-danger"><i class="feather icon-x-circle"></i> Ditolak</span>';
                endif;
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= convertTanggalPendek($k['tanggal']) ?></td>
                  <td><?= $k['masuk'] ?></td>
                  <td><?= $k['keluar'] ?></td>
                  <td><?= $k['jumlah_jam'] ?></td>
                  <td><?= $k['kelas'] ?></td>
                  <td><?= $k['modul_praktikum'] ?></td>
                  <td><?= $k['kode_dosen'] ?></td>
                  <td><?= $approve ?></td>
                  <td>
                    <?php if ($k['approve_dosen'] == '0') : ?>
                      <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_kehadiran_<?= $hash_id_kehadiran ?>">
                        <span data-toggle="tooltip" data-placement="bottom" title="Edit Kehadiran"><i class="feather icon-edit"></i></span>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger" onclick="hapus_kehadiran('<?= $hash_id_kehadiran ?>')">
                        <span data-toggle="tooltip" data-placement="bottom" title="Hapus Kehadiran"><i class="feather icon-trash-2"></i></span>
                      </button>
                    <?php elseif ($k['approve_dosen'] == '1') : ?>
                      -
                    <?php endif; ?>
                  </td>
                  <div id="edit_kehadiran_<?= $hash_id_kehadiran ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_form">Form Tambah Kehadiran</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="<?= base_url('Asprak/Kehadiran/updateKehadiran') ?>">
                          <?= csrf_field(); ?>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="tanggal">Tanggal</label>
                                  <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= convertTanggal(date('Y-m-d')) ?>" readonly>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="jam_masuk">Jam Masuk</label>
                                  <div class="input-group jam_masuk" data-autoclose="true">
                                    <input type="text" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="09:30" onkeypress="jam_praktikum(event)" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="jam_keluar">Jam Keluar</label>
                                  <div class="input-group jam_keluar" data-autoclose="true">
                                    <input type="text" class="form-control" name="jam_keluar" id="jam_keluar" placeholder="11:30" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="kelas">Kelas</label>
                                  <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Contoh: D3SI-38-06" required>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="mk_asprak">Mata Kuliah</label>
                                  <select class="mk_asprak form-control" name="mk_asprak" required>
                                    <option></option>
                                    <?php foreach ($mk as $m) : ?>
                                      <option value="<?= $m['id_asprak_list'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="kode_dosen">Kode Dosen</label>
                                  <select class="dosen form-control" name="kode_dosen" required>
                                    <option></option>
                                    <?php foreach ($dosen as $d) : ?>
                                      <option value="<?= $d['kode_dosen'] ?>"><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="modul">Modul Praktikum</label>
                                  <input type="text" class="form-control" name="modul" id="modul" placeholder="Contoh: Installasi Framework Laravel" required>
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
<?= $this->endSection('content') ?>