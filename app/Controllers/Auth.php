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

  public function index()
  {
    return view('auth/v_login');
  }

  public function login()
  {
    if (!$this->validate([
      'username'  => ['rules' => 'required'],
      'password'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', $this->validator->listErrors());
      return redirect()->back()->withInput();
    } else {
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');
      $cek_data = $this->users->getUsername($username);
      if ($cek_data) {
        $password_hash  = $cek_data['password'];
        if (password_verify($password, $password_hash)) {
          session()->set('nip_laboran', $cek_data['nip_laboran']);
          return redirect()->to(base_url('Dashboard'));
        } else {
          session()->setFlashdata('invalid_password', 'Password tidak valid');
          return redirect()->back()->withInput();
        }
      } else {
        session()->setFlashdata('not_found', 'Username tidak ditemukan');
        return redirect()->back()->withInput();
      }
    }
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
              'jabatan'     => 'Laboran',
              'status_akun' => '1',
              'nip_laboran' => $nip
            ];
            $cek_data_laboran = $this->laboran->getDataLaboran($nip);
            $nama_laboran     = $cek_data_laboran['nama_laboran'];
            $no_telp          = $cek_data_laboran['no_telp'];
            $pesan            = 'Selamat ' . greetings() . " " . $nama_laboran . ',';
            $pesan            .= "
            
Registrasi Anda ke SIMLABFIT sudah berhasil. Berikut ini adalah detail akun Anda untuk login ke SIMLABFIT.
Username: *" . $username . "*
Password: *" . $password . "*
            
Terima kasih";
            kirimWA($pesan, $no_telp);
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
