<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticket_Kategori_Orang extends Model
{

  protected $table = 'trouble_ticket_kategori_orang';
  protected $primaryKey = 'id_tt_orang';
  protected $allowedFields = ['nama_kategori'];

  public function getListKategori()
  {
    return $this->findAll();
  }
}
