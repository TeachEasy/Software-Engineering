<?php
session_start();
//Check to see if someone is logged in
if($_SESSION['loggedIn'] != "1"){
	echo "<script> window.location.assign('index.php'); </script>";
}

?>
<br>
<!DOCTYPE html>
<html>
<head>
	<title>Teach Easy</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="teachEasyStyle.css">
</head>

<body>
	<div class="colorNav">
	<div class="container-fluid">
		<p id="logoText">Teach Easy</p>
		<p id="userInfo"><?php echo $_SESSION['userFirstName']; echo " "; echo $_SESSION['userLastName']?></p><!--this needs some JS to return the user from a query-->
		<button id="logoutButton" onclick="window.location.href='data/logout.php'">Log Out</button>
	</div>
	<div class="container-fluid">
		<hr>
	  	<nav class="navbar">
			<button class="navButton" onclick="window.location.href='calendar.php'">Calendar</button>
			<button class="navButton" onclick="window.location.href='attendance.php'">Attendance</button>

			<select class="navButton" onchange="location = this.options[this.selectedIndex].value;" style="width: 160px;">
				<option selected disabled>Grade Book</option>
				<option value='english.php'>English</option>
				<option value='math.php'>Math</option>
				<option value='science.php'>Science</option>
				<option value='socialstudies.php'>Social Studies</option>
			</select>		
	  	</nav>
	  	<hr>
	</div>
	</div>
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>