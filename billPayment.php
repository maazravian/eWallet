<?php    
 include("dbConnection.php");
session_start();
$userid = $_SESSION["userId"];

	$billType = mysqli_real_escape_string($conn, $_REQUEST['selected_type']);
	$billId = mysqli_real_escape_string($conn, $_REQUEST['billid']);
	$amount = mysqli_real_escape_string($conn, $_REQUEST['amount']);

	$transactionIdTobeInserted=0;
	$billTypeID = 0;

	$sql = "SELECT bill_type_id FROM bill_type where bill_name = '$billType'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
	    	$row = $result->fetch_assoc();
	    	$billTypeID  = $row["bill_type_id"];
		}



	if($billId > 9999999999 || $billId<10000 )
	{
		echo "<br><h1>Enter a valid bill id</h1>";
	}else
	{

		$sql = "SELECT bill_payment_id FROM bill_payment where bill_payment_id = '$billId'";
			$result = $conn->query($sql);

		if ($result->num_rows > 0) {
	    	
	    	echo "<br><h1>Enter a valid bill id</h1>";
		}
		else
		{
			// if there is no previous bill id with entered bill id

			$sql = "SELECT balance from user where userid = '$userid'";
			$result=$conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
	    		if($row["balance"] < $amount)
	    		{
	    			echo "<br><h1>You dont have enough balance</h1>";
	    		}
	    		else
	    		{
	    			$sql1 = "INSERT INTO transactions ( userid, transaction_type) VALUES ( '$userid', 'BILL');";
					
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



			$sql1 = "INSERT INTO bill_payment ( transaction_id,billtypeid,amount,payment_date, user_id,due_date) VALUES ( '$transactionIdTobeInserted', '$billTypeID' , '$amount' , now() , '$userid',now());";
					
					if(mysqli_query($conn, $sql1)){
					    echo "bill payment table value added successfully.";
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
	    		}
			}

			

		}
	}


?>