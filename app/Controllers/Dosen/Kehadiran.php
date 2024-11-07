<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\M_Asprak_BAP_Kehadiran;
use App\Models\M_BAP_Asprak_Kehadiran;
use App\Models\M_Dosen;
use App\Models\M_Tahun_Ajaran;
use App\Models\M_Users;

class Kehadiran extends BaseController
{

  var $data;
  protected $dosen;
  protected $kehadiran;
  protected $ta;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '5') {
      header("Location: " . base_url());
      die();
    } else {
      $this->dosen      = new M_Dosen();
      $this->kehadiran  = new M_Asprak_BAP_Kehadiran();
      $this->ta         = new M_Tahun_Ajaran();
      $this->users      = new M_Users();
      $username         = session()->get('username');
      $kode_dosen       = $this->users->getUsername($username)['kode_dosen'];
      $data_dosen       = $this->dosen->getDataDosenByKodeDosen($kode_dosen);
      $this->data       = array(
        'kode_dosen'    => $kode_dosen,
        'nama_dosen'    => $data_dosen['nama_dosen']
      );
    }
  }

  public function index()
  {
    $data               = $this->data;
    $data['accept']     = $this->kehadiran->getApproveByKodeDosen($this->data['kode_dosen']);
    $data['kehadiran']  = $this->kehadiran->getDataByKodeDosen($this->data['kode_dosen']);
    $data['reject']     = $this->kehadiran->getRejectByKodeDosen($this->data['kode_dosen']);
    $data['ta']         = $this->ta->getAllTahunAjaran();
    return view('dosen/kehadiran/v_index', $data);
  }

  public function approveAll()
  {
    $tanggal = date('Y-m-d H:i:s');
    $this->kehadiran->approveKehadiranAll($this->data['kode_dosen'], $tanggal);
    session()->setFlashdata('sukses', 'Data Kehadiran Asisten Praktikum Sukses Disetujui Semua');
    return redirect()->to(base_url('Dosen/Kehadiran'));
  }

  public function approve()
  {
    if (!$this->validate([
      'id'  => ['rules' => 'required']
    ])) {
      return redirect()->to('Dosen/Beranda');
    } else {
      $id = $this->request->getPost('id');
      $tanggal = date('Y-m-d H:i:s');
      $this->kehadiran->approveKehadiran($id, $tanggal);
      return 'sukses';
    }
  }

  public function reject()
  {
    if (!$this->validate([
      'id'  => ['rules' => 'required']
    ])) {
      return redirect()->to('Dosen/Beranda');
    } else {
      $id = $this->request->getPost('id');
      $alasan = $this->request->getPost('alasan');
      $tanggal = date('Y-m-d H:i:s');
      $this->kehadiran->rejectKehadiran($id, $tanggal, $alasan);
      session()->setFlashdata('sukses', 'Data Kehadiran Asisten Praktikum Sukses Ditolak');
      return redirect()->to(base_url('Dosen/Kehadiran'));
    }
  }
}
