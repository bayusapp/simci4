<?php

namespace App\Controllers;

use App\Models\M_Dokumen;
use App\Models\M_Dokumen_Kategori;
use App\Models\M_Laboran;

class Dokumen extends BaseController
{

  var $data;
  protected $dokumen;
  protected $dokumen_kategori;
  protected $laboran;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->dokumen          = new M_Dokumen();
        $this->dokumen_kategori = new M_Dokumen_Kategori();
        $this->laboran          = new M_Laboran();
        $nip                    = session()->get('nip_laboran');
        $data_laboran           = $this->laboran->getDataLaboran($nip);
        $this->data             = array(
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

  public function template()
  {
    $data = $this->data;
    $data['jenis']  = $this->dokumen_kategori->getList();
    return view('laboran/dokumen/v_template', $data);
  }

  public function simpanDokumen()
  {
    if (!$this->validate([
      'nama_dokumen'      => ['rules' => 'required'],
      'kategori_dokumen'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $nama_dokumen     = $this->request->getPost('nama_dokumen');
      $kategori_dokumen = $this->request->getPost('kategori_dokumen');
      $file_dokumen     = $this->request->getFile('file_dokumen');
      $input = [
        'nama_dokumen'        => $nama_dokumen,
        'id_dokumen_kategori' => $kategori_dokumen
      ];
      if ($file_dokumen->getSize() > 0) {
        $nama_file      = $file_dokumen->getGenerateName($file_dokumen->getName());
        $input['file_dokumen']  = 'assets/template/' . $nama_file;
        $file_dokumen->move('assets/template', $nama_file);
      }
      $this->dokumen->insert($input);
      session()->setFlashdata('sukses', 'Data Dokumen Sukses Ditambahkan');
      return redirect()->back();
    }
  }

  public function suratTugasAsprak()
  {
    return view('laboran/praktikum/v_surat_tugas_asprak');
  }
}
