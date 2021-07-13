<?php
  include_once("../model/connection.php");
  $db = new dbObj();
  $conn = $db->get_conn_string();

  function register($txt)
  {
    global $conn;
    $data = json_decode($txt);

    $password = $data -> password;
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_stmt_init($conn);

    $sql2 = "SELECT email FROM users WHERE email = ?";
    mysqli_stmt_prepare($stmt, $sql2);
    mysqli_stmt_bind_param($stmt, 's', $email);
    $email =  $data -> email;
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    // mysqli_stmt_fetch($stmt);
    $email_taken = mysqli_stmt_num_rows($stmt);
    
    if ($email_taken == 0)
    {
      $sql = "INSERT INTO users (email, password, forename, surname, mobile_no) VALUES (?, ?, ?, ?, ?)";
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt, 'sssss', $email, $password_hash, $forename, $surname, $mobile_no);
      $email = $data -> email;
      $forename =  $data -> forename;
      $surname = $data -> surname;
      $mobile_no = $data -> mobile_no;
      mysqli_stmt_execute($stmt);
      return 0;
    }
    else 
    {
      return true;
    }
  }

  function authenticate($email, $password)
  {
    global $conn;
    
    $stmt = mysqli_stmt_init($conn);
    $sql = "SELECT user_id,password FROM users WHERE email=?";
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $password_hash);
    mysqli_stmt_fetch($stmt);

    if (password_verify($password, $password_hash))
    {
      return $user_id;
    }
    else
    {
      return false;
    }
  }

  function clean_data($data, $conn)
  {
    $data = stripslashes($data);
    $data = strip_tags($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
  }
  function clean_pw($data, $conn)
  {
    $data = strip_tags($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
  }

  // $pw = clean_pw("Tester123!", $conn);
  // echo $pw;
?>