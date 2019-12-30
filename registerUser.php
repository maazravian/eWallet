<?php 

    include("dbConnection.php");


    $first_name = mysqli_real_escape_string($conn, $_REQUEST['firstName']);
	$last_name = mysqli_real_escape_string($conn, $_REQUEST['lastName']);
	$email = mysqli_real_escape_string($conn, $_REQUEST['email']);
	$pass = mysqli_real_escape_string($conn, $_REQUEST['pass']);
	$confirmPass = mysqli_real_escape_string($conn, $_REQUEST['confirmPass']);
	$age = mysqli_real_escape_string($conn, $_REQUEST['age']);

	if($pass!=$confirmPass)
	{
		echo "<br><h1>Password and Confirm Password does not match...</h1>";
	}
	else
	{


  		$sql = "SELECT email FROM contact_info where email = '$email'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			echo "<br><h1>User with this email already exists.<h1>";								      
   		 }
		} else {
		    
		$newUserId = 0;
		$sql1 = "INSERT INTO user (first_name, last_name, password,age,date_joined,balance,is_retailer) VALUES ('$first_name', '$last_name', '$pass','$age',curdate(),0,'NO');";

		if(mysqli_query($conn, $sql1)){
		    echo "user added successfully.";
		    
		} else{
		    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
		}

		$sql = "SELECT userid FROM user order by userid desc limit 1";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			$newUserId = $row["userid"];								      
   		 }
		}
		echo $newUserId;

		

		$sql2 = "	INSERT INTO contact_info ( user_id,email) VALUES ('$newUserId' , '$email' );";
		
		if(mysqli_query($conn, $sql2)){
			    echo "contact_info added successfully.";
			} else{
			    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
			}
		
		header('location:login.php');

	}

		


	   
		 
		// Close connection
		mysqli_close($conn);
	}
 ?>