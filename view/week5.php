<?php
  include("../view/session_start.php");
?>
<!DOCTYPE html>
<html>
    <head>
      <title></title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel="stylesheet" type="text/css" href="index.css">
      <meta name="viewport" content="width=device-width, intial-scale=1.0">
    </head>
    <body>
      <?php
        include("../view/navbar.php");
        include("../model/api-items.php");

        $items_txt = get_all_items();
        $items_json = json_decode($items_txt);

        $counter = 0;
        $counter_2 = 1000;
        echo '<div class="container">';
        for($i = 0; $i < sizeof($items_json); $i++)
        {
          $item_images_txt = get_item_images($counter_2 += 1);
          $item_images_json = json_decode($item_images_txt);
          if ($counter == 0)
          {
            echo '<div class="row">';
          }
          echo '<div class="col-sm">
                  <div class="card">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                      <div class="carousel-inner">';
                        for($j = 0; $j < sizeof($item_images_json); $j++)
                        {
                          if ($j == 0)
                          {
                            echo '<div class="carousel-item active">
                                    <img class="d-block w-100" src="'.$item_images_json[$j] -> image_path.'" alt="First slide">
                                  </div>';
                          }
                          else
                          {
                            echo '<div class="carousel-item">
                                    <img class="d-block w-100" src="'.$item_images_json[$j] -> image_path.'" alt="First slide">
                                  </div>';
                          }                          
                        }
          echo        '</div>
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">'.$items_json[$i] -> item_name.'</h5>
                      <p class="card-text">'.$items_json[$i] -> item_desc.'</p>
                    </div>
                    <div class="card-body">
                      <a href="article.php?id='.$items_json[$i] -> item_id.'" class="card-link">Read Articles</a>
                    </div>
						      </div>
                </div>'; // col-sm div
        $counter += 1;
        if ($counter == 4)
        {
          echo '</div>'; // row div
          $counter = 0;
        }
        
        }
        echo '</div>'; // container div
      ?>

      <?php include("../view/footer.html");?> 

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>