<?php

namespace App\Controllers;

use App\Models\M_Dosen;
use App\Models\M_Laboran;
use App\Models\M_Matakuliah;
use App\Models\M_Prodi;
use CodeIgniter\Files\File;

class DataMaster extends BaseController
{

  var $data;
  protected $dosen;
  protected $laboran;
  protected $matakuliah;
  protected $prodi;

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') == '1' || session()->get('id_role') == '2' || session()->get('id_role') == '6') {
        $this->dosen      = new M_Dosen();
        $this->laboran    = new M_Laboran();
        $this->matakuliah = new M_Matakuliah();
        $this->prodi      = new M_Prodi();
        $nip              = session()->get('nip_laboran');
        $data_laboran     = $this->laboran->getDataLaboran($nip);
        $this->data       = array(
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
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $id_prodi = $this->request->getPost('id');
      $this->prodi->deleteProdi($id_prodi);
    }
  }

  public function Dosen()
  {
    $data = $this->data;
    $data['dosen']  = $this->dosen->getDataDosen();
    return view('laboran/data_master/v_dosen', $data);
  }

  public function simpanDosen()
  {
    if (!$this->validate([
      'kode_dosen'  => ['rules' => 'required'],
      'nama_dosen'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_dosen = strtoupper($this->request->getPost('kode_dosen'));
      $nama_dosen = $this->request->getPost('nama_dosen');
      $split_gelar  = explode(",", $nama_dosen);
      $gelar = '';
      for ($i = 1; $i < count($split_gelar); $i++) {
        $gelar .= ',' . $split_gelar[$i];
      }
      $split_nama = explode(" ", $split_gelar[0]);
      for ($i = 0; $i < count($split_nama); $i++) {
        $split_nama[$i] = ucwords(strtolower($split_nama[$i]));
      }
      $nama_dosen = '';
      for ($i = 0; $i < count($split_nama); $i++) {
        if ($i != (count($split_nama) - 1)) {
          $nama_dosen .= $split_nama[$i] . ' ';
        } else {
          $nama_dosen .= $split_nama[$i];
        }
      }
      $nama_dosen = $nama_dosen . '' . $gelar;
      $input      = [
        'kode_dosen'  => $kode_dosen,
        'nama_dosen'  => $nama_dosen
      ];
      $cek_data_dosen = $this->dosen->getDataDosenByKodeDosen($kode_dosen);
      if ($cek_data_dosen) {
        session()->setFlashdata('error', 'Kode Dosen/Data Dosen Sudah Ada');
        return redirect()->back()->withInput();
      } else {
        $this->dosen->insert($input);
        session()->setFlashdata('sukses', 'Data Dosen Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateDosen()
  {
    if (!$this->validate([
      'kode_dosen'  => ['rules' => 'required'],
      'nama_dosen'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_dosen_old   = $this->request->getPost('kode_dosen_old');
      $kode_dosen       = strtoupper($this->request->getPost('kode_dosen'));
      $nama_dosen       = $this->request->getPost('nama_dosen');
      $split_gelar      = explode(",", $nama_dosen);
      $hash_kode_dosen  = substr(sha1($kode_dosen), 7, 7);
      $gelar = '';
      for ($i = 1; $i < count($split_gelar); $i++) {
        $gelar .= ',' . $split_gelar[$i];
      }
      $split_nama = explode(" ", $split_gelar[0]);
      for ($i = 0; $i < count($split_nama); $i++) {
        $split_nama[$i] = ucwords(strtolower($split_nama[$i]));
      }
      $nama_dosen = '';
      for ($i = 0; $i < count($split_nama); $i++) {
        if ($i != (count($split_nama) - 1)) {
          $nama_dosen .= $split_nama[$i] . ' ';
        } else {
          $nama_dosen .= $split_nama[$i];
        }
      }
      $nama_dosen = $nama_dosen . '' . $gelar;
      if ($kode_dosen_old == $hash_kode_dosen) {
        $this->dosen->updateDataDosen($kode_dosen_old, $kode_dosen, $nama_dosen);
        session()->setFlashdata('sukses', 'Data Dosen Sukses Diperbarui');
        return redirect()->back();
      } else {
        $cek_data_dosen = $this->dosen->getDataDosenByKodeDosen($kode_dosen);
        if ($cek_data_dosen) {
          session()->setFlashdata('error', 'Kode Dosen/Data Dosen Sudah Ada');
          return redirect()->back()->withInput();
        } else {
          $this->dosen->updateDataDosen($kode_dosen_old, $kode_dosen, $nama_dosen);
          session()->setFlashdata('sukses', 'Data Dosen Sukses Diperbarui');
          return redirect()->back();
        }
      }
    }
  }

  public function deleteDosen()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $kode_dosen = $this->request->getPost('id');
      $this->dosen->deleteDosen($kode_dosen);
    }
  }

  public function csvDosen()
  {
    return view('laboran/data_master/v_csv_dosen');
  }

  public function simpanCSVDosen()
  {
    $file = $_FILES['file_csv']['tmp_name'];
    $ekstensi_file  = explode('.', $_FILES['file_csv']['name']);
    if (strtolower(end($ekstensi_file)) === 'csv' && $_FILES['file_csv']['size'] > 0) {
      $handle = fopen($file, 'r');
      $i = 0;
      while ($row = fgetcsv($handle, 2048, ';')) {
        $i++;
        if ($i == 1) {
          continue;
        }
        $nama_dosen = $row[1];
        $split_gelar  = explode(",", $nama_dosen);
        $gelar = '';
        for ($i = 1; $i < count($split_gelar); $i++) {
          $gelar .= ',' . $split_gelar[$i];
        }
        $split_nama = explode(" ", $split_gelar[0]);
        for ($i = 0; $i < count($split_nama); $i++) {
          $split_nama[$i] = ucwords(strtolower($split_nama[$i]));
        }
        $nama_dosen = '';
        for ($i = 0; $i < count($split_nama); $i++) {
          if ($i != (count($split_nama) - 1)) {
            $nama_dosen .= $split_nama[$i] . ' ';
          } else {
            $nama_dosen .= $split_nama[$i];
          }
        }
        $kode_dosen = $row[0];
        $input  = [
          'kode_dosen'  => $kode_dosen,
          'nama_dosen'  => $nama_dosen . '' . $gelar
        ];
        $this->dosen->insert($input);
      }
    }
    return redirect();
  }

  public function MataKuliah()
  {
    $data = $this->data;
    $data['matkul'] = $this->matakuliah->getDataMKAll();
    $data['prodi']  = $this->prodi->getDataProdi();
    return view('laboran/data_master/v_matakuliah', $data);
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
      $nama_mk  = $this->request->getPost('nama_mk');
      $id_prodi = $this->request->getPost('id_prodi');
      $input    = [
        'kode_mk'   => $kode_mk,
        'nama_mk'   => $nama_mk,
        'id_prodi'  => $id_prodi
      ];
      $cek_data_mk = $this->matakuliah->getDataMK($kode_mk);
      if ($cek_data_mk) {
        session()->setFlashdata('error', 'Data Mata Kuliah sudah ada');
        return redirect()->back()->withInput();
      } else {
        $this->matakuliah->insert($input);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateMK()
  {
    if (!$this->validate([
      'kode_mk'   => ['rules' => 'required'],
      'nama_mk'   => ['rules' => 'required'],
      'id_prodi'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $kode_mk_old  = $this->request->getPost('kode_mk_old');
      $kode_mk      = $this->request->getPost('kode_mk');
      $nama_mk      = $this->request->getPost('nama_mk');
      $id_prodi     = $this->request->getPost('id_prodi');
      $hash_kode_mk = substr(sha1($kode_mk), 7, 7);
      if ($kode_mk_old == $hash_kode_mk) {
        $this->matakuliah->updateDataMK($kode_mk_old, $kode_mk, $nama_mk, $id_prodi);
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Diperbarui');
        return redirect()->back();
      } else {
        $cek_data_mk  = $this->matakuliah->getDataMK($kode_mk);
        if ($cek_data_mk) {
          session()->setFlashdata('error', 'Kode Mata Kuliah sudah ada');
          return redirect()->back()->withInput();
        } else {
          $this->matakuliah->updateDataMK($kode_mk_old, $kode_mk, $nama_mk, $id_prodi);
          session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Diperbarui');
          return redirect()->back();
        }
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
      $kode_mk = $this->request->getPost('id');
      $this->matakuliah->deleteDataMK($kode_mk);
    }
  }

  public function csvMK()
  {
    return view('laboran/data_master/v_csv_mk');
  }

  public function simpanCSVMK()
  {
    $file = $_FILES['file_csv']['tmp_name'];
    $ekstensi_file  = explode('.', $_FILES['file_csv']['name']);
    if (strtolower(end($ekstensi_file)) === 'csv' && $_FILES['file_csv']['size'] > 0) {
      $handle = fopen($file, 'r');
      $i = 0;
      while ($row = fgetcsv($handle, 2048, ';')) {
        $i++;
        if ($i == 1) {
          continue;
        }
        $kode_prodi = $row[0];
        $kode_mk    = $row[1];
        $nama_mk    = $row[2];
        $id_prodi   = $this->prodi->getDataProdiByKodeProdi($kode_prodi)['id_prodi'];
        $input      = [
          'kode_mk'   => $kode_mk,
          'nama_mk'   => $nama_mk,
          'id_prodi'  => $id_prodi
        ];
        $cek_data_mk = $this->matakuliah->getDataMK($kode_mk);
        if (!$cek_data_mk) {
          $this->matakuliah->insert($input);
        }
      }
    }
    return redirect();
  }

  public function Laboran()
  {
    $data             = $this->data;
    $data['laboran']  = $this->laboran->getAllLaboran();
    return view('laboran/data_master/v_laboran', $data);
  }

  public function simpanLaboran()
  {
    if (!$this->validate([
      'nip_laboran'   => ['rules' => 'required'],
      'nama_laboran'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $nip_laboran    = $this->request->getPost('nip_laboran');
      $nama_laboran   = $this->request->getPost('nama_laboran');
      $foto_laboran   = $this->request->getFile('foto_laboran');
      $kontak_laboran = $this->request->getPost('kontak_laboran');
      $email_laboran  = $this->request->getPost('email_laboran');
      $posisi_laboran = $this->request->getPost('posisi_laboran');
      $tmp_kontak     = str_replace('-', '', $kontak_laboran);
      $tmp_kontak     = str_replace('(', '', $tmp_kontak);
      $kontak_laboran = str_replace(') ', '', $tmp_kontak);
      $input          = [
        'nip_laboran'     => $nip_laboran,
        'nama_laboran'    => $nama_laboran,
        'kontak_laboran'  => $kontak_laboran,
        'email_laboran'   => $email_laboran,
        'posisi_laboran'  => $posisi_laboran,
        'status'          => '1'
      ];
      if ($foto_laboran->getSize() > 0) {
        $nama_file      = $foto_laboran->getGenerateName($foto_laboran->getName());
        $input['foto_laboran']  = 'assets/images/laboran/' . $nama_file;
      }
      $cek_data       = $this->laboran->getDataLaboranByNIP($nip_laboran);
      if ($cek_data) {
        session()->setFlashdata('error', 'NIP Laboran sudah ada');
        return redirect()->back()->withInput();
      } else {
        $this->laboran->insert($input);
        if ($foto_laboran->getSize() > 0) {
          $foto_laboran->move('assets/images/laboran', $nama_file);
        }
        session()->setFlashdata('sukses', 'Data Mata Kuliah Sukses Ditambahkan');
        return redirect()->back();
      }
    }
  }

  public function updateLaboran()
  {
    if (!$this->validate([
      'nip_laboran'   => ['rules' => 'required'],
      'nama_laboran'  => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', 'Harap lengkapi seluruh field');
      return redirect()->back()->withInput();
    } else {
      $nip_old        = $this->request->getPost('nip_laboran_old');
      $nip_laboran    = $this->request->getPost('nip_laboran');
      $nama_laboran   = $this->request->getPost('nama_laboran');
      $foto_laboran   = $this->request->getFile('foto_laboran');
      $kontak_laboran = $this->request->getPost('kontak_laboran');
      $email_laboran  = $this->request->getPost('email_laboran');
      $posisi_laboran = $this->request->getPost('posisi_laboran');
      $tmp_kontak     = str_replace('-', '', $kontak_laboran);
      $tmp_kontak     = str_replace('(', '', $tmp_kontak);
      $kontak_laboran = str_replace(') ', '', $tmp_kontak);
      $hash_nip       = substr(sha1($nip_laboran), 7, 7);
      $cek_data       = $this->laboran->getDataLaboranByNIPHash($hash_nip);
      if ($foto_laboran->getSize() > 0) {
        $nama_file      = $foto_laboran->getGenerateName($foto_laboran->getName());
        $foto           = 'assets/images/laboran/' . $nama_file;
        $foto_laboran->move('assets/images/laboran', $nama_file);
      } else {
        $foto           = '';
      }
      if ($nip_old == $hash_nip) {
        if ($cek_data['foto_laboran']) {
          unlink($cek_data['foto_laboran']);
        }
        $this->laboran->updateDataLaboran($nip_old, $nip_laboran, $nama_laboran, $foto, $kontak_laboran, $email_laboran, $posisi_laboran);
        session()->setFlashdata('sukses', 'Data Laboran Sukses Diperbarui');
        return redirect()->back();
      } else {
        if ($cek_data) {
          session()->setFlashdata('error', 'NIP sudah ada');
          return redirect()->back()->withInput();
        } else {
          $hash_nip       = $nip_old;
          $cek_data       = $this->laboran->getDataLaboranByNIPHash($hash_nip);
          if ($cek_data['foto_laboran'] != NULL) {
            unlink($cek_data['foto_laboran']);
          }
          $this->laboran->updateDataLaboran($nip_old, $nip_laboran, $nama_laboran, $foto, $kontak_laboran, $email_laboran, $posisi_laboran);
          session()->setFlashdata('sukses', 'Data Laboran Sukses Diperbarui');
          return redirect()->back();
        }
      }
    }
  }

  public function deleteLaboran()
  {
    if (!$this->validate([
      'id' => ['rules' => 'required']
    ])) {
      return redirect()->to('Beranda');
    } else {
      $nip_laboran  = $this->request->getPost('id');
      $data         = $this->laboran->getDataLaboranByNIPHash($nip_laboran);
      // unlink($data['foto_laboran']);
      $this->laboran->deleteLaboran($nip_laboran);
    }
  }
}
