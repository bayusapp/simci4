<?= $this->extend('auth/v_template') ?>
<?= $this->section('content') ?>
<div class="auth-side-form">
  <div class=" auth-content">
    <img src="assets/images/auth/auth-logo-dark.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
    <img src="<?= base_url() ?>assets/images/logo.png" alt="" class="img-fluid mb-4 d-block d-xl-none d-lg-none">
    <div style="text-align: center;">
      <h4 class="mb-3 f-w-400">Login</h4>
    </div>
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>
    <?php if (!empty(session()->getFlashdata('not_found'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('not_found') ?>
      </div>
    <?php endif; ?>
    <?php if (!empty(session()->getFlashdata('invalid_password'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('invalid_password') ?>
      </div>
    <?php endif; ?>
    <?php if (!empty(session()->getFlashdata('deactiv'))) : ?>
      <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('deactiv') ?>
      </div>
    <?php endif; ?>
    <form action="<?= base_url() ?>auth/login" method="post">
      <div class="form-group mb-3">
        <label class="floating-label" for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?= old('username') ?>">
      </div>
      <div class="form-group mb-4">
        <label class="floating-label" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password">
      </div>
      <input type="text" name="location" id="location" class="form-control" readonly hidden>
      <div id='map' hidden></div>
      <button class="btn btn-block btn-primary mb-4">Login</button>
    </form>
    <div class="text-center">
      <div class="saprator my-4"><span>ATAU</span></div>
      <p class="mb-2 mt-4 text-muted">Lupa password? <a href="<?= base_url('Auth/resetPassword') ?>" class="f-w-400">Reset Password</a></p>
      <p class="mb-0 text-muted">Belum punya akun? <a href="auth-signup-img-side.html" class="f-w-400">Register Akun</a></p>
    </div>
  </div>
</div>
<?= $this->endSection('content') ?>