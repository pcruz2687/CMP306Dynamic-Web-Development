<?php
  include("../model/api-comments.php");

  $data -> comment = trim($_POST['comment']);
  $data -> user_id = trim($_GET['user_id']);
  $data -> article_id = trim($_GET['article_id']);
  $item_id = $_GET['item_id'];
  $datatxt = json_encode($data);
  add_comment($datatxt);

  header("location: ../view/article.php?id=$item_id");
?>