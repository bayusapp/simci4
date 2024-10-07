<?= $this->extend('auth/v_template') ?>
<?= $this->section('content') ?>
<div class="auth-side-form">
  <div class=" auth-content">
    <img src="<?= base_url() ?>assets/images/logo_lab.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
    <div style="text-align: center;">
      <h4 class="mb-3 f-w-400">Register Akun</h4>
    </div>
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <?php if (!empty(session()->getFlashdata('success'))) : ?>
      <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>
    <form action="<?= base_url() ?>Auth/registerAsprak" method="post">
      <div class="form-group mb-3">
        <label class="floating-label" for="nim">Nomor Induk Mahasiswa</label>
        <input type="text" class="form-control" id="nim" name="nim" value="<?= old('nim') ?>" onkeypress="return hanyaAngka(event)" required>
      </div>
      <div class="form-group mb-3">
        <label class="floating-label" for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>" onkeypress="return event.charCode != 32" required>
      </div>
      <div class="form-group mb-4">
        <label class="floating-label" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
    </form>
    <div class="text-center">
      <div class="saprator my-4"><span>ATAU</span></div>
      <p class="mb-2 mt-4 text-muted">Lupa password? <a href="<?= base_url('Auth/resetPassword') ?>" class="f-w-400">Reset Password</a></p>
      <p class="mb-0 text-muted">Sudah punya akun? <a href="<?= base_url() ?>" class="f-w-400">Login</a></p>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>