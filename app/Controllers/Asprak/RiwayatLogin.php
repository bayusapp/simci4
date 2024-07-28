<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Riwayat_Login;
use App\Models\M_Users;

class RiwayatLogin extends BaseController
{

  var $data;
  protected $asprak;
  protected $riwayat_login;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak         = new M_Asprak();
      $this->riwayat_login  = new M_Riwayat_Login();
      $this->users          = new M_Users();
      $username             = session()->get('username');
      $nim_asprak           = $this->users->getUsername($username)['nim_asprak'];
      $data_asprak          = $this->asprak->checkDataAsprak($nim_asprak);
      $this->data           = array(
        'nim_asprak'  => $nim_asprak,
        'nama_asprak' => $data_asprak['nama_asprak'],
        'foto_asprak' => $data_asprak['file_foto']
      );
    }
  }

  public function index()
  {
    $data = $this->data;
    $data['data_login'] = $this->riwayat_login->getHistoryLogin(session()->get('username'));
    return view('asprak/riwayat_login/v_index', $data);
  }
}
