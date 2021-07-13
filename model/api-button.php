<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn = $db->get_conn_string();

  function create_switch_state($sw_state, $sw_pin)
  {
    global $conn;
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO switch_state (state, pin) VALUES (?,?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $state, $pin);
    $state = $sw_state;
    $pin = $sw_pin;
    mysqli_stmt_execute($stmt);
  }
?>