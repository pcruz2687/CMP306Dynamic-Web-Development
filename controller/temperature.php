<?php 
  include("../model/api-temperature.php");
  // decode the json body from the request
  $jsonbody = file_get_contents('php://input');
  $jsonobj = json_decode($jsonbody);

  $device_id = $jsonobj -> device;

  $json_readings -> external = $jsonobj -> external;
  $json_readings -> internal = $jsonobj -> internal;
  $json_readings -> voltage = $jsonobj -> voltage;
  $json_readings -> lightlevel = $jsonobj -> lightlevel;

  $readingsbody = json_encode($json_readings);

  
  store_readings($device_id, $readingsbody);
?>