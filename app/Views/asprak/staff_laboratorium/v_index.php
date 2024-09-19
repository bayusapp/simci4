<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row" style="margin-bottom: 50px;">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Staff Laboratorium</h5>
      </div>
    </div>
    <div class="row mb-n4">
      <?php foreach ($laboran as $l): ?>
        <div class="col-xl-4 col-md-6">
          <div class="card user-card user-card-3 support-bar1">
            <div class="card-body ">
              <div class="text-center">
                <img class="img-radius img-fluid wid-150" src="<?= base_url() . '' . $l['foto_laboran'] ?>" alt="<?= $l['nama_laboran'] ?>">
                <h5 class="mb-1 mt-3 f-w-400"><?= $l['nama_laboran'] ?></h5>
                <span class="mb-3 text-muted">NIP. <?= $l['nip_laboran'] ?></span>
                <p class="mb-3 text-muted"><?= $l['posisi_laboran'] ?></p>
              </div>
            </div>
            <div class="card-footer bg-light">
              <div class="row text-center">
                <?php if ($l['kontak_laboran'] == NULL): ?>
                  <div class="col">
                    <i class="fab fa-whatsapp"></i>
                    <p class="mb-1">-</p>
                  </div>
                <?php else: ?>
                  <div class="col">
                    <a href="https://wa.me/<?= $l['kontak_laboran'] ?>" target="_blank" style="color: #373a3c;">
                      <i class="fab fa-whatsapp"></i>
                      <p class="mb-1"><?= $l['kontak_laboran'] ?></p>
                    </a>
                  </div>
                <?php endif; ?>
                <div class="col">
                  <i class="feather icon-mail"></i>
                  <p class="mb-1"><?= $l['email_laboran'] ?></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>