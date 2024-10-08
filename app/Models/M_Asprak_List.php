<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak_List extends Model
{

  protected $table = 'asprak_list';
  protected $allowedFields = ['surat_perjanjian', 'tanggal_surat_perjanjian', 'nim_asprak', 'id_mk_semester'];

  public function numberOfAsprak($id_ta)
  {
    $this->select('count(id_asprak_list) jumlah');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->where('id_ta', $id_ta);
    return $this->first();
  }

  public function checkDataAsprakList($nim, $id_mk_semester)
  {
    $this->where('nim_asprak', $nim);
    $this->where('id_mk_semester', $id_mk_semester);
    return $this->first();
  }

  public function getDataAsprakMK($kode_prodi, $id_ta)
  {
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('bank', 'asprak.kode_bank = bank.kode_bank', 'left');
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->where('prodi.kode_prodi', $kode_prodi);
    $this->where('matakuliah_semester.id_ta', $id_ta);
    $this->orderBy('matakuliah.kode_mk', 'ASC');
    $this->orderBy('asprak.nim_asprak', 'ASC');
    return $this->findAll();
  }

  function getAsprakByIdMkSemester($id_mk_semester)
  {
    $this->where('id_mk_semester', $id_mk_semester);
    return $this->findAll();
  }

  public function validateBank($id_hash)
  {
    $this->where("substr(sha1(id_asprak_list), 8, 7)", $id_hash);
    return $this->first();
  }

  public function getListMKAsprak($nim, $id_ta)
  {
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->where('asprak_list.nim_asprak', $nim);
    $this->where('matakuliah_semester.id_ta', $id_ta);
    $this->orderBy('prodi.id_prodi', 'ASC');
    $this->orderBy('matakuliah.kode_mk', 'ASC');
    return $this->findAll();
  }

  public function getHistoryMKAsprak($nim)
  {
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->where('asprak_list.nim_asprak', $nim);
    $this->orderBy('matakuliah_semester.id_mk_semester', 'DESC');
    return $this->findAll();
  }

  public function getSuratPerjanjian($nim)
  {
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->where('nim_asprak', $nim);
    return $this->findAll();
  }

  public function getSuratPerjanjianById($id)
  {
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->where('substr(sha1(id_asprak_list), 8, 7)', $id);
    $this->orderBy('matakuliah.kode_mk', 'asc');
    $this->orderBy('tahun_ajaran.id_ta', 'desc');
    return $this->first();
  }

  public function approveSuratPerjanjian($id, $tanggal)
  {
    $this->set('surat_perjanjian', '1');
    $this->set('tanggal_surat_perjanjian', $tanggal);
    $this->where('substr(sha1(id_asprak_list), 8, 7)', $id);
    $this->update();
  }

  public function deleteAsprakList($id_asprak_list)
  {
    $this->where('SUBSTR(SHA1(id_asprak_list), 8, 7)', $id_asprak_list);
    return $this->delete();
  }
}
