<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Tahun_Ajaran extends Model
{

  protected $table = 'tahun_ajaran';
  protected $allowedFields = ['tahun_ajaran', 'is_active'];

  public function getAllTahunAjaran()
  {
    $this->orderBy('id_ta', 'DESC');
    return $this->findAll();
  }

  public function getTahunAjaran()
  {
    $this->where('is_active', '1');
    return $this->first();
  }

  public function getTahunAjaranByID($id)
  {
    $this->where('id_ta', $id);
    return $this->first();
  }

  public function getTahun()
  {
    $this->select('distinct(substring(tahun_ajaran, 1, 4)) as tahun');
    $this->orderBy('tahun', 'DESC');
    return $this->findAll();
  }
}
