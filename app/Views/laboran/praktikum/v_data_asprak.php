<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<!-- profile header start -->
<div class="user-profile user-card mb-4" style="margin-top: 60px;">
  <div class="card-body py-0">
    <div class="user-about-block m-0">
      <div class="row">
        <div class="col-md-4 text-center mt-n5">
          <div class="change-profile text-center">
            <div class="dropdown w-auto d-inline-block">
              <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="profile-dp">
                  <div class="position-relative d-inline-block">
                    <?php
                    if ($asprak['file_foto'] == NULL) {
                      $foto = base_url('assets/images/person-flat.png');
                    } else {
                      $foto = base_url($asprak['file_foto']);
                    }
                    ?>
                    <img class="img-radius img-fluid wid-100" src="<?= $foto ?>" alt="User image">
                  </div>
                </div>
              </a>
            </div>
          </div>
          <h5 class="mb-1"><?= $asprak['nama_asprak'] ?></h5>
          <p class="mb-2 text-muted"><?= $asprak['nim_asprak'] ?></p>
        </div>
        <div class="col-md-8 mt-md-4">
          <div class="row">
            <div class="col-md-6">
              <?php
              if ($asprak['email_asprak'] == NULL) {
                $email = '<a href="#" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>-</a>';
              } else {
                $email = '<a href="mailto:' . $asprak['email_asprak'] . '" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="feather icon-mail mr-2 f-18"></i>' . $asprak['email_asprak'] . '</a>';
              }
              ?>
              <?= $email ?>
              <div class="clearfix"></div>
              <?php
              if ($asprak['kontak_asprak'] == NULL) {
                $kontak = '<a href="#" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="fab fa-whatsapp mr-2 f-18"></i>-</a>';
              } else {
                $kontak = '<a href="https://wa.me/' . $asprak['kontak_asprak'] . '" target="_blank" class="mb-1 text-muted d-flex align-items-end text-h-primary"><i class="fab fa-whatsapp mr-2 f-18"></i>' . $asprak['kontak_asprak'] . '</a>';
              }
              ?>
              <?= $kontak ?>
            </div>
            <div class="col-md-6">
              <div class="media">
                <i class="feather icon-credit-card mr-2 mt-1 f-18 text-muted"></i>
                <div class="media-body">
                  <?php
                  if ($asprak['nama_bank'] == NULL) {
                    $bank = '<p class="mb-0 text-muted">-</p>';
                  } else {
                    $bank = '<p class="mb-0 text-muted">' . $asprak['nama_bank'] . '</p><p class="mb-0 text-muted">' . $asprak['norek_asprak'] . '</p><p class="mb-0 text-muted">' . $asprak['nama_akun'] . '</p>';
                  }
                  ?>
                  <?= $bank ?>
                </div>
              </div>
            </div>
          </div>
          <ul class="nav nav-tabs profile-tabs nav-fill" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link text-reset active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-user-check mr-2"></i>Kehadiran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-reset" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"><i class="feather icon-rotate-ccw mr-2"></i>Riwayat Mata Kuliah</a>
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
  <div class="col-md-12">
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="card">
          <div class="card-body">
            <div class="dt-responsive table-responsive">
              <table id="profil_kehadiran" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Tanggal</th>
                    <th>Kelas</th>
                    <th>Jam</th>
                    <th>Jumlah</th>
                    <th>Modul</th>
                    <th>Kode Dosen</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($kehadiran as $k) :
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
                      <td><?= $k['kode_mk'] ?></td>
                      <td><?= convertTanggal($k['tanggal']) ?></td>
                      <td><?= $k['kelas'] ?></td>
                      <td><?= $k['masuk'] . ' - ' . $k['keluar'] ?></td>
                      <td><?= $k['jumlah_jam'] ?></td>
                      <td><?= $k['modul_praktikum'] ?></td>
                      <td><?= $k['kode_dosen'] ?></td>
                      <td><?= $approve ?></td>
                    </tr>
                  <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Personal details</h5>
            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-det-edit" aria-expanded="false" aria-controls="pro-det-edit-1 pro-det-edit-2">
              <i class="feather icon-edit"></i>
            </button>
          </div>
          <div class="card-body border-top pro-det-edit collapse show" id="pro-det-edit-1">
            <form>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                <div class="col-sm-9">
                  <?= $asprak['nama_asprak'] ?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
                <div class="col-sm-9">
                  Male
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                <div class="col-sm-9">
                  16-12-1994
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Martail Status</label>
                <div class="col-sm-9">
                  Unmarried
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                <div class="col-sm-9">
                  <p class="mb-0 text-muted">4289 Calvin Street</p>
                  <p class="mb-0 text-muted">Baltimore, near MD Tower Maryland,</p>
                  <p class="mb-0 text-muted">Maryland (21201)</p>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body border-top pro-det-edit collapse " id="pro-det-edit-2">
            <form>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Full Name</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Full Name" value="Lary Doe">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Gender</label>
                <div class="col-sm-9">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input" checked>
                    <label class="custom-control-label" for="customRadioInline1">Male</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Female</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Birth Date</label>
                <div class="col-sm-9">
                  <input type="date" class="form-control" value="1994-12-16">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Martail Status</label>
                <div class="col-sm-9">
                  <select class="form-control" id="exampleFormControlSelect1">
                    <option>Select Marital Status</option>
                    <option>Married</option>
                    <option selected>Unmarried</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Location</label>
                <div class="col-sm-9">
                  <textarea class="form-control">4289 Calvin Street,  Baltimore, near MD Tower Maryland, Maryland (21201)</textarea>
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
        </div>
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Contact Information</h5>
            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-dont-edit" aria-expanded="false" aria-controls="pro-dont-edit-1 pro-dont-edit-2">
              <i class="feather icon-edit"></i>
            </button>
          </div>
          <div class="card-body border-top pro-dont-edit collapse show" id="pro-dont-edit-1">
            <form>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Mobile Number</label>
                <div class="col-sm-9">
                  +1 9999-999-999
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
                <div class="col-sm-9">
                  Demo@domain.com
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Twitter</label>
                <div class="col-sm-9">
                  @phonixcoded
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Skype</label>
                <div class="col-sm-9">
                  @phonixcoded demo
                </div>
              </div>
            </form>
          </div>
          <div class="card-body border-top pro-dont-edit collapse " id="pro-dont-edit-2">
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
        </div>
        <div class="card">
          <div class="card-body d-flex align-items-center justify-content-between">
            <h5 class="mb-0">other Information</h5>
            <button type="button" class="btn btn-primary btn-sm rounded m-0 float-right" data-toggle="collapse" data-target=".pro-wrk-edit" aria-expanded="false" aria-controls="pro-wrk-edit-1 pro-wrk-edit-2">
              <i class="feather icon-edit"></i>
            </button>
          </div>
          <div class="card-body border-top pro-wrk-edit collapse show" id="pro-wrk-edit-1">
            <form>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
                <div class="col-sm-9">
                  Designer
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Skills</label>
                <div class="col-sm-9">
                  C#, Javascript, Scss
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
                <div class="col-sm-9">
                  Phoenixcoded
                </div>
              </div>
            </form>
          </div>
          <div class="card-body border-top pro-wrk-edit collapse " id="pro-wrk-edit-2">
            <form>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Occupation</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Full Name" value="Designer">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Email Address</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" placeholder="Ema" value="Demo@domain.com">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 col-form-label font-weight-bolder">Jobs</label>
                <div class="col-sm-9">
                  <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-1" checked>
                    <label class="custom-control-label" for="pro-wrk-chk-1">C#</label>
                  </div>
                  <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-2" checked>
                    <label class="custom-control-label" for="pro-wrk-chk-2">Javascript</label>
                  </div>
                  <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-3" checked>
                    <label class="custom-control-label" for="pro-wrk-chk-3">Scss</label>
                  </div>
                  <div class="custom-control custom-checkbox form-check d-inline-block mr-2">
                    <input type="checkbox" class="custom-control-input" id="pro-wrk-chk-4">
                    <label class="custom-control-label" for="pro-wrk-chk-4">Html</label>
                  </div>
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
        </div>
      </div>
    </div>
  </div>
</div>
<!-- profile body end -->
<?= $this->endSection('content') ?>