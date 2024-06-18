<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Matakuliah extends Model
{

  protected $table = 'matakuliah';
  protected $primaryKey = 'kode_mk';
  protected $allowedFields = ['kode_mk', 'nama_mk', 'id_prodi'];

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

  public function updateDataMK($kode_mk, $data)
  {
    return $this->update($kode_mk, $data);
  }

  public function deleteDataMK($kode_mk)
  {
    $this->where('substr(sha1(kode_mk), 8, 7)', $kode_mk);
    return $this->delete();
  }
}