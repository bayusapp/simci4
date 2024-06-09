<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Role extends Model
{

  protected $table = 'users_role';
  protected $allowedFields = ['id_role', 'nama_role'];

  public function getRole($id_role)
  {
    $this->where('id_role', $id_role);
    return $this->first();
  }
}
