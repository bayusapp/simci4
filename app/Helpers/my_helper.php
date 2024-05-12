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
