<?php include'includes/header.php';

	//set up the database 
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$nameDB = "teacheasy";
	//connect to the database
	$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);


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
	echo "<button type='submit' name='submitAbsences' class='navButton'>Submit Absences</button>";
	echo "</form>";
?>
<button class="navButton" onclick="window.location.href='attendance.php'">Check Absences</button>
