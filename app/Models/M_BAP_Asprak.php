<?php

namespace App\Models;

use CodeIgniter\Model;

class M_BAP_Asprak extends Model
{

  protected $table = 'bap_asprak';
  protected $primaryKey = 'id_bap';
  protected $allowedFields  = ['bulan', 'tahun', 'jumlah_jam', 'tanggal_awal', 'tanggal_akhir', 'tanggal_generate', 'nim_asprak', 'id_prodi', 'kode_mk'];

  function getDataBAP($id_prodi)
  {
    $this->select('bap_asprak.id_bap, bap_asprak.bulan, bap_asprak.tahun, bap_asprak.jumlah_jam, asprak.nim_asprak, asprak.nama_asprak, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('asprak', 'bap_asprak.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah', 'bap_asprak.kode_mk = matakuliah.kode_mk');
    $this->where('bap_asprak.id_prodi', $id_prodi);
    $this->orderBy('id_bap', 'DESC');
    $this->orderBy('asprak.nama_asprak', 'ASC');
    return $this->findAll();
  }

  function getDataBAPById($id_bap)
  {
    $this->select('bap_asprak.id_bap, bap_asprak.bulan, bap_asprak.tahun, bap_asprak.jumlah_jam, bap_asprak.tanggal_generate, asprak.nim_asprak, asprak.nama_asprak, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('asprak', 'bap_asprak.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah', 'bap_asprak.kode_mk = matakuliah.kode_mk');
    $this->where('substr(sha1(bap_asprak.id_bap), 8, 7)', $id_bap);
    $this->orderBy('id_bap', 'DESC');
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
}
