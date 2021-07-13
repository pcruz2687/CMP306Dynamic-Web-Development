<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
      <?php 
        include 'server-connection-inc.php';

        $item_id = $_GET['id']; 

        $stmt = "SELECT articles.article_title, articles.article_author, articles.article_text, images.image_path, images.image_title
        FROM articles, images INNER JOIN article_images
        WHERE articles.article_id = article_images.article_id AND images.image_id = article_images.image_id AND articles.item_id = '$item_id';";
        $result = mysqli_query($conn, $stmt);
        $items = array();
        if (mysqli_num_rows($result) > 0)
        {
          while($row = mysqli_fetch_assoc($result))
          {
            $data = array("article" => $row["article_title"], "author" => $row["article_author"], "text" => $row["article_text"], "image_title" => $row["image_title"], "image" => $row["image_path"]);
            array_push($items, $data);
          }
        }
      ?>
    
      <div class="container"><p class="h1">Basketball Teams</p></div>

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
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
                <a class="nav-link" href="view/week3.php">Week 3</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="view/week4.php">Week 4</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="view/commentary.php">Commentary</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container">

        <?php 
          for($i = 0; $i < mysqli_num_rows($result); $i++)
          {
            echo '<div class="row">
            <div class="col-sm">
              <div class="card mb-3">
                <div style="height: 500px;">
                  <img src="'; echo $items[$i]["image"]; echo '" class="card-img-top" alt="'; echo $items[$i]["image_title"]; echo '" style="height:100%;object-fit:cover;">
                </div>
                <div class="card-body">
                  <h5 class="card-title">';echo $items[$i]["article"]; echo '</h5>
                  <p class="card-text"><small class="text-muted">'; echo $items[$i]["author"]; echo '</small></p>
                  <p class="card-text">';echo $items[$i]["text"]; echo '</p>
                </div>
              </div>
            </div>
          </div>';
          }
        ?>

      </div>
 
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>