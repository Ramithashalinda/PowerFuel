<?php require_once('include/connections.php'); 
 session_start();


    $user_id = $_GET['user_id'];

    // $user_id = $_POST['myselect'];

    if($user_id != ""){

        $query = "SELECT * FROM user WHERE id = '{$user_id}'";

        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) == 1){

            $user = mysqli_fetch_assoc($result);

            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
        }

        $result_set = (object)array("firstName"=>"$first_name","lastName"=> "$last_name");
        $myjson = json_encode($result_set);
        echo $myjson;
    }

    // $result_set =(object)array("userid" => "$user_id");
    // $myjson = json_encode($result_set);
    // echo $myjson;


