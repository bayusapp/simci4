<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboran extends Model
{

  protected $table = 'laboran';
  protected $allowedFields = ['nip_laboran', 'nama_laboran', 'foto_laboran', 'kontak_laboran', 'email_laboran', 'posisi_laboran', 'level_laboran'];

  public function getListLaboran()
  {
    return $this->findAll();
  }

  public function getAllLaboran()
  {
    $this->where('posisi_laboran != "System Administrator"');
    $this->orderBy('nip_laboran', 'ASC');
    return $this->findAll();
  }

  public function getDataLaboranByNIP($nip)
  {
    $this->where('nip_laboran', $nip);
    return $this->first();
  }

  public function getDataLaboranByNIPHash($nip)
  {
    $this->where('SUBSTR(SHA1(nip_laboran), 8, 7)', $nip);
    return $this->first();
  }

  public function getDataLaboran($nip)
  {
    $this->join('users', 'laboran.nip_laboran = users.nip_laboran');
    $this->where('laboran.nip_laboran', $nip);
    return $this->first();
  }

  public function getListLaboranToProfile($nip)
  {
    $nip_ = [$nip];
    $this->whereNotIn('nip_laboran', $nip_);
    $this->orderBy('nip_laboran', 'asc');
    return $this->findAll();
  }

  public function updateDataLaboran($nip_old, $nip_laboran, $nama_laboran, $foto_laboran, $kontak_laboran, $email_laboran, $posisi_laboran)
  {
    $db = db_connect();
    $query = "UPDATE laboran SET nip_laboran = '{$nip_laboran}', nama_laboran = '{$nama_laboran}', foto_laboran = '{$foto_laboran}', kontak_laboran = '{$kontak_laboran}', email_laboran = '{$email_laboran}', posisi_laboran = '{$posisi_laboran}' WHERE SUBSTR(SHA1(nip_laboran), 8, 7) = '{$nip_old}'";
    return $db->query($query);
  }

  public function deleteLaboran($nip_laboran)
  {
    $this->where('SUBSTR(SHA1(nip_laboran), 8, 7)', $nip_laboran);
    return $this->delete();
  }
}
