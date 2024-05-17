<?php

namespace App\Controllers;

use App\Models\M_Laboran;

class Dashboard extends BaseController
{

  protected $laboran;
  protected $nama_laboran;

  public function __construct()
  {
    $this->laboran = new M_Laboran();
    $nip                = session()->get('nip_laboran');
    $tmp                = $this->laboran->getDataLaboran($nip);
    $this->nama_laboran = $tmp['nama_laboran'];
  }

  public function index()
  {
    $data['nama_laboran'] = $this->nama_laboran;
    return view('dashboard/v_index', $data);
  }
}
