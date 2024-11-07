<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<?php
$model_tahun  = new \App\Models\M_Tahun_Ajaran();
$ta           = $model_tahun->getTahunAjaran();
$split  = explode('-', $ta['tahun_ajaran']);
if ($split[1] == '1') {
  $ta   = 'Tahun Ajaran ' . $split[0] . ' Semester Ganjil';
} elseif ($split[1] == '2') {
  $ta   = 'Tahun Ajaran ' . $split[0] . ' Semester Genap';
}
?>
<!-- [ Main Content ] start -->
<!-- [ Main Content ] start -->
<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
    <div class="row">
      <div class="col-lg-12">
        <div class="card table-card review-card round_custom">
          <div class="card-header borderless ">
            <h5>Sambutan Ka.Ur. Laboratorium</h5>
            <div class="card-header-right" style="padding-top: 5px;">
              <div class="btn-group card-option">
                <button class="dropdown-item minimize-card">
                  <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="review-block">
              <blockquote class="blockquote" style="margin-left: 10px; margin-top: 10px;">
                <p class="mb-2">SIMLABFIT hadir sebagai sarana kebutuhan administrasi yang dirancang untuk memberikan akses mudah kepada seluruh civitas akademika terkait dengan fasilitas, trouble ticket, serta kegiatan yang dilaksanakan di laboratorium. Melalui platform ini, kami berupaya memberikan informasi yang akurat, relevan, dan bermanfaat mengenai berbagai aktivitas laboratorium, mulai dari jadwal praktikum, panduan penggunaan alat-alat laboratorium, hingga tracking trouble ticket dari civitas akademika.</p>
                <footer class="blockquote-footer"><span style="font-size: 13px;">Tedi Gunawan, S.T., M.Kom.</span></footer>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-12">
        <div class="card table-card review-card round_custom">
          <div class="card-header borderless ">
            <h5>Peraturan Laboratorium</h5>
            <div class="card-header-right" style="padding-top: 5px;">
              <div class="btn-group card-option">
                <button class="dropdown-item minimize-card">
                  <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul style="margin-top: 10px;">
              <li>Rapikan kembali kursi setelah selesai menggunakan,</li>
              <li>Setelah selesai digunakan, PC harus dalam keadaan off/mati,</li>
            </ul>
          </div>
        </div>
      </div> -->
    </div>
  </div>
  <div class="col-lg-6">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card round_custom">
          <div class="card-header">
            <h5>Template Dokumen</h5>
            <div class="card-header-right" style="padding-top: 5px;">
              <div class="btn-group card-option">
                <button class="dropdown-item minimize-card">
                  <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row" style="margin-bottom: 25px;">
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/89-TEMPLATE-LAPORAN-ASPRAK-SI.docx') ?>" target=" _blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3SI
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/44-TEMPLATE-LAPORAN-ASPRAK-TK.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3TK
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/74-TEMPLATE-LAPORAN-ASPRAK-SIA.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3SIA
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/33-TEMPLATE-LAPORAN-ASPRAK-MP.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3MP
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/39-TEMPLATE-LAPORAN-ASPRAK-TT.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3TT
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/41-TEMPLATE-LAPORAN-ASPRAK-RPLA.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3RPLA
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/99-TEMPLATE-LAPORAN-ASPRAK-PH.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D3PH
                  </div>
                </div>
              </div>
              <div class="col-lg-3" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/42-TEMPLATE-LAPORAN-ASPRAK-TRM.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D4TRM
                  </div>
                </div>
              </div>
            </div>
            <div class="row" style="margin-bottom: 25px;">
              <div class="offset-lg-4 col-lg-4" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <a href="<?= base_url('assets/template/70-TEMPLATE-LAPORAN-ASPRAK-SIKC-v2024.docx') ?>" target="_blank"><button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button></a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D4SIKC
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row" style="margin-bottom: 25px;">
              <div class="col-lg-4 offset-lg-4" style="text-align: center;">
                <div class="row">
                  <div class="col-lg-12">
                    <button class="btn btn-primary btn-icon"><i class="feather icon-file-text"></i></button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    LPJ Asprak D4SIKC
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
      <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card round_custom">
          <div class="card-header">
            <h5>Persentase Kehadiran <?= $ta ?></h5>
            <div class="card-header-right" style="padding-top: 5px;">
              <div class="btn-group card-option">
                <button class="dropdown-item minimize-card">
                  <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
  <div class="col-lg-3">
    <div class="card round_custom">
      <div class="card-header">
        <h5>Peraturan Asprak</h5>
        <div class="card-header-right" style="padding-top: 5px;">
          <div class="btn-group card-option">
            <button class="dropdown-item minimize-card">
              <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <ul>
          <li>Jumlah jam yang diperkenankan <b>maksimal 6 jam/hari</b></li>
          <li>Presensi kehadiran hanya berlaku di hari tersebut dan tidak dapat di hari sebelumnya atau sesudahnya</li>
          <li>Di akhir semester, Asisten Praktikum membuat Laporan Praktikum sesuai Program Studi Mata Kuliah masing-masing yang diketahui Dosen Koordinator Mata Kuliah, Laboran, dan disetujui oleh Ka. Ur. Laboratorium/Bengkel/Studio</li>
          <li>Asisten Praktikum dapat memperoleh TAK jika persentase kehadiran diatas 75%</li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- [ Main Content ] end -->
<!-- Button trigger modal -->
<?= $this->endSection('content') ?>