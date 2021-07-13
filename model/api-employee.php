<?php
	// Connect to database
	include("connection-2.php");
	$db = new dbObj();
	$conn =  $db->getConnstring();
	
	//  function to create an employee
	function createemployee($txt) {
		global $conn;
		$data = json_decode($txt) ;
		$sql = "insert into employee (eno, ename) values (?, ?)" ;
		$stmt = $conn->prepare("insert into employee (eno, ename, ejob, edepartment, eroom, ephone, eemail) values (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $eno, $ename, $ejob, $edepartment, $eroom, $ephone, $eemail);
		$eno = $data -> eno ;
		$ename = $data -> ename ;
		$ejob = $data -> ejob ;
		$edepartment = $data -> edepartment ;
		$eroom = $data -> eroom ;
		$ephone = $data -> ephone ;
		$eemail = $data -> eemail ;
		$res = $stmt->execute();
		$resid = $stmt->insert_id ;
		return $resid ;
	}

	//  function to get all the employees
	function getallemployees()
	{
		global $conn;
		$sql = "SELECT * FROM employee";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//  function to get a single employee
	function getemployeebyid($id)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM employee WHERE eno= ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_array($result) ;  //there is only 1 row
		return json_encode($row);
	}
	
?>