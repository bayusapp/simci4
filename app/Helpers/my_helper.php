<?php

function getAddress($latlang)
{
  if ($latlang != null) {
    //google map api url
    $url = "https://maps.google.com/maps/api/geocode/json?latlng=$latlang&key=AIzaSyA-BQS8hr9-K1fOsgTpvWAFrh-ocZk3DcQ";

    // send http request
    $geocode = file_get_contents($url);
    $json = json_decode($geocode);
    $address = $json->results[0];
    return $address;
  } else {
    return 'off';
  }
}
