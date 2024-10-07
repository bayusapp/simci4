<?= $this->extend('auth/v_template') ?>
<?= $this->section('content') ?>
<div class="auth-side-form">
  <div class=" auth-content">
    <img src="<?= base_url() ?>assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
    <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
      </div>
    <?php elseif (!empty(session()->getFlashdata('error'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <h4 class="mb-3 f-w-400">Reset Password</h4>
    <form method="post" action="<?= base_url('Auth/submitReset') ?>">
      <div class="form-group mb-4">
        <label for="id">Kode Dosen/NIP/NIM</label>
        <input type="text" class="form-control" name="id" id="id" value="<?= old('id') ?>" placeholder="Contoh: 123456">
      </div>
      <input type="text" name="location" id="location" class="form-control" readonly hidden>
      <div id='map' hidden></div>
      <button type="submit" class="btn btn-block btn-primary mb-4">Reset Password</button>
    </form>
    <div class="text-center">
      <div class="saprator my-4"><span>ATAU</span></div>
      <p class="mb-2 mt-4 text-muted">Sudah punya akun? <a href="<?= base_url() ?>" class="f-w-400">Login</a></p>
      <p class="mb-0 text-muted">Belum punya akun? <a href="javascript:register()" class="f-w-400">Register Akun</a></p>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>