<?php
  include("../view/session_start.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
        <script type="text/javascript" src="js/register.js"></script>
    </head>
    <body>
      <?php 
        include("../view/navbar.php"); 
      ?>

      <div class="container">
        <form action="../controller/register-user.php" method="post" onsubmit="return validate_password()">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_email">Email</label>
              <input type="email" class="form-control" name="register_email" value="<?php echo $_GET['email']; ?>" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
              <?php   
                if (isset($_GET['email_taken']))
                {
                  echo '<span style="color:red;">Email is already taken.</span>';
                  //echo '<script type="text/javascript">alert("Email is already taken");</script>';
                }
              ?>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_password">Password</label>
              <input type="password" class="form-control" id="register_password" name="register_password" required onkeyup="password_strength(this.value);" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$" title="Password must contain at least 8 characters with at least one number, one uppercase letter, lowercase letter, and one special character">
              <span id="msg"></span>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_confirm_password">Confirm Password</label>
              <input type="password" class="form-control" id="register_confirm_password" name="register_confirm_password" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_forename">Forename</label>
              <input type="text" class="form-control" name="register_forename" value="<?php echo $_GET['forename']; ?>" required pattern="(?=.*[a-z])(?=.*[A-Z]).{2,40}" title="Forename cannot contain numbers or special characters.">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_surname">Surname</label>
              <input type="text" class="form-control" name="register_surname" value="<?php echo $_GET['surname']; ?>" required pattern="(?=.*[a-z])(?=.*[A-Z]).{2,40}" title="Surname cannot contain numbers or special characters.">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="register_mobile">Mobile Number</label>
              <input type="text" class="form-control" name="register_mobile" value="<?php echo $_GET['mobile_no']; ?>" required pattern="[0-9]{11}" title="Mobile number must have 11 digits.">
            </div>
          </div>
          <?php   
            if (isset($_GET['captcha']))
            {
              echo '<span style="color:red;">Prove you are not a robot.</span>';
            }
          ?>
          <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
      </div>
      <?php include("../view/footer.html");?>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>