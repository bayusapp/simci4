<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Aslab extends Model
{

  protected $table = 'aslab';
  protected $primaryKey = 'nim_aslab';
  protected $allowedKey  = ['nim_aslab', 'nama_aslab', 'foto_aslab', 'kontak_aslab', 'file_ktp', 'file_norek'];

  public function getDataAslab($nim_aslab)
  {
    $this->where('nim_aslab', $nim_aslab);
    return $this->first();
  }
}
