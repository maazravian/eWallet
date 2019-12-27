<?php    
include("dbConnection.php");

 	$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
	$price = mysqli_real_escape_string($conn, $_REQUEST['price']);
	$description = mysqli_real_escape_string($conn, $_REQUEST['description']);
	


$sql1 = "INSERT INTO item (name, description, price) VALUES ('$name', '$description', '$price');";
		
		if(mysqli_query($conn, $sql1)){
		    echo "item added successfully.";
		   
		   header('location:dashboardAdmin.php');

		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}


?>