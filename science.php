<?php include 'includes/header.php';?>
<html>
	<body>
		<!-- Modal for remove an absence -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">

		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add New Assignment</h4>
		      	</div>
		      	<div class="modal-body">
		      	
		        <form id="insert_form" method="post">
		        	<section class="container-fluid">
			      		<div class="leftColumn">
			      			<p>Assignment Name: <input type="text" name="newAssignmentName"><br></p>
			      			<?php
			      				$servername = "localhost";
								$usernameDB = "root";
								$passwordDB = "";
								$nameDB = "teacheasy";
								//connect to the database
								$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB); 		
			      				$sqlListStudents = "SELECT CONCAT(last_name,', ',first_name) AS 'StudentName',student_id FROM `students` WHERE teacher_id='" . $_SESSION['userId'] . "' ORDER BY last_name ASC;";
    							$resultListStudents = mysqli_query($connection, $sqlListStudents) or die("Bad Query: $sqlListStudents"); 
    							echo "<form method='post'>";
								echo"<table>";
								
								$countIdStudents = 0;
								while($row = mysqli_fetch_assoc($resultListStudents)){

									//naming these students allows them to be put into a list
									echo"<tr style='border:none;'><td><input  id='studentNum".$countIdStudents."' type='text' name='students[]' value='0' style='width:40px;'>{$row['StudentName']}</td></tr>";
								}
								echo "</table>";
								echo "<button type='submit' name='submitNewAssignment' class='navButton'>Submit New Assignment</button>";
								echo "</form>";

			      			?>
			      		</div>
			      	</section>
		        </form>	     
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="navButton" data-dismiss="modal">Close</button>
		      </div>
		      <?php 

				$sqlListStudents = "SELECT CONCAT(last_name,', ',first_name) AS 'StudentName',student_id FROM `students` WHERE teacher_id='" . $_SESSION['userId'] . "' ORDER BY last_name ASC;";
    			$resultListStudents = mysqli_query($connection, $sqlListStudents) or die("Bad Query: $sqlListStudents"); 
    			$doc = new DomDocument;
				if (isset($_POST['submitNewAssignment'])){
					$name = $_POST['students'];
					$newAssignmentName = $_POST["newAssignmentName"];


					echo "SUBMIT SET";
					//THIS IF WORKS
					if(empty($newAssignmentName)){
						echo "<script>alert('New Assignment Name not set')</script>";
					} else {
						echo "<script>alert('Else entered')</script>";
						$sqlNewAssignmentName = "INSERT INTO assignments(subject_id,assignment_name,teacher_id) VALUES ('3',".$newAssignmentName.",".$_SESSION['userId'].")";
						$forCount = 0;
						mysqli_query($connection, $sqlNewAssignmentName) or die("Bad Query: $sqlNewAssignmentName");
						
						//for loop is broken
						foreach ($name as $students) {
							echo "<script>alert('for ran')</script>";
							$grade = $doc->getElementById("studentNum".$forCount);
							$studentList= mysqli_fetch_assoc($resultListStudents);
							$sqlSelectGradebook = "INSERT INTO grades(student_id,grade,gradebook_id) 
								VALUES(".$students.",".$grade.",
								(SELECT gradebook_id FROM gradebooks 
								 WHERE teacher_id=".$_SESSION['userId']." AND gradebook_title='Language Arts'))";
							mysqli_query($connection, $sqlSelectGradebook) or die("Bad Query: $sqlSelectGradebook");
							echo "for loop stuck";
						}
						echo "<script>alert('The grades were added.')</script>";
					} 
				}			
		      ?>
		    </div>
		  </div>
		</div>
	<?php
		$sqlAssignment = "SELECT DISTINCT assignment_name FROM assignments WHERE teacher_id='" . $_SESSION['userId'] . "' AND subject_id = '3';";
		$resultAssignment = mysqli_query($connection, $sqlAssignment) or die("Bad Query: $sqlAssignment"); 
		//this section creates the column headers
		echo "<button type='button' class='navButton' data-toggle='modal' data-target='#myModal'>Add New Assignment</button>";
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
	?>

	</body>
</html>