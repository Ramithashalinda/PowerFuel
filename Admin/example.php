<?php

    require_once('../include/connections.php');
    require_once('../include/functions.php');

    $query = "SELECT * FROM request_fuel_dealer";
    $result = mysqli_query($connection, $query);
    // $value = mysqli_fetch_assoc($result);  
    
        while($row = mysqli_fetch_array($result)){

            $id = $row['id'];
            $dealer =  $row['dealer'];
            $fuel = $row['fuel'];
            $fuelType = $row['fuel_type'];
            $qty = $row['qty'];
            $requestDate = $row['requet_date'];
            $status = $row['status'];

?>

<tr>
    <td style="font-size: 12px;"><?php echo $id; ?></td>
    <td style="font-size: 12px;"><?php echo $dealer; ?></td>
    <td style="font-size: 12px;"><?php echo $fuel; ?></td>
    <td style="font-size: 12px;"><?php echo $fuelType; ?></td>
    <td style="font-size: 12px;"><?php echo $qty; ?></td>
    <td style="font-size: 12px;"><?php echo $requestDate; ?></td>
    <td style="font-size: 12px;"><?php echo $status; ?></td>
    <td style="font-size: 12px;">
    <a href="#" class="btn btn-info btn-sm btn-icon-split" data-toggle="modal" data-target="#statusChangeModal">
        <span class="icon text-white-50">
        <i class="fas fa-info-circle"></i>
        </span><span class="text">change status</span>
    </a></td>
</tr>

<?php } ?>

