<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak_List extends Model
{

  protected $table = 'asprak_list';
  protected $allowedFields = ['nim_asprak', 'id_mk_semester'];

  public function checkDataAsprakList($nim, $id_mk_semester)
  {
    $this->where('nim_asprak', $nim);
    $this->where('id_mk_semester', $id_mk_semester);
    return $this->first();
  }

  public function getDataAsprakMK($id_prodi, $id_ta)
  {
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->where('matakuliah.id_prodi', $id_prodi);
    $this->where('matakuliah_semester.id_ta', $id_ta);
    $this->orderBy('matakuliah.kode_mk', 'ASC');
    $this->orderBy('asprak.nim_asprak', 'ASC');
    return $this->findAll();
  }
}