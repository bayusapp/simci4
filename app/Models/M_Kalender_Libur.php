<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Kalender_Libur extends Model
{

  protected $table = 'kalender_libur';
  protected $primaryKey = 'id_tanggal';
  protected $allowedFields = ['tanggal', 'keterangan'];

  public function getDataKalender($tahun)
  {
    $this->where("tanggal like '{$tahun}%'");
    return $this->findAll();
  }
}
