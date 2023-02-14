<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/main.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">POWER FUEL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Fuel Request</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="buttons.php">Over View</a>
                        <!-- <a class="collapse-item" href="cards.html">All Requests</a> -->
                    </div>
                </div>
            </li>

              <!-- Nav Item - Utilities Collapse Menu -->
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Settings</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="blank.php">Registration</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user_name']; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Registration</h1>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <!-- Dealer Registraion -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Register Dealer</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <!-- add form -->
                                    <form action="" method="" id="myForm" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                                        
                                        <h2 class="login-heading">Add New Dealer</h2>
                                        <p class="login-para">Create New Dealer Account. It only takes a few steps<br></p>

        

                                            
                                            <div class="form-row">
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">First Name</label><input class="form-control" type="text" name="first_name" id="first_name" placeholder="first name" ></div>
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Last Name</label><input class="form-control" type="text" name="last_name" id="last_name" readonly placeholder="last name" value="Distributors" ></div>
                                            </div>
                                            <div class="form-row">
                                                <!-- <div class="form-group col-md-12"><label style="color: rgb(50,50,50);">Password</label><input class="form-control" type="password" name="password" placeholder="Password" ></div> -->
                                                <!-- <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Confirm password</label><input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" ></div> -->
                                                <input class="form-control" type="hidden" name="user_type" id="user_type" value="dealer">
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Email Address</label><input class="form-control" type="email" name="email" id="email" placeholder="email"></div>
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Contact</label><input class="form-control" type="number" name="telephone" id="telephone" placeholder="Telephone"></div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-8"><label style="color: rgb(50,50,50);">Address</label><input class="form-control" type="text" name="address" id="address" placeholder="Address"></div>
                                                <div class="form-group col-md-4"><label style="color: rgb(50,50,50);">Station Number</label><input class="form-control" type="text" name="stationId" id="stationId"  placeholder="Station Number"></div>
                                            </div>

                                            <div class="form-group"><button class="btn btn-primary btn-block btn-login" type="button" id="submit" name="submit" onclick="registerDealer()">&nbsp;Register</button></div>
                                            
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            
                        </div>

                    </div>

                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Power Fuel 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>


    <script>

        function registerDealer(){

            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;
            var email = document.getElementById('email').value;
            var telephone = document.getElementById('telephone').value;
            var address = document.getElementById('address').value;
            var stationId = document.getElementById('stationId').value;
            var usertype = document.getElementById('user_type').value;


            if (firstName == '' ) {
                alert("Please Eneter first name");
                return false;
	        }

            if (lastName == '' ) {
                alert("Please Eneter last name");
                return false;
	        }

            if (email == '' ) {
                alert("Please Eneter email");
                return false;
	        }

            if (telephone == '' ) {
                alert("Please Eneter telephone");
                return false;
	        }

            if (address == '' ) {
                alert("Please Eneter address");
                return false;
	        }
            
            if (stationId == '' ) {
                alert("Please Eneter station id");
                return false;
	        }


         $.ajax({
		 url: "Admin/dealerRegister.php", //call storeemdata.php to store form data
         type: "POST",
         dataType: 'json',
         data: {submit:"Yes",firstName:firstName, lastName:lastName, email:email, telephone:telephone, address:address, stationId:stationId, usertype:usertype},
		 success: function(result) {
		  alert(result.success);
        
            // document.getElementById('first_name').value ="";
            // // document.getElementById('last_name').value = "";
            // document.getElementById('email').value = "";
            // document.getElementById('telephone').value = "";
            // document.getElementById('address').value = "";
            // document.getElementById('stationId').value = "";
            // // document.getElementById('user_type').value = "";

            document.getElementById("myForm").reset();
		 },

         error:function(error){
            // console.log(error);
            alert(error.responseJSON.error);
         }

	});

        }
    </script>


</body>

</html>