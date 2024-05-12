<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticker extends Model
{
  protected $table = 'trouble_ticket';
  protected $allowedFields = ['tanggal_kendala', 'kategori_informan', 'nama_informan', 'no_informan', 'keluhan', 'status', 'ip_address', 'browser', 'platform', 'alamat_geolocation', 'isp', 'lat_long', 'id_lab'];
}
