<?php

namespace App\Controllers;

use App\Models\M_Laboratorium;
use App\Models\M_Laboratorium_Jadwal;
use App\Models\M_Laboratorium_Lokasi;

class Logbook extends BaseController
{

  protected $lab;
  protected $lab_jadwal;
  protected $lab_lokasi;

  public function __construct()
  {
    $this->lab        = new M_Laboratorium();
    $this->lab_jadwal = new M_Laboratorium_Jadwal();
    $this->lab_lokasi = new M_Laboratorium_Lokasi();
  }

  public function index()
  {
    $data['lab'] = $this->lab->getDataLabPraktikum();
    $data['lokasi'] = $this->lab_lokasi->getDataLokasi();
    return view('logbook/v_index', $data);
  }

  public function LogbookLab()
  {
    if (!$this->validate([
      'lab' => ['rules' => 'required']
    ])) {
      echo 'belum';
    } else {
      $data['lab']  = $this->request->getPost('lab');
      return view('logbook/v_logbook', $data);
    }
  }

  public function BAST()
  {
    if (!$this->validate([
      'lantai'  => ['rules' => 'required']
    ])) {
      //
    } else {
      $data['lantai'] = $this->request->getPost('lantai');
      return view('logbook/v_bast', $data);
    }
  }

  public function upload()
  {
    return view('logbook/v_upload');
  }

  public function simpan()
  {
    $file = $_FILES['file_csv']['tmp_name'];
    $ekstensi_file  = explode('.', $_FILES['file_csv']['name']);
    if (strtolower(end($ekstensi_file)) === 'csv' && $_FILES['file_csv']['size'] > 0) {
      $handle = fopen($file, 'r');
      $i = 0;
      while (($row = fgetcsv($handle, 2048, ';'))) {
        //while (($row = fgetcsv($handle, 2048, ','))) {
        $i++;
        if ($i == 1) {
          continue;
        }
        if ($row[0] == 'SENIN') {
          $no_hari = 1;
        } elseif ($row[0] == 'SELASA') {
          $no_hari = 2;
        } elseif ($row[0] == 'RABU') {
          $no_hari = 3;
        } elseif ($row[0] == 'KAMIS') {
          $no_hari = 4;
        } elseif ($row[0] == 'JUMAT') {
          $no_hari = 5;
        } elseif ($row[0] == 'SABTU') {
          $no_hari = 6;
        }
        $input = array(
          'no_hari'     => $no_hari,
          'hari'        => $row[0],
          'shift'       => $row[1],
          'ruangan'     => $row[2],
          'kelas'       => $row[5],
          'kode_dosen'  => $row[6],
          'kode_mk'     => $row[3]
        );
        $this->lab_jadwal->insert($input);
      }
      header("Location: " . base_url('Logbook'));
      die();
    }
  }
}
