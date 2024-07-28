<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak extends Model
{

  protected $table = 'asprak';
  protected $primaryKey = 'nim_asprak';
  protected $allowedFields = ['nim_asprak', 'nama_asprak', 'kontak_asprak', 'email_asprak', 'norek_asprak', 'bank', 'nama_akun', 'status_verif', 'verif_laboran', 'file_kk', 'file_foto', 'ttd_digital', 'id_prodi'];

  public function checkDataAsprak($nim)
  {
    $this->where('nim_asprak', $nim);
    return $this->first();
  }

  public function getDataAsprak($nim)
  {
    $this->join('bank', 'asprak.bank = bank.kode_bank', 'left');
    $this->join('prodi', 'asprak.id_prodi = prodi.id_prodi', 'left');
    $this->join('laboran', 'asprak.verif_laboran = laboran.nip_laboran', 'left');
    $this->where('nim_asprak', $nim);
    return $this->first();
  }

  public function validateBank($nim)
  {
    $db = db_connect();
    $query = "UPDATE asprak SET verif_laboran = '1' WHERE nim_asprak = '{$nim}'";
    return $db->query($query);
  }

  public function updateDataAsprak($nim, $nama_asprak, $kontak_asprak, $email_asprak, $norek_asprak, $bank, $nama_akun, $status_verif, $verif_laboran, $file_kk, $file_foto, $ttd_digital, $id_prodi)
  {
    $this->set('nama_asprak', $nama_asprak);
    $this->set('kontak_asprak', $kontak_asprak);
    $this->set('email_asprak', $email_asprak);
    $this->set('norek_asprak', $norek_asprak);
    $this->set('bank', $bank);
    $this->set('nama_akun', $nama_akun);
    $this->set('status_verif', $status_verif);
    $this->set('verif_laboran', $verif_laboran);
    $this->set('file_kk', $file_kk);
    $this->set('file_foto', $file_foto);
    $this->set('ttd_digital', $ttd_digital);
    $this->set('id_prodi', $id_prodi);
    $this->where('nim_asprak', $nim);
    $this->update();
  }
}
