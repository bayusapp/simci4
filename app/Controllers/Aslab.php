<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Laboratorium;
use App\Models\M_Riwayat_Login;

class Aslab extends BaseController
{

  var $data;
  protected $laboran;
  protected $laboratorium;
  protected $riwayat;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->laboran      = new M_Laboran();
        $this->laboratorium = new M_Laboratorium();
        $this->riwayat      = new M_Riwayat_Login();
        $nip                = session()->get('nip_laboran');
        $data_laboran       = $this->laboran->getDataLaboran($nip);
        $this->data         = array(
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
    $data                 = $this->data;
    $data['laboran']      = $this->laboran->getAllLaboran();
    $data['laboratorium'] = $this->laboratorium->getAllLaboratorium();
    return view('laboran/aslab/v_index', $data);
  }
}
