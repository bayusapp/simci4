<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Tahun_Ajaran extends Model
{

  protected $table = 'tahun_ajaran';
  protected $allowedFields = ['tahun_ajaran', 'is_active'];

  public function getTahunAjaran()
  {
    $this->where('is_active', '1');
    return $this->first();
  }
}
