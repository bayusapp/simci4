<?php

namespace App\Controllers;

use App\Models\M_Laboratorium;
use App\Models\M_Trouble_Ticket;
use App\Models\M_Trouble_Ticket_Tracking;

class Ticketing extends BaseController
{

  protected $laboratorium;
  protected $trouble_ticket;
  protected $trouble_ticket_tracking;

  public function __construct()
  {
    $this->laboratorium = new M_Laboratorium();
    $this->trouble_ticket = new M_Trouble_Ticket();
    $this->trouble_ticket_tracking = new M_Trouble_Ticket_Tracking();
  }

  public function index()
  {
    $data['title'] = 'Trouble Ticket Laboratorium | SIM Laboratorium';
    $data['laboratorium'] = $this->laboratorium->getAllLaboratorium();
    return view('ticketing/v_index', $data);
  }

  public function submit()
  {
    if (!$this->validate([
      'kategori_informan' => ['rules' => 'required'],
      'nama_informan'     => ['rules' => 'required'],
      'no_informan'       => ['rules' => 'required'],
      'laboratorium'      => ['rules' => 'required'],
      'keluhan'           => ['rules' => 'required']
    ])) {
      session()->setFlashdata('error', $this->validator->listErrors());
      return redirect()->back()->withInput();
    } else {
      $lat_lng    = $this->request->getPost('lokasi');
      $lat_lng    = preg_replace('/[^0-9-.,]/', '', $lat_lng);
      $maps       = getAddress($lat_lng);
      $get_ip     = check_ip();
      if ($maps == 'off') {
        $alamat   = $get_ip['city'] . ', ' . $get_ip['region'];
      } else {
        $maps     = getAddress($lat_lng)->address_components;
        $alamat   = $maps[1]->short_name . ', ' . $maps[2]->short_name . ', ' . $maps[3]->short_name . ', ' . $maps[4]->short_name . ', ' . $maps[5]->short_name;
      }
      $agent      = $this->request->getUserAgent();
      if ($agent->isBrowser()) {
        $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
      } elseif ($agent->isRobot()) {
        $currentAgent = $agent->getRobot();
      } elseif ($agent->isMobile()) {
        $currentAgent = $agent->getMobile();
      } else {
        $currentAgent = 'Unidentified User Agent';
      }

      $tanggal_kendala    = date('Y-m-d H:i:s');
      $kategori_informan  = $this->request->getPost('kategori_informan');
      $nama_informan      = $this->request->getPost('nama_informan');
      $no_informan        = $this->request->getPost('no_informan');
      $keluhan            = nl2br(htmlspecialchars_decode($this->request->getPost('keluhan')), ENT_HTML5);
      $status             = "0";
      $ip_address         = $get_ip['ip'];
      $browser            = $currentAgent;
      $platform           = $agent->getPlatform();
      $alamat_geolocation = $alamat;
      $isp                = check_isp();
      $lat_long           = $lat_lng;
      $id_lab             = $this->request->getPost('laboratorium');
      $tmp_no_informan    = substr($no_informan, 1);
      $no_informan        = '62' . $tmp_no_informan;
      print_r($no_informan);
      $data               = [
        'tanggal_kendala'     => $tanggal_kendala,
        'kategori_informan'   => $kategori_informan,
        'nama_informan'       => $nama_informan,
        'no_informan'         => $no_informan,
        'keluhan'             => $keluhan,
        'status'              => $status,
        'ip_address'          => $ip_address,
        'browser'             => $browser,
        'platform'            => $platform,
        'alamat_geolocation'  => $alamat_geolocation,
        'isp'                 => $isp,
        'lat_long'            => $lat_long,
        'id_lab'              => $id_lab
      ];
      $this->trouble_ticket->insert($data);
      session()->setFlashdata('success', 'success');
      return redirect()->back();
    }
  }

  public function tracking($id)
  {
    $data['trouble_ticket'] = $this->trouble_ticket->getTroubleTicketDetail($id);
    // dd($data);
    $data['tracking'] = $this->trouble_ticket_tracking->getTroubleTicketTracking($data['trouble_ticket']['id_trouble']);
    // dd($data['tracking']);
    return view('ticketing/v_tracking', $data);
  }
}
