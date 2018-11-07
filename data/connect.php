<?php
/*Login handled here*/
session_start();

//set up the database 
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "";
$nameDB = "teacheasy";

//use this to tell if they're already logged in
$_SESSION['loggedIn'] = "0";

//set user and password to values from form
if ( isset($_POST['username']) && isset($_POST['password']) ) { 
	$_SESSION['user'] = $_POST['username'];
	$pass = $_POST['password'];
} else {
	echo "The values weren't sent";
}

//connect to the database
$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

//Check if the connection was successful
if($connection->connect_error){
	die("Connection to the database failed: " . $connection->connect_error);
} else {
	//once the DB is connected, get information from the DB to check the records against the data entered
	$sqlUser = "SELECT `teacher_username` FROM `teacher` WHERE `teacher_username`= '{$_SESSION['user']}'";
	$sqlPass = "SELECT `password` FROM `teacher` WHERE `password`='$pass'";
	$resultUser = mysqli_query($connection, $sqlUser);
	$resultPass = mysqli_query($connection, $sqlPass);
	$textUser = $resultUser->fetch_assoc();
	$textPass = $resultPass->fetch_assoc();

	

	//check if the user and password match records in the database
	if($_SESSION['user'] == $textUser['teacher_username'] && $pass == $textPass['password']){
		//get first name and last name to populate the user
		$sqlUserFirstName = "SELECT `first_name` FROM `teacher` WHERE `teacher_username`='{$_SESSION['user']}'";
		$sqlUserLastName = "SELECT `last_name` FROM `teacher` WHERE `teacher_username`='{$_SESSION['user']}'";
		$sqlUserId = "SELECT `teacher_id` FROM `teacher` WHERE `teacher_username`='{$_SESSION['user']}'";

		$resultUserFirstName = mysqli_query($connection, $sqlUserFirstName);
		$resultUserLastName = mysqli_query($connection, $sqlUserLastName);
		$resultUserId = mysqli_query($connection, $sqlUserId);

		$_SESSION['userFirstName'] = $resultUserFirstName->fetch_assoc()['first_name'];
		$_SESSION['userLastName'] = $resultUserLastName->fetch_assoc()['last_name'];
		$_SESSION['userId'] = $resultUserId->fetch_assoc()['teacher_id'];

		//set session log in to 1 if the log in was sucessful
		$_SESSION['loggedIn'] = "1";

		//open the calendar if they match
		echo "<script> window.location.assign('../calendar.php'); </script>";
	} else{
		//ADD A WAY TO TELL THE USER THE LOGIN FAILED.
		echo "<script>alert('Login Failed. Try Again.')</script>";
		echo "<script> window.location.assign('../index.php'); </script>";

	}

}


