<?php

/*Login handled here*/
session_start();

//these will be changed once we set up the database
$servername = "localhost";
$username = "";
$password = "";

//connect to the database
$connection = new mysqli($servername, $username, $password);

//Check if the connection was successful
if($connection->connect_error){
	die("Connection to the database failed: " . $connection->connect_error);
} else{
	echo "<script> window.location.assign('../calendar.php'); </script>";
}
