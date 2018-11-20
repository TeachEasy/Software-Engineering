<?php include'includes/header.php';

	//set up the database 
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$nameDB = "teacheasy";
	//connect to the database
	$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);


    $sqlListStudents = "SELECT CONCAT(last_name,', ',first_name) AS 'StudentName',student_id FROM `students` WHERE teacher_id='" . $_SESSION['userId'] . "' ORDER BY last_name ASC;";
    $resultListStudents = mysqli_query($connection, $sqlListStudents) or die("Bad Query: $sqlListStudents"); 
    echo "<form method='get'>";
	echo"<table>";
	echo"<tr>
			<td><b>Mark Today's Absesences Only</b></td>
	     </tr>";
	$nameCount = 0;
	while($row = mysqli_fetch_assoc($resultListStudents)){

		//naming these students allows them to be put into a list
		echo"<tr><td><input type='checkbox' name='students[]' value='{$row['student_id']}'>{$row['StudentName']}</td></tr>";
	
	}
	echo "</table>";
	echo "<button type='submit' name='submitAbsences' class='navButton'>Submit Absences</button>";
	echo "</form>";
	$today = date("Y/m/d");

	if(isset($_GET['submitAbsences'])){
		$name = $_GET['students'];

		foreach ($name as $students) {
			$queryAdd = "INSERT INTO `absences` (`student_id`, `date_absence`) VALUES ('".$students."','".$today."');";
			$queryCheck = "SELECT student_id, date_absence FROM `absences` WHERE student_id='". $students."' AND date_absence='".$today."'";
			$runCheck = mysqli_query($connection, $queryCheck);
			if(mysqli_num_rows($runCheck) ==0 ){
				if(mysqli_query($connection, $queryAdd)){ 
				    echo "<script>alert('Success, attendance was taken for today!');</script>";
					echo "<script>window.location.assign('attendance.php'); </script>"; 
				}  
				else{ 
				    echo "<script>alert('Something went wrong.');</script>";
				}
			} else{
				echo "<script>alert('One or more of the students selected has already been marked absent today.');</script>";
			}
		}
	}
?>
<button class="navButton" onclick="window.location.href='attendance.php'">Check Absences</button>
