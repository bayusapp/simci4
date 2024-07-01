<?php

namespace App\Controllers;

use App\Models\M_Dosen;
use App\Models\M_Laboran;
use App\Models\M_Matakuliah;
use App\Models\M_Matakuliah_Semester;
use App\Models\M_Prodi;
use App\Models\M_Tahun_Ajaran;

class Praktikum extends BaseController
{

  var $data;
  protected $dosen;
  protected $laboran;
  protected $mk;
  protected $mk_semester;
  protected $prodi;
  protected $ta;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->dosen        = new M_Dosen();
        $this->laboran      = new M_Laboran();
        $this->prodi        = new M_Prodi();
        $this->mk           = new M_Matakuliah();
        $this->mk_semester  = new M_Matakuliah_Semester();
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

  public function Matakuliah()
  {
    $data = $this->data;
    if (!$this->validate([
      'tahun_ajaran'  => ['rules' => 'required']
    ])) {
      $data['tahun_aktif']  = $this->ta->getTahunAjaran()['id_ta'];
    } else {
      $data['tahun_aktif']  = $this->request->getPost('tahun_ajaran');
    }
    $data['dosen']      = $this->dosen->getDataDosen();
    $data['matakuliah'] = $this->mk->getDataMKAll();
    $data['prodi']      = $this->prodi->getDataProdi();
    $data['ta']         = $this->ta->getAllTahunAjaran();
    return view('laboran/praktikum/v_matakuliah', $data);
  }

  public function simpanMK()
  {
    if (!$this->validate([
      'kode_mk'     => ['rules' => 'required'],
      'id_ta'       => ['rules' => 'required'],
      'kode_dosen'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_mk    = $this->request->getPost('kode_mk');
      $id_ta      = $this->request->getPost('id_ta');
      $kode_dosen = $this->request->getPost('kode_dosen');
      $cek_data   = $this->mk_semester->checkDataMKSemester($kode_mk, $id_ta);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Semester ' . $kode_mk . ' Sudah Ada');
        return redirect()->back()->withInput();
      } else {
        $input    = [
          'kode_mk'     => $kode_mk,
          'id_ta'       => $id_ta,
          'kode_dosen'  => $kode_dosen
        ];
        $this->mk_semester->insert($input);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateMK()
  {
    if (!$this->validate([
      'id_mk_semester'  => ['rules' => 'required'],
      'kode_mk'         => ['rules' => 'required'],
      'id_ta'           => ['rules' => 'required'],
      'kode_dosen'      => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $id_mk_semester = $this->request->getPost('id_mk_semester');
      $kode_mk        = $this->request->getPost('kode_mk');
      $id_ta          = $this->request->getPost('id_ta');
      $kode_dosen     = $this->request->getPost('kode_dosen');
      $cek_data       = $this->mk_semester->checkDataMKSemesterUpdate($id_mk_semester, $kode_mk, $id_ta, $kode_dosen);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Semester ' . $kode_mk . ' Sudah Ada');
        return redirect()->back()->withInput();
      } else {
        $this->mk_semester->updateDataMKSemester($id_mk_semester, $kode_mk, $id_ta, $kode_dosen);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Diperbarui');
        return redirect()->back();
      }
    }
  }

  public function deleteMK()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id_mk_semester = $this->request->getPost('id');
      $this->mk_semester->deleteDataMKSemester($id_mk_semester);
    }
  }

  public function Asprak()
  {
    $data = $this->data;
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/praktikum/v_asprak', $data);
  }
}
