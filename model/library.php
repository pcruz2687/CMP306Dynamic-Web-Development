<?php
// include_once("../model/connection.php");
// $db = new dbObj();
// $conn =  $db->get_conn_string();

  function get_all_items($id)
  {
    global $conn;
    $sql = "SELECT * FROM items";
    if($id != 0)
    {
      $sql=$sql." WHERE item_id=".$id." LIMIT 1";
    }
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_array($result))
    {
      $rows[] = $r;
    }
    header('Content-Type: application/json');
    echo json_encode($rows);
  }

  function insert_item()
	{
		global $conn;
 
		$data = json_decode(file_get_contents('php://input'), true);
		$item_name=$data["item_name"];
    $item_desc=$data["item_desc"];
    
    echo $sql="INSERT INTO items SET item_name='".$item_name."', item_desc='".$item_desc."'";
		if(mysqli_query($conn, $sql))
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Item Added Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Item Addition Failed.'
			);
		}
		header('Content-Type: application/json');
		echo json_encode($response);
	}
  //get_all_items(0);
?>