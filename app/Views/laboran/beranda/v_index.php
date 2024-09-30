<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<!-- [ Main Content ] start -->
<div class="row">
  <div class="col-lg-3 col-md-3 col-sm-12 col-12">
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
  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
    <div class="card table-card round_custom">
      <div class="card-header">
        <h5>Biaya Honor Asisten Praktikum <?= date('Y') ?></h5>
        <div class="card-header-right" style="padding-top: 5px;">
          <div class="btn-group card-option">
            <button class="dropdown-item minimize-card">
              <a href="#!" style="color: #37474f;"><span><i class="feather icon-chevron-up"></i></span><span style="display:none"><i class="feather icon-chevron-down"></i></span></a>
            </button>
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive honor_asprak">
          <table id="honor_asprak" class="table table-striped table-borderless mb-0" style="width: 100%;" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Prodi</th>
                <th colspan="2">Triwulan 1</th>
                <th colspan="2">Triwulan 2</th>
                <th colspan="2">Triwulan 3</th>
                <th colspan="2">Triwulan 4</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($prodi as $p) :
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $p['jenjang_prodi'] . ' ' . $p['kode_prodi'] ?></td>
                  <td style="text-align: left;">Rp </td>
                  <td style="text-align: right;">-</td>
                  <td style="text-align: left;">Rp </td>
                  <td style="text-align: right;">-</td>
                  <td style="text-align: left;">Rp </td>
                  <td style="text-align: right;">-</td>
                  <td style="text-align: left;">Rp </td>
                  <td style="text-align: right;">-</td>
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
  <div class="col-lg-3">
    <div class="row">
      <div class="col-lg-12">
        <div class="card support-bar overflow-hidden round_custom">
          <div class="card-body pb-0">
            <h2 class="m-0">0</h2>
            <p class="mb-3 mt-3">Total Trouble Ticket dalam <?= date('Y') ?></p>
          </div>
          <div id="support-chart"></div>
          <div class="card-footer bg-primary text-white">
            <div class="row text-center">
              <div class="col">
                <h4 class="m-0 text-white">0</h4>
                <span>Buka</span>
              </div>
              <div class="col">
                <h4 class="m-0 text-white">0</h4>
                <span>Berjalan</span>
              </div>
              <div class="col">
                <h4 class="m-0 text-white">0</h4>
                <span>Selesai</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card bg-c-green text-white widget-visitor-card round_custom">
          <div class="card-body text-center">
            <h2 class="text-white">16</h2>
            <h6 class="text-white">Asisten Praktikum</h6>
            <i class="feather icon-users"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- [ Main Content ] end -->
<!-- Button trigger modal -->
<?= $this->endSection('content') ?>