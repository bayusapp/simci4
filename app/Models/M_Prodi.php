<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Prodi extends Model
{

  protected $table = 'prodi';
  protected $allowedFields = ['nama_prodi', 'jenjang_prodi', 'kode_prodi'];

  public function getDataProdi()
  {
    return $this->findAll();
  }
}
