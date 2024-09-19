<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Menu extends Model
{

  protected $table = 'users_menu';
  protected $primaryKey = 'id_menu';
  protected $allowedFields = ['nama_menu', 'url_menu', 'icon_menu', 'urutan_menu', 'is_active', 'id_role'];

  public function getMenuByRole($id_role)
  {
    $this->where('id_role', $id_role);
    $this->where('is_active', '1');
    $this->orderBy('urutan_menu', 'ASC');
    return $this->findAll();
  }

  public function getMenuByLink($url_link, $id_role)
  {
    $this->where('url_menu', $url_link);
    $this->where('id_role', $id_role);
    return $this->first();
  }
}
