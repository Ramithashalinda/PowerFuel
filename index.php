<?php session_start(); ?>

<?php require_once('include/connections.php'); ?>
<?php require_once('include/functions.php') ?>

<?php

// check for form submition (button eka press krada kiyala balanwa)

if(isset($_POST['submit'])){


// create array for display errors
$errors = array();

// check if the username and passeword has been enetered

if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1){

    $errors[] = "username is missing / invalid";

}

if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1){

    $errors[] = "password is missing / invalid";
    
}

    // check if there are any errors in the form
    if(empty($errors)){

            // save username and password into variables
            $email = mysqli_real_escape_string($connection, $_POST['email']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);
            $hashed_password = sha1($password);

            // prepare database query

            $query = "SELECT * FROM user WHERE email = '{$email}' AND password = '{$hashed_password}' LIMIT 1 ";

            $result_set = mysqli_query($connection, $query);

                verify_query($result_set);

                // query successfull
                
                // if records found ( check if the user is valid)
                if(mysqli_num_rows($result_set) == 1){

                    // valid user found (if valid user found page riderect to users.php)
                    $user = mysqli_fetch_assoc($result_set);
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['first_name'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_last_name'] = $user['last_name'];
                    $_SESSION['user_type'] = $user['usertype'];
                    $_SESSION['dealer_st_id'] = $user['station_id'];

                    // updating last login
                    $query = "UPDATE user SET last_login = NOW() WHERE id = {$_SESSION['user_id']} LIMIT 1";

                    $result_set = mysqli_query($connection, $query);

                    // used check if query is success or not, we used verify_query function in include folder
                    verify_query($result_set);      
                    
                    
                    if($user['usertype'] == 'customer'){
                        // redirect to users.php    
                        header('Location: users.php');

                    }else if($user['usertype'] == 'admin'){
                        // redirect to admin.php
                        header('Location: admin.php');
                    }else if($user['usertype'] == 'dealer'){
                        
                        header('Location: dealer.php');
                    }

                    

                }
                else{
                    // if not display the error
                    // user name and paswowrd invalid
                    $errors[] = "invalid user....!";
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
    <title>Log in - Power Fuel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<section id="login-section" style="height: 100vh;">
        <div class="container">
            <div class="row justify-content-center py-5 mt-5">
                <div class="col col-12 col-md-6">
                    <form action="index.php" method="POST" class="d-lg-flex flex-column justify-content-center" style="padding: 40px;background: #ffffff;box-shadow: 0px 0px 1px rgb(84,84,84);">
                    

                    <?php
                        if (isset($errors) && !empty($errors)) {
                            
                            echo ' <p class="error_message">invalid user name or password</p>';
                        }
                    ?>

                    <?php

                        if(isset($_GET['logout'])){

                            echo ' <p class="info">successfully logged out</p>';
                        } else if(isset($_GET['invalidCredential'])){
                            echo ' <p class="credentials">You do not have an access for that!</p>';
                        }
                    ?>


                        <h1 class="login-heading">POWER FUEL</h1>
                        <p class="login-para">Sign in to&nbsp; continue.</p>
                        <div class="form-group"><input class="form-control" type="email" name="email" placeholder="email" required></div>
                        <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password" required></div>
                        
                        <div class="form-group"><button class="btn btn-primary btn-block btn-login" name="submit" type="submit">&nbsp; Sign in</button></div>
                        
                        <div class="form-group text-center"><a class="create-account-link" href="register.php">Don't have an account? create</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<?php mysqli_close($connection); ?>