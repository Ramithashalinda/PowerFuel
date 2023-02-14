<?php

    require_once('../include/connections.php');
    require_once('../include/functions.php');


function request_fuel(){

    $response = array();
    global $connection;
    $query = "SELECT * FROM request_fuel_dealer";
    $result = mysqli_query($connection, $query);
    


    // if records found 
    while($item = mysqli_fetch_array($result)){

        array_push ($response ,
        (object) array(
              'id' => $item['id'],
              'dealer' =>  $item['dealer'],
              'fuel' => $item['fuel'],
              'fuelType' => $item['fuel_type'],
              'qty' => $item['qty'],
              'requestDate' => $item['requet_date']
            )
        );

    }

    return $response;
}    


function getTotal_request(){

    global $connection;
    $query = "SELECT COUNT(status) FROM request_fuel_dealer WHERE status = 'Completed';";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1){
        
        while($row = mysqli_fetch_array($result)){

            $status_count = $row[0];
        }       
            
    }

    return (object)array(
        'value'=> $status_count
    );
}

function getTotal_Earningrequest(){

    global $connection;
    $query = "SELECT COUNT(status) FROM request_fuel_dealer WHERE status = 'Cancel';";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1){
        
        while($row = mysqli_fetch_array($result)){

            $status_count = $row[0];
        }       
            
    }

    return (object)array(
        'value'=> $status_count
    );
}


function get_monthlyEaning(){

    global $connection;
    $query = "SELECT SUM(price) FROM request_fuel_dealer WHERE MONTH(requet_date) = MONTH(CURRENT_DATE) AND YEAR(requet_date) = YEAR(CURRENT_DATE) AND status = 'Completed';";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1){
        
        while($row = mysqli_fetch_array($result)){

            $status_count = $row[0];
        }       
            
    }

    return (object)array(
        'value'=> $status_count
    );
}


function get_registeredDealers(){

    global $connection;
    $query = "SELECT COUNT(first_name) FROM user WHERE usertype = 'dealer';";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1){
        
        while($row = mysqli_fetch_array($result)){

            $status_count = $row[0];
        }       
            
    }

    return (object)array(
        'value'=> $status_count
    );
}


$response = (object)array();

switch ($_GET['data_type']) {
    case 'recentRequest':
       $response = request_fuel();
        break;

    case 'totalRequest':
        $response = getTotal_request();
        break;

    case 'totalRequest2':
        $response = getTotal_Earningrequest();
        break;

    case 'monthlyIncome':
        $response = get_monthlyEaning();
        break;

    case 'totalDealers':
        $response = get_registeredDealers();
        break;
    
    default:
        $response = (object)array();
        break;
}


echo json_encode($response);
   
?>




