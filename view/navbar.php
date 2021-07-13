<div class="container"><p class="h1">Basketball Teams</p></div>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    
    <?php
      $session = check_session(); // check if session is set
      if ($session)
      {
        echo '<a class="navbar-brand" href="../controller/login-user.php?logout=1">Logout</a>';
      }
      else 
      {
        echo '<a class="navbar-brand" href="login.php">Login</a>';
        echo '<a class="navbar-brand" href="register.php">Register</a>';
      }
    ?>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">Week 1</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../week2.php">Week 2</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week3.php">Week 3</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week4.php">Week 4</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week5.php">Week 5</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week6.php">Week 6</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week7.php">Week 7</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week8.php">Week 8</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week9.php">Week 9</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week10.php">Week 10</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week11.php">Week 11</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="week12.php">Week 12</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="commentary.php">Commentary</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>