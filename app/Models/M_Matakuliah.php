<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Matakuliah extends Model
{

  protected $table = 'matakuliah';
  protected $primaryKey = 'kode_mk';
  protected $allowedFields = ['kode_mk', 'nama_mk', 'id_prodi'];

  public function getDataMKAll()
  {
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->orderBy('prodi.id_prodi', 'ASC');
    return $this->findAll();
  }

  public function getDataMK($kode_mk)
  {
    $this->where('kode_mk', $kode_mk);
    return $this->first();
  }

  public function getDataMKProdi($id_prodi)
  {
    $this->where('id_prodi', $id_prodi);
    return $this->findAll();
  }

  public function getProdiByKodeMK($kode_mk)
  {
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->where('kode_mk', $kode_mk);
    return $this->first();
  }

  public function updateDataMK($kode_old, $kode_mk, $nama_mk, $id_prodi)
  {
    $db = db_connect();
    $query = "UPDATE matakuliah SET kode_mk = '{$kode_mk}', nama_mk = '{$nama_mk}', id_prodi = '{$id_prodi}' WHERE SUBSTR(SHA1(kode_mk), 8, 7) = '{$kode_old}'";
    return $db->query($query);
  }

  public function deleteDataMK($kode_mk)
  {
    $this->where('substr(sha1(kode_mk), 8, 7)', $kode_mk);
    return $this->delete();
  }
}
