<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn = $db->get_conn_string();

  function add_comment($txt)
  {
    global $conn;
    $data = json_decode($txt);

    $stmt = mysqli_stmt_init($conn);
    $sql = "INSERT INTO comments (comment_text, user_id, article_id) VALUES (?,?,?)";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 'sss', $comment, $user_id, $article_id);
    $comment = $data -> comment;
    $user_id = $data -> user_id;
    $article_id = $data -> article_id;
    mysqli_stmt_execute($stmt);
  }

  function get_comments($article_id) 
  {
    global $conn;
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT comments.comment_text, users.forename, users.surname 
    FROM comments INNER JOIN users
    WHERE comments.user_id = users.user_id AND comments.article_id = ? ORDER BY comment_id DESC";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $article_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
    }
		return json_encode($rows);
  }
?>