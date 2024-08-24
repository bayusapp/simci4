<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\M_BAP_Asprak_Kehadiran;
use App\Models\M_Dosen;
use App\Models\M_Users;

class Kehadiran extends BaseController
{

  var $data;
  protected $dosen;
  protected $kehadiran;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '5') {
      header("Location: " . base_url());
      die();
    } else {
      $this->dosen    = new M_Dosen();
      $this->kehadiran = new M_BAP_Asprak_Kehadiran();
      $this->users    = new M_Users();
      $username       = session()->get('username');
      $kode_dosen     = $this->users->getUsername($username)['kode_dosen'];
      $data_dosen     = $this->dosen->getDataDosenByKodeDosen($kode_dosen);
      $this->data     = array(
        'kode_dosen'  => $kode_dosen,
        'nama_dosen'  => $data_dosen['nama_dosen']
      );
    }
  }

  public function index()
  {
    $data   = $this->data;
    $data['kehadiran'] = $this->kehadiran->getDataByKodeDosen($this->data['kode_dosen']);
    return view('dosen/kehadiran/v_index', $data);
  }

  public function approve()
  {
    if (!$this->validate([
      'id'  => ['rules' => 'required']
    ])) {
      return redirect()->to('Dosen/Beranda');
    } else {
      $id = $this->request->getPost('id');
      $this->kehadiran->approveKehadiran($id);
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
      $this->kehadiran->rejectKehadiran($id);
      return 'sukses';
    }
  }
}
