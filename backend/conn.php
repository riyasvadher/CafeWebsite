<?php 
$host ="localhost";
$username = "root";
$password = "";
$dbname = "cafe";

$con = new mysqli($host, $username, $password, $dbname);
if($con->connect_error)
	{
		die("Something Went Wrong!");
	}
?>