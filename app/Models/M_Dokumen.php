<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen extends Model
{

  protected $table = 'dokumen';
  protected $primaryKey = 'id_dokumen';
  protected $allowedFields = ['nama_dokumen', 'file_dokumen', 'id_dokumen_kategori'];
}
