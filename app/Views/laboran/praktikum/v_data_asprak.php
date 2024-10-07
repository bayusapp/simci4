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
              <a class="nav-link text-reset active" id="home-tab" data-toggle="tab" href="#kehadiran-tab" role="tab" aria-controls="home" aria-selected="true"><i class="feather icon-user-check mr-2"></i>Kehadiran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-reset" id="profile-tab" data-toggle="tab" href="#riwayat-tab" role="tab" aria-controls="profile" aria-selected="false"><i class="feather icon-rotate-ccw mr-2"></i>Riwayat Mata Kuliah</a>
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
      <div class="tab-pane fade show active" id="kehadiran-tab" role="tabpanel" aria-labelledby="riwayat-tab">
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
      <div class="tab-pane fade" id="riwayat-tab" role="tabpanel" aria-labelledby="riwayat-tab">
        <div class="card">
          <div class="card-body">
            <div class="dt-responsive table-responsive">
              <table id="riwayat_mk" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Mata Kuliah</th>
                    <th>Mata Kuliah</th>
                    <th>Tahun Ajaran/Semester</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($history as $h) :
                    $split = explode('-', $h['tahun_ajaran']);
                    if ($split[1] == '1') :
                      $semester = 'Ganjil';
                    elseif ($split[1] == '2') :
                      $semester = 'Genap';
                    endif;
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $h['kode_mk'] ?></td>
                      <td><?= $h['nama_mk'] ?></td>
                      <td><?= $split[0] . ' ' . $semester ?></td>
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
    </div>
  </div>
</div>
<!-- profile body end -->
<?= $this->endSection('content') ?>