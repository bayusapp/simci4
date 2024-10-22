<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
    <!-- <div class="alert alert-success" role="alert">
      Hai
    </div> -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-5">
            <h5>Asisten Laboratorium</h5>
          </div>
          <div class="col-lg-3 offset-lg-4">
            <div class="row">
              <div class="col-lg-8">
                <select class="tahun_ajaran form-control" name="tahun_ajaran">
                  <option></option>
                </select>
              </div>
              <div class="col-lg-4 col-md-5 col-sm-4 col-4">
                <button type="submit" class="btn btn-sm btn-info"><i class="feather icon-filter"></i> Filter</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" style="margin-bottom: 15px;">
  <div class="col-lg-12">
    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#form_aslab"><i class="feather icon-plus"></i> Tambah Asisten Laboratorium</button>
    <div id="form_aslab" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="label_form">Form Tambah Asisten Laboratorium</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <form method="post" action="<?= base_url('Laboratorium/simpanLab') ?>">
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="nim_aslab">NIM Asisten Laboratorium</label>
                    <input type="text" class="form-control" name="nim_aslab" id="nim_aslab" value="<?= old('nim_aslab') ?>" placeholder="Contoh: 6701144265">
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                  <div class="form-group">
                    <label for="nama_lab">Nama Asisten Laboratorium</label>
                    <input type="text" class="form-control" name="nama_lab" id="nama_lab" value="<?= old('nama_lab') ?>" placeholder="Contoh: John Doe">
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label for="nama_lab">PIC Laboratorium</label>
                    <select class="laboratorium form-control" name="laboratorium">
                      <option></option>
                      <?php
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="nama_lab">Laboran</label>
                    <select class="laboran form-control" name="laboran">
                      <option></option>
                      <?php foreach ($laboran as $l) : ?>
                        <option value="<?= $l['nip_laboran'] ?>"><?= $l['nama_laboran'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="nama_lab">Tahun Ajaran</label>
                    <select class="tahun form-control" name="laboran">
                      <option></option>
                      <option value="2024/2025">2024/2025</option>
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
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="card user-card user-card-3 social-hover support-bar1">
          <div class="card-body">
            <div class="row align-items-end">
              <div class="col text-left pb-3"></div>
              <div class="col"><img class="img-radius img-fluid wid-100" src="<?= base_url() ?>assets/images/administrator.png" alt="User image"></div>
              <div class="col text-right pb-3">
              </div>
            </div>
            <div class="text-center">
              <h5 class="mb-1 mt-3 f-w-400">Bayu Setya Ajie Perdana Putra</h5>
              <p class="mb-3 text-muted">1301178516</p>
              <p class="mb-1">OPERA Laboratory</p>
              <ul class="list-unstyled f-20 mb-0 social-top-link">
                <li class="list-item"><a href="#!" class="text-warning"><i class="feather icon-edit"></i></a></li>
                <li class="list-item"><a href="#!" class="text-danger"><i class="feather icon-trash-2"></i></a></li>
              </ul>
            </div>
          </div>
          <div class="card-footer bg-light">
            <div class="row text-center">
              <div class="col">
                <a href="#"><i class="feather icon-phone"></i> 62 8989817181</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>