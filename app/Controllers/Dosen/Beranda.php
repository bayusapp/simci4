<?php

namespace App\Controllers\Dosen;

use App\Controllers\BaseController;
use App\Models\M_Dosen;
use App\Models\M_Users;

class Beranda extends BaseController
{

  var $data;
  protected $dosen;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '5') {
      header("Location: " . base_url());
      die();
    } else {
      $this->dosen    = new M_Dosen();
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
    return view('aslab/beranda/v_index', $data);
  }
}
