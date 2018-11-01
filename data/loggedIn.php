<?php 
//Check to see if someone is logged in
session_start();
if($_SESSION['loggedIn'] != "1"){
	echo "<script> window.location.assign('../index.php'); </script>";
}

?>