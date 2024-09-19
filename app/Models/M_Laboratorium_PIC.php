<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboratorium_PIC extends Model
{

  protected $table = 'laboratorium_pic';
  protected $primaryKey = 'id_lab_pic';
  protected $allowedFields = ['id_lab', 'nip_laboran', 'nim_aslab', 'id_ta'];

  public function getDataPIC($id_lab)
  {
    $this->select('laboratorium.nama_lab, laboratorium.kode_lab, laboran.nama_laboran, laboran.kontak_laboran, aslab.nama_aslab, aslab.kontak_aslab');
    $this->join('laboratorium', 'laboratorium_pic.id_lab = laboratorium.id_lab');
    $this->join('laboran', 'laboratorium_pic.nip_laboran = laboran.nip_laboran');
    $this->join('aslab', 'laboratorium_pic.nim_aslab = aslab.nim_aslab');
    $this->join('tahun_ajaran', 'laboratorium_pic.id_ta = tahun_ajaran.id_ta');
    $this->where('laboratorium.id_lab', $id_lab);
    $this->where('tahun_ajaran.is_active', '1');
    return $this->first();
  }
}
