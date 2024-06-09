<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ Main Content ] start -->
    <!-- profile header start -->
    <div class="user-profile user-card mb-4">
      <div class="card-body py-0">
        <div class="user-about-block m-0">
          <div class="row">
            <div class="col-md-4 text-center mt-n5">
              <div class="change-profile text-center">
                <div class="dropdown w-auto d-inline-block">
                  <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="profile-dp">
                      <div class="position-relative d-inline-block">
                        <img class="img-radius img-fluid wid-100" src="<?= base_url($profil['foto_laboran']) ?>" alt="User image">
                      </div>
                      <div class="overlay">
                        <span>Ubah</span>
                      </div>
                    </div>
                    <div class="certificated-badge">
                      <i class="fas fa-certificate text-c-blue bg-icon"></i>
                      <i class="fas fa-check front-icon text-white"></i>
                    </div>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#"><i class="feather icon-upload-cloud mr-2"></i>Upload Foto</a>
                    <a class="dropdown-item" href="#"><i class="feather icon-trash-2 mr-2"></i>Hapus Foto</a>
                  </div>
                </div>
              </div>
              <h5 class="mb-1"><?= $profil['nama_laboran'] ?></h5>
              <p class="mb-2 text-muted"><?= $profil['posisi_laboran'] ?></p>
            </div>
            <div class="col-md-8 mt-md-4">
              <div class="row">
                <div class="col-md-6">
                  <a href="mailto:<?= $profil['email_laboran'] ?>" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i><?= $profil['email_laboran'] ?></a>
                </div>
                <div class="col-md-6">
                  <a href="https://wa.me/<?= $profil['kontak_laboran'] ?>" target="_blank" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-phone mr-2 f-18"></i><?= $profil['kontak_laboran'] ?></a>
                </div>
              </div>
              <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link text-reset active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true"><i class="feather icon-user mr-2"></i>Profil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-reset" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false"><i class="feather icon-users mr-2"></i>Asisten Laboratorium</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- profile header end -->

    <!-- profile body start -->
    <div class="row">
      <div class="col-md-8 order-md-2">
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                    <label class="col-sm-3 font-weight-bolder">Nama Lengkap</label>
                    <div class="col-sm-9"><?= $profil['nama_laboran'] ?></div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 font-weight-bolder">Nomor Telepon</label>
                    <div class="col-sm-9"><?= $profil['kontak_laboran'] ?></div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 font-weight-bolder">Alamat E-mail</label>
                    <div class="col-sm-9"><?= $profil['email_laboran'] ?></div>
                  </div>
                </form>
              </div>
              <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
                <form method="post" action="<?= base_url() ?>Profil/UbahProfil">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Nama Lengkap</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="Nama Lengkap" value="<?= $profil['nama_laboran'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Nomot Telepon</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="kontak_laboran" value="<?= $profil['kontak_laboran'] ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label font-weight-bolder">Alamat E-mail</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" placeholder="email_laboran" value="<?= $profil['email_laboran'] ?>">
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
          </div>
        </div>
      </div>
      <div class="col-md-4 order-md-1">
        <div class="card">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Staf Laboran</h5>
          </div>
          <div class="card-body">
            <ul class="list-inline">
              <?php
              foreach ($list_laboran as $l) {
              ?>
                <li class="list-inline-item"><a href="#!"><img src="<?= base_url($l['foto_laboran']) ?>" alt="user image" class="img-radius mb-2 wid-50" data-toggle="tooltip" title="<?= $l['nama_laboran'] ?>"></a></li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- profile body end -->
  </div>
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>