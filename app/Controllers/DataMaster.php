<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Prodi;

class DataMaster extends BaseController
{

  var $data;
  protected $laboran;
  protected $prodi;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1') {
        $this->laboran  = new M_Laboran();
        $this->prodi    = new M_Prodi();
        $nip            = session()->get('nip_laboran');
        $data_laboran   = $this->laboran->getDataLaboran($nip);
        $this->data     = array(
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

  public function ProgramStudi()
  {
    $data = $this->data;
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/data_master/v_program_studi', $data);
  }

  public function simpanProdi()
  {
    if (!$this->validate([
      'nama_prodi'    => ['rules' => 'required'],
      'jenjang_prodi' => ['rules' => 'required'],
      'kode_prodi'    => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $nama_prodi     = $this->request->getPost('nama_prodi');
      $jenjang_prodi  = $this->request->getPost('jenjang_prodi');
      $kode_prodi     = $this->request->getPost('kode_prodi');
      $input          = [
        'nama_prodi'    => $nama_prodi,
        'jenjang_prodi' => $jenjang_prodi,
        'kode_prodi'    => $kode_prodi
      ];
      $this->prodi->insert($input);
      session()->setFlashdata('sukses', 'Data Program Studi Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function updateProdi()
  {
    if (!$this->validate([
      'nama_prodi'    => ['rules' => 'required'],
      'jenjang_prodi' => ['rules' => 'required'],
      'kode_prodi'    => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $id_prodi       = $this->request->getPost('id_prodi');
      $nama_prodi     = $this->request->getPost('nama_prodi');
      $jenjang_prodi  = $this->request->getPost('jenjang_prodi');
      $kode_prodi     = $this->request->getPost('kode_prodi');
      $input          = [
        'nama_prodi'    => $nama_prodi,
        'jenjang_prodi' => $jenjang_prodi,
        'kode_prodi'    => $kode_prodi
      ];
      $tmp = $this->prodi->updateProdi($id_prodi, $nama_prodi, $jenjang_prodi, $kode_prodi);
      session()->setFlashdata('sukses', 'Data Program Studi Sukses Diperbarui');
      return redirect()->back();
    }
  }

  public function deleteProdi()
  {
    $id_prodi = $this->request->getPost('id');
    $this->prodi->deleteProdi($id_prodi);
  }
}
