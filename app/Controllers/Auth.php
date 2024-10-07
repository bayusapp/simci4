<?php

namespace App\Controllers;

use App\Models\M_Asprak;
use App\Models\M_Dosen;
use App\Models\M_Forgot_Password;
use App\Models\M_Laboran;
use App\Models\M_Riwayat_Login;
use App\Models\M_Users;
use App\Models\M_Users_Preference;
use App\Models\M_Users_Role;

class Auth extends BaseController
{

  protected $asprak;
  protected $dosen;
  protected $forgot_password;
  protected $laboran;
  protected $token;
  protected $users;
  protected $users_preference;
  protected $users_role;
  protected $history;

  public function __construct()
  {
    $this->asprak           = new M_Asprak();
    $this->dosen            = new M_Dosen();
    $this->forgot_password  = new M_Forgot_Password();
    $this->laboran          = new M_Laboran();
    $this->users            = new M_Users();
    $this->users_preference = new M_Users_Preference();
    $this->users_role       = new M_Users_Role();
    $this->history          = new M_Riwayat_Login();
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
      // $lokasi       = $this->request->getPost('location');
      // $lokasi       = preg_replace('/[^0-9-.,]/', '', $lokasi);
      // $maps         = getAddress($lokasi);
      // $geolocation  = check_ip();
      // if ($maps == 'off') {
      //   $kota = $geolocation['city'];
      //   $provinsi = $geolocation['region'];
      // } else {
      //   $maps     = getAddress($lokasi)->address_components;
      //   $kota = $maps[2]->short_name . ', ' . $maps[3]->short_name . ', ' . $maps[4]->short_name;
      //   $provinsi = $maps[5]->short_name;
      // }
      $cek_data = $this->users->getUsername($username);
      if ($cek_data) {
        if ($cek_data['status_akun'] == "1") {
          $password_hash  = $cek_data['password'];
          if (password_verify($password, $password_hash)) {
            // $data_history = [
            //   'ip_address'    => $geolocation['ip'],
            //   'browser'       => $this->checkUserAgent(),
            //   'platform'      => $this->getPlatform(),
            //   'tanggal_login' => date('Y-m-d H:i:s'),
            //   'kota'          => $kota,
            //   'provinsi'      => $provinsi,
            //   'organisasi'    => check_isp(),
            //   'geolocation'   => $lokasi,
            //   'username'      => $username
            // ];
            // $this->history->insert($data_history);
            $jenis_akses  = $this->users_role->getRole($cek_data['id_role']);
            session()->set('login', 'login');
            session()->set('username', $username);
            session()->set('id_role', $jenis_akses['id_role']);
            if ($jenis_akses['id_role'] == '1' || $jenis_akses['id_role'] == '2' || $jenis_akses['id_role'] == '6') {
              session()->set('nip_laboran', $cek_data['nip_laboran']);
              return redirect()->to(base_url('Beranda'));
            } elseif ($jenis_akses['id_role'] == '3') {
              return redirect()->to(base_url('Aslab/Beranda'));
            } elseif ($jenis_akses['id_role'] == '4') {
              return redirect()->to(base_url('Asprak/Beranda'));
            } elseif ($jenis_akses['id_role'] == '5') {
              return redirect()->to(base_url('Dosen/Beranda'));
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
      $cek_data = $this->laboran->getDataLaboranByNIP($nip);
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
              'username'          => $username,
              'password'          => $password_hash,
              'status_akun'       => '1',
              'tanggal_register'  => date('Y-m-d H:i:s'),
              'id_role'           => '2',
              'nip_laboran'       => $nip
            ];
            $cek_data_laboran = $this->laboran->getDataLaboranByNIP($nip);
            $nama_laboran     = $cek_data_laboran['nama_laboran'];
            $no_telp          = $cek_data_laboran['kontak_laboran'];
            $pesan            = 'Selamat ' . greetings() . " " . $nama_laboran . ',';
            $pesan            .= "
            
Registrasi Anda ke SIMLABFIT sudah berhasil. Berikut ini adalah detail akun Anda untuk login ke SIMLABFIT.
Username: *" . $username . "*
Password: *" . $password . "*
            
Terima kasih";
            kirimWA($pesan, $no_telp);
            $this->users->insert($data);
            session()->setFlashdata('success', 'Akun Anda sudah terdaftar. Silahkan login');
            return redirect()->to(base_url());
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

  public function dosen()
  {
    $data['title'] = 'Register Dosen | SIM Laboratorium';
    return view('auth/v_register_dosen', $data);
  }

  public function registerDosen()
  {
    if (!$this->validate([
      'kode_dosen'  => ['rules' => 'required'],
      'username'    => ['rules' => 'required'],
      'password'    => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', "Harap lengkapi seluruh field.");
      return redirect()->back()->withInput();
    } else {
      $kode_dosen   = $this->request->getPost('kode_dosen');
      $username     = $this->request->getPost('username');
      $password     = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
      $cek_dosen    = $this->dosen->getDataDosenByKodeDosen($kode_dosen);
      if (!$cek_dosen) {
        session()->setFlashdata('error', "Kode Dosen <b>{$kode_dosen}</b> tidak terdaftar sebagai Dosen. Silahkan ke Unit Laboratorium untuk konfirmasi.");
        return redirect()->back()->withInput();
      } else {
        $cek_regis  = $this->users->getUserByKodeDosen($kode_dosen);
        if ($cek_regis) {
          session()->setFlashdata('error', "Kode Dosen <b>{$kode_dosen}</b> sudah melakukan register akun.");
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
              'id_role'           => '5',
              'status_akun'       => '1',
              'tanggal_register'  => date('Y-m-d H:i:s'),
              'kode_dosen'        => strtoupper($kode_dosen)
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
      $username = null;
      $id       = $this->request->getPost('id');
      $cek_nip  = $this->users->getUserByNIP($id);
      if ($cek_nip) {
        $username = $cek_nip['username'];
        $tujuan   = $this->laboran->getDataLaboranByNIP($id)['kontak_laboran'];
      }
      $cek_nim = $this->users->getUserByNIM($id);
      if ($cek_nim) {
        $username = $cek_nim['username'];
        $tujuan   = $this->asprak->checkDataAsprak($id)['kontak_asprak'];
      }
      $cek_dosen = $this->users->getUserByKodeDosen($id);
      if ($cek_dosen) {
        $username = $cek_dosen['username'];
        // $tujuan   = $this->dosen->getDataDosenByKodeDosen($id)[''];
      }
      if ($username != null) {
        $token    = bin2hex(random_bytes(16));
        $tanggal  = date('Y-m-d H:i:s');
        $input    = [
          'username'  => $username,
          'token'     => $token,
          'tanggal'   => $tanggal,
          'status'    => '0'
        ];
        $this->forgot_password->insert($input);
        $pesan = "Selamat " . greetings() . ",

Kami menerima permintaan untuk reset password akun Anda.

Untuk melanjutkan, silahkan klik tautan berikut:

" . base_url('Auth/reset/' . $token) . "

Tautan tersebut hanya berlaku selama 5 menit.

Jika Anda tidak meminta reset password, abaikan pesan ini.

Terima kasih

Salam,
Unit Laboratorium/Bengkel/Studio Fakultas Ilmu Terapan, Universitas Telkom";
        kirimWA($pesan, $tujuan);
        session()->setFlashdata('sukses', 'Tautan untuk reset password sukses dikirim ke nomor WhatsApp Anda');
        return redirect()->back();
      } else {
        echo 'null';
        session()->setFlashdata('error', 'Data Kode Dosen/NIP/NIM tidak ditemukan');
        return redirect()->back()->withInput();
      }
    }
  }

  public function reset($id)
  {
    $cek_token = $this->forgot_password->checkToken($id);
    if ($cek_token) {
      if ($cek_token['status'] == '0') {
        $tanggal_token    = strtotime($cek_token['tanggal']);
        $tanggal_sekarang = strtotime(date('Y-m-d H:i:s'));
        $selisih          = round(abs($tanggal_sekarang - $tanggal_token) / 60);
        if ($selisih > 5) {
          session()->setFlashdata('error', 'Token sudah tidak belaku/lebih dari 5 menit');
          return redirect()->to(base_url('Auth/ResetPassword'));
        } else {
          $data['title'] = 'Reset Password | Sistem Informasi Manajemen Laboratorium';
          $data['token'] = $id;
          return view('auth/v_reset', $data);
        }
      } elseif ($cek_token['status'] == '1') {
        session()->setFlashdata('error', 'Token sudah digunakan');
        return redirect()->to(base_url('Auth/ResetPassword'));
      } else {
        session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
        return redirect()->to(base_url('Auth/ResetPassword'));
      }
    } else {
      session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
      return redirect()->to(base_url('Auth/ResetPassword'));
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
      $cek              = $this->forgot_password->checkToken($token);
      if ($password_baru != $konfirm_password) {
        session()->setFlashdata('error', 'Password Baru dan Konfirmasi Password Baru tidak cocok, harap cek kembali');
        return redirect()->to(base_url('Auth/reset/' . $token));
      }
      if ($cek) {
        // echo $cek['username'];
        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
        $this->users->changePassword($cek['username'], $password_baru);
        $this->forgot_password->updateStatus($token);
        session()->setFlashdata('success', 'Password sukses diperbarui. Silahkan login');
        return redirect()->to(base_url());
      } else {
        session()->setFlashdata('error', 'Token tidak ditemukan, harap cek kembali');
        return redirect()->back();
      }
    }
  }

  public function darkMode()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $username       = $this->request->getPost('id');
      $cek_dark_mode  = $this->users_preference->getStatusDarkMode($username);
      if (!$cek_dark_mode) {
        $input = [
          'dark_mode' => '1',
          'username'  => $username
        ];
        $this->users_preference->insert($input);
      } else {
        if ($cek_dark_mode['dark_mode'] == '1') {
          $this->users_preference->disableDarkMode($username);
        } elseif ($cek_dark_mode['dark_mode'] == '0') {
          $this->users_preference->enableDarkMode($username);
        }
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
