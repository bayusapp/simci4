<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users_Preference extends Model
{

  protected $table = 'users_preference';
  protected $primaryKey = 'id_users_preference';
  protected $allowedFields = ['dark_mode', 'username'];

  public function getStatusDarkMode($username)
  {
    $this->where('username', $username);
    return $this->first();
  }

  public function enableDarkMode($username)
  {
    $this->set('dark_mode', '1');
    $this->where('username', $username);
    return $this->update();
  }

  public function disableDarkMode($username)
  {
    $this->set('dark_mode', '0');
    $this->where('username', $username);
    return $this->update();
  }
}
