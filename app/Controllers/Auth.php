<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Riwayat_Login;
use App\Models\M_Users;
use App\Models\M_Users_Role;

class Auth extends BaseController
{

  protected $laboran;
  protected $users;
  protected $users_role;
  protected $history;

  public function __construct()
  {
    $this->laboran    = new M_Laboran();
    $this->users      = new M_Users();
    $this->users_role = new M_Users_Role();
    $this->history    = new M_Riwayat_Login();
  }

  public function index()
  {
    if (session()->get('id_role')) {
      header("Location: " . base_url('Beranda'));
      die();
    } else {
      $data['title'] = 'Login | Sistem Informasi Manajemen Laboratorium';
      return view('auth/v_login', $data);
    }
  }

  public function login()
  {
    if (!$this->validate([
      'username'  => ['rules' => 'required'],
      'password'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $username     = $this->request->getPost('username');
      $password     = $this->request->getPost('password');
      $lokasi       = $this->request->getPost('location');
      $lokasi       = preg_replace('/[^0-9-.,]/', '', $lokasi);
      $maps         = getAddress($lokasi);
      $geolocation  = check_ip();
      if ($maps == 'off') {
        $kota = $geolocation['city'];
        $provinsi = $geolocation['region'];
      } else {
        $maps     = getAddress($lokasi)->address_components;
        $kota = $maps[2]->short_name . ', ' . $maps[3]->short_name . ', ' . $maps[4]->short_name;
        $provinsi = $maps[5]->short_name;
      }
      $cek_data = $this->users->getUsername($username);
      if ($cek_data) {
        if ($cek_data['status_akun'] == "1") {
          $password_hash  = $cek_data['password'];
          if (password_verify($password, $password_hash)) {
            $data_history = [
              'ip_address'    => $geolocation['ip'],
              'browser'       => $this->checkUserAgent(),
              'platform'      => $this->getPlatform(),
              'tanggal_login' => date('Y-m-d H:i:s'),
              'kota'          => $kota,
              'provinsi'      => $provinsi,
              'organisasi'    => check_isp(),
              'geolocation'   => $lokasi,
              'username'      => $username
            ];
            $this->history->insert($data_history);
            $jenis_akses  = $this->users_role->getRole($cek_data['id_role']);
            session()->set('login', 'login');
            session()->set('username', $username);
            session()->set('id_role', $jenis_akses['id_role']);
            if ($jenis_akses['nama_role'] == 'Administrator' || $jenis_akses['nama_role'] == 'Laboran') {
              session()->set('nip_laboran', $cek_data['nip_laboran']);
              return redirect()->to(base_url('Beranda'));
            } elseif ($jenis_akses['nama_role'] == 'Asisten Laboratorium') {
              return redirect()->to(base_url('Aslab/Beranda'));
            } elseif ($jenis_akses['nama_role'] == 'Asisten Praktikum') {
              return redirect()->to(base_url('Asprak/Beranda'));
            }
          } else {
            session()->setFlashdata('invalid_password', 'Password tidak valid');
            return redirect()->back()->withInput();
          }
        } else {
          session()->setFlashdata('deactiv', 'Akun Anda berstatus nonaktif. Silahkan hubungi Unit Laboratorium');
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

  public function logout()
  {
    session()->destroy();
    return redirect()->to(base_url());
  }

  private function checkUserAgent()
  {
    $agent = $this->request->getUserAgent();
    if ($agent->isBrowser()) {
      $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
    } elseif ($agent->isRobot()) {
      $currentAgent = $agent->getRobot();
    } elseif ($agent->isMobile()) {
      $currentAgent = $agent->getMobile();
    } else {
      $currentAgent = 'Unidentified User Agent';
    }
    return $currentAgent;
  }

  private function getPlatform()
  {
    $agent = $this->request->getUserAgent();
    return $agent->getPlatform();;
  }
}
