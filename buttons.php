<?php session_start();


// checking if the user logged in
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_type'])){

    // if not logged page riderect to index page
    header('Location: index.php');

    
}else{
    
    if($_SESSION['user_type'] != 'admin'){

        header('Location: index.php?invalidCredential=yes');
    }
}

    // require_once('./Admin/emailService.php');
    require_once('./include/connections.php');
    $query = "SELECT * FROM request_fuel_dealer";
    $result = mysqli_query($connection, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fuel | Requests</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
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
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Manage Fuel Request</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="buttons.php">Over View</a>
                        <!-- <a class="collapse-item" href="cards.php">All Requests</a> -->
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
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['user_name']; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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
                    <h1 class="h3 mb-4 text-gray-800">FUEL | REQUESTS</h1>

                    <div class="row">

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Fuel Request List</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Dealer</th>
                                                    <th>Fuel</th>
                                                    <th>Fuel Type</th>
                                                    <th>Quentity</th>
                                                    <th>Price</th>
                                                    <th>Request Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (mysqli_num_rows($result) > 0) {
                                                
                                                    while ($row = mysqli_fetch_assoc($result)) {

                                                        $dealer_id = $row['id'];
                                                        $dealer_name = $row['dealer'];
                                                        $dealer_fuel = $row['fuel'];
                                                        $dealer_fuel_type = $row['fuel_type'];
                                                        $dealer_fuel_qty = $row['qty'];
                                                        $dealer_fuel_price = $row['price'];
                                                        $dealer_fuel_req_date = $row['requet_date'];
                                                        $dealer_fuel_status = $row['status'];
                                                    ?>

                                                <tr>
                                                    <td class="user_id"><?php echo $dealer_id; ?></td>
                                                    <td><?php echo $dealer_name; ?></td>
                                                    <td><?php echo $dealer_fuel; ?></td>
                                                    <td><?php echo $dealer_fuel_type; ?></td>
                                                    <td><?php echo $dealer_fuel_qty; ?></td>
                                                    <td><?php echo $dealer_fuel_price; ?></td>
                                                    <td><?php echo $dealer_fuel_req_date; ?></td>
                                                    <td><?php echo $dealer_fuel_status; ?></td>
                                                    <td>
                                                        <!-- <a href="#" class="badge badge-primary view_btn">view</a> -->
                                                        <a href="#" class="badge badge-success edit_btn p-2">Change
                                                            Status</a>
                                                        <!-- <a href="" class="badge badge-danger">delete</a> -->
                                                    </td>
                                                </tr>

                                                <?php }

                                                }else{

                                                    echo "<h5>Record Not Found</h5>";
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
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


    <!-- Modal status change -->
    <div class="modal fade" id="statusChangeModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusChangeModal">Change Requested Fuel Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                </div>
                <div class="modal-body">
                    <div id="contactus_processing" style="display:none;" class="alert alert-primary" role="alert">Updating...</div>
                    <iframe id="contactus_send" style="display:none;" src="https://giphy.com/embed/YlSR3n9yZrxfgVzagm" width="50" height="50" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                    <label style="color: blue;">Curent Status :</label>
                    <p id="status_change"></p>
                    <label style="color: blue;">Dealer :</label>
                    <p id="status_dealer"></p>
                    <br><br>
                    <form name="contact-form">
                    
                        <input type="hidden" name="dealer_id" id="dealer_id">
                        <input type="hidden" name="station_id" id="station_id">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Example select</label>
                            <select class="form-control form-control-sm" name="fuelStatusChange" id="fuelStatusChange">
                                <!-- <option value="Pending">Pending</option> -->
                                <option value="Approved">Approved</option>
                                <option value="Cancel">Cancel</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" onclick="updateStatusDealer()" name="updateStatus" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>  <!-- Modal status change end -->




    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>


    <script>


    $(document).ready(function() {

        $('.edit_btn').click(function(e) {
            e.preventDefault();

            var dealer_id = $(this).closest('tr').find('.user_id').text();
            // console.log(dealer_id);

            $.ajax({
                type: "POST",
                url: "Admin/fuelStatusChange.php",
                data: {
                    'checking_editbtn': true,
                    'dealer_id': dealer_id,
                },
                success: function(response) {

                    console.log(response);

                    $.each(response, function(key, value) {

                        $('#dealer_id').val(value['id']);
                        $('#station_id').val(value['station_id']);
                        $('#status_change').text(value['status']);
                        $('#status_dealer').text(value['dealer']);
                    });

                    $('#statusChangeModal').modal('show');

                }
            });

        });

    });


    function updateStatusDealer(){
    
        document.getElementById("contactus_processing").style.display = "block";
        var frm = document.getElementsByName('contact-form')[0];
        var formdata = new FormData();
        formdata.append("dealer_id",document.getElementById("dealer_id").value);
        formdata.append("station_id",document.getElementById("station_id").value );
        formdata.append("changed_status",document.getElementById("fuelStatusChange").value );
        
        var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
        };
        
        fetch("http://localhost/POWER-FUEL/Admin/fuelStatusChange.php", requestOptions)
        .then(response => response.text())
        .then(result => {
            console.log(result)
            document.getElementById("contactus_processing").style.display = "none";
            document.getElementById("contactus_send").style.display = "block";
            // window.location.reload();
            setTimeout(() => window.location.reload(), 2000);
            })
        .catch(error => console.log('error', error));

        frm.reset();

    }

    </script>

</body>

</html>