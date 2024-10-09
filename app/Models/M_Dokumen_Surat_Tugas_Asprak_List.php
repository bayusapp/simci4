<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Dokumen_Surat_Tugas_Asprak_List extends Model
{

  protected $table = 'dokumen_surat_tugas_asprak_list';
  protected $primaryKey = 'id_dsta_list';
  protected $allowedFields = ['nim_asprak', 'id_dsta'];

  public function getDataAsprak($id_dsta)
  {
    $this->join('asprak', 'dokumen_surat_tugas_asprak_list.nim_asprak = asprak.nim_asprak');
    $this->where('substr(sha1(id_dsta), 13, 7)', $id_dsta);
    $this->orderBy('asprak.nama_asprak', 'ASC');
    return $this->findAll();
  }
}
