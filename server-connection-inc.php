<?php 
  ini_set("display_errors", 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  $servername = "lochnagar.abertay.ac.uk";
  $username = "";
  $password = "";
  $dbname = "";
  $conn = mysqli_connect($servername,$username,$password,$dbname);

  if(!$conn) 
    {
      die("Connection Failed: " . mysqli_connect_error());
    }
?>