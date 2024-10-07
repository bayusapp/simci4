<?php

namespace App\Controllers\Asprak;

use App\Controllers\BaseController;
use App\Models\M_Asprak;
use App\Models\M_Bank;
use App\Models\M_Prodi;
use App\Models\M_Users;

class DataPribadi extends BaseController
{

  var $data;
  protected $asprak;
  protected $bank;
  protected $prodi;
  protected $users;

  public function __construct()
  {
    if (session()->get('id_role') != '4') {
      header("Location: " . base_url());
      die();
    } else {
      $this->asprak = new M_Asprak();
      $this->bank   = new M_Bank();
      $this->prodi  = new M_Prodi();
      $this->users  = new M_Users();
      $username     = session()->get('username');
      $nim_asprak   = $this->users->getUsername($username)['nim_asprak'];
      $data_asprak  = $this->asprak->checkDataAsprak($nim_asprak);
      $this->data   = array(
        'nim_asprak'  => $nim_asprak,
        'nama_asprak' => $data_asprak['nama_asprak'],
        'foto_asprak' => $data_asprak['file_foto']
      );
    }
  }

  public function index()
  {
    $data               = $this->data;
    $data['bank']       = $this->bank->getDataBank();
    $data['informasi']  = $this->asprak->getDataAsprak($this->data['nim_asprak']);
    $data['prodi']      = $this->prodi->getDataProdi();
    return view('asprak/data_pribadi/v_index', $data);
  }

  public function simpanData()
  {
    if (!$this->validate([
      'nim_asprak'    => ['rules' => 'required'],
      'nama_asprak'   => ['rules' => 'required'],
      'kontak_asprak' => ['rules' => 'required'],
      'email_asprak'  => ['rules' => 'required'],
      'id_prodi'      => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', $this->validator->getErrors());
      return redirect()->back()->withInput();
    } else {
      $array_error    = array();
      $max_file_size  = 1 * 1024 * 1024;
      $nim_asprak     = $this->request->getPost('nim_asprak');
      $nama_asprak    = $this->request->getPost('nama_asprak');
      $kontak_asprak  = $this->request->getPost('kontak_asprak');
      $email_asprak   = $this->request->getPost('email_asprak');
      $id_prodi       = $this->request->getPost('id_prodi');
      $file_foto      = $this->request->getFile('file_foto');
      $ttd_digital    = $this->request->getFile('ttd_digital');
      $norek_asprak   = $this->request->getPost('norek_asprak');
      $bank           = $this->request->getPost('bank');
      $nama_akun      = $this->request->getPost('nama_akun');
      $file_kk        = $this->request->getFile('file_kk');
      $tmp_kontak     = str_replace('-', '', $kontak_asprak);
      $tmp_kontak     = str_replace('(', '', $tmp_kontak);
      $kontak_asprak  = str_replace(') ', '', $tmp_kontak);
      $cek_data  = $this->asprak->getDataAsprak($this->data['nim_asprak']);
      if ($file_foto->getSize() > 0) {
        if ($file_foto->getSize() <= $max_file_size) {
          $nama_foto = $file_foto->getGenerateName($nim_asprak . '.' . $file_foto->guessExtension());
          $file_foto->move('assets/images/asprak/foto', $nama_foto);
          $file_fotoo = 'assets/images/asprak/foto/' . $nama_foto;
        } else {
          $array_error[] = 'Ukuran file pas foto tidak boleh lebih dari 1MB';
        }
      } else {
        $file_fotoo = $cek_data['file_foto'];
      }
      if ($ttd_digital->getSize() > 0) {
        if ($ttd_digital->getSize() <= $max_file_size) {
          $nama_ttd     = $ttd_digital->getGenerateName($nim_asprak . '.' . $ttd_digital->guessExtension());
          $ttd_digital->move('assets/images/asprak/ttd', $nama_ttd);
          $ttd_digitall  = 'assets/images/asprak/ttd/' . $nama_ttd;
        } else {
          $array_error[] = 'Ukuran file tanda tangan digital tidak boleh lebih dari 1MB';
        }
      } else {
        $ttd_digitall = $cek_data['ttd_digital'];
      }
      if ($file_kk->getSize() > 0) {
        if ($file_kk->getSize() <= $max_file_size) {
          $nama_kk = $file_kk->getGenerateName($nim_asprak . '.' . $file_kk->guessExtension());
          $file_kk->move('assets/images/asprak/kk', $nama_kk);
          $file_kkk = 'assets/image/asprak/kk/' . $nama_kk;
        } else {
          $array_error[] = 'Ukuran file Kartu Keluarga tidak boleh lebih dari 1MB';
        }
      } else {
        $file_kkk = $cek_data['file_kk'];
      }
      if ($cek_data['norek_asprak'] != $norek_asprak || $cek_data['kode_bank'] != $bank || $cek_data['nama_akun'] != $nama_akun) {
        $norek_asprak  = $norek_asprak;
        $bank          = $bank;
        $nama_akun     = $nama_akun;
        $status_verif  = '0';
        $verif_laboran = null;
      } elseif ($cek_data['norek_asprak'] == $norek_asprak && $cek_data['kode_bank'] == $bank && $cek_data['nama_akun'] == $nama_akun) {
        $norek_asprak   = $cek_data['norek_asprak'];
        $bank           = $cek_data['kode_bank'];
        $nama_akun      = $cek_data['nama_akun'];
        $status_verif   = $cek_data['status_verif'];
        $verif_laboran  = $cek_data['verif_laboran'];
      }
      if (count($array_error) > 0) {
        session()->setFlashdata('error', $array_error);
        return redirect()->back();
      } else {
        $this->asprak->updateDataAsprak($nim_asprak, $nama_asprak, $kontak_asprak, $email_asprak, $norek_asprak, $bank, $nama_akun, $status_verif, $verif_laboran, $file_kkk, $file_fotoo, $ttd_digitall, $id_prodi);
        session()->setFlashdata('sukses', 'Data Pribadi Anda Sukses Diperbarui');
        return redirect()->back();
      }
    }
  }
}
