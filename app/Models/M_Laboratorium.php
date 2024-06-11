<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium extends Model
{

  protected $table = 'laboratorium';
  protected $allowedFields  = ['nama_lab', 'kode_lab', 'kode_igracias', 'kode_ruang', 'id_lab_kategori', 'id_lab_lokasi', 'id_prodi'];

  public function getAllLaboratorium()
  {
    $this->orderBy("kode_lab");
    return $this->findAll();
  }
}
