<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
    <?php 
			include 'server-con	nection-inc.php';

      $stmt = "SELECT item_name, item_desc FROM items ORDER BY item_id ASC";
			$result = mysqli_query($conn, $stmt);
			$items = array();
      if (mysqli_num_rows($result) > 0)
      {
        while ($row = mysqli_fetch_assoc($result)) {
					$data = array("item" => $row["item_name"], "description" => $row["item_desc"], "image" => "");
					array_push($items, $data);
        }
			}

			$stmt2 = "SELECT image_path FROM images INNER JOIN item_images WHERE images.image_id = item_images.image_id ORDER BY images.image_id ASC;";
			$result2 = mysqli_query($conn, $stmt2);
			$images = array();
			if(mysqli_num_rows($result2) > 0)
			{
				while($row = mysqli_fetch_assoc($result2))
				{
					$counter = 0;
					for($int = 0; $int<12;$int++)
					{
						if ($counter == 0 && $items[$int]["image"] == "")
						{
							$items[$int]["image"] = $row["image_path"];
							$counter += 1;
						}
						else if ($counter != 0)
						{
							break;
						}
					}
					// $data = array("image" => $row["image_path"]);
					// array_push($items, $data);
				}
			}
    ?>
    
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
            <h1>Login</h1>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row row-form">
          <div class="col-sm-12 col-lg-6">
            <form action="login-validation.php" method="post">
              <div class="form-group">
                  <label for="exampleFormControlInput1">Email Address</label>
                  <input type="email" class="form-control" id="login_email" name="login_email" value="<?php if(isset($_GET['login_email'])){echo $_GET['login_email'];}?>">
              </div>
              <div class="form-group">
                  <label for="exampleFormControlInput1">Password</label>
                  <input type="password" class="form-control" id="login_password" name="login_password">
              </div>
              <div class="row">
                <div class="col-sm-4">
                  <a href="register.php" class="btn register-button" id="register_button" name="register_button">Sign Up</a>
                </div>
                <div class="col-sm-4 offset-sm-4">
                  <button type="submit" class="btn login-button" id="login_button" name="login_button">Login</button>
                </div>
                <div class="col-sm-4 offset-sm-8 forgot-password">
                  <a href="register.php">Forgot your password?</a>
                </div>
              </div>
              <span><?php if(isset($_GET['message'])){echo $_GET['message'];}?></span>
            </form>
          </div>
        </div>
      </div>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>