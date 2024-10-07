<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak_BAP extends Model
{

  protected $table = 'asprak_bap';
  protected $primaryKey = 'id_asprak_bap';
  protected $allowedFields  = ['bulan', 'tahun', 'jumlah_jam', 'tanggal_awal', 'tanggal_akhir', 'tanggal_generate', 'qr', 'nim_asprak', 'id_prodi', 'kode_mk', 'generated_by'];

  function getDataBAP($id_prodi)
  {
    $this->select('asprak_bap.id_asprak_bap, asprak_bap.bulan, asprak_bap.tahun, asprak_bap.jumlah_jam, asprak.nim_asprak, asprak.nama_asprak, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('asprak', 'asprak_bap.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah', 'asprak_bap.kode_mk = matakuliah.kode_mk');
    $this->where('asprak_bap.id_prodi', $id_prodi);
    $this->orderBy('id_asprak_bap', 'DESC');
    $this->orderBy('asprak.nama_asprak', 'ASC');
    return $this->findAll();
  }

  function getDataBAPById($id_bap)
  {
    $this->select('asprak_bap.id_asprak_bap, asprak_bap.bulan, asprak_bap.tahun, asprak_bap.jumlah_jam, asprak_bap.tanggal_generate, asprak_bap.generated_by, asprak_bap.qr, asprak.nim_asprak, asprak.nama_asprak, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('asprak', 'asprak_bap.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah', 'asprak_bap.kode_mk = matakuliah.kode_mk');
    $this->where('substr(sha1(asprak_bap.id_asprak_bap), 8, 7)', $id_bap);
    $this->orderBy('id_asprak_bap', 'DESC');
    $this->orderBy('asprak.nama_asprak', 'ASC');
    return $this->first();
  }

  function getIdBAP($bulan, $tahun, $jumlah_jam, $tanggal_awal, $tanggal_akhir, $tanggal_generate, $nim_asprak, $id_prodi, $kode_mk)
  {
    $this->where('bulan', $bulan);
    $this->where('tahun', $tahun);
    $this->where('jumlah_jam', $jumlah_jam);
    $this->where('tanggal_awal', $tanggal_awal);
    $this->where('tanggal_akhir', $tanggal_akhir);
    $this->where('tanggal_generate', $tanggal_generate);
    $this->where('nim_asprak', $nim_asprak);
    $this->where('id_prodi', $id_prodi);
    $this->where('kode_mk', $kode_mk);
    return $this->first();
  }

  public function updateForQR($id_bap, $qr)
  {
    $this->set('qr', $qr);
    $this->where('id_asprak_bap', $id_bap);
    $this->update();
  }
}
