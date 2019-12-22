<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <title>eWallet - Admin Dashboard</title>

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
      header('location:loginAdmin.php');
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
                <a class="navbar-brand" href="dashboardAdmin.php">eWallet Admin Panel</a>
            </div>

            <div class="header-right">

                <a href="logout.php" class="btn btn-danger" title="Logout"><b style="vertical-align: center;">  Logout  </b><i class="fa fa-exclamation-circle fa-2x"></i></a>

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
									           $adminid = $_SESSION["userId"];
									$sql = "SELECT first_name, last_name FROM admin where adminid='$adminid'";
									
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
									    // output data of each row
									    while($row = $result->fetch_assoc()) {
									        echo $row["first_name"]. " " . $row["last_name"];
									    }
									}
								 ?>
									                                
                            </div>
                        </div>

                    </li>
                    <li>
                        <a class="active-menu" href="dashboardAdmin.php"><i class="fa fa-dashboard "></i>Dashboard</a>
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
                            <a href="#" data-toggle="modal" data-target="#usersModal">
                                <i class="fa fa-users fa-5x"></i>
                                <h5>Manage Users</h5>
                            </a>
                        </div>
                    </div>

                    <!-- The Modal -->
                        <div class="modal fade " id="usersModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">All Users</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                <div class="form-group input-group">
                                             <h4 type="text"   ></h4>
                                        </div>

                                        <?php 

                                        $sql = "SELECT first_name, last_name FROM user u";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											    // output data of each row
											    while($row = $result->fetch_assoc()) {
											        echo "<div class='form-group input-group'>
		                                             <span class='input-group-addon'><i class='fa fa-user'  ></i></span>
		                                             <p type='text' class='form-control'  >" . $row["first_name"] . " " . 
		                                             $row["last_name"] . "</p>
		                                             <span class='input-group-addon'><i class='fa fa-remove'  ></i></span>
		                                        	</div>";
											    }
											} else {
											    echo "0 results";
											}

                                        ?>

                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                                 <button type="button" class="btn btn-primary" data-dismiss="modal">Transfer</button>


                              </div>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box btn-danger">
                            <a href="#" data-toggle="modal" data-target="#adduserModal">
                                <i class="fa fa-user fa-5x"></i>
                                <h5>Add User</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="adduserModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Add Details of User</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details

                                       <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="Enter Email" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control" placeholder="Password" />
                                       
                                      </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"  ></i></span>
                                            <input type="password" class="form-control"  placeholder="Confirm Password" />
                                        </div>

                                          <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="First Name" />
                                        </div>

                                          <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="Last Name" />
                                        </div>

                                         <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="number" class="form-control"  placeholder="Age" />
                                        </div>

                                         <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <select class="form-control">
                                                <option>
                                                    <p>I am not Retailer</p>
                                                </option>
                                                <option>
                                                    <p>I am a Retailer</p>
                                                </option>
                                            </select>
                                        </div>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Add User</button>
                              </div>

                            </div>
                          </div>
                        </div>


                    <div class="col-md-4">
                        <div class="main-box btn-success">
                            <a href="#" data-toggle="modal" data-target="#historyModal">
                                <i class="fa fa-file-text fa-5x"></i>
                                <h5>Transaction History</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="historyModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Transaction History of users</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                        <div class="form-group input-group">
                                             <h4 type="text"   ></h4>
                                        </div>

                                        <?php 

                                        $sql = "SELECT Transactions.transaction_id, user.first_name , user.last_name , Transactions.transaction_type FROM transactions,user  where Transactions.userid=user.userid";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											    // output data of each row
											    while($row = $result->fetch_assoc()) {
											        echo " <div class='form-group input-group'>
                                             		<span class='input-group-addon'><i class='fa fa-history'  ></i></span>
                                             		<p type='text' class='form-control'  >" . "Transaction Id  ".
                                             		$row["transaction_id"].":: User Name ".$row["first_name"]. " " . $row["last_name"].":: Transaction type ".$row["transaction_type"]
                                             		 . "</p></div>";
											    }
											} else {
											    echo "0 results";
											}

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
                            <a href="#" data-toggle="modal" data-target="#itemsModal">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                                <h5>Manage Items</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="itemsModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">All Items</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                      <?php 

                                        $sql = "SELECT name, price FROM item";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
											    // output data of each row
											    while($row = $result->fetch_assoc()) {
											        echo "<div class='form-group input-group'>
                                             <span class='input-group-addon'><i class='fa fa-shopping-cart'  ></i></span>
                                             <p type='text' class='form-control'  >" . $row["name"] . "   $" . $row["price"] ."</p>
                                             <span class='input-group-addon'><i class='fa fa-remove'  ></i></span>
                                        	 </div>";
											    }
											} else {
											    echo "0 results";
											}

                                        ?>
                                        
                                       
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Transfer</button>
                              </div>

                            </div>
                          </div>
                        </div>

                    <div class="col-md-4">
                        <div class="main-box btn-danger">
                            <a href="#" data-toggle="modal" data-target="#addItemModal">
                                <i class="fa fa-plus fa-5x"></i>
                                <h5>Add Item</h5>
                            </a>
                        </div>
                    </div>

                    <div class="modal fade " id="addItemModal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Add Item</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                                Enter Details

                                <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="Enter Item Name" />
                                        </div>
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-money"  ></i></span>
                                            <input type="number" class="form-control" placeholder="Price" />
                                       
                                      </div>
                                      <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-file-text"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="Enter Descrsiption" />
                                        </div>

                                         <div class="form-group input-group">
                                            <span class="input-group-addon"><input type="file"  /></span>

                                        </div>
                                        
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Add Item</button>
                              </div>

                            </div>
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
