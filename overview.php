<?php session_start(); 

// checking if the user logged in
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_type'])){

    // if not logged page riderect to index page
    header('Location: index.php');

    
}else{
    
    if($_SESSION['user_type'] != 'dealer'){

        header('Location: index.php?invalidCredential=yes');
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dealer - Dashboard</title>

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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dealer.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="sidebar-brand-text mx-3">POWER FUEL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dealer.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Request Fuel</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="overview.php">Over View</a>
                        <!-- <a class="collapse-item" href="cards.html">All Requests</a> -->
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
                        <h1 class="h3 mb-0 text-gray-800">Request Fuel</h1>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <div class="col-xl-6 col-lg-6">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Request Fuel</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                <div id="contactus_processing" style="display:none;" class="alert alert-primary" role="alert">Updating...</div>
                                <iframe id="contactus_send" style="display:none;" src="https://giphy.com/embed/YlSR3n9yZrxfgVzagm" width="50" height="50" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                                <!-- add form -->
                                <form  id="requestFuel_form" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                                            
                                            <label for="">Dealer :</label> 
                                            <p style="color: blue;" id="dealer_name"> <?php echo $_SESSION['user_name'] ." ". $_SESSION['user_last_name']; ?> </p>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="exampleFormControlSelect1">Select Fuel</label>
                                                    <select class="form-control form-control-sm" name="fuel" id="fuel" onchange="showFuelType(this.value)">
                                                        <option>Select Fuel</option>
                                                        <option value="Petrol" >Petrol</option>
                                                        <option value="Diesel">Diesel</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                <label for="exampleFormControlSelect1">Select Category</label>
                                                    <select class="form-control form-control-sm" name="fuel_cat" id="fuel_cat" onchange="getPrices(this.value)">
                                                    <option>Select Category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Quentity</label><input class="form-control" type="text" name="qty" id="qty" placeholder="qty"></div>
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Price</label><input class="form-control" type="text" name="price" id="price" placeholder="price"></div>
                                                <span class="badge badge-warning" id="showUP"></span>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Date</label><input class="form-control" type="date" name="date" id="date" ></div>
                                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Station Number</label><input class="form-control" type="text" name="stationId" id="stationId" value="<?php echo $_SESSION['dealer_st_id']; ?>"></div>
                                            </div>

                                            <div class="form-group"><button class="btn btn-primary btn-block btn-login" type="button"  name="btn_submit" onclick="requestDealerFuel()">Request Fuel</button></div>
                                            
                                    </form>
                                    
                                </div>
                            </div>
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



        function showFuelType(fuelType){

            document.getElementById("fuel_cat").innerHTML = "<option value=''>Select Category</option>";

            if(document.getElementById("fuel").value == ""){
                document.getElementById("fuel_cat").value = "";
            }else{

                    $.ajax({
                    url:"include/functions_customer.php", 
                    type: "post",    
                    dataType: 'text',
                    data: {getCategories: "price_main", fuelType: fuelType},
                    success:function(result){
                        document.getElementById("fuel_cat").innerHTML += result;
                    }
                });
            }           

        }


    let unitPrice = 0;
    //Get fuel category price
    function getPrices(category) {
        if(category!="")
        {
            $.ajax({
            url:"include/functions_customer.php", 
            type: "post",    
            dataType: 'text',
            data: {getCategoryPrice: "price_main", category: category},
            success:function(result){
                unitPrice=result;
                document.getElementById("showUP").innerHTML = "Unit Price Rs."+result; 
                calculateTotal();
            }
        });
        }
    
    }

        $('#qty').change(function() {
        calculateTotal();
        });

        
        function calculateTotal()
        {
        var reqAmount= document.getElementById("qty").value;
        var price=reqAmount*unitPrice
        document.getElementById("price").value=price;
        }


    function requestDealerFuel() {

        document.getElementById("contactus_processing").style.display = "block";
        var frm = document.getElementById('requestFuel_form');
        var formdata = new FormData();
        formdata.append("fuel",document.getElementById("fuel").value);
        formdata.append("fuel_cat",document.getElementById("fuel_cat").value );
        formdata.append("qty",document.getElementById("qty").value );
        formdata.append("price",document.getElementById("price").value );
        formdata.append("date",document.getElementById("date").value );
        formdata.append("stationId",document.getElementById("stationId").value );
        formdata.append("dealer_name",document.getElementById("dealer_name").innerHTML);
        
        var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
        };
        
        fetch("http://localhost/POWER-FUEL/Dealer/requestFuelDealer.php", requestOptions)
        .then(response => response.text())
        .then(result => {
            console.log(result)
            document.getElementById("contactus_processing").style.display = "none";
            document.getElementById("contactus_send").style.display = "block";
            // window.location.reload();
            // setTimeout(() => window.location.reload(), 2000);

        
            })
        .catch(error => console.log('error', error));

        frm.reset();

    }
                


    </script>



</body>

</html>