<?php    
 include("dbConnection.php");
session_start();
$userid = $_SESSION["userId"];
	

	$transactionIdTobeInserted;
	$recieverUserID;

	$recieverEmail = mysqli_real_escape_string($conn, $_REQUEST['recieverEmail']);
	$amount = mysqli_real_escape_string($conn, $_REQUEST['amount']);

	$sql = "SELECT balance FROM user where userid = '$userid'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			if($row["balance"]<$amount)
			{
				echo "<br><h1>Your balance is not enough for this transfer..</h1>";
			}
			else
			{

				$sql = "SELECT user_id FROM contact_info where email = '$recieverEmail'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			$recieverUserID = $row["user_id"];		

					$sql1 = "INSERT INTO transactions ( userid, transaction_type) VALUES ( '$userid', 'MONEYT');";
					
					if(mysqli_query($conn, $sql1)){
					    echo "transaction table value added successfully.";
					   
					} else{
					    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
					}

					$sql = "SELECT transaction_id FROM transactions order by transaction_id desc limit 1";
						$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  
				    while($row = $result->fetch_assoc()) {
						$transactionIdTobeInserted = $row["transaction_id"];								      
			   		 }
			   		}


					$sql1 = "INSERT INTO money_transfer ( transaction_id,senderid,recieverid,transfer_date, amount) VALUES ( '$transactionIdTobeInserted', '$userid' , '$recieverUserID' , now() , '$amount');";
					
					if(mysqli_query($conn, $sql1)){
					    echo "money transafer table value added successfully.";
					    header('location:dashboard.php');
					   
					} else{
					    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
					}

					$sql = "UPDATE user SET balance=balance-'$amount' WHERE userid='$userid'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "balance deducted successfully."; 
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}	
					$sql = "UPDATE user SET balance=balance+'$amount' WHERE userid='$recieverUserID'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "balance added successfully."; 
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}


   		 }
   		}else{
   			echo "<br><h1>No user with such email exist....</h1>";
		}


			}								      
   		 }
		}

	
?>