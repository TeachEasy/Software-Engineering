<?php include 'includes/header.php';?>
<html>
	<body>
	<?php
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
		echo "<tr>";
		echo "<td><b>Students</b></td>";
		while($row = mysqli_fetch_assoc($resultAssignment)){
			echo "<td><b>{$row['assignment_name']}</b></td>";
		}
		echo "<td><div  id='newAssignmentName' contenteditable='true' placeholder='Add Assignment Name'></div></td>";
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

		//add code to number the id for each contenteditable, use https://www.reddit.com/r/webdev/comments/4ga0ug/how_to_save_and_retrieve_contenteditable_data/ to figure out how to get the data from the contenteditables
		$counter = 0;
		while($row2 = mysqli_fetch_assoc($result)){
		    if($last_stud != $row2['Student Name']){

		        // close previous <tr>
		        if ( $last_stud !== null ) {
		        	echo "<td><div id='enter".$counter."' contenteditable='true' placeholder='".$last_stud."' data-toggle='tooltip' data-placement='left' title='Enter Grades Here'></div></td>";
		            echo "</tr>";
		        }

		        $last_stud = $row2['Student Name'];
		        echo"<tr><td>{$row2['Student Name']}</td>";
		        echo"<td>{$row2['grade']}</td>";
		        $counter++;
		    } else {
		        echo"<td>{$row2['grade']}</td>";
		    }
		}
		echo "<td><div id='enter".$counter."' contenteditable='true' placeholder='".$last_stud."'></div></td>";
		echo '</tr>';
		echo "<button class='navButton' id='submitNewAssignment' style='float:right'>Submit New Assignment</button>";


		//THIS SECTION IS WHERE THE NEW ASSIGNMENT IS CREATED
		if(isset($_POST['submitNewAssignment'])){
			$name = $_POST['students'];

			//check if title isset
			if(isset($_POST['newAssignmentName'])){
				$assignmentName = $_POST['newAssignmentName'];

				foreach ($name as $students) {
					$queryAdd = "INSERT INTO assignments(subject_id,assignment_name,teacher_id) VALUES ('2',".$assignmentName.",".$_SESSION['userId'].")";
					
					if(mysqli_query($connection, $queryAdd)){ 
					    echo "<script>alert('Success, the new assignment was added!');</script>";
						echo "<script>window.location.assign('english.php'); </script>"; 
					}  
					else{ 
					    echo "<script>alert('Something went wrong.');</script>";
					}
				}
			} else{
				echo "<script>alert('No assignment title was added.')</script>";
			}

			
	}
	?>

	</body>
</html>