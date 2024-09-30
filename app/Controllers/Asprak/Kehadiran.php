<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Asprak_BAP_Kehadiran;
use App\Models\M_Asprak_List;
use App\Models\M_Dosen;
use App\Models\M_Kalender_Libur;
use App\Models\M_Tahun_Ajaran;
use App\Models\M_Users;

class Kehadiran extends BaseController
{

  var $data;
  protected $asprak;
  protected $asprak_list;
  protected $dosen;
  protected $kalender_libur;
  protected $kehadiran;
  protected $ta;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak         = new M_Asprak();
      $this->asprak_list    = new M_Asprak_List();
      $this->dosen          = new M_Dosen();
      $this->kalender_libur = new M_Kalender_Libur();
      $this->kehadiran      = new M_Asprak_BAP_Kehadiran();
      $this->ta             = new M_Tahun_Ajaran();
      $this->users          = new M_Users();
      $username             = session()->get('username');
      $nim_asprak           = $this->users->getUsername($username)['nim_asprak'];
      $data_asprak          = $this->asprak->checkDataAsprak($nim_asprak);
      $this->data           = array(
        'nim_asprak'  => $nim_asprak,
        'nama_asprak' => $data_asprak['nama_asprak'],
        'foto_asprak' => $data_asprak['file_foto']
      );
    }
  }

  public function index()
  {
    $data               = $this->data;
    $id_ta              = $this->ta->getTahunAjaran()['id_ta'];
    $username           = session()->get('username');
    $nim_asprak         = $this->users->getUsername($username)['nim_asprak'];
    $data['dosen']      = $this->dosen->getDataDosen();
    $data['identitas']  = $this->asprak->checkDataAsprak($this->data['nim_asprak']);
    $data['kehadiran']  = $this->kehadiran->getDataBAP($this->data['nim_asprak']);
    $data['mk']         = $this->asprak_list->getListMKAsprak($nim_asprak, $id_ta);
    return view('asprak/kehadiran/v_index', $data);
  }

  public function simpanKehadiran()
  {
    if (!$this->validate([
      'tanggal'     => ['rules' => 'required'],
      'jam_masuk'   => ['rules' => 'required'],
      'jam_keluar'  => ['rules' => 'required'],
      'kelas'       => ['rules' => 'required'],
      'mk_asprak'   => ['rules' => 'required'],
      'modul'       => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $array_error      = array();
      // $tanggal          = '2024-02-29';
      $tanggal          = convertDatePicker($this->request->getPost('tanggal'));
      $jam_masuk        = $this->request->getPost('jam_masuk');
      $jam_keluar       = $this->request->getPost('jam_keluar');
      $kelas            = $this->request->getPost('kelas');
      $id_asprak_list   = $this->request->getPost('mk_asprak');
      $modul            = $this->request->getPost('modul');
      $kode_dosen       = $this->request->getPost('kode_dosen');
      if ((hitungJamKeMenit($jam_masuk) < hitungJamKeMenit('06:30')) || (hitungJamKeMenit($jam_masuk) > hitungJamKeMenit('18:30'))) {
        $array_error[]        = 'Jam perkuliahan direntang waktu 06:30 - 18:30, jam masuk Anda pada pukul ' . $jam_masuk . '.';
      }
      if ((hitungJamKeMenit($jam_keluar) < hitungJamKeMenit('06:30')) || (hitungJamKeMenit($jam_keluar) > hitungJamKeMenit('18:30'))) {
        $array_error[]        = 'Jam perkuliahan direntang waktu 06:30 - 18:30, jam keluar Anda pada pukul ' . $jam_keluar . '.';
      }
      $selisih_jam      = (hitungJamKeMenit($jam_keluar) - hitungJamKeMenit($jam_masuk)) / 60;
      if ($selisih_jam < 0) {
        $array_error[]        = 'Jam keluar Anda lebih awal dibanding jam masuk Anda, jam masuk Anda ' . $jam_masuk . ' dan jam keluar Anda ' . $jam_keluar . '.';
      }
      if ($selisih_jam < 1) {
        $array_error[]        = 'Minimal jam kehadiran dalam satu sesi adalah 1 jam, jam masuk Anda ' . $jam_masuk . ' dan jam keluar Anda ' . $jam_keluar . '.';
      }
      $cek_kalender_libur  = $this->kalender_libur->checkDataKalender($tanggal);
      if (date('D', strtotime($tanggal)) == 'Sun') {
        $array_error[]        = 'Tanggal ' . convertTanggal($tanggal) . ' adalah hari Minggu.';
      }
      if ($cek_kalender_libur) {
        $array_error[]        = 'Tanggal ' . convertTanggal($tanggal) . ' adalah hari libur (' . $cek_kalender_libur['keterangan'] . ').';
      }
      $cek_bap  = $this->kehadiran->checkBAP($tanggal, $this->data['nim_asprak']);
      if ($cek_bap) {
        $jumlah_jam_sebelumnya = 0;
        foreach ($cek_bap as $c) {
          if ((hitungJamKeMenit($jam_masuk) > $c['masuk']) && (hitungJamKeMenit($jam_masuk) < $c['keluar'])) {
            $array_error[] = 'Jam masuk Anda diantara jam ' . hitungMenitKeJam($c['masuk']) . ' - ' . hitungMenitKeJam($c['keluar']) . ' pada hari yang sama.';
          }
          if ((hitungJamKeMenit($jam_keluar) > $c['masuk']) && (hitungJamKeMenit($jam_keluar) < $c['keluar'])) {
            $array_error[] = 'Jam keluar Anda diantara jam ' . hitungMenitKeJam($c['masuk']) . ' - ' . hitungMenitKeJam($c['keluar']) . ' pada hari yang sama.';
          }
          $jumlah_jam_sebelumnya = $jumlah_jam_sebelumnya + (($c['keluar'] - $c['masuk']) / 60);
        }
        if (($jumlah_jam_sebelumnya + $selisih_jam) > 6) {
          $array_error[]  = 'Jumlah kehadiran Anda dalam satu hari sudah melebihi dari 6 jam, jumlah jam kehadiran Anda hari ini sudah ' . $jumlah_jam_sebelumnya . ' jam.';
        }
      }
      if (count($array_error) > 0) {
        session()->setFlashdata('error', $array_error);
        return redirect()->back();
      } else {
        $input = [
          'jam_masuk'       => $tanggal . ' ' . $jam_masuk,
          'jam_keluar'      => $tanggal . ' ' . $jam_keluar,
          'jumlah_jam'      => $selisih_jam,
          'kelas'           => $kelas,
          'modul_praktikum' => $modul,
          'kode_dosen'      => $kode_dosen,
          'approve_dosen'   => '0',
          'nim_asprak'      => $this->data['nim_asprak'],
          'id_asprak_list'  => $id_asprak_list
        ];
        $this->kehadiran->insert($input);
        session()->setFlashdata('sukses', 'Data Kehadiran Anda Sukses Disimpan');
        return redirect()->back();
      }
    }
  }
}
