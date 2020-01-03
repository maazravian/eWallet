<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <title>eWallet - Item</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />

    <?php 
    include("dbConnection.php");
    ?>

</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="dashboard.php">eWallet</a>
            </div>

            <div class="header-right">

                <a href="login.php" class="btn btn-danger" title="Logout"><b style="vertical-align: center;">  Logout  </b><i class="fa fa-exclamation-circle fa-2x"></i></a>

            </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />

                            <div class="inner-text">
                                <?php
                                session_start();
                                $userid = $_SESSION["userId"];
                                $sql = "SELECT first_name, last_name FROM user where userid='$userid'";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                     echo $row["first_name"]. " " . $row["last_name"];

                                  }
                              }
                                ?>
                            <br />
                                <small>Last Activity <?php

                                  // query to select last entry from transactions table

                                  $userid = $_SESSION["userId"];
                                $sql = "SELECT transaction_type FROM transactions
                                 where userid='$userid'
                                  order by transaction_id desc limit 1";
                  
                               $result = $conn->query($sql);

                              if ($row = $result->fetch_assoc()) {
                                  // output data of each row
                                $temp = $_SESSION["userId"];
                                if($row["transaction_type"]=="BILL")
                                {

                                  $sql = "SELECT max(payment_date) from bill_payment where user_Id = '$temp'";
                                  $result = $conn->query($sql);
                                  if($row = $result->fetch_assoc())
                                  {
                                    echo $row["max(payment_date)"];
                                  }

                                }else if($row["transaction_type"]=="MONEYT")
                                {

                                   $sql = "SELECT max(transfer_date) from money_transfer where senderId = '$temp'";
                                  $result = $conn->query($sql);
                                  if($row = $result->fetch_assoc())
                                  {
                                    echo $row["max(transfer_date)"];
                                  }

                                }else if($row["transaction_type"]=="WITHDRAW")
                                {

                                   $sql = "SELECT max(payment_date) from withdraw_deposit where userId = '$temp'";
                                  $result = $conn->query($sql);
                                  if($row = $result->fetch_assoc())
                                  {
                                    echo $row["max(payment_date)"];
                                  }

                                }else if($row["transaction_type"]=="DEPOSIT")
                                {

                                   $sql = "SELECT max(payment_date) from withdraw_deposit where USERID = '$temp'";
                                  $result = $conn->query($sql);
                                  if($row = $result->fetch_assoc())
                                  {
                                    echo $row["max(payment_date)"];
                                  }
                                }else if($row["transaction_type"]=="PURCHASE")
                                {
                                   $sql = "SELECT max(date_purchased) from PURCHASES where userId = '$temp'";
                                  $result = $conn->query($sql);
                                  if($row = $result->fetch_assoc())
                                  {
                                    echo $row["max(date_purchased)"];
                                  }
                                }

                               }
                               else
                               {
                                echo "No Recent Activity";
                               }

                                  ?></small>
                            </div>
                        </div>

                    </li>
                    <li>
                        <a  href="dashboard.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                     <li>
                        <a class="active-menu" href="store.php"><i class="fa fa-shopping-cart "></i>Store</a>
                    </li>
                       
                      
                    </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                
                	

                      <b><h4>ITEM WILL BE DELIVERED TO YOUR GIVEN ADDRESS IF YOU CLICK BUY</h4></b>


				              <?php  
                        $itemid=$_REQUEST["itemid"];
                        

                        $userid = $_SESSION["userId"];
                                $sql = "SELECT item_id,name,description,price  FROM item where item_id='$itemid'";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 $row = $result->fetch_assoc();
                                     echo "<style>
                                      .container {
                                          width: 80%;
                                          margin: 0 auto;
                                          padding: 20px;
                                          background: #f0e68c;
                                      }
                                  </style><div class='col-lg-7' class='container'>
                                                    <form method='post' action='buyItem.php'>
                                                    <div class='main-box btn-primary'>
                                                    
                                                    <img class='img-responsive' src='assets/items/item1.jpg'>
                                                    <h5>". $row["name"] ."</h5>
                                                    <p>Item id : ". $row["item_id"] . "</p>
                                                    <p>". $row["description"] . "</p>
                                                    <h5>" .  $row["price"] ."  Rs</h5>
                                                    <input type='hidden' name='itemid' value='".$row["item_id"]."'>
                                                    <input type='hidden' name='price' value='".$row["price"]."'>

                                                    <input type='submit' class='btn btn-success' value='Buy'/>
                                                    </div>
                                                    </form>
                                                    </div> 
                                                      ";
                                   
                                 }




                      ?>

                
                       

                
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->

    <div id="footer-sec">
        &copy; 2019 eWallet | Design By : <a>IT F18</a>
    </div>
    <!-- /. FOOTER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
       <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>



</body>
</html>