<?php
  $url = "https://mayar.abertay.ac.uk/~1702687/cmp306/controller/items.php";
  $data = '{"item_name": "'.$_POST["item_name"].'", "item_desc": "'.$_POST["item_desc"].'"}' ;
  $curl = curl_init($url) ;
  curl_setopt($curl, CURLOPT_CUSTOMERREQUEST, "POST");                                                                     
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);                                                                  
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    	'Content-Type: application/json',                                                                                
    	'Content-Length: ' . strlen($data))                                                                       
	);                 
  	$resp = curl_exec($curl) ;
  	echo "Finished :" ;
  	echo $resp ;
    if (!$resp) {die('Error : "'.curl_error($curl).'" - Code: '.curl_errno($curl)); }
    echo "<br/><br/><a href='https://mayar.abertay.ac.uk/~1702687/cmp306/view/week12.php'>Return to Week 12 Page</a>";
    curl_close($curl) ;	
    
?>