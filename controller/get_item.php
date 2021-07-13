<?php
  $url = "https://mayar.abertay.ac.uk/~1702687/cmp306/controller/items.php?id=" . $_POST['item_id'];
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMERREQUEST, "GET");                                                                                                                                     
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   
  $resp = curl_exec($curl);
  echo $resp;
  if (!$resp) {die('Error: "'.curl_error($curl).'" - Code: '.curl_errno($curl));}
  echo "<br/><br/><a href='https://mayar.abertay.ac.uk/~1702687/cmp306/view/week12.php'>Return to Week 12 Page</a>";
  curl_close($curl);
  
?>