<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak_BAP_Kehadiran extends Model
{

  protected $table = 'asprak_bap_kehadiran';
  protected $primaryKey = 'id_asprak_bap_kehadiran';
  protected $allowedFields  = ['jam_masuk', 'jam_keluar', 'jumlah_jam', 'kelas', 'modul_praktikum', 'kode_dosen', 'approve_dosen', 'tanggal_approve', 'alasan_ditolak', 'nim_asprak', 'id_asprak_list', 'id_asprak_bap', 'id_honor'];

  public function getDataBAP($nim_asprak)
  {
    $this->select('id_asprak_bap_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, modul_praktikum, kode_dosen, approve_dosen');
    $this->where('nim_asprak', $nim_asprak);
    $this->orderBy('approve_dosen', 'ASC');
    $this->orderBy('jam_masuk', 'DESC');
    $this->orderBy('id_asprak_bap_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function getKehadiranAsprak($nim_asprak)
  {
    $this->select('id_asprak_bap_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, modul_praktikum, asprak_bap_kehadiran.kode_dosen, approve_dosen, matakuliah.kode_mk, matakuliah.nama_mk');
    $this->join('asprak_list', 'asprak_bap_kehadiran.id_asprak_list = asprak_list.id_asprak_list');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->where('asprak_bap_kehadiran.nim_asprak', $nim_asprak);
    // $this->orderBy('approve_dosen', 'ASC');
    $this->orderBy('jam_masuk', 'DESC');
    $this->orderBy('id_asprak_bap_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function checkBAP($tanggal, $nim_asprak)
  {
    $this->select('id_asprak_bap_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, (cast(date_format(jam_masuk, "%H") as signed) * 60 + cast(date_format(jam_masuk, "%i") as signed)) masuk, (cast(date_format(jam_keluar, "%H") as signed) * 60 + cast(date_format(jam_keluar, "%i") as signed)) as keluar');
    $this->like('jam_masuk', $tanggal);
    $this->where('nim_asprak', $nim_asprak);
    return $this->findAll();
  }

  public function checkBAPForUpdate($tanggal, $nim_asprak, $id_kehadiran)
  {
    $this->select('id_asprak_bap_kehadiran, date_format(jam_masuk, "%Y-%m-%d") tanggal, (cast(date_format(jam_masuk, "%H") as signed) * 60 + cast(date_format(jam_masuk, "%i") as signed)) masuk, (cast(date_format(jam_keluar, "%H") as signed) * 60 + cast(date_format(jam_keluar, "%i") as signed)) as keluar');
    $this->like('jam_masuk', $tanggal);
    $this->where('nim_asprak', $nim_asprak);
    $this->whereNotIn('substr(sha1(id_asprak_bap_kehadiran), 8, 7)', $id_kehadiran);
    return $this->findAll();
  }

  public function getDataBAPByIdBAP($id_bap)
  {
    $this->where('id_asprak_bap', $id_bap);
    $this->orderBy('jam_masuk', 'ASC');
    return $this->findAll();
  }

  public function getDataKehadiran($id)
  {
    $this->where('substr(sha1(id_asprak_bap_kehadiran), 8, 7)', $id);
    return $this->first();
  }

  public function checkBAPNotIn($tanggal, $nim_asprak, $id_kehadiran)
  {
    //
  }

  public function generateBAP($id_asprak_list, $tanggal_awal, $tanggal_akhir)
  {
    $this->where('id_asprak_list', $id_asprak_list);
    $this->where('approve_dosen', '1');
    $this->where('jam_masuk >=', $tanggal_awal);
    $this->where('jam_masuk <=', $tanggal_akhir);
    return $this->findAll();
  }

  public function updateKehadiran($jam_masuk, $jam_keluar, $jumlah_jam, $kelas, $modul_praktikum, $kode_dosen, $id_asprak_list, $id)
  {
    $this->set('jam_masuk', $jam_masuk);
    $this->set('jam_keluar', $jam_keluar);
    $this->set('jumlah_jam', $jumlah_jam);
    $this->set('kelas', $kelas);
    $this->set('modul_praktikum', $modul_praktikum);
    $this->set('kode_dosen', $kode_dosen);
    $this->set('id_asprak_list', $id_asprak_list);
    $this->where('substr(sha1(id_asprak_bap_kehadiran), 8, 7)', $id);
    $this->update();
  }

  public function updateIdBAPnHonor($tanggal_awal, $tanggal_akhir, $id_asprak_list, $id_bap, $id_honor)
  {
    $this->set('id_asprak_bap', $id_bap);
    $this->set('id_honor', $id_honor);
    $this->where('jam_masuk >=', $tanggal_awal);
    $this->where('jam_masuk <=', $tanggal_akhir);
    $this->where('id_asprak_list', $id_asprak_list);
    $this->where('approve_dosen', '1');
    $this->update();
  }

  public function getDataByKodeDosen($kode_dosen)
  {
    $this->select('id_asprak_bap_kehadiran, asprak.nim_asprak, nama_asprak, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, matakuliah.kode_mk, matakuliah.nama_mk, modul_praktikum, approve_dosen');
    $this->join('asprak_list', 'asprak_bap_kehadiran.id_asprak_list = asprak_list.id_asprak_list');
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->where('asprak_bap_kehadiran.kode_dosen', $kode_dosen);
    $this->where('approve_dosen = "0"');
    $this->orderBy('approve_dosen', 'ASC');
    $this->orderBy('jam_masuk', 'DESC');
    $this->orderBy('id_asprak_bap_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function getApproveByKodeDosen($kode_dosen)
  {
    $this->select('id_asprak_bap_kehadiran, asprak.nim_asprak, nama_asprak, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, matakuliah.kode_mk, matakuliah.nama_mk, modul_praktikum, approve_dosen, tanggal_approve');
    $this->join('asprak_list', 'asprak_bap_kehadiran.id_asprak_list = asprak_list.id_asprak_list');
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->where('asprak_bap_kehadiran.kode_dosen', $kode_dosen);
    $this->where('approve_dosen = "1"');
    $this->orderBy('approve_dosen', 'ASC');
    $this->orderBy('jam_masuk', 'DESC');
    $this->orderBy('id_asprak_bap_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function getRejectByKodeDosen($kode_dosen)
  {
    $this->select('id_asprak_bap_kehadiran, asprak.nim_asprak, nama_asprak, date_format(jam_masuk, "%Y-%m-%d") tanggal, date_format(jam_masuk, "%H:%i") masuk, date_format(jam_keluar, "%H:%i") keluar, jumlah_jam, kelas, matakuliah.kode_mk, matakuliah.nama_mk, modul_praktikum, approve_dosen, tanggal_approve, alasan_ditolak');
    $this->join('asprak_list', 'asprak_bap_kehadiran.id_asprak_list = asprak_list.id_asprak_list');
    $this->join('asprak', 'asprak_list.nim_asprak = asprak.nim_asprak');
    $this->join('matakuliah_semester', 'asprak_list.id_mk_semester = matakuliah_semester.id_mk_semester');
    $this->join('matakuliah', 'matakuliah_semester.kode_mk = matakuliah.kode_mk');
    $this->where('asprak_bap_kehadiran.kode_dosen', $kode_dosen);
    $this->where('approve_dosen = "2"');
    $this->orderBy('approve_dosen', 'ASC');
    $this->orderBy('jam_masuk', 'DESC');
    $this->orderBy('id_asprak_bap_kehadiran', 'DESC');
    return $this->findAll();
  }

  public function approveKehadiranAll($kode_dosen, $waktu)
  {
    $this->set('approve_dosen', '1');
    $this->set('tanggal_approve', $waktu);
    $this->where('kode_dosen', $kode_dosen);
    $this->where('approve_dosen = "0"');
    $this->update();
  }

  public function approveKehadiran($id, $waktu)
  {
    $this->set('approve_dosen', '1');
    $this->set('tanggal_approve', $waktu);
    $this->where('substr(sha1(id_asprak_bap_kehadiran), 13, 7)', $id);
    $this->update();
  }

  public function rejectKehadiran($id, $waktu, $alasan)
  {
    $this->set('approve_dosen', '2');
    $this->set('tanggal_approve', $waktu);
    $this->set('alasan_ditolak', $alasan);
    $this->where('substr(sha1(id_asprak_bap_kehadiran), 13, 7)', $id);
    $this->update();
  }

  public function deleteKehadiran($id)
  {
    $this->where('substr(sha1(id_asprak_bap_kehadiran), 8, 7)', $id);
    $this->delete();
  }
}
