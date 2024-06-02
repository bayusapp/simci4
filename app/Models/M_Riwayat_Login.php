<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Riwayat_Login extends Model
{

  protected $table = 'riwayat_login';
  protected $allowedFields = ['ip_address', 'browser', 'platform', 'tanggal_login', 'kota', 'provinsi', 'organisasi', 'hostname', 'geolocation', 'username'];

  public function getHistoryLogin($username)
  {
    $this->where('username', $username);
    return $this->findAll();
  }
}
