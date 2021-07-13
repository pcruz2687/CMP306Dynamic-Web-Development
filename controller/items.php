<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn =  $db->get_conn_string();

  include("../model/library.php");
  $request_method=$_SERVER["REQUEST_METHOD"];

  switch($request_method)
  {
    case 'GET':
      // Retrieve Products
      if (!empty($_GET["id"]))
      {
        $id=intval($_GET["id"]);
        get_all_items($id);
      }
      else
      {
        get_all_items(0);
      }
      break;
    case 'POST':
      insert_item();
      break;
    default:
      // Invalid Request Method
      header("HTTP/1.0 405 Method Not Allowed");
      break;
    }
?>