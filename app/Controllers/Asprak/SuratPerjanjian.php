<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Asprak_List;
use App\Models\M_Users;

class SuratPerjanjian extends BaseController
{

  var $data;
  protected $asprak;
  protected $asprak_list;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak       = new M_Asprak();
      $this->asprak_list  = new M_Asprak_List();
      $this->users        = new M_Users();
      $username           = session()->get('username');
      $nim_asprak         = $this->users->getUsername($username)['nim_asprak'];
      $data_asprak        = $this->asprak->checkDataAsprak($nim_asprak);
      $this->data         = array(
        'nim_asprak'  => $nim_asprak,
        'nama_asprak' => $data_asprak['nama_asprak'],
        'foto_asprak' => $data_asprak['file_foto']
      );
    }
  }

  public function index()
  {
    $data = $this->data;
    $data['asprak'] = $this->asprak->checkDataAsprak($this->data['nim_asprak']);
    $data['sp']     = $this->asprak_list->getSuratPerjanjian($this->data['nim_asprak']);
    return view('asprak/surat_perjanjian/v_index', $data);
  }

  public function view()
  {
    $id  = $this->request->getUri()->getSegment(4);
    $data['sp'] = $this->asprak_list->getSuratPerjanjianById($id);
    return view('asprak/surat_perjanjian/v_surat_perjanjian', $data);
  }

  public function approve()
  {
    if (!$this->validate([
      'id'  => ['rules' => 'required']
    ])) {
      return redirect()->to('Asprak/Beranda');
    } else {
      $id = $this->request->getPost('id');
      $tanggal = date('Y-m-d');
      $this->asprak_list->approveSuratPerjanjian($id, $tanggal);
      return 'sukses';
    }
  }
}
