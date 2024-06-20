<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dosen extends Model
{

  protected $table = 'dosen';
  protected $primaryKey = 'kode_dosen';
  protected $allowedFields  = ['kode_dosen', 'nama_dosen'];

  public function getDataDosen()
  {
    return $this->findAll();
  }

  public function updateDataDosen($kode_old, $kode_dosen, $nama_dosen)
  {
    $db = db_connect();
    $query = "UPDATE dosen SET kode_dosen = '{$kode_dosen}', nama_dosen = '{$nama_dosen}' WHERE SUBSTR(SHA1(kode_dosen), 8, 7) = '{$kode_old}'";
    return $db->query($query);
  }
}
