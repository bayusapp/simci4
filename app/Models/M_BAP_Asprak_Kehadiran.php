<?php

namespace App\Models;

use CodeIgniter\Model;

class M_BAP_Asprak_Kehadiran extends Model
{

  protected $table = 'bap_asprak_kehadiran';
  protected $primaryKey = 'id_kehadiran';
  protected $allowedFields  = ['jam_masuk', 'jam_keluar', 'jumlah_jam', 'kelas', 'modul_praktikum', 'kode_dosen', 'approve_dosen', 'nim_asprak', 'id_asprak_list', 'id_bap', 'id_honor'];

  public function getDataBAP($nim_asprak)
  {
    $this->select('id_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, modul_praktikum, kode_dosen, approve_dosen');
    $this->where('nim_asprak', $nim_asprak);
    $this->orderBy('id_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function checkBAP($tanggal, $nim_asprak)
  {
    $this->select('id_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, (cast(date_format(jam_masuk, "%H") as signed) * 60 + cast(date_format(jam_masuk, "%i") as signed)) masuk, (cast(date_format(jam_keluar, "%H") as signed) * 60 + cast(date_format(jam_keluar, "%i") as signed)) as keluar');
    $this->like('jam_masuk', $tanggal);
    $this->where('nim_asprak', $nim_asprak);
    return $this->findAll();
  }

  public function checkBAPNotIn($tanggal, $nim_asprak, $id_kehadiran)
  {
    //
  }
}
