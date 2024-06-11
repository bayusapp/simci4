<?php

namespace App\Controllers\Aslab;

use App\Controllers\BaseController;

class Beranda extends BaseController
{

  public function index()
  {
    return view('aslab/beranda/v_index');
  }
}
