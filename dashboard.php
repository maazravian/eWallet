<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <title>eWallet - User Dashboard</title>

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
    session_start();
    if($_SESSION["userId"]==false)
    {
      header('location:login.php');
    }

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

                <a href="logout.php" class="btn btn-danger" title="Logout"><b style="vertical-align: center;">  Logout  </b><i class="fa fa-exclamation-circle fa-2x"></i></a>

            </div>
        </nav>
                                <?php
                                $userid = $_SESSION["userId"];
                                $currentFirstName;
                                $currentLastName;
                                $currentAge;
                                $currentPassword;
                                $currentAddress;
                                $currentPhone;
                                $sql = "SELECT user.first_name, user.last_name,user.age,user.password,contact_info.address,contact_info.phone_no FROM user,contact_info where user.userid='$userid'
                                  and user.userid = contact_info.user_id";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    $currentFirstName=$row["first_name"];
                                  $currentLastName=$row["last_name"];
                                  $currentAge=$row["age"];
                                  $currentPassword=$row["password"];
                                  $currentAddress=$row["address"];
                                  $currentPhone=$row["phone_no"];

                                  }
                              }
                                ?>

 <!-- The Modal -->
                        <div class="modal fade " id="EditProfileModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Edit Profile</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                                  <form action="editProfile.php" method="post">

                              <!-- Modal body -->
                              <div class="modal-body">
                                Update Info
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="text" class="form-control" name="first_name" value="<?php
                                             echo $currentFirstName; 
                                             ?>" placeholder="Edit First Name" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="text" class="form-control" name="last_name" value="<?php 
                                             echo $currentLastName;
                                             ?>" placeholder="Edit Last Name" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="number" class="form-control" name="age" value="<?php 
                                              echo $currentAge;
                                             ?>"  placeholder="Edit Age" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                             <input type="text" class="form-control" name="password" value="<?php 
                                             $currentPassword;
                                             ?>" placeholder="Edit Password" required />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-home"  ></i></span>
                                             <input type="text" class="form-control" name="address" value="<?php 
                                             echo $currentAddress;
                                             ?>"   placeholder="Edit Address" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-phone"  ></i></span>
                                             <input type="number" class="form-control" name="phone" value="<?php 
                                             echo $currentPhone;
                                             ?>"  placeholder="Edit Phone"  />
                                        </div>

                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" value="Update" class="btn btn-primary"/> 
                              </div>
                            </form>

                            </div>
                          </div>
                        </div>


        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="assets/img/user.png" class="img-thumbnail" />
                            <a href="#" data-toggle="modal" data-target="#EditProfileModal"> <input type="button" value="Edit Profile" class="btn-info btn"></a>

                            <div class="inner-text">
                                <?php
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
                              
                            <br/>
                                <small>Last Activity 
                                  <?php

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

                                  $sql = "SELECT max(payment_date) from bill_payment where userId = '$temp'";
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

                                  ?>

                                </small>
                            </div>
                        </div>

                    </li>
                    <li>
                        <a class="active-menu" href="dashboard.php"><i class="fa fa-dashboard "></i>Dashboard</a>
                    </li>
                       <li>
                        <a  href="store.php"><i class="fa fa-shopping-cart "></i>Store</a>
                    </li>
                      
                    </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="main-box btn-primary">
                            <a href="#" data-toggle="modal" data-target="#moneyModal">
                                <i class="fa fa-bolt fa-5x"></i>
                                <h5>Money Transfer</h5>
                            </a>
                        </div>
                    </div>

                    <!-- The Modal -->
                        <div class="modal fade " id="moneyModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Money Transfer</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                                  <form action="moneyTransfer.php" method="post">

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="text" class="form-control" name="recieverEmail" placeholder="Enter Reciever's Email" required />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-money"  ></i></span>
                                             <input type="number" class="form-control" name="amount" placeholder="Enter Amount" required />
                                        </div>

                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <input type="submit" value="Transfer" class="btn btn-primary"/> 
                              </div>
                            </form>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box btn-danger">
                            <a href="#" data-toggle="modal" data-target="#billModal">
                                <i class="fa fa-plug fa-5x"></i>
                                <h5>Bill Payment</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="billModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Bill Payment</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details

                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <select class="form-control">
                                              <?php
                                              $sql = "SELECT distinct bill_name FROM bill_type ";
                                              $result = $conn->query($sql);

                                              if ($result->num_rows > 0) {
                                                // output data of each row
                                               while($row = $result->fetch_assoc()) {
                                                  echo "<option>
                                                        <p>". $row["bill_name"] ."</p>
                                                          </option>" ;
                                                }
                                              }
                                           
                                                 ?>
                                            </select>
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-money"  ></i></span>
                                             <input type="number" class="form-control"  placeholder="Enter Bill ID" />
                                        </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Pay Bill</button>
                              </div>

                            </div>
                          </div>
                        </div>


                    <div class="col-md-4">
                        <div class="main-box btn-success">
                            <a href="#" data-toggle="modal" data-target="#balanceModal">
                                <i class="fa fa-dollar fa-5x"></i>
                                <h5>
                                  <?php

                                  $userid = $_SESSION["userId"];
                                $sql = "SELECT Balance FROM user where userid='$userid'";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    echo $row["Balance"]. " Rs." ;
                                  }
                               }
                             

                                  ?>

                                </h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="balanceModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Account Balance</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Your current Balance Details

                                        <div class="form-group input-group">
                                             <h4 type="text"   >
                                               
                                              <?php

                                  $userid = $_SESSION["userId"];
                                $sql = "SELECT Balance FROM user where userid='$userid'";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                    echo $row["Balance"]. " Rs." ;
                                  }
                               }
                             

                                    ?>

                                             </h4>
                                        </div>

                                        <?php

                                  $userid = $_SESSION["userId"];
                                $sql = "SELECT transaction_type FROM transactions where userid='$userid'";
                  
                               $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                  // output data of each row
                                 while($row = $result->fetch_assoc()) {
                                  echo "<div class='form-group input-group'>
                                             <span class='input-group-addon'><i class='fa fa-history'  ></i></span>
                                             <p type='text' class='form-control'  > ". $row["transaction_type"]. "</p>
                                        </div>";
                               }
                             }
                               else
                                echo "No History....";
                             
                                
                                  ?>
                                        
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                              </div>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box  btn-primary">
                            <a href="#" data-toggle="modal" data-target="#withdrawModal">
                                <i class="fa fa-money fa-5x"></i>
                                <h5>Withdraw Money</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="withdrawModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Withdraw Money</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details

                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="text" class="form-control"  placeholder="Enter retailer's Email" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-money"  ></i></span>
                                             <input type="number" class="form-control"  placeholder="Enter Amount" />
                                        </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Withdraw</button>
                              </div>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box btn-danger">
                            <a href="#" data-toggle="modal" data-target="#depositModal">
                                <i class="fa fa-money fa-5x"></i>
                                <h5>Deposit Money</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="depositModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Deposit Money</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details

                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                             <input type="text" class="form-control"  placeholder="Enter Retailer's Email" />
                                        </div>
                                        <div class="form-group input-group">
                                             <span class="input-group-addon"><i class="fa fa-money"  ></i></span>
                                             <input type="number" class="form-control"  placeholder="Enter Amount" />
                                        </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Deposit</button>
                              </div>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box btn-success">
                            <a href="store.php">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                                <h5>Store</h5>
                            </a>
                        </div>
                    </div>

                </div>
                <!-- /. ROW  -->

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
