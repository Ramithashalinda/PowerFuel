<?php

require_once('../include/connections.php');
require_once('emailService.php');


function generatePassword($length = 8) {
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < $length; $i++) {
        $index = rand(0, $count - 1);
        $result .= mb_substr($chars, $index, 1);
    }

    return $result;
}

// $erros = array();


if(isset($_POST['submit'])){

    $req_fileds = array('firstName','lastName','email','address','telephone','stationId');

    foreach ($req_fileds as $field) {

        if(empty(trim($_POST[$field]))){

                $head = "HTTP/1.1 400 Bad Request";
                header($head, true, 400);    
                header("Connection: Close");
                echo json_encode(array("error"=>ucfirst(preg_replace('/(?:[a-z]|[A-Z]+)\K(?=[A-Z]|\d+)/',' ',$field))." is required"));
                die();
            }
        
    }


    // add enetred values to variable when submit button cliked
    $first_name = $_POST['firstName'];
    $last_name =  $_POST['lastName'];
    $email =  $_POST['email'];
    $address = $_POST['address'];
    $contact = $_POST['telephone'];
    $station_id = $_POST['stationId'];
    $user_type = $_POST['usertype'];


    


    // checking if email address is already exist in database (alredy used for register that mail)
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $query = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";

    $result_set = mysqli_query($connection, $query);

    if($result_set){
        if(mysqli_num_rows($result_set) == 1){

            // if record found it means mail is alredy exist so we shold display error
            $head = "HTTP/1.1 400 Bad Request";
            header($head, true, 400);    
            header("Connection: Close");
            echo json_encode(array("error"=>"email already exist"));
            die();
        }
    }

    // if(empty($erros)){

        // no error found . adding new record 

        // field sanitize (email address is already sanitize above)
        $first_name = mysqli_real_escape_string($connection, $_POST['firstName']);
        $last_name = mysqli_real_escape_string($connection, $_POST['lastName']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $contact = mysqli_real_escape_string($connection, $_POST['telephone']);
        $station_id = mysqli_real_escape_string($connection, $_POST['stationId']);
        $user_type = mysqli_real_escape_string($connection, $_POST['usertype']);

        $password = generatePassword();

        // to encrypt the password
        $hashed_password = sha1($password);

        $query = "INSERT INTO user (first_name, last_name, email, password, address, contact_number, usertype, station_id, is_deleted) VALUES ('{$first_name}','{$last_name}','{$email}','{$hashed_password}','{$address}','{$contact}','{$user_type}','{$station_id}', 0)";

        $result = mysqli_query($connection, $query);

        if($result){ 

            
            dealerRegisterEmail($_POST['email'], $_POST['firstName'], $_POST['email'], $password);
            // $query = "SELECT email FROM user WHERE station_id = '{$_POST['stationId']}'";
            // $result = mysqli_query($connection, $query);

            // if(mysqli_num_rows($result) == 1){

            //     foreach ($result as $row) {

            //         $dealer_email = $row['email'];
            //     }
            //     // statusChangeMail($dealer_email, $chagedStatus);
            //     // statusChangeEmail($dealer_email, );
            //     dealerRegisterEmail($dealer_email, $first_name, $email, $password);
            // }  

            // header('Location: ../blank.php?dealer_added=true');
            echo json_encode(array("success"=>"Registration Successfull."));

           
        
        }else{

            // $erros[] = 'Failed to add new record';
            // echo 'filed';

            $erros=mysqli_error($connection);
            echo json_encode(array("success"=>$erros));
        }


    // }



}






?>