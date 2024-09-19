<?php

namespace App\Controllers;

use App\Libraries\QRCode;
use App\Models\M_Laboran;
use App\Models\M_Laboratorium;
use App\Models\M_Laboratorium_PIC;
use App\Models\M_Trouble_Ticket;
use App\Models\M_Trouble_Ticket_Kategori_Orang;

class TroubleTicket extends BaseController
{

  var $data;
  protected $laboran;
  protected $laboratorium;
  protected $laboratorium_pic;
  protected $trouble_ticket;
  protected $tt_kategori;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->laboran          = new M_Laboran();
        $this->laboratorium     = new M_Laboratorium();
        $this->laboratorium_pic = new M_Laboratorium_PIC();
        $this->trouble_ticket   = new M_Trouble_Ticket();
        $this->tt_kategori      = new M_Trouble_Ticket_Kategori_Orang();
        $nip                    = session()->get('nip_laboran');
        $data_laboran           = $this->laboran->getDataLaboran($nip);
        $this->data             = array(
          'nip_laboran'   => $data_laboran['nip_laboran'],
          'nama_laboran'  => $data_laboran['nama_laboran'],
          'foto_laboran'  => $data_laboran['foto_laboran']
        );
      } else {
        header("Location: " . base_url());
        die();
      }
    }
  }

  public function index()
  {
    $data = $this->data;
    $data['laboratorium'] = $this->laboratorium->getAllLaboratorium();
    $data['trouble_ticket'] = $this->trouble_ticket->getAllTroubleTicket();
    $data['tt_kategori'] = $this->tt_kategori->getListKategori();
    return view('laboran/trouble_ticket/v_index', $data);
    // dd($data['trouble_ticket']);
  }

  public function simpanTroubleTicket()
  {
    if (!$this->validate([
      'tanggal_tt'      => ['rules' => 'required'],
      'nama_informan'   => ['rules' => 'required'],
      'kontak_informan' => ['rules' => 'required'],
      'tt_kategori'     => ['rules' => 'required'],
      'laboratorium'    => ['rules' => 'required'],
      'kendala'         => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $tanggal_tt       = convertDatePicker($this->request->getPost('tanggal_tt'));
      $nama_informan    = $this->request->getPost('nama_informan');
      $kontak_informan  = convertWA($this->request->getPost('kontak_informan'));
      $tt_kategori      = $this->request->getPost('tt_kategori');
      $laboratorium     = $this->request->getPost('laboratorium');
      $kendala          = $this->request->getPost('kendala');
      $input            = [
        'tanggal_tt'        => $tanggal_tt,
        'kategori_informan' => $tt_kategori,
        'nama_informan'     => $nama_informan,
        'kontak_informan'   => $kontak_informan,
        'kendala'           => $kendala,
        'status_tt'         => '1',
        'id_lab'            => $laboratorium
      ];
      $this->trouble_ticket->insert($input);
      $id_trouble_ticket  = $this->trouble_ticket->getIdTroubleTicket($tanggal_tt, $tt_kategori, $nama_informan, $kontak_informan)['id_trouble_ticket'];
      $data               = $this->laboratorium_pic->getDataPIC($laboratorium);
      $id_trouble_ticket  = substr(sha1($id_trouble_ticket), 12, 7);
      $link               = base_url('Tracking/' . $id_trouble_ticket);
      $this->pesanWA($data['nama_laboran'], $data['nama_lab'], $nama_informan, $kendala, $data['kontak_laboran']);
      $this->pesanWA($data['nama_aslab'], $data['nama_lab'], $nama_informan, $kendala, $data['kontak_aslab']);
      $this->pesanWAInforman($nama_informan, $data['nama_lab'], $link, $kontak_informan);
      session()->setFlashdata('sukses', 'Data Trouble Ticket Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function TrackTroubleTicket()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id_tt = $this->request->getPost('id');
      $response = '<div id="view_track_tt_' . $id_tt . '" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="label_form" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="label_form">Form Tambah Trouble Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              </div>
              
              
                <div class="modal-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12">
                      <div class="form-group">
                        <label for="tanggal_tt">Tanggal</label>
                        <input type="text" class="form-control" name="tanggal_tt" id="tanggal_tt" placeholder="Contoh: 12345678" required>
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
            </div>
          </div>
        </div>';
      return $response;
    }
  }

  private function pesanWA($nama_laboran, $lab, $nama_informan, $kendala, $tujuan)
  {
    $pesan = "Selamat " . greetings() . " {$nama_laboran},

Di laboratorium {$lab} ada komplain dari {$nama_informan} terkait:
{$kendala}

Mohon segera dilakukan pengecekan dan/atau perbaikan agar kegiatan praktikum dapat berjalan dengan baik.

Terima kasih";
    kirimWA($pesan, $tujuan);
  }

  private function pesanWAInforman($nama_informan, $lab, $link, $tujuan)
  {
    $pesan = "Selamat " . greetings() . " {$nama_informan},
    
Keluhan Anda di laboratorium {$lab} sudah kami terima. Untuk melihat progres keluhan Anda dapat klik tautan berikut:

{$link}

Terima kasih
";
    kirimWA($pesan, $tujuan);
  }

  public function test()
  {
    $qrCode = new QRCode();
    $filePath = 'assets/files/'; // Path untuk menyimpan QR Code

    // Pastikan folder writable/uploads ada dan dapat ditulis
    if (!file_exists($filePath)) {
      mkdir($filePath);
    }

    // Menghasilkan QR Code
    $qrCode->generate('https://www.bayusapp.com', $filePath . "bayu_20_l.png");

    // Menampilkan QR Code di browser
    echo '<img src="' . base_url($filePath) . 'bayu_20_l.png">';
  }
}
