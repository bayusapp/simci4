<?php

namespace App\Libraries;

use Mpdf\Mpdf;

class MpdfLibrary
{
  protected $mpdf;

  public function __construct()
  {
    $this->mpdf = new Mpdf();
  }

  public function load($options = [])
  {
    $this->mpdf = new Mpdf($options);
    return $this;
  }

  public function writeHTML($html)
  {
    $this->mpdf->WriteHTML($html);
    return $this;
  }

  public function output($filename = '', $dest = 'I')
  {
    return $this->mpdf->Output($filename, $dest);
  }
}
