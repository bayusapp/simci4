<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Users;

class Beranda extends BaseController
{

  var $data;
  protected $asprak;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak   = new M_Asprak();
      $this->users    = new M_Users();
      $username       = session()->get('username');
      $nim_asprak     = $this->users->getUsername($username)['nim_asprak'];
      $data_asprak    = $this->asprak->checkDataAsprak($nim_asprak);
      $this->data     = array(
        'nim_asprak'  => $nim_asprak,
        'nama_asprak' => $data_asprak['nama_asprak'],
        'foto_asprak' => $data_asprak['file_foto']
      );
    }
  }

  public function index()
  {
    $data   = $this->data;
    return view('aslab/beranda/v_index', $data);
  }
}
