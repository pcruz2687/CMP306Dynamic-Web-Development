<?php 
  include("../model/api-button.php");
  // decode the json body from the request
  $jsonbody = file_get_contents('php://input');
  $jsonobj = json_decode($jsonbody);
  $state = $jsonobj -> state;
  $pin = $jsonobj -> pin;
  $result = create_switch_state($state, $pin);
?>