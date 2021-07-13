  <?php
  include_once("../model/api-user.php");

  $data -> email = clean_data($_POST['register_email'], $conn);
  $data -> password = clean_pw($_POST['register_password'], $conn);
  $data -> mobile_no = clean_data($_POST['register_mobile'], $conn);
  $data -> forename = clean_data($_POST['register_forename'], $conn);
  $data -> surname = clean_data($_POST['register_surname'], $conn);

  $datatxt = json_encode($data);
  $email_taken = register($datatxt);

  if ($email_taken)
  {
    header("location: ../view/register.php?email_taken=1&email=$data->email&mobile_no=$data->mobile_no&forename=$data->forename&surname=$data->surname");
  }
  else
  {
    header("location: ../view/login.php");
  }
  
?>