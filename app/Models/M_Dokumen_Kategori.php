<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen_Kategori extends Model
{

  protected $table = 'dokumen_kategori';
  protected $primaryKey = 'id_dokumen_kategori';
  protected $allowedFields = ['nama_dokumen_kategori'];

  public function getList()
  {
    return $this->findAll();
  }
}
