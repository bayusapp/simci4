<?= $this->extend('template/v_template') ?>
<?= $this->section('content') ?>
<!-- [ Main Content ] start -->
<div class="row">
  <!-- Zero config table start -->
  <div class="col-sm-12">
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-12 col-12">
            <h5>Kehadiran Asisten Praktikum</h5>
          </div>
          <!-- <div class="offset-lg-4 col-lg-3 offset-md-3 col-md-4 col-sm-12 col-12">
            <form method="post" action="<?= base_url('Dosen/Kehadiran') ?>">
              <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-8 col-8">
                  <select class="tahun_ajaran form-control" name="tahun_ajaran">
                    <option></option>
                    <?php foreach ($ta as $t) : ?>
                      <option value="<?= $t['id_ta'] ?>"><?= $t['tahun_ajaran'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-4 col-md-5 col-sm-4 col-4">
                  <button type="submit" class="btn btn-sm btn-info"><i class="feather icon-filter"></i> Filter</button>
                </div>
              </div>
            </form>
          </div> -->
        </div>
      </div>
      <div class="card-body">
        <?php if (!empty(session()->getFlashdata('sukses'))) : ?>
          <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('sukses') ?>
          </div>
        <?php endif; ?>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="belum_disetujui_tab" data-toggle="pill" href="#belum_disetujui" role="tab" aria-controls="belum_disetujui" aria-selected="true">Belum Disetujui</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="disetujui_tab" data-toggle="pill" href="#disetujui" role="tab" aria-controls="disetujui" aria-selected="false">Disetujui</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="ditolak_tab" data-toggle="pill" href="#ditolak" role="tab" aria-controls="ditolak" aria-selected="false">Ditolak</a>
          </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="belum_disetujui" role="tabpanel" aria-labelledby="belum_disetujui_tab">
            <a href="<?= base_url('Dosen/Kehadiran/approveAll') ?>">
              <button class="btn btn-sm btn-info"><i class="feather icon-check-circle"></i> Setujui Semua</button>
            </a>
            <div class="dt-responsive table-responsive" style="margin-top: 10px;">
              <table id="kehadiran_asprak" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Asprak</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($kehadiran as $k) :
                    $hash_kehadiran = substr(sha1($k['id_asprak_bap_kehadiran']), 12, 7);
                    if ($k['approve_dosen'] == '0') :
                      $approve = '<span class="badge badge-warning"><i class="feather icon-alert-circle"></i> Menunggu Persetujuan</span>';
                    elseif ($k['approve_dosen'] == '1') :
                      $approve = '<span class="badge badge-success"><i class="feather icon-check-circle"></i> Disetujui</span>';
                    elseif ($k['approve_dosen'] == '2') :
                      $approve = '<span class="badge badge-danger"><i class="feather icon-x-circle"></i> Ditolak</span>';
                    endif;
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $k['nim_asprak'] ?></td>
                      <td><?= $k['nama_asprak'] ?></td>
                      <td><?= convertTanggalPendek($k['tanggal']) ?></td>
                      <td><?= $k['masuk'] ?></td>
                      <td><?= $k['keluar'] ?></td>
                      <td>
                        <span id="status_approve_<?= $hash_kehadiran ?>">
                          <?= $approve ?>
                        </span>
                      </td>
                      <td>
                        <?php
                        if ($k['approve_dosen'] == '0'):
                        ?>
                          <span id="button_aksi_<?= $hash_kehadiran ?>">
                            <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail_<?= $hash_kehadiran ?>">
                              <i class="feather icon-info"></i> Detail
                            </button>
                            <button type="button" class="btn btn-sm btn-success" onclick="approve_kehadiran('<?= $hash_kehadiran ?>')">
                              <i class="feather icon-check"></i> Setujui
                            </button>
                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reject_<?= $hash_kehadiran ?>">
                              <i class="feather icon-x"></i> Tolak
                            </button>
                          </span>
                          <div id="detail_<?= $hash_kehadiran ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="label_form">Detail Kehadiran</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body" style="text-align: left;">
                                  <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label>NIM Asprak</label>
                                        <input class="form-control" value="<?= $k['nim_asprak'] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label>Nama Asprak</label>
                                        <input class="form-control" value="<?= $k['nama_asprak'] ?>" readonly>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" value="<?= convertTanggalPendek($k['tanggal']) ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Jam Masuk</label>
                                        <input class="form-control" value="<?= $k['masuk'] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Jam Keluar</label>
                                        <input class="form-control" value="<?= $k['keluar'] ?>" readonly>
                                      </div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                      <div class="form-group">
                                        <label>Kelas</label>
                                        <input class="form-control" value="<?= $k['kelas'] ?>" readonly>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                      <div class="form-group">
                                        <label>Mata Kuliah & Modul Praktikum</label>
                                        <input class="form-control" value="<?= $k['kode_mk'] . ' - ' . $k['nama_mk'] . ' | ' . $k['modul_praktikum'] ?>" readonly>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div id="reject_<?= $hash_kehadiran ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="label_form">Detail Kehadiran</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <form method="post" action="<?= base_url('Dosen/Kehadiran/reject') ?>">
                                  <div class="modal-body" style="text-align: left;">
                                    <div class="row">
                                      <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label>NIM Asprak</label>
                                          <input class="form-control" value="<?= $k['nim_asprak'] ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                          <label>Nama Asprak</label>
                                          <input class="form-control" value="<?= $k['nama_asprak'] ?>" readonly>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label>Tanggal</label>
                                          <input class="form-control" value="<?= convertTanggalPendek($k['tanggal']) ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label>Jam Masuk</label>
                                          <input class="form-control" value="<?= $k['masuk'] ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label>Jam Keluar</label>
                                          <input class="form-control" value="<?= $k['keluar'] ?>" readonly>
                                        </div>
                                      </div>
                                      <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group">
                                          <label>Kelas</label>
                                          <input class="form-control" value="<?= $k['kelas'] ?>" readonly>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                          <label>Mata Kuliah & Modul Praktikum</label>
                                          <input class="form-control" value="<?= $k['kode_mk'] . ' - ' . $k['nama_mk'] . ' | ' . $k['modul_praktikum'] ?>" readonly>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                          <label>Alasan Ditolak</label>
                                          <input type="text" name="id" id="id" value="<?= $hash_kehadiran ?>" hidden readonly>
                                          <textarea class="form-control" name="alasan" id="alasan" placeholder="Contoh: Jam Kehadiran Tidak Sesuai"></textarea>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn  btn-primary">Simpan</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        <?php
                        elseif ($k['approve_dosen'] == '1' || $k['approve_dosen'] == '2'):
                          echo '-';
                        endif;
                        ?>
                      </td>
                    </tr>
                  <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="disetujui" role="tabpanel" aria-labelledby="disetujui_tab">
            <div class="dt-responsive table-responsive" style="margin-top: 10px;">
              <table id="kehadiran_approve" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Asprak</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Tanggal Disetujui</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($accept as $a) :
                    $hash_kehadiran = substr(sha1($a['id_asprak_bap_kehadiran']), 12, 7);
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $a['nim_asprak'] ?></td>
                      <td><?= $a['nama_asprak'] ?></td>
                      <td><?= convertTanggalPendek($a['tanggal']) ?></td>
                      <td><?= $a['masuk'] ?></td>
                      <td><?= $a['keluar'] ?></td>
                      <td><?= convertTanggalApprove($a['tanggal_approve']) ?></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detail_<?= $hash_kehadiran ?>">
                          <i class="feather icon-info"></i> Detail
                        </button>
                        <div id="detail_<?= $hash_kehadiran ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="label_form">Detail Kehadiran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body" style="text-align: left;">
                                <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label>NIM Asprak</label>
                                      <input class="form-control" value="<?= $a['nim_asprak'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label>Nama Asprak</label>
                                      <input class="form-control" value="<?= $a['nama_asprak'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Tanggal</label>
                                      <input class="form-control" value="<?= convertTanggalPendek($a['tanggal']) ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Jam Masuk</label>
                                      <input class="form-control" value="<?= $a['masuk'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Jam Keluar</label>
                                      <input class="form-control" value="<?= $a['keluar'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Kelas</label>
                                      <input class="form-control" value="<?= $a['kelas'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                      <label>Mata Kuliah & Modul Praktikum</label>
                                      <input class="form-control" value="<?= $a['kode_mk'] . ' - ' . $a['nama_mk'] . ' | ' . $a['modul_praktikum'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php
                  endforeach;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="tab-pane fade" id="ditolak" role="tabpanel" aria-labelledby="ditolak_tab">
            <div class="dt-responsive table-responsive" style="margin-top: 10px;">
              <table id="kehadiran_reject" class="table table-striped table-bordered nowrap">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Asprak</th>
                    <th>Tanggal</th>
                    <th>Masuk</th>
                    <th>Keluar</th>
                    <th>Tanggal Ditolak</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($reject as $r) :
                    $hash_kehadiran = substr(sha1($r['id_asprak_bap_kehadiran']), 12, 7);
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $r['nim_asprak'] ?></td>
                      <td><?= $r['nama_asprak'] ?></td>
                      <td><?= convertTanggalPendek($r['tanggal']) ?></td>
                      <td><?= $r['masuk'] ?></td>
                      <td><?= $r['keluar'] ?></td>
                      <td><?= convertTanggalApprove($r['tanggal_approve']) ?></td>
                      <td>
                        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#reject_<?= $hash_kehadiran ?>">
                          <i class="feather icon-info"></i> Detail
                        </button>
                        <div id="reject_<?= $hash_kehadiran ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="label_form">Detail Kehadiran</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              </div>
                              <div class="modal-body" style="text-align: left;">
                                <div class="row">
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label>NIM Asprak</label>
                                      <input class="form-control" value="<?= $r['nim_asprak'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                      <label>Nama Asprak</label>
                                      <input class="form-control" value="<?= $r['nama_asprak'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Tanggal</label>
                                      <input class="form-control" value="<?= convertTanggalPendek($r['tanggal']) ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Jam Masuk</label>
                                      <input class="form-control" value="<?= $r['masuk'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Jam Keluar</label>
                                      <input class="form-control" value="<?= $r['keluar'] ?>" readonly>
                                    </div>
                                  </div>
                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                      <label>Kelas</label>
                                      <input class="form-control" value="<?= $r['kelas'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                      <label>Mata Kuliah & Modul Praktikum</label>
                                      <input class="form-control" value="<?= $r['kode_mk'] . ' - ' . $r['nama_mk'] . ' | ' . $r['modul_praktikum'] ?>" readonly>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                      <label>Alasan Ditolak</label>
                                      <textarea class="form-control" readonly><?= $r['alasan_ditolak'] ?></textarea>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
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
    </div>
  </div>
  <!-- Zero config table end -->
</div>
<!-- [ Main Content ] end -->
<?= $this->endSection('content') ?>