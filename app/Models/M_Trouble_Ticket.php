<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Trouble_Ticket extends Model
{
  protected $table = 'trouble_ticket';
  protected $allowedFields = ['tanggal_tt', 'kategori_informan', 'nama_informan', 'kontak_informan', 'kendala', 'status_tt', 'ip_address', 'browser', 'platform', 'alamat_geolocation', 'isp', 'lat_long', 'id_lab'];

  public function getAllTroubleTicket()
  {
    $this->join('laboratorium', 'trouble_ticket.id_lab = laboratorium.id_lab');
    $this->join('trouble_ticket_kategori_orang', 'trouble_ticket.kategori_informan = trouble_ticket_kategori_orang.id_tt_orang');
    $this->orderBy('status_tt', 'ASC');
    $this->orderBy('id_trouble_ticket', 'DESC');
    return $this->findAll();
  }

  public function getTroubleTicketDetail($id)
  {
    $this->join('laboratorium', 'trouble_ticket.id_lab = laboratorium.id_lab');
    $this->join('trouble_ticket_kategori_orang', 'trouble_ticket.kategori_informan = trouble_ticket_kategori_orang.id_tt_orang');
    $this->where('substr(sha1(id_trouble_ticket), 13, 7)', $id);
    return $this->first();
  }

  public function getIdTroubleTicket($tanggal_tt, $kategori_informan, $nama_informan, $kontak_informan)
  {
    $this->where('tanggal_tt', $tanggal_tt);
    $this->where('kategori_informan', $kategori_informan);
    $this->where('nama_informan', $nama_informan);
    $this->where('kontak_informan', $kontak_informan);
    $this->orderBy('id_trouble_ticket', 'DESC');
    return $this->first();
  }

  public function updateStatusTT($status, $id)
  {
    $this->set('status_tt', $status);
    $this->where('substr(sha1(id_trouble_ticket), 13, 7)', $id);
    $this->update();
  }
}
