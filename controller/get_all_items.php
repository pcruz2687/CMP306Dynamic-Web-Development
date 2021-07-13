<?php
  $url = "https://mayar.abertay.ac.uk/~1702687/cmp306/controller/items.php";
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_CUSTOMERREQUEST, "GET");                                                                                                                                     
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);   
  $resp = curl_exec($curl);
  echo $resp;
  if (!$resp) {die('Error: "'.curl_error($curl).'" - Code: '.curl_errno($curl));}

  curl_close($curl);
?>