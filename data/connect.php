<?php

/*Login handled here*/
session_start();

//these will be changed once we set up the database
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$nameDB = "teacheasy";

//set user and password to values from form
//md5 can be used to hash
if ( isset($_POST['username']) && isset($_POST['password']) ) { 
	$user = $_POST['username']; 
	$pass = $_POST['password']; 
} else {
	echo "The values weren't sent";
}

//connect to the database
$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

//Check if the connection was successful
if($connection->connect_error){
	die("Connection to the database failed: " . $connection->connect_error);
} 

//once the DB is connected, get information from the DB to check the records against the data entered
$sqlUser = "SELECT `teacher_username` FROM `teacher` WHERE `teacher_username`='$user'";
$sqlPass = "SELECT `password` FROM `teacher` WHERE `password`='$pass'";
$resultUser = mysqli_query($connection, $sqlUser);
$resultPass = mysqli_query($connection, $sqlPass);
$textUser = $resultUser->fetch_assoc();
$textPass = $resultPass->fetch_assoc();


//check if the user and password match records in the database
if($user == $textUser['teacher_username'] && $pass == $textPass['password']){
	//open the calendar if they match
	echo "<script> window.location.assign('../calendar.php'); </script>";
} else{
	//set this up to load a log in failed page rather than a blank page with error message
	$row = $resultUser->fetch_assoc();
	echo "{$row['teacher_username']}";

	$row2 = $resultPass->fetch_assoc();
	echo "{$row2['password']}";
	//if the DB check of records fails, do this
	echo "The data entered has no match.";
}

