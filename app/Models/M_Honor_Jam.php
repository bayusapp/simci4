<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Honor_Jam extends Model
{

  protected $table = 'honor_jam';
  protected $primaryKey = 'id_honor';
  protected $allowedFields  = ['honor_jam', 'status'];

  public function getHonorActive()
  {
    $this->where('status', '1');
    return $this->first();
  }
}
