<?php

namespace App\Controllers;

use App\Models\M_Asprak;
use App\Models\M_Forgot_Password;
use App\Models\M_Laboran;
use App\Models\M_Riwayat_Login;
use App\Models\M_Users;
use App\Models\M_Users_Role;

class Auth extends BaseController
{

  protected $asprak;
  protected $laboran;
  protected $token;
  protected $users;
  protected $users_role;
  protected $history;

  public function __construct()
  {
    $this->asprak     = new M_Asprak();
    $this->laboran    = new M_Laboran();
    $this->token      = new M_Forgot_Password();
    $this->users      = new M_Users();
    $this->users_role = new M_Users_Role();
    $this->history    = new M_Riwayat_Login();
  }

  public function index()
  {
    if (session()->get('login') == 'login') {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        header("Location: " . base_url('Beranda'));
        die();
      } elseif (session()->get('id_role') == '3') {
        header("Location: " . base_url('Aslab/Beranda'));
        die();
      } elseif (session()->get('id_role') == '4') {
        header("Location: " . base_url('Asprak/Beranda'));
        die();
      }
    } else {
      $data['title'] = 'Login | SIM Laboratorium';
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
            session()->setFlashdata('error', 'Password tidak valid');
            return redirect()->back()->withInput();
          }
        } else {
          session()->setFlashdata('error', 'Akun Anda berstatus nonaktif. Silahkan hubungi Unit Laboratorium');
          return redirect()->back()->withInput();
        }
      } else {
        session()->setFlashdata('error', 'Username tidak ditemukan');
        return redirect()->back()->withInput();
      }
    }
  }

  public function laboran()
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

  public function asprak()
  {
    $data['title'] = 'Register Asisten Praktikum | SIM Laboratorium';
    return view('auth/v_register_asprak', $data);
  }

  public function registerAsprak()
  {
    if (!$this->validate([
      'nim'       => ['rules' => 'required'],
      'username'  => ['rules' => 'required'],
      'password'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', "Harap lengkapi seluruh field.");
      return redirect()->back()->withInput();
    } else {
      $nim          = $this->request->getPost('nim');
      $username     = $this->request->getPost('username');
      $password     = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
      $cek_asprak   = $this->asprak->checkDataAsprak($nim);
      if (!$cek_asprak) {
        session()->setFlashdata('error', "NIM <b>{$nim}</b> tidak terdaftar sebagai Asisten Praktikum. Silahkan ke Unit Laboratorium untuk konfirmasi.");
        return redirect()->back()->withInput();
      } else {
        $cek_regis  = $this->users->getUserByNIM($nim);
        if ($cek_regis) {
          session()->setFlashdata('error', "NIM <b>{$nim}</b> sudah melakukan register akun.");
          return redirect()->back()->withInput();
        } else {
          $cek_username = $this->users->getUsername($username);
          if ($cek_username) {
            session()->setFlashdata('error', "Username <b>{$username}</b> sudah digunakan. Silahkan gunakan username lain.");
            return redirect()->back()->withInput();
          } else {
            $input  = [
              'username'          => $username,
              'password'          => $password,
              'id_role'           => '4',
              'status_akun'       => '1',
              'tanggal_register'  => date('Y-m-d H:i:s'),
              'nim_asprak'        => $nim
            ];
            $this->users->insert($input);
            session()->setFlashdata('success', "Akun Anda sudah terdaftar. Silahkan login");
            header("Location: " . base_url());
            die();
          }
        }
      }
    }
  }

  public function resetPassword()
  {
    $data['title'] = 'Reset Password | Sistem Informasi Manajemen Laboratorium';
    return view('auth/v_reset_password', $data);
  }

  public function submitReset()
  {
    if (!$this->validate([
      'id'  => ['rules' => 'required']
    ])) {
      return redirect()->to(base_url());
    } else {
      $id = $this->request->getPost('id');
      $cek = $this->users->getData($id);
      if ($cek) {
        $username = $cek['username'];
        $token    = bin2hex(random_bytes(16));
        $tanggal  = date('Y-m-d H:i:s');
        $input    = [
          'username'  => $username,
          'token'     => $token,
          'tanggal'   => $tanggal,
          'status'    => '0'
        ];
        if ($cek['status_akun'] == '1') {
          if ($cek['nip_laboran']) {
            $whatsapp = $this->laboran->getDataLaboranByNIP($cek['nip_laboran'])['kontak_laboran'];
            $nama     = $this->laboran->getDataLaboranByNIP($cek['nip_laboran'])['nama_laboran'];
          }
          if ($cek['nim_aslab']) {
            echo 'aslab nih';
          }
          if ($cek['nim_asprak']) {
            echo 'asprak nih';
          }
          $this->token->insert($input);
          $pesan = 'Selamat ' . greetings() . ' ' . $nama . ',

Untuk melakukan reset password silahkan klik tautan dibawah ini dan tautan tersebut *hanya berlaku selama 5 menit*
          
' . base_url('Auth/reset/' . $token) . ' 
          
Terima kasih
          
Salam
Unit Laboratorium/Bengkel/Studio, Fakultas Ilmu Terapan';
          session()->setFlashdata('sukses', 'Token untuk reset password sukses dikirim ke WhatsApp');
          kirimWA($pesan, $whatsapp);
          return redirect()->back();
        } else {
          session()->setFlashdata('error', 'Akun berstatus tidak aktif, silahkan hubungi Unit Laboratorium');
          return redirect()->back()->withInput();
        }
      } else {
        session()->setFlashdata('error', 'Data Username/NIP/NIM tidak ditemukan');
        return redirect()->back()->withInput();
      }
    }
  }

  public function reset($id)
  {
    $cek_token = $this->token->checkToken($id);
    if ($cek_token) {
      if ($cek_token['status'] == '0') {
        $tanggal_token    = strtotime($cek_token['tanggal']);
        $tanggal_sekarang = strtotime(date('Y-m-d H:i:s'));
        $selisih          = round(abs($tanggal_sekarang - $tanggal_token) / 60);
        if ($selisih > 5) {
          session()->setFlashdata('error', 'Token sudah tidak belaku/lebih dari 5 menit');
          return redirect()->to(base_url('Auth/resetPassword'));
        } else {
          $data['title'] = 'Reset Password | Sistem Informasi Manajemen Laboratorium';
          $data['token'] = $id;
          return view('auth/v_reset', $data);
        }
      } elseif ($cek_token['status'] == '1') {
        session()->setFlashdata('error', 'Token sudah digunakan');
        return redirect()->to(base_url('Auth/resetPassword'));
      } else {
        session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
        return redirect()->to(base_url('Auth/resetPassword'));
      }
    } else {
      session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
      return redirect()->to(base_url('Auth/resetPassword'));
    }
  }

  public function ubah()
  {
    if (!$this->validate([
      'password_baru'     => ['rules' => 'required'],
      'konfirm_password'  => ['rules' => 'required'],
      'token'             => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back();
    } else {
      $password_baru    = $this->request->getPost('password_baru');
      $konfirm_password = $this->request->getPost('konfirm_password');
      $token            = $this->request->getPost('token');
      $cek              = $this->token->checkToken($token);
      if ($password_baru == $konfirm_password) {
        //
      } else {
        session()->setFlashdata('error', 'Password Baru dan Konfirmasi Password Baru tidak cocok, harap cek kembali');
        return redirect()->to(base_url('Auth/reset/' . $token));
      }
      if ($cek) {
        // echo $cek['username'];
        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        $this->users->changePassword($cek['username'], $password_baru);
        session()->setFlashdata('sukses', 'Password sukses diperbarui. Silahkan login');
        return redirect()->to(base_url());
      } else {
        session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
        return redirect()->back();
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
