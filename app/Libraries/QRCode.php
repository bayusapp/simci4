<?php

namespace App\Libraries;

require_once APPPATH . 'Libraries/phpqrcode/qrlib.php';

class QRCode
{
  public function generate($text, $file = null, $ecc = 'H', $size = 20, $margin = 1)
  {
    // Menggunakan fungsi dari qrlib.php
    \QRcode::png($text, $file, $ecc, $size, $margin);
  }
}
