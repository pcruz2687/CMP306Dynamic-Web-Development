<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn = $db->get_conn_string();

  function store_readings($device_id, $data)
  {
    global $conn;
    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO readings (eidevice, state) VALUES (?, ?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $device, $state);
    $device = $device_id;
    $state = $data;
    mysqli_stmt_execute($stmt);
  }
?>