<?= $this->extend('auth/v_template') ?>
<?= $this->section('content') ?>
<div class="auth-side-form">
  <div class=" auth-content">
    <img src="assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
    <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('sukses') ?>
      </div>
    <?php elseif (!empty(session()->getFlashdata('error'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <form method="post" action="<?= base_url('Auth/ubah') ?>">
      <div class="mb-4">
        <h4 class="mb-4 f-w-400">Ubah password</h4>
        <div class="form-group mb-3">
          <label for="Password2">Password Baru</label>
          <input type="password" class="form-control" name="password_baru" id="password_baru" placeholder="Masukkan Password Baru" required>
          <input type="text" name="token" id="token" value="<?= $token ?>" readonly hidden>
        </div>
        <div class="form-group mb-4">
          <label for="Password3">Konfirmasi Password Baru</label>
          <input type="password" class="form-control" name="konfirm_password" id="konfirm_password" placeholder="Masukkan Konfirmasi Password Baru">
        </div>
      </div>
      <button type="submit" class="btn btn-block btn-primary mb-4">Ubah Password</button>
    </form>
  </div>
</div>
<?= $this->endSection('content') ?>