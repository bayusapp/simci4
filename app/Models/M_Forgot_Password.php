<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Forgot_Password extends Model
{

  protected $table = 'forgot_password';
  protected $primaryKey = 'id_forgot_password';
  protected $allowedFields = ['username', 'token', 'tanggal', 'status'];

  public function checkToken($token)
  {
    $this->where('token', $token);
    return $this->first();
  }

  public function updateStatus($token)
  {
    $this->set('status', '1');
    $this->where('token', $token);
    $this->update();
  }
}
