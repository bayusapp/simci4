<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Asprak extends Model
{

  protected $table = 'asprak';
  protected $primaryKey = 'nim_asprak';
  protected $allowedFields = ['nim_asprak', 'nama_asprak', 'kontak_asprak', 'email_asprak', 'norek_asprak', 'bank', 'nama_akun', 'verif_laboran', 'file_kk', 'file_foto'];

  public function checkDataAsprak($nim)
  {
    $this->where('nim_asprak', $nim);
    return $this->first();
  }
}
