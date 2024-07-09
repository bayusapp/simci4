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

  public function checkDataKalender($tanggal)
  {
    $this->where('tanggal', $tanggal);
    return $this->first();
  }

  public function checkDataKalenderByID($id)
  {
    $this->where("substr(sha1(id_tanggal), 8, 7) = '{$id}'");
    return $this->first();
  }

  public function updateKalender($id_tanggal, $tanggal, $keterangan)
  {
    $db = db_connect();
    $query = "UPDATE kalender_libur SET tanggal = '{$tanggal}', keterangan = '{$keterangan}' WHERE substr(sha1(id_tanggal), 8, 7) = '{$id_tanggal}'";
    return $db->query($query);
  }

  public function deleteKalender($id)
  {
    $this->where("substr(sha1(id_tanggal), 8, 7) = '{$id}'");
    return $this->delete();
  }
}
