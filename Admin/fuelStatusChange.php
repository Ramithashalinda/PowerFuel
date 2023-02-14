<?php session_start();

require_once('../include/connections.php');
include('emailService.php');


// status edit
if(isset($_POST['checking_editbtn'])){

    $dealer_id = $_POST['dealer_id'];
    // echo $return = $dealer_id;
    $result_array = [];

    $query = "SELECT * FROM request_fuel_dealer WHERE id = '{$dealer_id}'";  
    $result = mysqli_query($connection, $query); 

    if (mysqli_num_rows($result) > 0){

        foreach ($result as $row) {
                
            $dealer_status = $row['status'];

            array_push($result_array, $row);
            header('Content-type: application/json');
            echo json_encode($result_array);
        }
            
    }else{

        echo $return = "<h5>Record Not Found!</h5>";
    }

}


// update status (form submitting)

// if(isset($_POST['updateStatus'])){

    
//     $changed_status = $_POST['fuelStatusChange']; 
//     $dealer_id = $_POST['dealer_id'];
//     $id = $_POST['station_id'];
//     // $station_id = $_POST['station_id'];
//     //$email = "matheesha.ama@gmail.com"; // for sent email

//     $query = "UPDATE  request_fuel_dealer SET status = '{$changed_status}' WHERE id = '{$dealer_id}'";  
//     $result = mysqli_query($connection, $query); 

//     if ($result) {
          
        
//             $query_two = "SELECT email FROM dealers WHERE station_id = '{$id}'";
//             $result_two = mysqli_query($connection, $query_two);
    
//             if($result_two){
               
//                 foreach ($result_two as $rows) {
    
//                     $dealer_email = $rows['email'];
//                 }
    
//                 // statusChangeMail($dealer_email, $chagedStatus);

//                 statusChangeEmail($dealer_email, $changed_status);

//                 $_SESSION['status'] = "Status Changed Successfully!";
            
//                 header("Location: ../buttons.php?test=yes");

//             }

//     } else {

//         $_SESSION['status'] = "Something Wrong!";
//         header('Location: ../buttons.php');
//     }
    
// }



// update dealer fuel status

if(isset($_POST['dealer_id']) && isset($_POST['station_id']) && isset($_POST['changed_status'])){

    $query = "UPDATE  request_fuel_dealer SET status = '{$_POST['changed_status']}' WHERE id = '{$_POST['dealer_id']}'";  
    $result = mysqli_query($connection, $query); 

    if($result){

        echo "it works";

            $query = "SELECT email FROM user WHERE station_id = '{$_POST['station_id']}'";
            $result = mysqli_query($connection, $query);

            if(mysqli_num_rows($result) == 1){

                foreach ($result as $row) {

                    $dealer_email = $row['email'];
                }
                // statusChangeMail($dealer_email, $chagedStatus);
                statusChangeEmail($dealer_email, $_POST['changed_status']);
            }   
        
    }else{
        echo "it didn't works";
    }
}



?>