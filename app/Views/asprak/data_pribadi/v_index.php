<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<!-- profile header start -->
<div class="user-profile user-card mb-4" style="margin-top: 10px;">
  <div class="card-body py-0">
    <div class="user-about-block m-0">
      <div class="row">
        <div class="col-md-6 offset-md-3 text-center">
          <div class="change-profile text-center">
            <div class="dropdown w-auto d-inline-block">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="profile-dp">
                  <div class="position-relative d-inline-block">
                    <?php
                    if ($informasi['file_foto'] == null) {
                      $foto = base_url('assets/images/person-flat.png');
                    } else {
                      $foto = base_url($informasi['file_foto']);
                    }
                    ?>
                    <img class="img-radius img-fluid wid-100" src="<?= $foto ?>" alt="User image">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <h5 class="mb-1"><?= $nama_asprak ?></h5>
          <p class="mb-2 text-muted"><?= $nim_asprak ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- profile header end -->
<?php if (!empty(session()->getFlashdata('error'))) : ?>
  <div class="alert alert-danger" role="alert">
    Data Anda tidak dapat disimpan karena:
    <ul>
      <?php for ($i = 0; $i < count(session()->getFlashdata('error')); $i++) : ?>
        <li><?= session()->getFlashdata('error')[$i] ?></li>
      <?php endfor ?>
    </ul>
  </div>
<?php endif; ?>
<?php if (!empty(session()->getFlashdata('sukses'))) : ?>
  <div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('sukses') ?>
  </div>
<?php endif; ?>
<!-- profile body start -->
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Informasi Pribadi</h5>
        <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
          <i class="feather icon-edit"></i>
        </button>
      </div>
      <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
        <form>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">NIM</label>
            <div class="col-sm-9"><?= $nim_asprak ?></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Lengkap</label>
            <div class="col-sm-9"><?= $nama_asprak ?></div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Seluler <span class="text-danger" style="font-size: 10px;">*Aktif WhatsApp</span></label>
            <div class="col-sm-9">
              <?php
              if ($informasi['kontak_asprak'] == null) {
                echo '-';
              } else {
                echo $informasi['kontak_asprak'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Email Aktif</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['email_asprak'] == null) {
                echo '-';
              } else {
                echo $informasi['email_asprak'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Program Studi</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['id_prodi'] == null) {
                echo '-';
              } else {
                echo $informasi['jenjang_prodi'] . ' ' . $informasi['nama_prodi'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Tanda Tangan Digital</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['ttd_digital'] == null) {
                echo '-';
              } else {
                echo '<img src="' . base_url('assets/images/ttd/Henokh_edit.png') . '" style="max-height: 60px;">';
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Rekening</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['norek_asprak'] == null) {
                echo '-';
              } else {
                echo $informasi['norek_asprak'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Bank</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['nama_bank'] == null) {
                echo '-';
              } else {
                echo $informasi['nama_bank'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Pemilik Rekening</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['nama_akun'] == null) {
                echo '-';
              } else {
                echo $informasi['nama_akun'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Divalidasi Oleh</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['verif_laboran'] == null) {
                echo '-';
              } else {
                echo ' (Laboran)';
              }
              ?>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
        <form method="post" action="<?= base_url('Asprak/DataPribadi/simpanData') ?>" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">NIM</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nim_asprak" id="nim_asprak" value="<?= $nim_asprak ?>" placeholder="NIM Anda" readonly required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Lengkap</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_asprak" id="nama_asprak" value="<?= $nama_asprak ?>" placeholder="Contoh: John Doe" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Seluler<br><span class="text-danger" style="font-size: 10px;">Aktif WhatsApp</span></label>
            <div class="col-sm-9">
              <input type="text" class="form-control kontak" name="kontak_asprak" id="kontak_asprak" value="<?= $informasi['kontak_asprak'] ?>" placeholder="Contoh: (62) 8123-4567-8901" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Email Aktif</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="email_asprak" id="email_asprak" value="<?= $informasi['email_asprak'] ?>" placeholder="Contoh: admin@mailto.com" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Program Studi</label>
            <div class="col-sm-9">
              <select class="prodi form-control" name="id_prodi" required>
                <option></option>
                <?php foreach ($prodi as $p) : ?>
                  <?php if ($informasi['id_prodi'] == $p['id_prodi']) : ?>
                    <option value="<?= $p['id_prodi'] ?>" selected><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></option>
                  <?php else : ?>
                    <option value="<?= $p['id_prodi'] ?>"><?= $p['jenjang_prodi'] . ' ' . $p['nama_prodi'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Pas Foto</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="file_foto" id="file_foto" placeholder="Pilih Foto" accept="image/*">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Tanda Tangan Digital</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="ttd_digital" id="ttd_digital" placeholder="Pilih Foto" accept="image/*">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Rekening</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="norek_asprak" id="norek_asprak" value="<?= $informasi['norek_asprak'] ?>" placeholder="Contoh: 1234567890" onkeypress="return hanyaAngka(event)" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Bank</label>
            <div class="col-sm-9">
              <select class="bank form-control" name="bank" required>
                <option></option>
                <?php foreach ($bank as $b) : ?>
                  <?php if ($informasi['bank'] == $b['kode_bank']) : ?>
                    <option value="<?= $b['kode_bank'] ?>" selected><?= $b['nama_bank'] ?></option>
                  <?php else : ?>
                    <option value="<?= $b['kode_bank'] ?>"><?= $b['nama_bank'] ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Pemilik Rekening</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" name="nama_akun" id="nama_akun" value="<?= $informasi['nama_akun'] ?>" placeholder="Contoh: John Doe" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Scan Kartu Keluarga<br><span class="text-danger" style="font-size: 10px;">Jika Pemilik Rekening Bukan Punya Pribadi</span></label>
            <div class="col-sm-9">
              <input type="file" class="form-control" name="file_kk" id="file_kk" placeholder="Pilih Foto" accept="image/*">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- <div class="card">
      <div class="card-body d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Informasi Rekening Bank</h5>
        <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-dont-edit" aria-expanded="false" aria-controls="info_bank edit_bank">
          <i class="feather icon-edit"></i>
        </button>
      </div>
      <div class="card-body border-top pro-dont-edit collapse show" id="info_bank">
        <form>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nomor Rekening</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['norek_asprak'] == null) {
                echo '-';
              } else {
                echo $informasi['norek_asprak'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Bank</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['nama_bank'] == null) {
                echo '-';
              } else {
                echo $informasi['nama_bank'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Nama Pemilik Rekening</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['nama_akun'] == null) {
                echo '-';
              } else {
                echo $informasi['nama_akun'];
              }
              ?>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Divalidasi Oleh</label>
            <div class="col-sm-9">
              <?php
              if ($informasi['verif_laboran'] == null) {
                echo '-';
              } else {
                echo ' (Laboran)';
              }
              ?>
            </div>
          </div>
        </form>
      </div>
      <div class="card-body border-top pro-dont-edit collapse" id="edit_bank">
        <form>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Full Name" value="+1 9999-999-999">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" placeholder="Full Name" value="@phonixcoded demo">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div> -->
  </div>
</div>
<!-- profile body end -->
</div>
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>