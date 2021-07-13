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
    
			<?php include("navbar-week-1-2.php") ?>

			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-3">
						<div class="card">
							<img src="<?php echo $items[0]["image"]; ?>" class="card-img-top">
							<div class="card-body">
								<h5 class="card-title"><?php echo $items[0]["item"]; ?></h5>
								<p class="card-text"><?php echo $items[0]["description"]; ?></p>
							</div>
						</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[1]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[1]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[1]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[2]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[2]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[2]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[3]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[3]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[3]["description"]; ?></p>
								</div>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[4]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[4]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[4]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[5]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[5]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[5]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[6]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[6]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[6]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[7]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[7]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[7]["description"]; ?></p>
								</div>
							</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[8]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[8]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[8]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[9]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[9]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[9]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[10]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[10]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[10]["description"]; ?></p>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-3">
							<div class="card">
								<img src="<?php echo $items[11]["image"]; ?>" class="card-img-top">
								<div class="card-body">
									<h5 class="card-title"><?php echo $items[11]["item"]; ?></h5>
									<p class="card-text"><?php echo $items[11]["description"]; ?></p>
								</div>
							</div>
					</div>
				</div>
			</div>

			<?php include("view/footer.html"); ?>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>