<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users extends Model
{

  protected $table = 'users';
  protected $allowedFields = ['username', 'password', 'jenis_akses', 'jabatan', 'status_akun', 'nip_laboran', 'id_aslab'];

  public function getUsername($username)
  {
    $this->where('username', $username);
    return $this->first();
  }

  public function getUserByNIP($nip)
  {
    $this->where('nip_laboran', $nip);
    return $this->first();
  }
}
