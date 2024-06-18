<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<section class="pcoded-main-container">
  <div class="pcoded-content">
    <!-- [ breadcrumb ] start -->
    <div class="page-header">
      <div class="page-block">
        <div class="row align-items-center">
          <div class="col-md-12">
            <div class="page-header-title">
              <!-- <h5 class="m-b-10">Basic Table Sizes</h5> -->
              <img src="<?= base_url() ?>assets/images/toppng.com-all-new-r15-all-new-r15-logo-1551x302.png" style="max-height: 30px;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-3">
                <button type="button" class="btn btn-sm btn-primary"><i class="feather icon-plus"></i> Tambah Asisten Laboratorium</button>
              </div>
            </div>
          </div>
        </div>
        <!-- user card [ 3 ] Start -->
        <div class="row mb-n4">
          <div class="col-lg-3 col-md-6">
            <div class="card user-card user-card-3 support-bar1">
              <!-- <div class="card-body ">
                <div class="text-center">
                  <img class="img-radius img-fluid wid-100" src="assets/images/user/img-avatar-1.jpg" alt="User image">
                  <h5 class="mb-1 mt-3 f-w-400">Bayu Setya Ajie Perdana Putra</h5>
                  <p class="mb-3 text-muted">1301178516</p>
                  <p class="mb-1">OPERA Laboratory</p>
                </div>
              </div> -->
              <div class="card-body">
                <div class="row align-items-end">
                  <div class="col text-left pb-3"></div>
                  <div class="col"><img class="img-radius img-fluid wid-100" src="assets/images/user/img-avatar-1.jpg" alt="User image"></div>
                  <div class="col text-right pb-3">
                    <div class="dropdown">
                      <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="feather icon-edit"></i> Edit</a>
                        <a class="dropdown-item text-danger" href="#"><i class="feather icon-trash-2"></i> Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-1 mt-3 f-w-400">Bayu Setya Ajie Perdana Putra</h5>
                  <p class="mb-3 text-muted">1301178516</p>
                  <p class="mb-1">OPERA Laboratory</p>
                </div>
              </div>
              <div class="card-footer bg-light">
                <div class="row text-center">
                  <div class="col">
                    <!-- <p class="mb-0"><i class="feather icon-phone"></i> 62</p> -->
                    <a href="#" style="color: #373a3c;"><i class="feather icon-phone"></i> 62 8989817181</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- user card [ 3 ] end -->
      </div>
    </div>
    <!-- [ Main Content ] end -->
  </div>
</section>
<?= $this->endSection('content') ?>