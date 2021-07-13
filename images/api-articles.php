<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn =  $db->get_conn_string();

  // Get item's article and its images
  function get_article($item_id)
  {
    global $conn;
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT articles.article_id, articles.article_title, articles.article_author, articles.article_text, images.image_path, images.image_title
    FROM articles, images INNER JOIN article_images
    WHERE articles.article_id = article_images.article_id AND images.image_id = article_images.image_id AND articles.item_id = ?";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $item_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
 
    $row = mysqli_fetch_array($result);
    $encode = json_encode($row);
    $decode = json_decode($encode);
    return json_encode($row);
  }

  function get_five_articles()
  {
    global $conn;
    $sql = "SELECT articles.article_id, articles.article_title, articles.article_author, articles.article_text, images.image_path, images.image_title 
    FROM articles, images INNER JOIN article_images 
    WHERE articles.article_id = article_images.article_id AND images.image_id = article_images.image_id ORDER BY article_id DESC LIMIT 5";
    $result = mysqli_query($conn, $sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($result))
    {
      $rows[] = $r;
    }
    return json_encode($rows);
  }

?>  