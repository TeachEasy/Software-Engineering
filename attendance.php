<?php include 'includes/header.php';?>
<html>
	<body>

	<?php 
	//WE SHOULD REALLY BE USING PREPARED STATEMENTS FOR THIS FOR SECURITY, BUT FOR TESTING PURPOSES THIS IS OKAY

	//set up the database 
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$nameDB = "teacheasy";
	//connect to the database
	$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

	$sql = "SELECT s.last_name,s.first_name, group_concat(a.date_absence) AS 'DatesAbsent', COUNT(a.student_id) AS 'TotalAbsent' \n"
    . "FROM `students` s JOIN `absences` a ON s.student_id = a.student_id \n"
    . "WHERE s.teacher_id='" . $_SESSION['userId'] . "'GROUP BY s.student_id";

	$result = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 
	
	echo"<table>";
	echo"<tr>
			<td><b>FirstName</b></td>
			<td><b>LastName</b></td>
			<td><b>TotalAbsent</b></td>
			<td><b>DatesAbsent</b></td>
		</tr>";
	$result = mysqli_query($connection, $sql);
	$row = mysqli_fetch_assoc($result);
	while($row = mysqli_fetch_assoc($result)){
		echo"<tr><td>{$row['first_name']}</td><td>{$row['last_name']}</td><td>{$row['TotalAbsent']}</td><td>{$row['DatesAbsent']}</td></tr>";
	}

	?>

	</body>
</html>