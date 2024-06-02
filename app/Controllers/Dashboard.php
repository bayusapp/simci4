<?php

namespace App\Controllers;

use App\Models\M_Laboran;

class Dashboard extends BaseController
{

  var $data;
  protected $laboran;
  protected $nama_laboran;

  public function __construct()
  {
    if (session()->get('jenis_akses') != 'laboran') {
      header("Location: " . base_url());
    }
    if (session()->get('nip_laboran')) {

      $this->laboran = new M_Laboran();
      $nip                = session()->get('nip_laboran');
      $dataLaboran        = $this->laboran->getDataLaboran($nip);
      $this->data = array(
        'nip_laboran'   => $dataLaboran['nip_laboran'],
        'nama_laboran'  => $dataLaboran['nama_laboran'],
        'foto_laboran'  => $dataLaboran['foto_laboran']
      );
    } else {
      header("Location: " . base_url());
      die();
    }
  }

  public function index()
  {
    $data   = $this->data;
    return view('dashboard/v_index', $data);
  }
}
