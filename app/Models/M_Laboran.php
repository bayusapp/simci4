<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Laboran extends Model
{

  protected $table = 'laboran';

  public function getListLaboran()
  {
    return $this->findAll();
  }

  public function getDataLaboran($nip)
  {
    $this->where('nip_laboran', $nip);
    return $this->first();
  }

  public function getListLaboranToProfile($nip)
  {
    $nip_ = [$nip];
    $this->whereNotIn('nip_laboran', $nip_);
    $this->orderBy('nip_laboran', 'asc');
    return $this->findAll();
  }
}
