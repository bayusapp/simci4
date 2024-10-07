<?php

namespace App\Controllers;

use App\Models\M_Kalender_Libur;
use App\Models\M_Laboran;
use App\Models\M_Tahun_Ajaran;

class Kalender extends BaseController
{

  var $data;
  protected $kalender;
  protected $laboran;
  protected $ta;
  protected $nama_laboran;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->kalender     = new M_Kalender_Libur();
        $this->laboran      = new M_Laboran();
        $this->ta           = new M_Tahun_Ajaran();
        $nip                = session()->get('nip_laboran');
        $data_laboran       = $this->laboran->getDataLaboran($nip);
        $this->data         = array(
          'nip_laboran'   => $data_laboran['nip_laboran'],
          'nama_laboran'  => $data_laboran['nama_laboran'],
          'foto_laboran'  => $data_laboran['foto_laboran']
        );
      } else {
        header("Location: " . base_url());
        die();
      }
    }
  }

  public function index()
  {
    if (!$this->validate([
      'tahun' => ['rules' => 'required']
    ])) {
      $data             = $this->data;
      $data['kalender'] = $this->kalender->getDataKalender(date('Y'));
      $data['ta']       = $this->ta->getTahun();
      $data['tahun']    = date('Y');
      return view('laboran/kalender/v_index', $data);
    } else {
      $tahun            = $this->request->getPost('tahun');
      $data             = $this->data;
      $data['kalender'] = $this->kalender->getDataKalender($tahun);
      $data['ta']       = $this->ta->getTahun();
      $data['tahun']    = $tahun;
      return view('laboran/kalender/v_index', $data);
    }
  }

  public function simpanTanggal()
  {
    if (!$this->validate([
      'tanggal'     => ['rules' => 'required'],
      'keterangan'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $tanggal        = $this->request->getPost('tanggal');
      $keterangan     = $this->request->getPost('keterangan');
      $split_tanggal  = explode('/', $tanggal);
      $array_tanggal  = array($split_tanggal[2], $split_tanggal[0], $split_tanggal[1]);
      $tanggal        = implode('-', $array_tanggal);
      $cek_tanggal    = $this->kalender->checkDataKalender($tanggal);
      if ($cek_tanggal) {
        session()->setFlashdata('error', tanggalIndo($tanggal) . ' Sudah Ada Sebelumnya');
        return redirect()->back()->withInput();
      } else {
        $input = [
          'tanggal'     => $tanggal,
          'keterangan'  => $keterangan
        ];
        $this->kalender->insert($input);
        session()->setFlashdata('sukses', 'Data Kalender Libur Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function simpanCSVKalender()
  {
    $file           = $_FILES['file_csv']['tmp_name'];
    $ekstensi_file  = explode('.', $_FILES['file_csv']['name']);
    if (strtolower(end($ekstensi_file)) === 'csv' && $_FILES['file_csv']['size'] > 0) {
      $handle = fopen($file, 'r');
      $i      = 0;
      while ($row = fgetcsv($handle, 2048, ';')) {
        $i++;
        if ($i == 1) {
          continue;
        }
        $tanggal  = $row[0];
        $kalender = $row[1];
        $split    = explode('/', $tanggal);
        $input    = [
          'tanggal_libur' => $split[2] . '-' . $split[1] . '-' . $split[0],
          'keterangan'    => $kalender
        ];
        $this->kalender->insert($input);
      }
      session()->setFlashdata('sukses', 'Data Kalender Libur Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function updateTanggal()
  {
    if (!$this->validate([
      'id_tanggal'  => ['rules' => 'required'],
      'tanggal'     => ['rules' => 'required'],
      'keterangan'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $id_tanggal     = $this->request->getPost('id_tanggal');
      $tanggal        = $this->request->getPost('tanggal');
      $keterangan     = $this->request->getPost('keterangan');
      $split_tanggal  = explode('/', $tanggal);
      $array_tanggal  = array($split_tanggal[2], $split_tanggal[0], $split_tanggal[1]);
      $tanggal        = implode('-', $array_tanggal);
      $input          = [
        'tanggal'     => $tanggal,
        'keterangan'  => $keterangan
      ];
      $cek_tanggal_id = $this->kalender->checkDataKalenderByID($id_tanggal);
      if ($cek_tanggal_id['tanggal'] == $tanggal) {
        $this->kalender->updateKalender($id_tanggal, $tanggal, $keterangan);
        session()->setFlashdata('sukses', 'Data Kalender Libur Sukses Diperbarui');
        return redirect()->back();
      } else {
        $cek_tanggal  = $this->kalender->checkDataKalender($tanggal);
        if ($cek_tanggal) {
          session()->setFlashdata('error', tanggalIndo($tanggal) . ' Sudah Ada Sebelumnya');
          return redirect()->back();
        } else {
          $this->kalender->updateKalender($id_tanggal, $tanggal, $keterangan);
          session()->setFlashdata('sukses', 'Data Kalender Libur Sukses Diperbarui');
          return redirect()->back();
        }
      }
    }
  }

  public function deleteKalender()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to(base_url('Kalender'));
    } else {
      $id_kalender = $this->request->getPost('id');
      $this->kalender->deleteKalender($id_kalender);
    }
  }
}
