<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Matakuliah;
use App\Models\M_Prodi;

class Praktikum extends BaseController
{

  var $data;
  protected $laboran;
  protected $mk;
  protected $prodi;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->laboran      = new M_Laboran();
        $this->prodi        = new M_Prodi();
        $this->mk           = new M_Matakuliah();
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
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/praktikum/v_matakuliah', $data);
  }

  public function simpanMK()
  {
    if (!$this->validate([
      'kode_mk'   => ['rules' => 'required'],
      'nama_mk'   => ['rules' => 'required'],
      'id_prodi'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_mk  = $this->request->getPost('kode_mk');
      $nama_mk  = ucwords(strtolower($this->request->getPost('nama_mk')));
      $id_prodi = $this->request->getPost('id_prodi');
      $cek_data = $this->mk->getDataMK($kode_mk);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Sudah Pernah Ditambahkan');
        return redirect()->back()->withInput();
      } else {
        $data     = [
          'kode_mk'   => $kode_mk,
          'nama_mk'   => $nama_mk,
          'id_prodi'  => $id_prodi
        ];
        $this->mk->insert($data);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateMK()
  {
    if (!$this->validate([
      'kode_mk_lama'  => ['rules' => 'required'],
      'kode_mk'       => ['rules' => 'required'],
      'nama_mk'       => ['rules' => 'required'],
      'id_prodi'      => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_mk_lama = $this->request->getPost('kode_mk_lama');
      $kode_mk      = $this->request->getPost('kode_mk');
      $nama_mk      = ucwords(strtolower($this->request->getPost('nama_mk')));
      $id_prodi     = $this->request->getPost('id_prodi');
      $cek_data     = $this->mk->getDataMK($kode_mk);
      if ($cek_data) {
        session()->setFlashdata('error', 'Data Mata Kuliah Sudah Pernah Ditambahkan');
        return redirect()->back()->withInput();
      } else {
        $data     = [
          'kode_mk'   => $kode_mk,
          'nama_mk'   => $nama_mk,
          'id_prodi'  => $id_prodi
        ];
        $this->mk->updateDataMK($kode_mk_lama, $data);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Diperbarui');
        return redirect()->back();
      }
    }
  }

  public function deleteMK($kode_mk)
  {
    $this->mk->deleteDataMK($kode_mk);
    session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Dihapus');
    return redirect()->back();
  }

  public function Asprak()
  {
    $data = $this->data;
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/praktikum/v_asprak', $data);
  }
}
