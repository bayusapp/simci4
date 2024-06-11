<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Access_Menu extends Model
{

  protected $table = 'users_access_menu';
  protected $allowedFields = ['id_role', 'id_menu', 'urutan_menu'];

  public function getAccessMenu($id_role)
  {
    $this->join('users_menu', 'users_access_menu.id_menu = users_menu.id_menu');
    $this->where('id_role', $id_role);
    $this->where('is_active', '1');
    $this->orderBy('urutan_menu', 'asc');
    return $this->findAll();
  }

  public function getAccessMenuByLink($id_role, $link)
  {
    $this->join('users_menu', 'users_access_menu.id_menu = users_menu.id_menu');
    $this->where('id_role', $id_role);
    $this->where('url_menu', $link);
    return $this->first();
  }
}
