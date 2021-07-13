<?php
  include("../view/session_start.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
        <script type="text/javascript">
          var verifyCallback = function(response) {
          };

          var onloadCallback = function() {
            grecaptcha.render('example3', {
              'sitekey' : '6Ler2L8UAAAAAO9xdlgSKKhkpuQDxMYje339oQd-',
              'callback' : verifyCallback,
              'theme' : 'dark'
            });
          };
        </script>
    </head>
    <body>
      <?php include("../view/navbar.php"); ?>
      <div class="container">
        <form action="../controller/login-user.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="login_email">Email</label>
              <input type="email" class="form-control" name="login_email" placeholder="Email" value="<?php echo $_GET['email']; ?>"required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
              <?php   
                if (isset($_GET['captcha']) && isset($_GET['email']))
                {
                  echo '<span style="color:red;">Prove you are not a robot.</span>';
                }
                else if (isset($_GET['email']))
                {
                  echo '<span style="color:red;">Email or Password is wrong.</span>';
                  //echo '<script type="text/javascript">alert("Email is already taken");</script>';
                }
                else if (isset($_GET['captcha']))
                {
                  echo '<span style="color:red;">Prove you are not a robot.</span>';
                }
              ?>
            </div>
            <div class="form-group col-md-6">
              <label for="login_password">Password</label>
              <input type="password" class="form-control" name="login_password" placeholder="Password" required>
            </div>
          </div>
          <div id="example3"></div>
          <button type="submit" class="btn btn-primary">Sign In</button>  
        </form>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
            async defer>
        </script>
        <?php
          if($_GET['session_expired'] == 1)
          {
            echo '<p style="color:red;">Session expired. Please login again.</p>';
          }
        ?>
      </div>
      
      <?php include("../view/footer.html");?>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>