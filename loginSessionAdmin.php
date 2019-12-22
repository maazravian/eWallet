<?php
   

   session_start();
   

   if(isset($_REQUEST["submit"]))
   {
      $username = $_REQUEST["user"];
      $password = $_REQUEST["pass"];

      $sql = "SELECT EMAIL,PASSWORD,adminid from admin
      where EMAIL='$username' and password = '$password' ";
                           
       $result = $conn->query($sql);

       if ($result->num_rows > 0) {
                               // output data of each row
       while($row = $result->fetch_assoc()) {
          $_SESSION["userId"]=$row["adminid"];
         header('location:dashboardAdmin.php');
         }
      }
      else if($result->num_rows==0)
         echo "<script type='text/javascript'>";
         echo "window.alert('Wrong email and password')";
         echo "</script>";
      }


?>