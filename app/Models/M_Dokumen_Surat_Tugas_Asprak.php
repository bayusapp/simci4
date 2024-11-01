<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen_Surat_Tugas_Asprak extends Model
{

  protected $table          = 'dokumen_surat_tugas_asprak';
  protected $primaryKey     = 'id_dsta';
  protected $allowedFields  = ['tanggal_dibuat', 'tanggal_penugasan', 'pembuat_dokumen', 'id_mk_semester'];

  public function getAllSuratTugas()
  {
    // $this->select('dokumen_surat_tugas_asprak.id_dsta, dokumen_surat_tugas_asprak.tanggal_dibuat, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('matakuliah_semester', 'dokumen_surat_tugas_asprak.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->orderBy('id_dsta', 'DESC');
    return $this->findAll();
  }

  public function getDataSuratTugas($id_dsta)
  {
    $this->where('id_dsta', $id_dsta);
    return $this->first();
  }

  public function getDataSuratTugasHash($id_dsta)
  {
    $this->join('matakuliah_semester', 'dokumen_surat_tugas_asprak.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->join('tahun_ajaran', 'matakuliah_semester.id_ta = tahun_ajaran.id_ta');
    $this->join('prodi', 'matakuliah.id_prodi = prodi.id_prodi');
    $this->where('substr(sha1(id_dsta), 13, 7)', $id_dsta);
    return $this->first();
  }

  public function getIDSuratTugas($tanggal_dibuat, $pembuat_dokumen, $id_mk_semester)
  {
    $this->where('tanggal_dibuat', $tanggal_dibuat);
    $this->where('pembuat_dokumen', $pembuat_dokumen);
    $this->where('id_mk_semester', $id_mk_semester);
    return $this->first();
  }

  public function deleteSuratTugas($id_dsta)
  {
    $this->where('substr(sha1(id_dsta), 13, 7)', $id_dsta);
    $this->delete();
  }
}
