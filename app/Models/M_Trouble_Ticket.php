<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticket extends Model
{
  protected $table = 'trouble_ticket';
  protected $allowedFields = ['tanggal_kendala', 'kategori_informan', 'nama_informan', 'no_informan', 'keluhan', 'status', 'ip_address', 'browser', 'platform', 'alamat_geolocation', 'isp', 'lat_long', 'id_lab'];

  public function getTroubleTicketDetail($id)
  {
    $this->join('laboratorium', 'trouble_ticket.id_lab = laboratorium.id_lab');
    $this->where('substring(sha1(id_trouble), 8, 7)', $id);
    return $this->first();
  }
}
