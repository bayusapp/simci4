<?php

namespace App\Controllers;

use App\Libraries\QRCode;
use App\Models\M_Laboran;
use App\Models\M_Laboratorium;
use App\Models\M_Laboratorium_PIC;
use App\Models\M_Trouble_Ticket;
use App\Models\M_Trouble_Ticket_Kategori_Orang;
use App\Models\M_Trouble_Ticket_Tracking;
use DateTime;

class TroubleTicket extends BaseController
{

  var $data;
  protected $laboran;
  protected $laboratorium;
  protected $laboratorium_pic;
  protected $trouble_ticket;
  protected $tt_kategori;
  protected $tt_tracking;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2' || session()->get('id_role') == '6') {
        $this->laboran          = new M_Laboran();
        $this->laboratorium     = new M_Laboratorium();
        $this->laboratorium_pic = new M_Laboratorium_PIC();
        $this->trouble_ticket   = new M_Trouble_Ticket();
        $this->tt_kategori      = new M_Trouble_Ticket_Kategori_Orang();
        $this->tt_tracking      = new M_Trouble_Ticket_Tracking();
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
    $data['laboratorium']   = $this->laboratorium->getAllLaboratorium();
    $data['trouble_ticket'] = $this->trouble_ticket->getAllTroubleTicket();
    $data['tt_kategori']    = $this->tt_kategori->getListKategori();
    return view('laboran/trouble_ticket/v_index', $data);
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
      $this->pesanWA($data['nama_laboran'], $data['nama_lab'], $nama_informan, $kendala, $data['kontak_laboran']); //laboran
      $this->pesanWA($data['nama_aslab'], $data['nama_lab'], $nama_informan, $kendala, $data['kontak_aslab']); //aslab
      $this->pesanWAInforman($nama_informan, $id_trouble_ticket, $kendala, $data['nama_lab'], $link, $kontak_informan); //informan
      session()->setFlashdata('sukses', 'Data Trouble Ticket Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function progresTroubleTicket()
  {
    if (!$this->validate([
      'id_trouble_ticket' => ['rules' => 'required'],
      'tanggal_tt'        => ['rules' => 'required'],
      'nama_petugas'      => ['rules' => 'required'],
      'tt_petugas'        => ['rules' => 'required'],
      'solusi'            => ['rules' => 'required'],
      'status_tt'         => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $id_trouble_ticket  = $this->request->getPost('id_trouble_ticket');
      $tanggal_tt         = convertDatePicker($this->request->getPost('tanggal_tt'));
      $nama_petugas       = $this->request->getPost('nama_petugas');
      $tt_petugas         = $this->request->getPost('tt_petugas');
      $solusi             = $this->request->getPost('solusi');
      $status_tt          = $this->request->getPost('status_tt');
      $data_tt            = $this->trouble_ticket->getTroubleTicketDetail($id_trouble_ticket);
      $this->trouble_ticket->updateStatusTT($status_tt, $id_trouble_ticket);
      $input_track        = [
        'tanggal_track'     => $tanggal_tt,
        'kategori_petugas'  => $tt_petugas,
        'nama_petugas'      => $nama_petugas,
        'solusi'            => $solusi,
        'id_trouble_ticket' => $data_tt['id_trouble_ticket']
      ];
      $this->tt_tracking->insert($input_track);
      $tanggal_open   = new DateTime($data_tt['tanggal_tt']);
      $tanggal_close  = new DateTime($tanggal_tt);
      $durasi         = $tanggal_open->diff($tanggal_close);
      if ($status_tt == '3') {
        $this->pesanWAInformanSelesai($data_tt['nama_informan'], $id_trouble_ticket, $data_tt['kendala'], $data_tt['nama_lab'], $durasi->days, $data_tt['kontak_informan']);
      }
      session()->setFlashdata('sukses', 'Data Progres Trouble Ticket Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  private function pesanWA($nama_laboran, $lab, $nama_informan, $kendala, $tujuan)
  {
    $pesan = "Selamat " . greetings() . " {$nama_laboran},

Kami telah menerima trouble ticket baru terkait {$kendala} di {$lab} dari {$nama_informan}. Mohon segera dilakukan pengecekan dan/atau perbaikan agar kegiatan di {$lab} dapat berjalan dengan baik.

Salam,
Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom";
    kirimWA($pesan, $tujuan);
  }

  private function pesanWAInforman($nama_informan, $id_trouble_ticket, $kendala, $lab, $link, $tujuan)
  {
    $pesan = "Selamat " . greetings() . " {$nama_informan},

Terima kasih atas laporan Anda. Kami telah menerima trouble ticket dengan nomor #{$id_trouble_ticket} terkait {$kendala} di {$lab}.

Tim kami sedang melakukan pengecekan lebih lanjut dan akan segera menangani masalah ini. Perkembangan atas masalah tersebut dapat dilihat pada {$link}.

Jika Anda memiliki informasi tambahan yang dapat membantu kami dalam proses penanganan, dapat hubungi kami melalui 0851-7208-8181.

Terima kasih atas perhatian dan kesabarannya.

Salam,
Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom";
    kirimWA($pesan, $tujuan);
  }

  private function pesanWAInformanSelesai($nama_informan, $id_trouble_ticket, $kendala, $lab, $durasi, $tujuan)
  {
    $pesan = "Selamat " . greetings() . " {$nama_informan},
    
Kami ingin menginformasikan bahwa trouble ticket dengan nomor #{$id_trouble_ticket} yang Anda laporkan terkait {$kendala} di {$lab} telah berhasil kami selesaikan dalam {$durasi} hari.

Jika Anda memiliki pertanyaan lebih lanjut atau membutuhkan bantuan tambahan, dapat menghubungi kami di 0851-7208-8181. Kami senantiasa siap membantu.

Terima kasih atas kesabarannya, dan mohon maaf atas ketidaknyamanan.

Salam,
Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom";
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
