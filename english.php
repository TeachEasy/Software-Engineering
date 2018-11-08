<?php include 'includes/header.php';?>
<html>
	<body>
	<?php
		//SELECT s.first_name,s.last_name,g.grade, a.assignment_name FROM `grades` g JOIN `students` s ON s.student_id = g.student_id JOIN `assignments` a ON a.assignment_id=g.assignment_id

		$servername = "localhost";
		$usernameDB = "root";
		$passwordDB = "";
		$nameDB = "teacheasy";
		//connect to the database
		$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);


		//this section creates the column headers
		$sqlAssignment = "SELECT DISTINCT assignment_name FROM assignments WHERE teacher_id='" . $_SESSION['userId'] . "' AND subject_id = '2';";
		$resultAssignment = mysqli_query($connection, $sqlAssignment) or die("Bad Query: $sqlAssignment"); 
		echo"<table>";
		$resultAssignemnt = mysqli_query($connection, $sqlAssignment);

		echo "<tr>";
		echo "<td><b>Students</b></td>";
		while($row = mysqli_fetch_assoc($resultAssignment)){
			echo"<td><b>{$row['assignment_name']}</b></td>";
		}
		echo "</tr>";

		$sql = "SELECT CONCAT(s.last_name, ', ',s.first_name) AS 'Student Name',g.grade FROM `grades` g JOIN assignments a ON a.assignment_id=g.assignment_id JOIN teacher t ON t.teacher_id=a.teacher_id JOIN students s ON s.student_id=g.student_id WHERE a.teacher_id='" . $_SESSION['userId'] . "' AND a.subject_id='2' ORDER BY s.last_name ASC";
		$sqlCount = "SELECT DISTINCT COUNT(assignment_name) FROM `assignments` WHERE subject_id = '2' AND teacher_id= '" . $_SESSION['userId'] . "';";

		$result = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 

		//gets the number of assignments so it can display the table
		$resultCount = mysqli_query($connection, $sqlCount);
		$countNum = $resultCount->fetch_assoc();
		$counter = 0;

		//this loops through the data and outputs it to the table
		echo "<tr>";
		while($row2 = mysqli_fetch_assoc($result)){
			if($counter == 0){
				echo"<td>{$row2['Student Name']}</td>";
				$counter++;
			} else if($counter <= $countNum['COUNT(assignment_name)']){
				echo"<td>{$row2['grade']}</td>";
				$counter++;
			} else{	
				$counter = 0;
				echo"</tr>";
			}
		}
		echo "</table>";
	?>

	</body>
</html>