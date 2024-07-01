<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Matakuliah_Semester extends Model
{

  protected $table = 'matakuliah_semester';
  protected $primaryKey = 'id_mk_semester';
  protected $allowedFields = ['kode_mk', 'id_ta', 'kode_dosen'];

  public function checkDataMKSemester($kode_mk, $id_ta)
  {
    $this->where('kode_mk', $kode_mk);
    $this->where('id_ta', $id_ta);
    return $this->first();
  }

  public function checkDataMKSemesterUpdate($id_mk_semester, $kode_mk, $id_ta, $kode_dosen)
  {
    $this->where("SUBSTR(SHA1(id_mk_semester), 8, 7) = '{$id_mk_semester}'");
    $this->where('kode_mk', $kode_mk);
    $this->where('id_ta', $id_ta);
    $this->where('kode_dosen', $kode_dosen);
    return $this->first();
  }

  public function getDataMKSemesterProdi($id_prodi, $id_ta)
  {
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('dosen', 'matakuliah_semester.kode_dosen = dosen.kode_dosen');
    $this->orderBy('matakuliah.nama_mk');
    $this->where('matakuliah.id_prodi', $id_prodi);
    $this->where('matakuliah_semester.id_ta', $id_ta);
    return $this->findAll();
  }

  public function updateDataMKSemester($id_mk_semester, $kode_mk, $id_ta, $kode_dosen)
  {
    $db = db_connect();
    $query = "UPDATE matakuliah_semester set kode_mk = '{$kode_mk}', id_ta = '{$id_ta}', kode_dosen = '{$kode_dosen}' WHERE SUBSTR(SHA1(id_mk_semester), 8, 7) = '{$id_mk_semester}'";
    return $db->query($query);
  }

  public function deleteDataMKSemester($id_mk_semester)
  {
    $this->where('SUBSTR(SHA1(id_mk_semester), 8, 7)', $id_mk_semester);
    return $this->delete();
  }
}
