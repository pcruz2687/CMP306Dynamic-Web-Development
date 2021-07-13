<?php
  // Connect to the database
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn =  $db->get_conn_string();
  
  // Get all the items
  function get_all_items()
  {
    global $conn;
    $sql = "SELECT * FROM items";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result))
    {
      $rows[] = $r;
    }
    //echo $rows;
    return json_encode($rows);
  }

  // Get all item images
  function get_item_images($item_id)
  {
    global $conn;
    $sql = "SELECT images.image_path FROM images INNER JOIN item_images
    WHERE images.image_id = item_images.image_id AND item_images.item_id = $item_id";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result))
    {
      $rows[] = $r;
    }
    //echo $rows;
    return json_encode($rows);
  }
?>