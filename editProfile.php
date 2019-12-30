<?php
 include("dbConnection.php");

 session_start();
$userid = $_SESSION["userId"];


	$first_name = mysqli_real_escape_string($conn, $_REQUEST['first_name']);
	$last_name = mysqli_real_escape_string($conn, $_REQUEST['last_name']);
	$age = mysqli_real_escape_string($conn, $_REQUEST['age']);
	$password = mysqli_real_escape_string($conn, $_REQUEST['password']);
	$address = mysqli_real_escape_string($conn, $_REQUEST['address']);
	$phone = mysqli_real_escape_string($conn, $_REQUEST['phone']);


	$sql = "UPDATE user SET first_name='$first_name',
	last_name = '$last_name' , 
	age = '$age',
	password = '$password'
	 WHERE userid='$userid'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "user table updated successfully."; 
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}

	$sql = "UPDATE contact_info SET address='$address',
	phone_no = '$phone' 
	 WHERE user_id='$userid'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "contact_info table updated successfully."; 
					    header('location:dashboard.php');
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}


?>