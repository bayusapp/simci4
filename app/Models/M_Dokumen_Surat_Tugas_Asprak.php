<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen_Surat_Tugas_Asprak extends Model
{

  protected $table = 'dokumen_surat_tugas_asprak';
  protected $primaryKey = 'id_dsta';
  protected $allowedFields  = ['tanggal_generate', 'pembuat_dokumen', 'id_mk_semester'];

  public function getDataSuratTugas($id_dsta)
  {
    $this->where('id_dsta', $id_dsta);
    return $this->first();
  }
}
