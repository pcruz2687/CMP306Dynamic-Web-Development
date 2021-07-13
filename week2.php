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

				// $stmt = "SELECT items.item_name, items.item_desc, images.image_path
				// FROM items, images INNER JOIN item_images
				// WHERE items.item_id = item_images.item_id AND images.image_id = item_images.image_id;";
				// $result = mysqli_query($conn, $stmt);
				// $items = array();
				// if (mysqli_num_rows($result) > 0)
				// {
				// 	while($row = mysqli_fetch_assoc($result))
				// 	{
				// 		$data = array("item" => $row["item_name"], "description" => $row["item_desc"], "image" => $row["image_path"]);
				// 		array_push($items, $data);
				// 	}
				// }

				function get_items($conn, $item_id)
				{
					$stmt = "SELECT items.item_id, items.item_name, items.item_desc, images.image_path
					FROM items, images INNER JOIN item_images
					WHERE items.item_id = $item_id AND item_images.item_id = $item_id AND images.image_id = item_images.image_id;";
					$result = mysqli_query($conn, $stmt);

					$items = array();

					if (mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_assoc($result))
						{
							$data = array("items" => $row["item_id"],"item" => $row["item_name"], "description" => $row["item_desc"], "image" => $row["image_path"]);
							array_push($items, $data);
						}
					}

					echo '<div class="col-sm-12 col-md-3">
						<div class="card">
							<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">';
									for ($i = 0; $i < mysqli_num_rows($result); $i++)
										{
											if ($i == 0)
											{
												echo '<div class="carousel-item active">
												<img class="d-block w-100" src="'.$items[$i]["image"].'" alt="Second slide">
											</div>';
											}
											else {
												echo '<div class="carousel-item">
												<img class="d-block w-100" src="'.$items[$i]["image"].'" alt="Second slide">
											</div>';
											}
										
										}
								echo '</div>
							</div>

							<div class="card-body">
								<h5 class="card-title">'.$items[0]["item"].'</h5>
								<p class="card-text">'.$items[0]["description"].'</p>
							</div>
							<div class="card-body">
								<a href="view/article.php?id='.$items[0]["items"].'" class="card-link">Read Articles</a>
							</div>
						</div>
				</div>';
				}
			?>
    
      <?php include("navbar-week-1-2.php") ?>

			<div class="container">

				<?php 
					for ($i = 0; $i < 3; $i++)
					{
						echo '<div class="row">';
						if ($i == 0)
						{
							for ($j = 0; $j < 4; $j++)
							{
								if ($j == 0)
								{
									get_items($conn, 1001);
								}
								else
								{
									get_items($conn, 1001 + $j);
								}
							}
						}
						else if ($i == 1)
						{
							for ($j = 0; $j < 4; $j++)
							{
								if ($j == 0)
								{
									get_items($conn, 1005);
								}
								else
								{
									get_items($conn, 1005 + $j);
								}
							}
						}
						else if ($i == 2)
						{
							for ($j = 0; $j < 4; $j++)
							{
								if ($j == 0)
								{
									get_items($conn, 1009);
								}
								else
								{
									get_items($conn, 1009 + $j);
								}
							}
						}
						echo '</div>';
					}
				?>
			
					<!-- <div class="col-sm-12 col-md-3">
						<a href="#">
							<div class="card">
								<img src="<?php echo $items[11]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[11]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[11]["description"]; ?></p>
								</div>
								<div class="card-body">
									<a href="article.php?id=<?php echo '10012'; ?>" class="card-link">Read Articles</a>
								</div>
							</div>
						</a>
					</div> -->
			</div>
			
			<?php include("view/footer.html"); ?>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>