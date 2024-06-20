<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dosen extends Model
{

  protected $table = 'dosen';
  protected $primaryKey = 'kode_dosen';
  protected $allowedFields  = ['kode_dosen', 'nama_dosen'];

  public function getDataDosen()
  {
    return $this->findAll();
  }
}
