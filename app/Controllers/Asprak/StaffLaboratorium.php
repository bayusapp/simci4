<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Laboran;
use App\Models\M_Users;

class StaffLaboratorium extends BaseController
{

  var $data;
  protected $asprak;
  protected $laboran;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak   = new M_Asprak();
      $this->laboran  = new M_Laboran();
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
    $data['laboran']  = $this->laboran->getAllLaboran();
    return view('asprak/staff_laboratorium/v_index', $data);
  }
}
