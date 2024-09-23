<?php

namespace App\Controllers;

use App\Models\M_Trouble_Ticket;

class Tracking extends BaseController
{

  var $data;
  protected $trouble_ticket;

  public function __construct()
  {
    $this->trouble_ticket = new M_Trouble_Ticket();
  }

  public function index()
  {
    $uri  = service('uri');
    $id   = $uri->getSegment(2);
    $data['trouble_ticket'] = $this->trouble_ticket->getTroubleTicketDetail($id);
    return view('tracking/v_index', $data);
  }
}
