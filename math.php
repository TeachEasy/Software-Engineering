<html>
	<body>
	<?php include 'includes/header.php';
		$servername = "localhost";
		$usernameDB = "root";
		$passwordDB = "";
		$nameDB = "teacheasy";
		//connect to the database
		$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

		//this section creates the column headers
		$sqlAssignment = "SELECT DISTINCT assignment_name FROM assignments WHERE teacher_id='" . $_SESSION['userId'] . "' AND subject_id = '1';";
		$resultAssignment = mysqli_query($connection, $sqlAssignment) or die("Bad Query: $sqlAssignment"); 
		echo"<table>";

		echo "<tr>";
		echo "<td><b>Students</b></td>";
		while($row = mysqli_fetch_assoc($resultAssignment)){
			echo"<td><b>{$row['assignment_name']}</b></td>";
		}
		echo "</tr>";

		//this fills the table with the student information and grades
		$sql = "SELECT CONCAT(s.last_name, ', ',s.first_name) AS 'Student Name',g.grade 
        FROM `grades` g 
            JOIN assignments a ON a.assignment_id=g.assignment_id 
            JOIN teacher t ON t.teacher_id=a.teacher_id 
            JOIN students s ON s.student_id=g.student_id 
        WHERE a.teacher_id='" . $_SESSION['userId'] . "' 
        AND a.subject_id='2' 
        ORDER BY s.last_name,s.first_name ASC";

		$result = mysqli_query($connection, $sql); 

		$last_stud = null;

		while($row2 = mysqli_fetch_assoc($result)){
		    if($last_stud != $row2['Student Name']){

		        // close previous <tr>
		        if ( $last_stud !== null ) {
		            echo '</tr>';
		        }

		        $last_stud = $row2['Student Name'];
		        echo"<tr><td>{$row2['Student Name']}</td>";
		        echo"<td>{$row2['grade']}</td>";
		    } else {
		        echo"<td>{$row2['grade']}</td>";
		    }
		}
		echo '</tr>';
	?>

	</body>
</html>