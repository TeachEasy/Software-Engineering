<!DOCTYPE html>
<html>
<head>
	<title>Teach Easy</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="teachEasyStyle.css">
</head>

<body>
	<div class="container-fluid">
		
		<p id="logoText">Teach Easy</p>
		<p id="userInfo">User: </p><!--this needs some JS to return the user from a query-->
		<button id="logoutButton">Log Out</button>
		
	</div>
	<div class="container-fluid">
		<hr>
	  	<nav class="navbar">
			<button id="navButton">Calendar</button>
			<button id="navButton">Attendance</button>
			<div class="dropdown">
			<button class="btn dropdown-toggle" id="navButton" data-toggle="dropdown">Gradebook<span class="caret"></span></button>
			  	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	<li><a class="dropdown-item" href="#">English</a></li>
				  	<li><a class="dropdown-item" href="#">Math</a></li>
				    <li><a class="dropdown-item" href="#">Science</a></li>
				    <li><a class="dropdown-item" href="#">Social Studies</a></li>
			  	</ul>
			</div>
	  	</nav>
	  	<hr>
	</div>
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>