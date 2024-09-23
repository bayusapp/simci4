<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <h5>Trouble Ticket</h5>
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
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#form_laboran"><i class="feather icon-plus"></i> Tambah Trouble Ticket</button>
        <div id="form_laboran" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Trouble Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              <form method="post" action="<?= base_url('TroubleTicket/simpanTroubleTicket') ?>">
                <?= csrf_field(); ?>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="tanggal_tt">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal_tt" id="tanggal_tt" placeholder="Contoh: 07/12/2024" required>
                      </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <div class="form-group">
                        <label for="nama_informan">Nama Informan</label>
                        <input type="text" class="form-control" name="nama_informan" id="nama_informan" value="<?= old('nama_informan') ?>" placeholder="Contoh: John Doe" required>
                      </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                      <div class="form-group">
                        <label for="kontak_informan">Kontak Informan</label>
                        <input type="text" class="form-control kontak" name="kontak_informan" id="kontak_informan" value="<?= old('kontak_informan') ?>" placeholder="Contoh: (62) 8123-4567-8901" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="kategori_informan">Kategori Informan</label>
                        <select class="tt_kategori form-control" name="tt_kategori" required>
                          <option></option>
                          <?php foreach ($tt_kategori as $k): ?>
                            <option value="<?= $k['id_tt_orang'] ?>"><?= $k['nama_kategori'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                        <label for="laboratorium">Laboratorium</label>
                        <select class="laboratorium form-control" name="laboratorium" required>
                          <option></option>
                          <?php foreach ($laboratorium as $l): ?>
                            <option value="<?= $l['id_lab'] ?>"><?= $l['kode_lab'] . ' | ' . $l['nama_lab'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                        <label for="kendala">Kendala</label>
                        <textarea class="form-control" name="kendala" id="kendala" placeholder="Contoh: Lampu di lab D1 mati" required></textarea>
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
          <table id="trouble_ticket" class="table table-striped table-bordered nowrap">
            <thead>
              <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Laboratorium</th>
                <th>Informan</th>
                <th>Kendala</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              foreach ($trouble_ticket as $tt) :
                $hash_id_tt = substr(sha1($tt['id_trouble_ticket']), 12, 7);
                if ($tt['status_tt'] == '1') :
                  $status_tt = '<span class="badge badge-success">Dibuka</span>';
                elseif ($tt['status_tt'] == '2') :
                  $status_tt = '<span class="badge badge-warning">Ditangani</span>';
                elseif ($tt['status_tt'] == '3'):
                  $status_tt = '<span class="badge badge-danger">Ditutup</span>';
                endif;
              ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= convertTanggal($tt['tanggal_tt']) ?></td>
                  <td><?= $tt['kode_lab'] . ' | ' . $tt['nama_lab'] ?></td>
                  <td><?= $tt['nama_informan'] . " ({$tt['nama_kategori']})" ?></td>
                  <td><?= $tt['kendala'] ?></td>
                  <td><?= $status_tt ?></td>
                  <td>
                    <a href="<?= base_url('Tracking/' . $hash_id_tt) ?>" target="_blank">
                      <button class="btn btn-sm btn-info"><i class="feather icon-eye"></i></button>
                    </a>
                    <?php if ($tt['status_tt'] != '3'): ?>
                      <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#edit_tt_<?= $hash_id_tt ?>">
                        <span data-toggle="tooltip" data-placement="bottom" title="Tambah Progres"><i class="feather icon-plus"></i></span>
                      </button>
                    <?php endif; ?>
                  </td>
                  <div id="edit_tt_<?= $hash_id_tt ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_form">Form Tambah Progres Trouble Ticket</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <form method="post" action="<?= base_url('TroubleTicket/progresTroubleTicket') ?>">
                          <?= csrf_field(); ?>
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-lg-3 col-md-3 col-sm-12">
                                <div class="form-group">
                                  <label for="tanggal_tt">Tanggal</label>
                                  <input type="text" class="form-control" name="tanggal_tt" id="tanggal_tt" placeholder="Contoh: 07/12/2024" required>
                                  <input type="text" name="id_trouble_ticket" id="id_trouble_ticket" value="<?= $hash_id_tt ?>" hidden required>
                                </div>
                              </div>
                              <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="form-group">
                                  <label for="nama_petugas">Nama Petugas</label>
                                  <input type="text" class="form-control" name="nama_petugas" id="nama_petugas" placeholder="Contoh: John Doe" required>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="tt_petugas">Kategori Petugas</label>
                                  <select class="tt_petugas form-control" name="tt_petugas" required>
                                    <option></option>
                                    <?php foreach ($tt_kategori as $k): ?>
                                      <option value="<?= $k['id_tt_orang'] ?>"><?= $k['nama_kategori'] ?></option>
                                    <?php endforeach; ?>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="form-group">
                                  <label for="solusi">Solusi</label>
                                  <textarea class="form-control" name="solusi" id="solusi" placeholder="Contoh: Lampu sudah diganti oleh Logistik FIT" required></textarea>
                                </div>
                              </div>
                              <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label for="status_tt">Status Trouble Ticket</label>
                                  <select class="status_tt form-control" name="status_tt" required>
                                    <option></option>
                                    <option value="2">Sedang Ditangani</option>
                                    <option value="3">Trouble Ticket Selesai</option>
                                  </select>
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
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>