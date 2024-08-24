<?php

namespace App\Controllers;

use App\Libraries\QRCode;

class TroubleTicket extends BaseController
{

  public function __construct()
  {
    //
  }

  public function index()
  {
    echo 'hai';
  }

  public function test()
  {
    $qrCode = new QRCode();
    $filePath = 'assets/files/'; // Path untuk menyimpan QR Code

    // Pastikan folder writable/uploads ada dan dapat ditulis
    if (!file_exists($filePath)) {
      mkdir($filePath);
    }

    // Menghasilkan QR Code
    $qrCode->generate('https://www.bayusapp.com', $filePath . "bayu.png");

    // Menampilkan QR Code di browser
    echo '<img src="' . base_url($filePath) . 'bayu.png">';
  }
}
