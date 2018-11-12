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

	$sql = "SELECT CONCAT(s.last_name,', ',s.first_name) AS 'StudentName', group_concat(a.date_absence) AS 'DatesAbsent', COUNT(a.student_id) AS 'TotalAbsent' \n"
    . "FROM `students` s JOIN `absences` a ON s.student_id = a.student_id \n"
    . "WHERE s.teacher_id='" . $_SESSION['userId'] . "'GROUP BY s.student_id \n"
    . "ORDER BY s.last_name ASC;";

	$result = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 
	
	echo"<table>";
	echo"<tr>
			<td><b>Student Name</b></td>
			<td><b>Total Absent</b></td>
			<td><b>Dates Absent</b></td>
		</tr>";

	while($row = mysqli_fetch_assoc($result)){
		echo"<tr><td>{$row['StudentName']}</td><td>{$row['TotalAbsent']}</td><td>{$row['DatesAbsent']}</td></tr>";
	}
	
	
    $sqlListStudents = "SELECT CONCAT(last_name,', ',first_name) AS 'StudentName' FROM `students` WHERE teacher_id='" . $_SESSION['userId'] . "' ORDER BY last_name ASC;";
    $resultListStudents = mysqli_query($connection, $sqlListStudents) or die("Bad Query: $sqlListStudents"); 
    echo "<form method='post'>";
	echo"<table>";
	echo"<tr>
			<td><b>Mark Today's Absesences Only</b></td>
	     </tr>";
	$nameCount = 0;
	while($row = mysqli_fetch_assoc($resultListStudents)){
		echo"<tr><td><input type='checkbox' name='student". $nameCount ."'>{$row['StudentName']}</td></tr>";
		$nameCount++;
	}
	echo "</table>";
	echo "<button type='submit' name='submitAbsences'>Submit Absences</button>";
	echo "</form>";

    ?>
    
	</body>
</html>