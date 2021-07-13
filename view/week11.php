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

        $xmltxt = file_get_contents('https://www.cbssports.com/rss/headlines/nba/');
        $xml = simplexml_load_string($xmltxt);
        $xsl = simplexml_load_file("basketball.xsl");
        $proc = new XSLTProcessor();
        $proc->importStyleSheet($xsl);
        $result = $proc->transformToXML($xml);
        
        echo '<div class="container">';
        echo $result;
        echo '</div>';
      ?>

      <?php include("../view/footer.html");?>

      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>