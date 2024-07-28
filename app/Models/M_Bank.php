<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Bank extends Model
{

  protected $table = 'bank';
  protected $primaryKey = 'kode_bank';
  protected $allowedFields = ['kode_bank', 'nama_bank'];

  public function getDataBank()
  {
    return $this->findAll();
  }
}
