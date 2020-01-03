<?php    
 include("dbConnection.php");
session_start();
$userid = $_SESSION["userId"];
	

	$transactionIdTobeInserted;
	

	$Email = mysqli_real_escape_string($conn, $_REQUEST['email']);
	$amount = mysqli_real_escape_string($conn, $_REQUEST['amount']);




				$sql = "SELECT user_id FROM contact_info where email = '$Email'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			$Email = $row["user_id"];		


			$sql = "SELECT balance FROM user where userid = '$Email'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  
	    while($row = $result->fetch_assoc()) {
			if($row["balance"]<$amount)
			{
				echo "<br><h1>Retailer balance is not enough for deposit..</h1>";
			}
			else
			{

$sql1 = "INSERT INTO transactions ( userid, transaction_type) VALUES ( '$userid', 'DEPOSIT');";
					
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


					$sql1 = "INSERT INTO withdraw_deposit ( amount,payment_date,is_withdraw,is_deposit, transaction_id,userid,retailer_id) VALUES ( '$amount', now() , 'no' , 'yes' , '$transactionIdTobeInserted','$userid','$Email');";
					
					if(mysqli_query($conn, $sql1)){
					    echo "deposit  table value added successfully.";
					    header('location:dashboard.php');
					   
					} else{
					    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
					}

					$sql = "UPDATE user SET balance=balance+'$amount' WHERE userid='$userid'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "balance deducted successfully."; 
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}	
					$sql = "UPDATE user SET balance=balance-'$amount' WHERE userid='$Email'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "balance added successfully."; 
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}	



			}								      
   		 }
		}

					
   		 }
   		}else{
   			echo "<br><h1>No user with such email exist....</h1>";
		}


	

	
?>