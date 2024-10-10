<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Edit Kehadiran Asisten Praktikum</h5>
      </div>
      <div class="card-body">
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
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h5>Detail Kehadiran Sebelum Diedit</h5>
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="form-group">
                      <label for="tanggal">Tanggal</label>
                      <input type="text" class="form-control" id="tanggal" value="<?= convertTanggalDBToView($kehadiran['jam_masuk']) ?>" readonly>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="jam_masuk">Jam Masuk</label>
                      <div class="input-group jam_masuk" data-autoclose="true">
                        <input type="text" class="form-control" placeholder="09:30" value="<?= convertJamDB($kehadiran['jam_masuk']) ?>" maxlength="5" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="jam_keluar">Jam Keluar</label>
                      <div class="input-group jam_keluar" data-autoclose="true">
                        <input type="text" class="form-control" placeholder="11:30" value="<?= convertJamDB($kehadiran['jam_keluar']) ?>" maxlength="5" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-12">
                    <div class="form-group">
                      <label for="kelas">Kelas</label>
                      <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Contoh: D3SI-38-06" value="<?= $kehadiran['kelas'] ?>" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                      <label for="mk_asprak">Mata Kuliah</label>
                      <select class="form-control" name="mk_asprak" id="mk_asprak" disabled>
                        <option></option>
                        <?php
                        foreach ($mk as $m) :
                          if ($m['id_asprak_list'] == $kehadiran['id_asprak_list']) :
                        ?>
                            <option value="<?= $m['id_asprak_list'] ?>" selected><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                          <?php
                          else:
                          ?>
                            <option value="<?= $m['id_asprak_list'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                        <?php
                          endif;
                        endforeach;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                      <label for="kode_dosen">Kode Dosen</label>
                      <select class="form-control" name="kode_dosen" id="kode_dosen" disabled>
                        <option></option>
                        <?php
                        foreach ($dosen as $d) :
                          if ($d['kode_dosen'] == $kehadiran['kode_dosen']):
                        ?>
                            <option value="<?= $d['kode_dosen'] ?>" selected><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                          <?php
                          else:
                          ?>
                            <option value="<?= $d['kode_dosen'] ?>"><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                        <?php
                          endif;
                        endforeach;
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="form-group">
                      <label for="modul">Modul Praktikum</label>
                      <input type="text" class="form-control" name="modul" id="modul" placeholder="Contoh: Installasi Framework Laravel" value="<?= $kehadiran['modul_praktikum'] ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <h5>Form Edit Kehadiran</h5>
                <form method="post" action="<?= base_url('Asprak/Kehadiran/updateKehadiran') ?>">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                      <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?= convertTanggalDBToView($kehadiran['jam_masuk']) ?>" required>
                        <input type="text" name="id_kehadiran" value="<?= substr(sha1($kehadiran['id_asprak_bap_kehadiran']), 7, 7) ?>" hidden readonly>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="jam_masuk">Jam Masuk</label>
                        <div class="input-group jam_masuk" data-autoclose="true">
                          <input type="text" class="form-control" name="jam_masuk" id="jam_masuk" placeholder="09:30" value="<?= convertJamDB($kehadiran['jam_masuk']) ?>" maxlength="5" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="jam_keluar">Jam Keluar</label>
                        <div class="input-group jam_keluar" data-autoclose="true">
                          <input type="text" class="form-control" name="jam_keluar" id="jam_keluar" placeholder="11:30" value="<?= convertJamDB($kehadiran['jam_keluar']) ?>" maxlength="5" required>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Contoh: D3SI-38-06" value="<?= $kehadiran['kelas'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="mk_asprak">Mata Kuliah</label>
                        <select class="mk_asprak form-control" name="mk_asprak" id="mk_asprak" required>
                          <option></option>
                          <?php
                          foreach ($mk as $m) :
                            if ($m['id_asprak_list'] == $kehadiran['id_asprak_list']) :
                          ?>
                              <option value="<?= $m['id_asprak_list'] ?>" selected><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                            <?php
                            else:
                            ?>
                              <option value="<?= $m['id_asprak_list'] ?>"><?= $m['jenjang_prodi'] . '' . $m['kode_prodi'] . ' | ' . $m['kode_mk'] . ' | ' . $m['nama_mk'] ?></option>
                          <?php
                            endif;
                          endforeach;
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="kode_dosen">Kode Dosen</label>
                        <select class="dosen form-control" name="kode_dosen" id="kode_dosen" required>
                          <option></option>
                          <?php
                          foreach ($dosen as $d) :
                            if ($d['kode_dosen'] == $kehadiran['kode_dosen']):
                          ?>
                              <option value="<?= $d['kode_dosen'] ?>" selected><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                            <?php
                            else:
                            ?>
                              <option value="<?= $d['kode_dosen'] ?>"><?= $d['kode_dosen'] . ' | ' . $d['nama_dosen'] ?></option>
                          <?php
                            endif;
                          endforeach;
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="modul">Modul Praktikum</label>
                        <input type="text" class="form-control" name="modul" id="modul" placeholder="Contoh: Installasi Framework Laravel" value="<?= $kehadiran['modul_praktikum'] ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-2 offset-lg-10 col-md-10 offset-md-10 col-sm-12 col-12">
                      <button class="btn btn-sm btn-primary">Perbarui</button>
                      <a>
                        <button class="btn btn-sm btn-warning">Kembali</button>
                      </a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>