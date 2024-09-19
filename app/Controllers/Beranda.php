<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Prodi;

class Beranda extends BaseController
{

  var $data;
  protected $laboran;
  protected $prodi;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->laboran      = new M_Laboran();
        $this->prodi        = new M_Prodi();
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
    $data           = $this->data;
    $data['title']  = 'Beranda | SIM Laboratorium';
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/beranda/v_index', $data);
  }
}
