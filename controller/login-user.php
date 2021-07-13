<?php
  include_once("../model/api-user.php");

  $email = clean_data($_POST['login_email'], $conn);
  $password = clean_pw($_POST['login_password'], $conn);

  if ($_GET['logout'] == 1) // will only work if url has a GET request
  {
    logout();
    header("location: ../view/login.php");
  }
  else if ($_POST['g-recaptcha-response'])
  {
    $valid = authenticate($email, $password);
    
    //echo $valid;
    if ($valid)
    {
      session_start();
      $_SESSION['id'] = $valid;
      $test = $_SESSION['id'];
      header("location: ../view/week4.php");
    }
    else
    {
      header("location: ../view/login.php?email=$email");
    }
  }
  else
  {
    header("location: ../view/login.php?captcha=false&email=$email");
  }
  
  function logout()
  {
    session_start();
    $_SESSION = array();
    setcookie(session_name(), '', time()-2592000, '/');
    session_destroy();
  }

?>