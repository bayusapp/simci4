<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboran extends Model
{

  protected $table = 'laboran';

  public function getListLaboran()
  {
    return $this->findAll();
  }

  public function getDataLaboran($nip)
  {
    $this->where('nip_laboran', $nip);
    return $this->first();
  }
}
