<?php 

   		include("dbConnection.php");

   		$item_id = mysqli_real_escape_string($conn, $_REQUEST['item_id']);


   		// sql to delete a record
		$sql = "DELETE FROM item WHERE item_id='$item_id'";

		if (mysqli_query($conn, $sql)) {
		    echo "Record deleted successfully";
		    header('location:dashboardAdmin.php');
		} else {
		    echo "Error deleting record: " . mysqli_error($conn);
		}


 ?>