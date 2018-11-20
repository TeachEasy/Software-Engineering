<?php include'includes/header.php';

	//set up the database 
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$nameDB = "teacheasy";
	//connect to the database
	$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

	$todayYear = date("Y");
	$todayMonth = date("m");
	$todayDay = date("d");
    $sqlListStudents = "SELECT CONCAT(last_name,', ',first_name) AS 'StudentName',student_id FROM `students` WHERE teacher_id='" . $_SESSION['userId'] . "' ORDER BY last_name ASC;";
    $resultListStudents = mysqli_query($connection, $sqlListStudents) or die("Bad Query: $sqlListStudents"); 
    echo "<form method='post'>";
	echo"<table>";
	echo"<tr>
			<td><b>Date: <input type='text' name='yearTakeAttendance' placeholder='Year' value='".$todayYear."' style='width: 60px;'>
		        		<input type='text' name='monthTakeAttendance' placeholder='Month' value='".$todayMonth."' style='width: 60px;'>
		        		<input type='text' name='dayTakeAttendance' placeholder='Day' value='".$todayDay."' style='width: 60px;'></b></td>
	     </tr>";
	$nameCount = 0;
	while($row = mysqli_fetch_assoc($resultListStudents)){

		//naming these students allows them to be put into a list
		echo"<tr><td><input type='checkbox' name='students[]' value='{$row['student_id']}'>{$row['StudentName']}</td></tr>";
	
	}
	echo "</table>";
	echo "<button type='submit' name='submitAbsences' class='navButton'>Submit Absences</button>";
	echo "</form>";

	if(isset($_POST['submitAbsences'])){
		$name = $_POST['students'];
		if(isset($_POST['yearTakeAttendance']) && isset($_POST['monthTakeAttendance']) && isset($_POST['dayTakeAttendance'])){
			$todaysDate = $_POST['yearTakeAttendance']."-".$_POST['monthTakeAttendance']."-".$_POST['dayTakeAttendance'];
		} else{
			echo "<script>alert('Enter a date to take attendance')</script>";
		}

		foreach ($name as $students) {
			$queryAdd = "INSERT INTO `absences` (`student_id`, `date_absence`) VALUES ('".$students."','".$todaysDate."');";
			$queryCheck = "SELECT student_id, date_absence FROM `absences` WHERE student_id='". $students."' AND date_absence='".$todaysDate."'";
			$runCheck = mysqli_query($connection, $queryCheck);
			if(mysqli_num_rows($runCheck) == 0){
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
