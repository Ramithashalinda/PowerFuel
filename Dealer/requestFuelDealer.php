<?php require_once('../include/connections.php');

if(isset($_POST['fuel']) && isset($_POST['fuel_cat']) && isset($_POST['qty']) && isset($_POST['price']) && isset($_POST['date']) && isset($_POST['stationId']) && isset($_POST['dealer_name'])){


    $query = "INSERT INTO  request_fuel_dealer(dealer, fuel, fuel_type, qty, price, requet_date, station_id) VALUES ('{$_POST['dealer_name']}', '{$_POST['fuel']}', '{$_POST['fuel_cat']}', '{$_POST['qty']}', '{$_POST['price']}', '{$_POST['date']}', '{$_POST['stationId']}') ";  
    $result = mysqli_query($connection, $query); 

    if($result){

        echo "it works";
        

    }else{

        echo "it didn't works";
    }

}


?>