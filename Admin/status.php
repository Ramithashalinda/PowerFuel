<?php 

require_once('../include/connections.php'); 

$user_id = $_GET['data_type'];


if(isset($_GET['data_type']) || $user_id != ""){

    $query = "SELECT * FROM request_fuel_dealer";
    $result = mysqli_query($connection, $query);

    if(mysqli_num_rows($result) > 0){

        while($item = mysqli_fetch_array($result)){

            $delear_id = $item['id'];
            $dealer =  $item['dealer'];
            $fuel = $item['fuel'];
            $fuelType = $item['fuel_type'];
            $qty = $item['qty'];
            $requestDate = $item['requet_date'];
            $status = $item['status'];
   
        }

    }

    

    $result_set = (object)array("delear_id"=>"$delear_id","dealer"=> "$dealer", "fuel" => "$fuel", "fuelType" => "$fuelType", "qty" => "$qty", "requestDate" => "$requestDate", "status" => "$status");
    $myjson = json_encode($result_set);
    echo $myjson;

}


?>