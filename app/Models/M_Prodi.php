<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Prodi extends Model
{

  protected $table = 'prodi';
  protected $primaryKey = 'id_prodi';
  protected $allowedFields = ['nama_prodi', 'jenjang_prodi', 'kode_prodi'];

  public function getDataProdi()
  {
    return $this->findAll();
  }

  public function getDataProdiByKodeProdi($kode_prodi)
  {
    $this->where('kode_prodi', $kode_prodi);
    return $this->first();
  }

  public function updateProdi($id_prodi, $nama_prodi, $jenjang_prodi, $kode_prodi)
  {
    $db = db_connect();
    $query  = "UPDATE prodi SET nama_prodi = '{$nama_prodi}', jenjang_prodi = '{$jenjang_prodi}', kode_prodi = '{$kode_prodi}' WHERE SUBSTR(SHA1(id_prodi), 8, 7) = '{$id_prodi}'";
    return $db->query($query);
  }

  public function deleteProdi($id)
  {
    $this->where('substr(sha1(id_prodi), 8, 7)', $id);
    return $this->delete();
  }
}
