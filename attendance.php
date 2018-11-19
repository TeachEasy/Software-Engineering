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


	//Create table of students based on teacher
	$sql = "SELECT s.student_id, CONCAT(s.last_name,', ',s.first_name) AS 'StudentName', group_concat(a.date_absence) AS 'DatesAbsent', COUNT(a.student_id) AS 'TotalAbsent' \n"
    . "FROM `students` s JOIN `absences` a ON s.student_id = a.student_id \n"
    . "WHERE s.teacher_id='" . $_SESSION['userId'] . "'GROUP BY s.student_id \n"
    . "ORDER BY s.last_name ASC;";

	$result = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 
	
	echo"<table>";
	echo"<tr>
			<td><b>Student ID</b></td>
			<td><b>Student Name</b></td>
			<td><b>Total Absent</b></td>
			<td><b>Dates Absent</b></td>
		</tr>";

	while($row = mysqli_fetch_assoc($result)){
		echo"<tr><td>{$row['student_id']}</td><td>{$row['StudentName']}</td><td>{$row['TotalAbsent']}</td><td>{$row['DatesAbsent']}</td></tr>";
	}
 
    ?>



	<!--ADD CSS TO MAKE THESE BUTTONS MATCH THE FORMATTING -->
    <button class="navButton" onclick="window.location.href='absences.php'">Take Attendance</button>
    <!-- Trigger the modal with a button -->
	<button type="button" class="navButton" data-toggle="modal" data-target="#myModal">Remove Absence</button>
	<button type="button" class="navButton" data-toggle="modal" data-target="#singleAddModal">Add Single Past Absence</button>





	<!-- Modal for remove an absence -->
	<div id="myModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	        	<h4 class="modal-title">Remove Absence</h4>
	      	</div>
	      	<div class="modal-body">
	      	
	        <form id="insert_form" method="post">
	        	<section class="container-fluid">
		      		<div class="leftColumn">
		      			<label>Student ID: </label><br>
		      			<label>Date: </label>
		      		</div>
		      		<div class="rightColumn">
		        		<input type="text" name="studentidRemoveAbs" placeholder="Student ID"><br>
		        		<input type="text" name="yearRemove" placeholder="Year" value="2018" style="width: 60px;">
		        		<input type="text" name="monthRemove" placeholder="Month" style="width: 60px;">
		        		<input type="text" name="dayRemove" placeholder="Day" style="width: 60px;">
		      		</div>
		      	</section>
		      	<input type="submit" name='submitRemoveButton' class='navButton' value='Remove Absence' id="submitRemoveButton">
	        </form>	     
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="navButton" data-dismiss="modal">Close</button>
	      </div>
	      <?php 
			if (isset($_POST['submitRemoveButton'])){
				$studentID = $_POST["studentidRemoveAbs"];
				$year = $_POST["yearRemove"];
				$month = $_POST["monthRemove"];
				$day = $_POST["dayRemove"];
				$date = $year."-".$month."-".$day;

				//this chain of if statements is broken in the isset. IDK why
				if(empty($studentID)){
					echo "<script>alert('Student ID not set')</script>";
					
				} else if(empty($year)){
					echo "<script>alert('Year not set')</script>";
					
				} else if(empty($month)){
					echo "<script>alert('Month not set')</script>";
					
				} else if(empty($day)){
					echo "<script>alert('Day not set')</script>";
					
				} else if(isset($studentID) && isset($year) && isset($month) && isset($day)){
					$query = "DELETE FROM `absences` WHERE student_id='". $studentID ."' AND date_absence = '". $date."';";
  
					if($connection === false){ 
					    die("ERROR: Could not connect. " . mysqli_connect_error()); 
					} 
					  
					if(mysqli_query($connection, $query)){ 
					    echo "<script>alert('Success, the record was deleted');</script>";
						echo "<script> window.location.assign('attendance.php'); </script>"; 
					}  
					else{ 
					    echo "<script>alert('No record was found.');</script>";
					} 
					
				} 
			}			
	      ?>
	    </div>
	  </div>
	</div>

	<!--MODAL FOR ADDING A SINGLE PAST ABSENCE-->
	<div id="singleAddModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Past Absence</h4>
		      	</div>
		      	<div class="modal-body">
			        <form id="insert_formAdd" method="post">
			        	<section class="container-fluid">
				      		<div class="leftColumn">
				      			<label>Student ID: </label><br>
				      			<label>Date: </label>
				      		</div>
				      		<div class="rightColumn">
				        		<input type="text" name="studentidAdd" placeholder="Student ID"><br>
				        		<input type="text" name="yearAdd" placeholder="Year" value="2018" style="width: 60px;">
				        		<input type="text" name="monthAdd" placeholder="Month" style="width: 60px;">
				        		<input type="text" name="dayAdd" placeholder="Day" style="width: 60px;">
				      		</div>
				      	</section>
				      	<input type="submit" name='submitAddButton' class='navButton' value='Add Absence' id="submitAddButton">
			        </form>	     
		      	</div>
			    <div class="modal-footer">
			    	<button type="button" class="navButton" data-dismiss="modal">Close</button>
			    </div>
			    <?php
					if (isset($_POST['submitAddButton'])){
						$studentIDadd = $_POST["studentidAdd"];
						$yearAdd = $_POST["yearAdd"];
						$monthAdd = $_POST["monthAdd"];
						$dayAdd = $_POST["dayAdd"];
						$dateAdd = $yearAdd."-".$monthAdd."-".$dayAdd;

						//this chain of if statements is broken. IDK why
						if(empty($_POST["studentidAdd"])){
							echo "<script>alert('Student ID not set')</script>";
							
						} else if(empty($_POST["yearAdd"])){
							echo "<script>alert('Year not set')</script>";
							
						} else if(empty($_POST["monthAdd"])){
							echo "<script>alert('Month not set')</script>";
							
						} else if(empty($_POST["dayAdd"])){
							echo "<script>alert('Day not set')</script>";	

						} else if(isset($studentIDadd) && isset($yearAdd) && isset($monthAdd) && isset($dayAdd)){
							$queryCheck = "SELECT student_id, date_absence FROM `absences` WHERE student_id='". $studentIDadd."' AND date_absence='".$dateAdd."'";
							$queryAdd = "INSERT INTO `absences` (`student_id`, `date_absence`) VALUES ('".$studentIDadd."','".$dateAdd."');";
							$runCheck = mysqli_query($connection, $queryCheck);
							if(mysqli_num_rows($runCheck) ==0 ){
								if(mysqli_query($connection, $queryAdd)){ 
								    echo "<script>alert('Success, the record was added');</script>";
									echo "<script>window.location.assign('attendance.php'); </script>"; 
								}  
								else{ 
								    echo "<script>alert('The record already exists, or was entered improperly. Only enter numbers in the boxes.');</script>";
								}
							} else{
								echo "<script>alert('The record already exists.');</script>";
							}
							mysqli_close($connection);
						}	
					}
				?>
		    </div>
		</div>		
	</div>
	</body>
</html>