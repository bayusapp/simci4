<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Laboratorium;
use App\Models\M_Laboratorium_Kategori;
use App\Models\M_Laboratorium_Lokasi;
use App\Models\M_Prodi;

class Laboratorium extends BaseController
{

  var $data;
  protected $laboran;
  protected $lab;
  protected $lab_kategori;
  protected $lab_lokasi;
  protected $prodi;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->laboran  = new M_Laboran();
        $this->lab          = new M_Laboratorium();
        $this->lab_kategori = new M_Laboratorium_Kategori();
        $this->lab_lokasi = new M_Laboratorium_Lokasi();
        $this->prodi    = new M_Prodi();
        $nip          = session()->get('nip_laboran');
        $data_laboran = $this->laboran->getDataLaboran($nip);
        $this->data   = array(
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
    $data = $this->data;
    $data['kategori'] = $this->lab_kategori->getDataKategori();
    $data['lab_praktikum']  = $this->lab->getDataLabPraktikum();
    $data['lokasi']   = $this->lab_lokasi->getDataLokasi();
    $data['prodi']    = $this->prodi->getDataProdi();
    return view('laboran/laboratorium/v_index', $data);
  }

  public function simpanLaboratorium()
  {
    if (!$this->validate([
      'nama_lab'        => ['rules' => 'required'],
      'kode_lab'        => ['rules' => 'required'],
      'id_lab_kategori' => ['rules' => 'required'],
      'id_lab_lokasi'   => ['rules' => 'required'],
      'id_prodi'        => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $nama_lab         = $this->request->getPost('nama_lab');
      $kode_lab         = $this->request->getPost('kode_lab');
      $kode_ruang       = $this->request->getPost('kode_ruang');
      $id_lab_lokasi    = $this->request->getPost('id_lab_lokasi');
      $id_lab_kategori  = $this->request->getPost('id_lab_kategori');
      $id_prodi         = $this->request->getPost('id_prodi');
      $data_lab         = [
        'nama_lab'        => $nama_lab,
        'kode_lab'        => $kode_lab,
        'kode_igracias'   => $kode_lab,
        'kode_ruang'      => $kode_ruang,
        'id_lab_lokasi'   => $id_lab_lokasi,
        'id_lab_kategori' => $id_lab_kategori,
        'id_prodi'        => $id_prodi
      ];
      $this->lab->insert($data_lab);
      session()->setFlashdata('sukses', 'Data Laboratorium Sukses Ditambahkan');
      return redirect()->back();
    }
  }
}
