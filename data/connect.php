<?php

/*Login handled here*/
session_start();

//these will be changed once we set up the database
$servername = "localhost";
$usernameDB = "";
$passwordDB = "";

//set user and password to values from form
//md5 can be used to hash
if ( isset($_POST['username']) && isset($_POST['password']) ) { 
	$user = $_POST['username']; 
	$pass = $_POST['password']; 
} else {
	echo "The values weren't sent";
}

//connect to the database
$connection = new mysqli($servername, $usernameDB, $passwordDB);

//Check if the connection was successful
if($connection->connect_error){
	die("Connection to the database failed: " . $connection->connect_error);
} 

//once the DB is connected, get information from the DB to check the records against the data entered
$sqlUser = "SELECT `username`FROM `user` WHERE `username`=\"$user\"";
$sqlPass = "SELECT `password`FROM `user` WHERE `password`=\"$pass\"";
$resultUser = mysqli_query($connection, $sqlUser);
$resultPass = mysqli_query($connection, $sqlPass);

echo $resultUser;
echo $resultPass;

//check if the user and password match records in the database
if($user == $resultUser && $pass == $resultPass){

	//open the calendar if they match
	echo "<script> window.location.assign('../calendar.php'); </script>";
} else{
	echo "yeet";
	echo $resultUser;
	echo $resultPass;
	//if the DB check of records fails, do this
	echo "The data entered has no match.";
}

