<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticket_Tracking extends Model
{

  protected $table = 'trouble_ticket_tracking';

  public function getTroubleTicketTracking($id)
  {
    $this->where('id_trouble', $id);
    return $this->findAll();
  }
}
