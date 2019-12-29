<?php 
   		include("dbConnection.php");

   		$userid = mysqli_real_escape_string($conn, $_REQUEST['userid']);


	


   		// sql to delete a record
		$sql = "DELETE FROM money_transfer WHERE senderid='$userid' or RECIEVERID = '$userid'";

		if (mysqli_query($conn, $sql)) {
		    echo "Money Transfer Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}
		// sql to delete a record
		$sql = "DELETE FROM bill_payment WHERE user_id='$userid'";

		if (mysqli_query($conn, $sql)) {
		    echo "Bill Payment Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}

		// sql to delete a record
	

		// sql to delete a record
		$sql = "DELETE FROM purchases WHERE userid='$userid'";

		if (mysqli_query($conn, $sql)) {
		    echo "Purchases Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}

// sql to delete a record
		

		$sql = "DELETE FROM transactions WHERE userid='$userid' and (transaction_type <> 'WITHDRAW' <> transaction_type != 'DEPOSIT') ";

		if (mysqli_query($conn, $sql)) {
		    echo "All transactions Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}


		$sql = "DELETE FROM withdraw_deposit WHERE userid='$userid'";

		if (mysqli_query($conn, $sql)) {
		    echo "Withdraw Deposit  Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}


		$sql = "DELETE FROM transactions WHERE userid='$userid'";

		if (mysqli_query($conn, $sql)) {
		    echo "All transactions Record deleted successfully";
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}


   		// sql to delete a record
		$sql1 = "DELETE FROM contact_info WHERE user_id='$userid'";

		if (mysqli_query($conn, $sql1)) {
		    echo "contact_info deleted successfully";

		    // sql to delete a record
			

		} else {
		    echo "Error deleting  contact info record: " . mysqli_error($conn);
		}


		$sql2 = "DELETE FROM user WHERE userid='$userid'";

			if (mysqli_query($conn, $sql2)) {
			    echo "Record deleted successfully";
			    header('location:dashboardAdmin.php');
			} else {
			    echo "Error deleting user record: " . mysqli_error($conn);
			}
 ?>