<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium extends Model
{

  protected $table = 'laboratorium';

  public function getAllLaboratorium()
  {
    $this->orderBy("kode_lab");
    return $this->findAll();
  }
}
