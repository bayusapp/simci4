<?php

namespace App\Controllers;

use App\Models\M_Aslab;
use CodeIgniter\RESTful\ResourceController;

class Aslab_API extends ResourceController
{

  protected $aslab;
  protected $json;

  public function __construct()
  {
    $this->aslab = new M_Aslab();
  }

  public function show($id = null)
  {
    $data = $this->aslab->getDataAslab($id);
    if ($data) {
      return $this->respond($data);
    } else {
      return $this->failNotFound('Data tidak ditemukan');
    }
  }
}
