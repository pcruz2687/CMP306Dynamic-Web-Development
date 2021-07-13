<?php
  session_start();
  function check_session()
  {
    if (isset($_SESSION['id']))
    {
      return true;
    }
    else
    {
      session_destroy();
      return 0;
    }
  }
  
  $session_duration = 300;

  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_duration)
  {
    session_unset();
    session_destroy();
    header("location: ../view/login.php?session_expired=1");
  }

  $_SESSION['last_activity'] = time();
?>