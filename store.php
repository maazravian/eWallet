<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
    <title>eWallet - Store</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
       <!--CUSTOM BASIC STYLES-->
    <link href="assets/css/basic.css" rel="stylesheet" />
    <!--CUSTOM MAIN STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
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
                                Jhon Deo Alex
                            <br />
                                <small>Last Activity : 12/04/19 </small>
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
                <div class="row">
                	<div class="col-md-4">
                        <div class="main-box btn-primary">
                            <a href="#" data-toggle="modal" data-target="#Modal">
                                <img class="img-responsive" src="assets/items/item1.jpg">
                                <h5>Item name</h5>
                                <p>this is item description which is usually 4 to 5 long in length so dummy description is also long</p>
                                <h5>2000 Rs</h5>

                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box btn-primary">
                            <a href="#" data-toggle="modal" data-target="#Modal">
                                <img class="img-responsive" src="assets/items/item1.jpg">
                                <h5>Item name</h5>
                                <p>this is item description which is usually 4 to 5 long in length so dummy description is also long</p>
                                <h5>2000 Rs</h5>

                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box btn-primary">
                            <a href="#" data-toggle="modal" data-target="#Modal">
                                <img class="img-responsive" src="assets/items/item1.jpg">
                                <h5>Item name</h5>
                                <p>this is item description which is usually 4 to 5 long in length so dummy description is also long</p>
                                <h5>2000 Rs</h5>

                            </a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="main-box btn-primary">
                            <a href="#" data-toggle="modal" data-target="#Modal">
                                <img class="img-responsive" src="assets/items/item1.jpg">
                                <h5>Item name</h5>
                                <p>this is item description which is usually 4 to 5 long in length so dummy description is also long</p>
                                <h5>2000 Rs</h5>

                            </a>
                        </div>
                    </div>
                    


				</div>

                <!-- /. ROW  -->

                <!-- The Modal -->
                        <div class="modal fade " id="Modal">
                          <div class="modal-dialog">
                            <div class="modal-content">

                              <!-- Modal Header -->
                              <div class="modal-header">
                                <h4 class="modal-title">Item name</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">
                               

                                        <img class="img-responsive" src="assets/items/item1.jpg">
		                                <h5>Item name</h5>
		                                <p>this is item description which is usually 4 to 5 long in length so dummy description is also long</p>
		                                <h5>2000 Rs</h5>
                              </div>

                              <!-- Modal footer -->
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Buy</button>
                              </div>

                            </div>
                          </div>
                        </div>

                
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
