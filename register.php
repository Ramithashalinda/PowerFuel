    <?php session_start(); ?>
    <?php require_once('include/connections.php'); ?>
    <?php require_once('include/functions.php') ?>


    <?php

    // validate our fields in backend
    $erros = array();



    // cretae empty variables for store past enterd values in filed
    $first_name = '';
    $last_name = '';
    $email = '';
    $vehicle_num = '';
    $address = '';
    $contact = '';

    if(isset($_POST['submit'])){

        

        // add enetred values to variable when submit button cliked
        $first_name = $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $email =  $_POST['email'];
        $vehicle_num = $_POST['vehicleno'];
        $address = $_POST['address'];
        $contact = $_POST['telephone'];



        if(trim($_POST['password'] !== $_POST['confirmpassword'])){

            $erros[] = 'password and confrim password does not match';
        }




        $req_fileds = array('first_name','last_name','password','confirmpassword','email','vehicleno','address','telephone');

        foreach ($req_fileds as $field) {

            if(empty(trim($_POST[$field]))){

                    $erros[] = $field .' is required';
                }
            
        }



        // checking if email address is already exist in database (alredy used for register that mail)
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

        $result_set = mysqli_query($connection, $query);

        if($result_set){
            if(mysqli_num_rows($result_set) == 1){

                // if record found it means mail is alredy exist so we shold display error
                $erros[] = 'email address alreday exist';
            }
        }


        if(empty($erros)){

            // no error found . adding new record 

            // field sanitize (email address is already sanitize above)
            $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $vehicle_num = mysqli_real_escape_string($connection, $_POST['vehicleno']);
            $address = mysqli_real_escape_string($connection, $_POST['address']);
            $contact = mysqli_real_escape_string($connection, $_POST['telephone']);
            $vehicleType = mysqli_real_escape_string($connection, $_POST['vehicletype']);
            $fuelType = mysqli_real_escape_string($connection, $_POST['fueltype']);

            // to encrypt the password
            $hashed_password = sha1($password);

            $query = "INSERT INTO user (first_name,last_name,email,password,address,contact_number,is_deleted) VALUES ('{$first_name}','{$last_name}','{$email}','{$hashed_password}','{$address}',{$contact}, 0)";

            $result = mysqli_query($connection, $query);

            if($result){

                // query successfull and redirect users.php

                $query = "INSERT INTO vehicle(email,regNo,fuelType,vehicleType) VALUES ('{$email}','{$vehicle_num}','{$fuelType}','{$vehicleType}')";

                $result = mysqli_query($connection, $query);

                if($result){

                    header('Location: register.php?user_added=true');
                }
                else{

                    $erros[] = 'Failed to add  vehicle record';
                }

                // header('Location: register.php?user_added=true');
            

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
        <title>add new user</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        

    <section id="table" style="padding-top:100px ;">
            <div class="container">
            
                
                <div class="container">
                <div class="row justify-content-center py-5 mt-5">
                    <div class="col col-12 col-md-8">
                        <form action="register.php" method="POST" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                            
                        <h2 class="login-heading">New here?</h2>
                        <p class="login-para">Signing up is easy. It only takes a few steps<br></p>

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

                                    if(isset($_GET['user_added'])){

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo 'user register succesfully';
                                        echo '</div>';
                                    }
                                    ?>

                            
                            <div class="form-row">
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">First Name</label><input class="form-control" type="text" name="first_name" placeholder="first name" <?php echo 'value="' . $first_name . '"'; ?>></div>
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Last Name</label><input class="form-control" type="text" name="last_name" placeholder="last name"  <?php echo 'value="' . $last_name . '"'; ?>></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Password</label><input class="form-control" type="password" name="password" placeholder="Password" ></div>
                                <!-- <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Email Address</label><input class="form-control" type="email" name="email" placeholder="email" <?php echo 'value="' . $email . '"'; ?>></div> -->
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Confirm password</label><input class="form-control" type="password" name="confirmpassword" placeholder="Confirm Password" ></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Email Address</label><input class="form-control" type="email" name="email" placeholder="email" <?php echo 'value="' . $email . '"'; ?>></div>
                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Contact</label><input class="form-control" type="number" name="telephone" placeholder="Telephone" <?php echo 'value="' . $contact . '"'; ?>></div>
                            </div>

                            <div class="form-group"><label style="color: rgb(50,50,50);">Address</label><input class="form-control" type="text" name="address" placeholder="Address" <?php echo 'value="' . $address . '"'; ?>></div>

                            <div class="form-group"><label style="color: rgb(50,50,50);">Vehicle Number</label><input class="form-control" type="text" name="vehicleno" placeholder="Vehicle number" <?php echo 'value="' . $vehicle_num . '"'; ?>></div>
                            
                            <div class="form-row">
                                    
                                    
                                    <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Vehicle Type</label><select class="form-control" name="vehicletype" required>
                                    <optgroup label="Select vehicle type">
                                        <option value="Car" >Car</option>
                                        <option value="Bike">Bike</option>
                                        <option value="Lorry" >Lorry</option>
                                        <option value="Bus">Bus</option>
                                    </optgroup>
                                </select></div>

                                <div class="form-group col-md-6"><label style="color: rgb(50,50,50);">Fuel Type</label><select class="form-control" name="fueltype" required>
                                    <optgroup label="Select fule type">
                                        <option value="petrol">Petrol</option>
                                        <option value="disel">Disel</option>
                                    </optgroup>
                                </select></div>

                            </div>

                            
                            

                            <div class="form-group"><button class="btn btn-primary btn-block btn-login" type="submit" name="submit">&nbsp;Register</button></div>
                            <div class="form-group text-center"><a class="create-account-link" href="index.php">Already have an account? Login</a></div>
                        </form>
                    </div>
                </div>
            </div>
                
            </div>
        </section>


    </body>
    </html>