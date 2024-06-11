<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium_Kategori extends Model
{

  protected $table = 'laboratorium_kategori';
  protected $allowedFields = ['id_lab_kategori', 'kategori_lab'];

  public function getDataKategori()
  {
    return $this->findAll();
  }
}
