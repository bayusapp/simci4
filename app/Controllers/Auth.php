<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Users;

class Auth extends BaseController
{

  protected $laboran;
  protected $users;

  public function __construct()
  {
    $this->laboran  = new M_Laboran();
    $this->users    = new M_Users();
  }

  public function registerLaboran()
  {
    $data['title'] = 'Register Laboran | SIM Laboratorium';
    return view('auth/v_register_laboran', $data);
  }

  public function submitLaboran()
  {
    if (!$this->validate([
      'nip' => ['rules' => 'required'],
      'username'  => ['rules' => 'required'],
      'password'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', $this->validator->listErrors());
      return redirect()->back()->withInput();
    } else {
      $nip            = $this->request->getPost('nip');
      $username       = $this->request->getPost('username');
      $password       = $this->request->getPost('password');
      $password_hash  = password_hash($password, PASSWORD_DEFAULT);
      // echo $password;
      $cek_data = $this->laboran->getDataLaboran($nip);
      if ($cek_data) {
        $cek_nip = $this->users->getUserByNIP($nip);
        if ($cek_nip) {
          session()->setFlashdata('already', $this->validator->listErrors());
          return redirect()->back();
        } else {
          $cek_username = $this->users->getUsername($username);
          if ($cek_username) {
            session()->setFlashdata('already_username', $this->validator->listErrors());
            return redirect()->back()->withInput();
          } else {
            $data = [
              'username'    => $username,
              'password'    => $password_hash,
              'jenis_akses' => 'laboran',
              'Jabatan'     => 'Laboran',
              'status_akun' => '1',
              'nip_laboran' => $nip
            ];
            $this->users->insert($data);
            session()->setFlashdata('success', 'success');
            return redirect()->back();
          }
        }
      } else {
        session()->setFlashdata('not_laboran', $this->validator->listErrors());
        return redirect()->back()->withInput();
      }
    }
  }
}
