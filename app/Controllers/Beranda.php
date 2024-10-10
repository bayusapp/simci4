<?php

namespace App\Controllers;

use App\Models\M_Asprak_List;
use App\Models\M_Laboran;
use App\Models\M_Prodi;
use App\Models\M_Tahun_Ajaran;

class Beranda extends BaseController
{

  var $data;
  protected $asprak_list;
  protected $laboran;
  protected $prodi;
  protected $ta;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2' || session()->get('id_role') == '6') {
        $this->asprak_list  = new M_Asprak_List();
        $this->laboran      = new M_Laboran();
        $this->prodi        = new M_Prodi();
        $this->ta           = new M_Tahun_Ajaran();
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
    $data                   = $this->data;
    $data['title']          = 'Beranda | SIM Laboratorium';
    $data['tahun_ajaran']   = $this->ta->getTahunAjaran();
    $data['jumlah_asprak']  = $this->asprak_list->numberOfAsprak($data['tahun_ajaran']['id_ta'])['jumlah'];
    $data['prodi']          = $this->prodi->getDataProdi();
    return view('laboran/beranda/v_index', $data);
  }
}
