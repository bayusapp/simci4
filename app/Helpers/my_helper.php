<?php

if (!function_exists('getAddress')) {
  function getAddress($latlng)
  {
    if ($latlng != null) {
      //google map api url
      $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latlng&key=AIzaSyA-BQS8hr9-K1fOsgTpvWAFrh-ocZk3DcQ";

      // send http request
      $geocode = file_get_contents($url);
      $json = json_decode($geocode);
      $address = $json->results[0];
      return $address;
    } else {
      return 'off';
    }
  }
}

if (!function_exists('check_ip')) {
  function check_ip()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    // IP TUNE
    // $json = file_get_contents("http://ipinfo.io/103.233.100.236/geo");
    // IP ITB
    // $json = file_get_contents("http://ipinfo.io/167.205.22.106/geo");
    // IP Non TUNE
    // $json = file_get_contents("http://ipinfo.io/114.122.100.20/geo");
    $json = file_get_contents("http://ipinfo.io/{$ip_address}/geo");
    $details = json_decode($json, true);
    return $details;
  }
}

if (!function_exists('check_isp')) {
  function check_isp()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip_address = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip_address = $_SERVER['REMOTE_ADDR'];
    }
    // IP TUNE
    // $json = file_get_contents("http://ipinfo.io/103.233.100.236/geo");
    // IP ITB
    $json = file_get_contents("http://ipinfo.io/167.205.22.106/geo");
    // IP Non TUNE
    // $json = file_get_contents("http://ipinfo.io/114.122.100.20/geo");
    // $json = file_get_contents("http://ipinfo.io/{$ip_address}/geo");
    $details = json_decode($json, true);
    $tmp = explode(' ', $details['org']);
    $org  = '';
    for ($i = 1; $i < count($tmp); $i++) {
      if ($i < (count($tmp) - 1)) {
        $org .= $tmp[$i] . ' ';
      } else {
        $org .= $tmp[$i];
      }
    }
    return $org;
  }
}

if (!function_exists('greetings')) {
  function greetings()
  {
    date_default_timezone_set('Asia/Jakarta');
    $jam = date('H:i');

    if ($jam > '05:30' && $jam < '10:00') {
      $salam = 'Pagi';
    } elseif ($jam >= '10:00' && $jam < '15:00') {
      $salam = 'Siang';
    } elseif ($jam < '18:00') {
      $salam = 'Sore';
    } else {
      $salam = 'Malam';
    }

    return $salam;
  }
}

if (!function_exists('tanggalIndoLengkap')) {
  function tanggalIndoLengkap($tanggal)
  {
    $nama_hari      = hariIndo(date('l', strtotime($tanggal)));
    $split          = explode(' ', $tanggal);
    $split_tanggal  = explode('-', $split[0]);
    $tanggal        = $split_tanggal[2];
    $bulan          = bulanIndoPanjang($split_tanggal[1]);
    $tahun          = $split_tanggal[0];
    return $nama_hari . ', ' . $tanggal . ' ' . $bulan . ' ' . $tahun . ' ' . $split[1];
  }
}

if (!function_exists('bulanIndoPanjang')) {
  function bulanIndoPanjang($bulan)
  {
    switch ($bulan) {
      case 1:
        return 'Januari';
        break;
      case 2:
        return 'Februari';
        break;
      case 3:
        return 'Maret';
        break;
      case 4:
        return 'April';
        break;
      case 5:
        return 'Mei';
        break;
      case 6:
        return 'Juni';
        break;
      case 7:
        return 'Juli';
        break;
      case 8:
        return 'Agustus';
        break;
      case 9:
        return 'September';
        break;
      case 10:
        return 'Oktober';
        break;
      case 11:
        return 'November';
        break;
      case 12:
        return 'Desember';
        break;
    }
  }
}

if (!function_exists('hariIndo')) {
  function hariIndo($hari)
  {
    if ($hari == 'Sunday') {
      return  'Minggu';
    } elseif ($hari == 'Monday') {
      return 'Senin';
    } elseif ($hari == 'Tuesday') {
      return 'Selasa';
    } elseif ($hari == 'Wednesday') {
      return 'Rabu';
    } elseif ($hari == 'Thursday') {
      return 'Kamis';
    } elseif ($hari == 'Friday') {
      return 'Jumat';
    } elseif ($hari == 'Saturday') {
      return 'Sabtu';
    }
  }
}

if (!function_exists('kirimWA')) {
  function kirimWA($pesan, $tujuan)
  {
    $pesan = str_replace(' ', ' ', $pesan);

    $body = array(
      "api_key" => "5b79f4142bf39b929c2e27013fc10db7daf5c275",
      "receiver" => $tujuan,
      "data" => array("message" => $pesan)
    );

    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => "https://waps.bayusapp.com/api/send-message",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($body),
      CURLOPT_HTTPHEADER => [
        "Accept: */*",
        "Content-Type: application/json",
      ],
    ]);

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;
    // sleep(7);
  }
}
