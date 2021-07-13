<?php
  include_once("../../model/connection.php");
  $db = new dbObj();
  $conn =  $db->get_conn_string();

  $request_method=$_SERVER["REQUEST_METHOD"];

  switch($request_method)
	{
		case 'GET':
      // Retrive Products
      echo $_GET["id"];
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_item($id);
			}
			else
			{
				get_all_items();
			}
			break;
		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
  } 
  
  function get_all_items() 
  {
    global $conn;
    $query = "SELECT * FROM items";
    $result = mysqli_query($conn, $query);
    $rows = array();
    while($r=mysqli_fetch_array($result))
    {
      $rows[] = $r;
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function get_item($id=0)
  {
    global $conn;
    $query = "SELECT item_id FROM items";
    if($id != 0)
    {
      $query.=" WHERE item_id=".$id." LIMIT 1";
    }
    $result = mysqli_query($conn, $query);
    $rows = array();
    while($r=mysqli_fetch_array($result))
    {
      $rows[] = $r;
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
  }
?>