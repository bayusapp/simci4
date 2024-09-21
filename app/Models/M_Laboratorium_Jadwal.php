<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium_Jadwal extends Model
{

  protected $table = 'laboratorium_jadwal';
  protected $primaryKey = 'id_jadwal';
  protected $allowedFields  = ['no_hari', 'hari', 'shift', 'ruangan', 'kelas', 'kode_dosen', 'kode_mk', 'nama_mk'];

  public function getDataJadwal($ruangan)
  {
    // $this->join('matakuliah', 'laboratorium_jadwal.kode_mk = matakuliah.kode_mk');
    $this->where('ruangan', $ruangan);
    $this->orderBy('no_hari', 'ASC');
    $this->orderBy('shift', 'ASC');
    return $this->findAll();
  }

  public function getDataBAST($lantai, $no_hari)
  {
    $this->join('laboratorium', 'laboratorium_jadwal.ruangan = laboratorium.kode_igracias');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->where('laboratorium_lokasi.id_lab_lokasi', $lantai);
    $this->where('laboratorium_jadwal.no_hari', $no_hari);
    $this->orderBy('laboratorium_jadwal.shift', 'ASC');
    return $this->findAll();
  }

  public function getDataBASTSatuEmpat($no_hari)
  {
    $this->join('laboratorium', 'laboratorium_jadwal.ruangan = laboratorium.kode_igracias');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->where('laboratorium_lokasi.id_lab_lokasi', '1');
    $this->where('laboratorium_jadwal.no_hari', $no_hari);
    $this->orWhere('laboratorium_lokasi.id_lab_lokasi', '4');
    $this->where('laboratorium_jadwal.no_hari', $no_hari);
    $this->orderBy('laboratorium_jadwal.shift', 'ASC');
    return $this->findAll();
  }
}
