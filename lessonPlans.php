<?php include 'includes/header.php';?>

<html>

	<body>
		<link rel="stylesheet" href="teachEasyStyle.css">
		<div class="modal-body">
	      	
	        <form id="insert_form" method="post">
	        	<section class="container-fluid">
		      		
		      		<div class="centerColumn">
		      			<?php 
	//WE SHOULD REALLY BE USING PREPARED STATEMENTS FOR THIS FOR SECURITY, BUT FOR TESTING PURPOSES THIS IS OKAY

	//THE RECORDS CAN BE DELETED, THE ISSETS DO NOT WORK, I DONT KNOW WHY
	//LINES 85-107
	echo '<link rel="stylesheet" href="teachEasyStyle.css">';

	//set up the database 
	$servername = "localhost";
	$usernameDB = "root";
	$passwordDB = "";
	$nameDB = "teacheasy";

	//connect to the database
	$connection = new mysqli($servername, $usernameDB, $passwordDB, $nameDB);

	//Create lesson plan based on lesson plan id
	$sql = "SELECT *From lesson_plans WHERE lesson_plan_id = 1";

	$result = mysqli_query($connection, $sql) or die("Bad Query: $sql"); 

	
	//displays the lesson plan
	while($row = mysqli_fetch_assoc($result)){
		print" 	<div class =\".leftColumn\"></div><b>Title:</b>  {$row['lesson_plan_title']} <br><br>
				<b>Date:</b> {$row['date_executed']} <br><br> 
				<b>Objectives:</b> {$row['objectives']} <br><br> 
				<b>Information:</b> {$row['information']} <br><br> 
				<b>Procedure:</b> {$row['procedure']} <br><br> 
				<b>Student Instructions:</b> {$row['student_instructions']} <br><br> 
				<b>Resources:</b> {$row['resources']} <br><br> 
				<b>State Standards:</b> {$row['state_standards']} <br><br> 
				<b>Notes:</b> {$row['notes']} <br>";
	
	}
    ?>
		      		
		      	</section>
		      	


	        </form>	     
	      </div>
	
	

	</body>
</html>