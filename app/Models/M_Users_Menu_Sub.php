<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Menu_Sub extends Model
{

  protected $table = 'users_menu_sub';
  protected $allowedFields = ['nama_menu', 'url_menu', 'is_active', 'id_menu'];

  public function getDataSubMenu($id_menu)
  {
    $this->where('id_menu', $id_menu);
    return $this->findAll();
  }
}
