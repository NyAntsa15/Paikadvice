<?php
	function dbconnect()
	{
		static $connect = null;
		if($connect === null) {
			$connect = mysqli_connect('localhost', 'root', 'root', 'hackaton');
		}
		return $connect;
	}  
?>