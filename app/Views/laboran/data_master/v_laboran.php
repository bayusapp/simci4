<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Laboran</h5>
      </div>
      <div class="card-body">
        <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
          </div>
        <?php endif; ?>
        <?php if (!empty(session()->getFlashdata('error'))) : ?>
          <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('error') ?>
          </div>
        <?php endif; ?>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_laboran"><i class="feather icon-plus"></i> Tambah Laboran</button>
        <div id="form_laboran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Laboran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('DataMaster/simpanLaboran') ?>" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="nip_laboran">NIP Laboran</label>
                        <input type="text" class="form-control" name="nip_laboran" id="nip_laboran" value="<?= old('nip_laboran') ?>" placeholder="Contoh: 12345678" required>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="nama_laboran">Nama Laboran</label>
                        <input type="text" class="form-control" name="nama_laboran" id="nama_laboran" value="<?= old('nama_laboran') ?>" placeholder="Contoh: John Doe" required>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="foto_laboran">Foto Laboran</label>
                        <input type="file" class="form-control" name="foto_laboran" id="foto_laboran">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="kontak_laboran">Kontak Laboran</label>
                        <input type="text" class="form-control kontak" name="kontak_laboran" id="kontak_laboran" value="<?= old('kontak_laboran') ?>" placeholder="Contoh: (62) 8123-4567-8901">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="email_laboran">Email Laboran</label>
                        <input type="text" class="form-control" name="email_laboran" id="email_laboran" value="<?= old('email_laboran') ?>" placeholder="Contoh: example@mail.com">
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="posisi_laboran">Posisi Laboran</label>
                        <input type="text" class="form-control" name="posisi_laboran" id="posisi_laboran" value="<?= old('posisi_laboran') ?>" placeholder="Contoh: Laboran Komputer">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="dt-responsive table-responsive" style="margin-top: 10px;">
          <table id="laboran" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>Kontak Laboran</th>
                <th>Posisi Laboran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; ?>
              <?php foreach ($laboran as $l) : ?>
                <?php $hash_nip = substr(sha1($l['nip_laboran']), 7, 7); ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $l['nip_laboran'] ?></td>
                  <td><?= $l['nama_laboran'] ?></td>
                  <td style="text-align: center;">
                    <?php if ($l['kontak_laboran']) : ?>
                      <a href="https://wa.me/<?= $l['kontak_laboran'] ?>" target="_blank" class="badge badge-pill badge-success">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                      </a>
                    <?php else : ?>
                      <a href="#" class="badge badge-pill badge-danger">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                      </a>
                    <?php endif; ?>
                    <?php if ($l['email_laboran']) : ?>
                      <a href="mailto:<?= $l['email_laboran'] ?>" target="_blank" class="badge badge-pill badge-success">
                        <i class="feather icon-mail"></i> Email
                      </a>
                    <?php else : ?>
                      <a href="#" class="badge badge-pill badge-danger">
                        <i class="feather icon-mail"></i> Email
                      </a>
                    <?php endif; ?>
                  </td>
                  <td><?= $l['posisi_laboran'] ?></td>
                  <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_laboran_<?= $hash_nip ?>">
                      <span data-toggle="tooltip" data-placement="bottom" title="Edit"><i class="feather icon-edit"></i></span>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="hapus_laboran('<?= $hash_nip ?>')">
                      <span data-toggle="tooltip" data-placement="bottom" title="Hapus"><i class="feather icon-trash-2"></i></span>
                    </button>
                  </td>
                  <div id="edit_laboran_<?= $hash_nip ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_form">Form Edit Laboran</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="<?= base_url('DataMaster/updateLaboran') ?>" enctype="multipart/form-data">
                          <?= csrf_field(); ?>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="nip_laboran">NIP Laboran</label>
                                  <input type="text" class="form-control" name="nip_laboran" id="nip_laboran" value="<?= $l['nip_laboran'] ?>" placeholder="Contoh: 12345678" required>
                                  <input type="text" name="nip_laboran_old" value="<?= $hash_nip ?>" hidden readonly>
                                </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                  <label for="nama_laboran">Nama Laboran</label>
                                  <input type="text" class="form-control" name="nama_laboran" id="nama_laboran" value="<?= $l['nama_laboran'] ?>" placeholder="Contoh: John Doe" required>
                                </div>
                              </div>
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="foto_laboran">Foto Laboran</label>
                                  <input type="file" class="form-control" name="foto_laboran" id="foto_laboran">
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="kontak_laboran">Kontak Laboran</label>
                                  <input type="text" class="form-control kontak" name="kontak_laboran" id="kontak_laboran" value="<?= $l['kontak_laboran'] ?>" placeholder="Contoh: (62) 8123-4567-8901">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="email_laboran">Email Laboran</label>
                                  <input type="text" class="form-control" name="email_laboran" id="email_laboran" value="<?= $l['email_laboran'] ?>" placeholder="Contoh: example@mail.com">
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="posisi_laboran">Posisi Laboran</label>
                                  <input type="text" class="form-control" name="posisi_laboran" id="posisi_laboran" value="<?= $l['posisi_laboran'] ?>" placeholder="Contoh: Laboran Komputer">
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>