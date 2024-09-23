<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticket_Tracking extends Model
{

  protected $table = 'trouble_ticket_tracking';
  protected $primaryKey = 'id_track_tt';
  protected $allowedFields = ['tanggal_track', 'kategori_petugas', 'nama_petugas', 'solusi', 'id_trouble_ticket'];

  public function getTroubleTicketTracking($id)
  {
    $this->where('substr(sha1(id_trouble_ticket), 13, 7)', $id);
    return $this->findAll();
  }

  public function getDateTTClose($id)
  {
    $this->where('substr(sha1(id_trouble_ticket), 13, 7)', $id);
    $this->orderBy('id_track_tt', 'DESC');
    return $this->first();
  }
}
