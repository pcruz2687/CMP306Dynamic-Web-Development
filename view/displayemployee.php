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
			$id = $_GET['id'] ;
		
			$requestdata -> jsonrpc = "2.0" ;
			$requestdata -> id = 1 ;
			$requestdata -> method = "getemployeebyid" ;
			$requestdata -> param -> id = $id ;
			$requesttxt = json_encode($requestdata) ;
			// echo "REQUEST1" ;
			// echo $requesttxt ;
			// echo "REQUEST1" ;
			// echo "<br/>" ;
			$url = "https://mayar.abertay.ac.uk/~g510572/week06/api/index.php" ;
				$ch = curl_init($url);                                                                      
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $requesttxt);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
					'Content-Type: application/json',                                                                                
					'Content-Length: ' . strlen($requesttxt))                                                                       
			);                                                                                                                                                                                                                                       
			$responsetxt = curl_exec($ch) ;
				if (!$responsetxt) {die('Error : "'.curl_error($ch).'" - Code: '.curl_errno($ch)); }
				curl_close($ch) ;	
			
			
			// echo "RESPONSE1" ;
			// echo $responsetxt ;
			// echo "RESPONSE1" ;
			// echo "<br/>" ;
			// echo "<br/>" ;
			
			$responsedata = json_decode($responsetxt) ;
			$err = $responsedata -> error ;
			$employeejson = $responsedata -> result ;
			

			echo "<div class='container'>";
				echo "<table class='table'>
								<thead class='thead-dark'>
									<tr>
										<th scope='col'></th>
										<th scope='col'></th>
									</tr>
								</thead>
								<tbody>
									<tr>";
								
			if ($err == NULL ) {
					echo "<tr>";
					echo "<th scope='row'>Name</th>";
					echo "<td>";
					echo $employeejson -> ename;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th scope='row'>Job</th>";
					echo "<td>";
					echo $employeejson -> ejob;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th scope='row'>Department</th>";
					echo "<td>";
					echo $employeejson -> edepartment;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th scope='row'>Room</th>";
					echo "<td>";
					echo $employeejson -> eroom;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th scope='row'>Phone</th>";
					echo "<td>";
					echo $employeejson -> ephone;
					echo "</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th scope='row'>Email</th>";
					echo "<td>";
					echo $employeejson -> eemail;
					echo "</td>";
					echo "</tr>";
				}
				echo "</tbody></table>";
				echo "</div>";
		?>  

	<?php include("../view/footer.html");?>	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>