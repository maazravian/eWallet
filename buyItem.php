<?php

include("dbConnection.php");
session_start();
$userid = $_SESSION["userId"];

	$transactionIdTobeInserted;
	$itemid = $_REQUEST["itemid"];
	$itemPrice = $_REQUEST["price"];
	
	$sql = "SELECT balance from user where userid = '$userid'";
			$result=$conn->query($sql);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
	    		if($row["balance"] < $itemPrice)
	    		{
	    			echo "<br><h1>You dont have enough balance</h1>";
	    		}
	    		else
	    		{
	    			$sql1 = "INSERT INTO transactions ( userid, transaction_type) VALUES ( '$userid', 'PURCHASE');";
					
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


			   		$sql1 = "INSERT INTO purchases ( transactionid,userid,itemid,date_purchased,price ) VALUES ( '$transactionIdTobeInserted', '$userid','$itemid',now(),'$itemPrice');";
					
					if(mysqli_query($conn, $sql1)){
					    echo "purchase table value added successfully.";
					   
					} else{
					    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
					}

					$sql = "UPDATE user SET balance=balance-'$itemPrice' WHERE userid='$userid'"; 
					if(mysqli_query($conn, $sql)){ 
					    echo "balance deducted successfully."; 
					    header('location:dashboard.php');
					} else { 
					    echo "ERROR: Could not able to execute $sql. "  
					                            . mysqli_error($conn); 
					}



	    		}
			}

?>