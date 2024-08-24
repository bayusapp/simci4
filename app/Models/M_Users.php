<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users extends Model
{

  protected $table = 'users';
  protected $allowedFields = ['username', 'password', 'id_role', 'jabatan', 'status_akun', 'tanggal_register', 'nip_laboran', 'nim_aslab', 'nim_asprak', 'kode_dosen'];

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

  public function getUserByNIM($nim)
  {
    $this->where('nim_asprak', $nim);
    return $this->first();
  }

  public function getUserByKodeDosen($kode_dosen)
  {
    $this->where('kode_dosen', $kode_dosen);
    return $this->first();
  }

  public function getData($id)
  {
    $this->where('username', $id);
    $this->orWhere('nip_laboran', $id);
    $this->orWhere('nim_aslab', $id);
    $this->orWhere('nim_asprak', $id);
    return $this->first();
  }

  public function changePassword($username, $password)
  {
    $this->set('password', $password);
    $this->where('username', $username);
    $this->update();
  }
}
