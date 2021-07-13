<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn = $db->get_conn_string();
  
  function get_recent_reading()
  {
    global $conn;
    //$stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * FROM readings WHERE reading_id = (SELECT max(reading_id) FROM readings)";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result))
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }

  function get_ten_readings()
  {
    global $conn;
    //$stmt = mysqli_stmt_init($conn);
    $sql = "SELECT * FROM readings ORDER BY reading_id DESC LIMIT 10";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result))
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }

?>