<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Menu_Sub_Sub extends Model
{
  protected $table = 'users_menu_sub_sub';
  protected $primaryKey = 'id_menu_sub_sub';
  protected $allowedFields = ['nama_menu', 'url_menu', 'urutan_menu', 'is_active', 'id_menu_sub', 'id_role'];

  public function getDataSubSubMenu($id_menu_sub, $id_role)
  {
    $this->where('id_menu_sub', $id_menu_sub);
    $this->where('id_role', $id_role);
    return $this->findAll();
  }
}
