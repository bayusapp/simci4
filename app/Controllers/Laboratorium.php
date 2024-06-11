<?php

namespace App\Controllers;

class Laboratorium extends BaseController
{

  public function __construct()
  {
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      //
    }
  }

  public function index()
  {
    // echo 'menu laboratorium';
  }
}
