<?php

namespace App\Controllers;

use App\Models\M_Asprak_List;
use App\Models\M_Dokumen;
use App\Models\M_Dokumen_Kategori;
use App\Models\M_Dokumen_Surat_Tugas_Asprak;
use App\Models\M_Dokumen_Surat_Tugas_Asprak_List;
use App\Models\M_Laboran;
use App\Models\M_Matakuliah_Semester;

class Dokumen extends BaseController
{

  var $data;
  protected $asprak_list;
  protected $dokumen;
  protected $dokumen_kategori;
  protected $dokumen_surat_tugas_asprak;
  protected $dokumen_surat_tugas_asprak_list;
  protected $laboran;
  protected $matakuliah_semester;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2') {
        $this->asprak_list                      = new M_Asprak_List();
        $this->dokumen                          = new M_Dokumen();
        $this->dokumen_kategori                 = new M_Dokumen_Kategori();
        $this->dokumen_surat_tugas_asprak       = new M_Dokumen_Surat_Tugas_Asprak();
        $this->dokumen_surat_tugas_asprak_list  = new M_Dokumen_Surat_Tugas_Asprak_List();
        $this->laboran                    = new M_Laboran();
        $this->matakuliah_semester        = new M_Matakuliah_Semester();
        $nip                              = session()->get('nip_laboran');
        $data_laboran                     = $this->laboran->getDataLaboran($nip);
        $this->data                       = array(
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
    $data                         = $this->data;
    $data['surat_tugas']          = $this->dokumen_surat_tugas_asprak->getAllSuratTugas();
    $data['matakuliah_semester']  = $this->matakuliah_semester->getDataMKSemesterAktif();
    return view('laboran/dokumen/v_surat_tugas_asprak', $data);
  }

  public function simpanSuratTugasAsprak()
  {
    if (!$this->validate([
      'mk'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $mk               = $this->request->getPost('mk');
      $tanggal_dibuat   = date('Y-m-d');
      $pembuat_dokumen  = session()->get('nip_laboran');
      $input  = [
        'tanggal_dibuat'  => $tanggal_dibuat,
        'pembuat_dokumen' => $pembuat_dokumen,
        'id_mk_semester'  => $mk
      ];
      $this->dokumen_surat_tugas_asprak->insert($input);
      $id_dsta  = $this->dokumen_surat_tugas_asprak->getIDSuratTugas($tanggal_dibuat, $pembuat_dokumen, $mk)['id_dsta'];
      // $id_dsta = 1;
      if ($id_dsta) {
        $asprak = $this->asprak_list->getAsprakByIdMkSemester($mk);
        foreach ($asprak as $a) {
          $asprak = [
            'nim_asprak'  => $a['nim_asprak'],
            'id_dsta'     => $id_dsta
          ];
          $this->dokumen_surat_tugas_asprak_list->insert($asprak);
        }
      }
      session()->setFlashdata('sukses', 'Surat Tugas Asprak Sukses Dibuat');
      return redirect()->back();
    }
  }

  public function lihatSuratTugas($id)
  {
    $data['surat'] = $this->dokumen_surat_tugas_asprak->getDataSuratTugasHash($id);
    if ($data['surat']) {
      return view('laboran/dokumen/v_surat_tugas', $data);
    } else {
      session()->setFlashdata('error', 'ID Surat Tugas Asprak Tidak Ditemukan');
      return redirect()->to(base_url('Dokumen/SuratTugasAsprak'));
    }
  }
}
