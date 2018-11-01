<?php 
session_start();
?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="teachEasyStyle.css">
</head>
<body class="loginBackground">
	<div class="login">
		<h1>Teach Easy</h1>
	</div>	

	<div class="container">
		<div class="loginForm">
			<h1 id="loginLabel">LOGIN</h1>
			<form method="post" action="data/connect.php">
				<!-- this only works if it gets clicked on the right...no idea why-->
				<input type="text" name="username" placeholder="Username" id="inputs">
				<input type="password" name="password" placeholder="Password" id="inputs">
				<input type="submit" name="submitLogin" value="Submit" id="submitButton">
			</form>
		</div>	
	</div>
</body>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>