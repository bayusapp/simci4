<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium extends Model
{

  protected $table = 'laboratorium';
  protected $primaryKey = 'id_lab';
  protected $allowedFields  = ['id_lab', 'nama_lab', 'kode_lab', 'kode_igracias', 'kode_ruang', 'id_lab_kategori', 'id_lab_lokasi', 'id_prodi'];

  public function getAllLaboratorium()
  {
    $this->orderBy("kode_lab");
    return $this->findAll();
  }

  public function getDataLabByKode($kode)
  {
    $this->where('kode_igracias', $kode);
    return $this->first();
  }

  public function getDataLabPraktikum()
  {
    $this->select('laboratorium.id_lab, laboratorium.nama_lab, laboratorium.kode_lab, laboratorium.kode_ruang, laboratorium.id_lab_kategori, laboratorium.id_lab_lokasi, laboratorium.id_prodi, laboratorium_lokasi.lokasi, prodi.nama_prodi, prodi.jenjang_prodi');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->join('prodi', 'laboratorium.id_prodi = prodi.id_prodi');
    $this->where('laboratorium.id_lab_kategori', '1');
    $this->orderBy('laboratorium.kode_lab', 'asc');
    return $this->findAll();
  }

  public function getDataLabRiset()
  {
    $this->select('laboratorium.id_lab, laboratorium.nama_lab, laboratorium.kode_lab, laboratorium.kode_ruang, laboratorium.id_lab_kategori, laboratorium.id_lab_lokasi, laboratorium.id_prodi, laboratorium_lokasi.lokasi');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->where('laboratorium.id_lab_kategori', '2');
    $this->orderBy('laboratorium.kode_lab', 'asc');
    return $this->findAll();
  }

  public function getDataLabWorkshop()
  {
    $this->select('laboratorium.id_lab, laboratorium.nama_lab, laboratorium.kode_lab, laboratorium.kode_ruang, laboratorium.id_lab_kategori, laboratorium.id_lab_lokasi, laboratorium.id_prodi, laboratorium_lokasi.lokasi');
    $this->join('laboratorium_lokasi', 'laboratorium.id_lab_lokasi = laboratorium_lokasi.id_lab_lokasi');
    $this->where('laboratorium.id_lab_kategori', '3');
    $this->orderBy('laboratorium.kode_lab', 'asc');
    return $this->findAll();
  }

  public function updateDataLab($id, $nama_lab, $kode_lab, $kode_ruang, $id_lab_lokasi, $id_lab_kategori, $id_prodi)
  {
    $db = db_connect();
    $query = "UPDATE laboratorium SET nama_lab = '{$nama_lab}', kode_lab = '{$kode_lab}', kode_igracias = '{$kode_lab}', kode_ruang = '{$kode_ruang}', id_lab_kategori = '{$id_lab_kategori}', id_lab_lokasi = '{$id_lab_lokasi}', id_prodi = {$id_prodi} WHERE id_lab = {$id}";
    return $db->query($query);
  }

  public function deleteDataLab($id)
  {
    $this->where('substr(sha1(id_lab), 8, 7)', $id);
    return $this->delete();
  }
}
