    <?php session_start(); ?>
    <?php require_once('include/connections.php'); ?>
    <?php require_once('include/functions.php') ?>
    <?php

    // checking if the user logged in
    if(!isset($_SESSION['user_id'])){

        // if not logged page riderect to index page
        header('Location: index.php');
    }

    ?>


    <?php

        $erros = array();


        if(isset($_POST['submit'])){


        // checking if email address is already exist in database (alredy used for register that mail)
        $vehicleNo = mysqli_real_escape_string($connection, $_POST['vehiclenumber']);
        $query = "SELECT * FROM vehicle WHERE regNo = '{$vehicleNo}' LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set){
            if(mysqli_num_rows($result_set) == 1){

                // if record found it means vehicle no is alredy exist so we shold display error
                $erros[] = 'vehicle no alreday exist';
            }
        }

        if(empty($erros)){

            // no error found . adding new record 

            // field sanitize
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $vehicleType = mysqli_real_escape_string($connection, $_POST['vehicletype']);
            $fuelType = mysqli_real_escape_string($connection, $_POST['fueltype']);
            
            $query = "INSERT INTO vehicle (email,regNo,fuelType,vehicleType) VALUES ('{$email}','{$vehicleNo}','{$fuelType}','{$vehicleType}')";
            
            $result = mysqli_query($connection, $query);

            if($result){

                // query successfull and redirect users.php

                header('Location: addvehicle.php?vehicle_added=true');

            }else{

                $erros[] = 'Failed to add new record';
            }


            }
        }

        

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add | Vehicle</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background: #ebeced;">
    <a class="navbar-brand" href="#" style="font-size:16px ;">POWER FUEL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
        
            <a class="nav-link" href="">Welcome! | <?php echo $_SESSION['user_name']; ?> </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php" style="color: #4287f5;">Log out</a>
        </li>
        </ul>
    </div>
    </nav>

    <section id="register">
            <div class="container">
                <div class="row justify-content-center py-5 mt-5">
                    <div class="col col-12 col-md-6">
                        <form action="addvehicle.php" method="POST" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                            <h1 class="login-heading">- Register New Vehicle</h1>
                            
                            <p class="login-para">you can add new vehicle here</p>


                            <!-- display error if any filed is empty -->
                                <?php 

                                    if(!empty($erros)){

                                        // echo 'There ware errors on your form';
                                        echo '<div class="errormessage">';
                                        foreach ($erros as $value ) {
                                            
                                            echo $value . '<br>';
                                        }

                                        echo '</div>';

                                    } 
        
                                ?>

                                <?php

                                    if(isset($_GET['vehicle_added'])){

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo 'Vehicle added succesfully';
                                        echo '</div>';
                                    }
                                ?>
                    
                            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="email" style="width: px;" readonly value="<?php echo $_SESSION['user_email']; ?>" required></div>
                            <div class="form-group"><input class="form-control" type="text" name="vehiclenumber" placeholder="vehicle number" required></div>
                            <div class="form-group"><select class="form-control" name="vehicletype" required>
                                    <optgroup label="Select vehicle type">
                                        <option value="Car" >Car</option>
                                        <option value="Bike">Bike</option>
                                        <option value="Lorry" >Lorry</option>
                                        <option value="Bus">Bus</option>
                                    </optgroup>
                                </select></div>
                            <div class="form-group"><select class="form-control" name="fueltype" required>
                                    <optgroup label="Select fule type">
                                        <option value="petrol">Petrol</option>
                                        <option value="disel">Disel</option>
                                    </optgroup>
                                </select></div>
                            
                            <div class="form-group"><button class="btn btn-primary btn-block btn-login" type="submit" name="submit">&nbsp;Register</button></div>
                            <div class="form-group text-center"><a class="create-account-link" href="users.php">Already register vehicles ? Go back</a></div>
                        </form>
                    </div>
                </div>
            </div>

            

        </section>

    </body>
    </html>