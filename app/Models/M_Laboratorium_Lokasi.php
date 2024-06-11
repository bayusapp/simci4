<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium_Lokasi extends Model
{

  protected $table = 'laboratorium_lokasi';
  protected $allowedFields = ['id_lab_lokasi', 'lokasi'];

  public function getDataLokasi()
  {
    return $this->findAll();
  }
}
