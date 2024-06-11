<?php

namespace App\Controllers;

use App\Models\M_Laboran;
use App\Models\M_Riwayat_Login;
use App\Models\M_Users_Access_Menu;

class RiwayatLogin extends BaseController
{

  var $data;
  protected $laboran;
  protected $riwayat;

  public function __construct()
  {
    // $model  = new M_Users_Access_Menu();
    // $menu   = $model->getAccessMenuByLink(session()->get('id_role'), 'RiwayatLogin');
    // if ($menu['is_active'] == '1') {
    //   $this->riwayat = new M_Riwayat_Login();
    //   if (session()->get('id_role') != '1') {
    //     header("Location: " . base_url());
    //     die();
    //   }
    //   if (session()->get('nip_laboran')) {
    //     $this->laboran = new M_Laboran();
    //     $nip                = session()->get('nip_laboran');
    //     $dataLaboran        = $this->laboran->getDataLaboran($nip);
    //     $this->data = array(
    //       'nip_laboran'   => $dataLaboran['nip_laboran'],
    //       'nama_laboran'  => $dataLaboran['nama_laboran'],
    //       'foto_laboran'  => $dataLaboran['foto_laboran']
    //     );
    //   } else {
    //     header("Location: " . base_url());
    //     die();
    //   }
    // } else {
    //   header("Location: " . base_url());
    //   die();
    // }
    if (session()->get('login') != 'login') {
      header("Location: " . base_url());
      die();
    } else {
      if (session()->get('id_role') != '1') {
        header("Location: " . base_url());
        die();
      } else {
        echo 'laboran/admin';
      }
    }
  }

  public function index()
  {
    // $data = $this->data;
    // $data['title']  = 'Riwayat Login | SIM Laboratorium';
    // $data['data_login'] = $this->riwayat->getHistoryLogin(session()->get('username'));
    // return view('riwayat_login/v_index', $data);
  }
}
