<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium extends Model
{

  protected $table = 'laboratorium';
  protected $allowedFields  = ['nama_lab', 'kode_lab', 'kode_igracias', 'kode_ruang', 'id_lab_kategori', 'id_lab_lokasi', 'id_prodi'];

  public function getAllLaboratorium()
  {
    $this->orderBy("kode_lab");
    return $this->findAll();
  }

  public function getDataLabPraktikum()
  {
    $this->select('laboratorium.id_lab, laboratorium.nama_lab, laboratorium.kode_lab, laboratorium.kode_ruang, laboratorium_lokasi.lokasi, prodi.nama_prodi, prodi.jenjang_prodi');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->join('prodi', 'laboratorium.id_prodi = prodi.id_prodi');
    $this->where('laboratorium.id_lab_kategori', '1');
    $this->orderBy('laboratorium.kode_lab', 'asc');
    return $this->findAll();
  }
}
