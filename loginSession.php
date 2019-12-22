<?php
   

   session_start();
   

   if(isset($_REQUEST["submit"]))
   {
      $username = $_REQUEST["user"];
      $password = $_REQUEST["pass"];

      $sql = "SELECT contact_info.EMAIL,user.PASSWORD,user.userid from contact_info,user
      where contact_info.USER_ID=user.USERID
      and contact_info.EMAIL='$username' and user.password = '$password' ";
                           
       $result = $conn->query($sql);

       if ($result->num_rows > 0) {
                               // output data of each row
       while($row = $result->fetch_assoc()) {
          $_SESSION["userId"]=$row["userid"];
         header('location:dashboard.php');
         }
      }
      else if($result->num_rows==0)
         echo "<script type='text/javascript'>";
         echo "window.alert('Wrong email and password')";
         echo "</script>";
      }


?>