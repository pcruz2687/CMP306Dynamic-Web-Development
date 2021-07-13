<?php
  session_start();
  $session = false;
  if(isset($_SESSION['myemail']))
  {
    $session = true;
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
    <?php include 'server-connection-inc.php'; ?>
    
      <div class="container"><p class="h1">Basketball Teams</p></div>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="login.php">Login</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Week 1</a>
              </li>
			  <li class="nav-item">
	  			<a class="nav-link" href="week2.php">Week 2</a>
			  </li>
              <li class="nav-item">
                <a class="nav-link" href="commentary.html">Commentary</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">
        <div class="row">
          <div class="col align-self-start">
            <h1>Register</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row row-form">
          <div class="col-sm-12 col-lg-6">

            <span><?php if(isset($_GET['message'])){echo $_GET['message'];}?></span>
            <form action="register-validation.php" method="post">
              <div class="form-group">
                  <label for="exampleFormControlInput1">First Name</label>
                  <input type="text" class="form-control" id="register_first_name" name="register_first_name" value="<?php if(isset($_GET['register_first_name'])){echo $_GET['register_first_name'];}?>">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Last Name</label>
                  <input type="text" class="form-control" id="register_last_name" name="register_last_name" value="<?php if(isset($_GET['register_last_name'])){echo $_GET['register_last_name'];}?>">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Email Address</label>
                  <input type="email" class="form-control" id="register_email" name="register_email" value="<?php if(isset($_GET['register_email'])){echo $_GET['register_email'];}?>">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Password</label>
                  <input type="password" class="form-control" id="register_password" name="register_password">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Confirm Password</label>
                  <input type="password" class="form-control" id="register_password_repeat" name="register_password_repeat">
              </div>
              <div class="row row-form">
                <div class="col-sm-12 col-lg-12">
                  <button type="submit" class="btn register-button" id="register_button" name="register_button">Create New Account</button>
                </div>
              </div>
              
            </form>
          </div>
        </div> <!-- row div -->
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>