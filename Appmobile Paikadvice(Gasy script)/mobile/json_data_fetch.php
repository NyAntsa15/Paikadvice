<?php
	include("db_connect.php");
	$sql = "SELECT * FROM vulg";
	$result = mysqli_query(dbconnect(),$sql);
	while ($row = mysqli_fetch_array($result)) {
	  	$data[] = $row;
	}
	$json = json_encode($data);
	echo str_replace("\/", "/", $json);
?>