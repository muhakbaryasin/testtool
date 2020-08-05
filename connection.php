<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database = "testtool";

	$connection_mysql = mysqli_connect($hostname, $username, $password);
   
	if (mysqli_connect_errno($connection_mysql)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
   
	mysqli_select_db($connection_mysql, $database) or die("Database Tidak Ditemukan");
?>
