<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium extends Model
{

  protected $table = 'laboratorium';

  public function getAllLaboratorium()
  {
    return $this->findAll();
  }
}
