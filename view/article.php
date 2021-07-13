<?php
  include("../view/session_start.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
      <?php 
        include("../view/navbar.php");
        include("../model/api-articles.php");
        include("../model/api-comments.php");
        
        $article_txt = get_article($_GET['id']);
        $article_json = json_decode($article_txt);

        $comment_txt = get_comments($article_json -> article_id);
        $comment_json = json_decode($comment_txt);
        echo '<div class="container">'; // this entire container disappears when I include 
          echo '<button type="button" class="btn btn-secondary btn-sm" onclick="history.back()">Back</button>';
          echo '<div class="row">
                  <div class="col-sm">
                    <div class="card mb-3">
                      <div style="height: 500px;">
                        <img src="'.$article_json -> image_path.'" class="card-img-top" alt="'.$article_json -> image_title.'" style="height:100%;object-fit:cover;">
                      </div>
                      <div class="card-body">
                        <h4 class="card-title">'.$articles_json -> article_title.'</h4>
                        <p class="card-text"><small class="text-muted">'.$article_json -> article_author.'</small></p>
                        <p class="card-text">'.$article_json -> article_text.'</p>
                      </div>
                    </div>
                  </div>
                </div>';
        
        if (isset($_SESSION['id']))
        {
          echo '<form action="../controller/add-comment.php?item_id='.$_GET['id'].'&article_id='.$article_json -> article_id.'&user_id='.$_SESSION["id"].'" method="POST">
                  <div class="form-group">
                    <label for="comment">Add Comment</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>';
        }
        else
        {
          echo '<p style="color:red;">You must be logged in to comment.</p>';
        }
        
        echo '<h5>Comments</h5>';
        for ($i = 0; $i < sizeof($comment_json); $i++)
        {
          echo '<div class="card">
                  <div class="card-header">
                    <h6>'.$comment_json[$i] -> forename.' '.$comment_json[$i] -> surname.'</h6>
                  </div>
                  <div class="card-body">
                    '.$comment_json[$i] -> comment_text.'
                  </div>
                </div>';
          echo '<br>';
        }

        
       echo '</div>'; 
      ?>

      <?php include("../view/footer.html");?>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>