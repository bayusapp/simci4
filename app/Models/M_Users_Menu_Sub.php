<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Menu_Sub extends Model
{

  protected $table = 'users_menu_sub';
  protected $allowedFields = ['nama_menu', 'url_menu', 'urutan_menu', 'is_active', 'id_menu', 'id_role'];

  public function getDataSubMenu($id_menu, $id_role)
  {
    $this->where('id_menu', $id_menu);
    $this->where('id_role', $id_role);
    $this->where('is_active', '1');
    $this->orderBy('urutan_menu', 'ASC');
    return $this->findAll();
  }

  public function getDataSubMenuSegment($segment_1, $segment_2)
  {
    $this->where('url_menu', $segment_1 . '/' . $segment_2);
    return $this->first();
  }
}
